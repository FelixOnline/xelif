<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\Controller;
use A17\Twill\Repositories\MediaRepository;
use App\Models\Article;
use App\Repositories\IssueRepository;
use App\Repositories\SectionRepository;
use DOMNode;
use Illuminate\Config\Repository as Config;
use Illuminate\Container\Container;
use Illuminate\Contracts\Filesystem\Factory as FilesystemFactory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class ArticleUploadController extends Controller
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var mixed
     */
    private $mediaRepository;

    public function __construct(
        Config $config
    ) {
        parent::__construct();
        $this->config = $config;
        $this->mediaRepository = App::make(MediaRepository::class);
    }

    public function show()
    {
        return view('admin.uploader.uploader', [
            'saveUrl' => '/' . Route::getCurrentRoute()->uri() . '/save',
            'issues' => app()->make(IssueRepository::class)->listAll('issue')->sortDesc(),
            'sections' => app()->make(SectionRepository::class)->listAll(),
        ]);
    }

    public function save(Request $request)
    {
        $path = $request->file('word-file')->getPathname();
        $media_dir = sys_get_temp_dir() . '/xelif_uploaded_docx_media' . mt_rand();
        mkdir($media_dir);
        $html = shell_exec("pandoc --extract-media=$media_dir -f docx -t html $path");
        $doc = new \DOMDocument();
        $doc->loadHTML($html);

        $article = new Article([
            'published' => false,
            'headline' => $request->input('headline'),
            'lede' => '',
            'position' => 0,
            'issue_id' => $request->input('issue')
        ]);
        $article->save();

        $article->blocks()->create([
            'blockable_id' => $article->id,
            'blockable_type' => 'articles',
            'position' => 1,
            'content' => ["html" => $html],
            'type' => 'text'
        ]);

        $imgs = self::imgs($doc);
        foreach ($imgs as $img) {
            $media = $this->storeFile(basename($img), $img);
//            $article->blocks()->create([
//                'blockable_id' => $article->id,
//                'blockable_type' => 'articles',
//                'content' => [],
//                'position' => 1,
//                'type' => 'image'
//            ])->medias()->attach($media, ['metadatas'=>'']);
        }

        return redirect(route('admin.articles.edit', ['article' => $article->id]));
    }

    private static function imgs(DOMNode $root): array
    {
        if ($root->nodeName === "img") {
            return [$root->attributes->getNamedItem('src')->nodeValue];
        } else {
            return collect($root->childNodes)->flatMap(function ($node) {
                return self::imgs($node);
            })->toArray();
        }
    }

    private function storeFile($originalFilename, string $file)
    {
        $filename = sanitizeFilename($originalFilename);

        $fileDirectory = Uuid::uuid4()->toString();

        $uuid = $fileDirectory . '/' . $filename;

        if ($this->config->get('twill.media_library.prefix_uuid_with_local_path', false)) {
            $prefix = trim($this->config->get('twill.media_library.local_path'), '/ ') . '/';
            $fileDirectory = $prefix . $fileDirectory;
            $uuid = $prefix . $uuid;
        }

        $disk = $this->config->get('twill.media_library.disk');

        Container::getInstance()->make(FilesystemFactory::class)->disk($disk)->putFileAs(
            $fileDirectory,
            $file,
            $filename
        );

        $filePath = Storage::disk($disk)->path($fileDirectory . '/' . $filename);

        list($w, $h) = getimagesize($filePath);

        $fields = [
            'uuid' => $uuid,
            'filename' => $originalFilename,
            'width' => $w,
            'height' => $h,
        ];

        return $this->mediaRepository->create($fields);
    }

}