<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Repositories\IssueRepository;
use App\Repositories\SectionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ArticleUploadController
{
    public function show() {
        return view('admin.uploader.uploader', [
            'saveUrl' => '/' . Route::getCurrentRoute()->uri() . '/save',
            'issues' => app()->make(IssueRepository::class)->listAll('issue')->sortDesc(),
            'sections' => app()->make(SectionRepository::class)->listAll(),
        ]);
    }

    public function save(Request $request) {
        $word = $request->file('word-file');

        $path = $word->getPathname();
        $html = shell_exec("pandoc -f docx -t html $path");

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
        return redirect(route('admin.articles.edit', ['article' => $article->id]));
    }
}