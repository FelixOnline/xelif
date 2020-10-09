<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Article;

class SectionController extends Controller
{
    protected $settingsController;

    protected $articlesPerPage = 16;

    public function __construct(SettingsController $settings)
    {
        $this->settingsController = $settings;
    }

    public function show($sectionSlug, $page = null)
    {
        $section = Section::forSlug($sectionSlug)->firstOrFail();

        $numPages = (int) ceil($this->getArticleCount($section) / $this->articlesPerPage);

        return view('layouts.section', [
            'section' => $section,
            'sections' => Section::current()->get(),
            'aboutSection' => Section::forSlug('about')->first(),
            'articles' => $this->getArticles($section, $page),
            'page' => $page ?? 1,
            'numPages' => $numPages,
            'look' => $this->settingsController->lookAndFeel(),
        ]);
    }

    protected function getArticles(Section $section, $page)
    {
        $articles = $this->getArticlesQueryStub($section);

        if ($page)
            $articles->offset(($page - 1) * $this->articlesPerPage);

        return $articles->limit($this->articlesPerPage)->get();
    }

    protected function getArticlesQueryStub(Section $section)
    {
        return Article::where('section_id', $section->id)
                        ->scopes(['published', 'visible']);
    }

    protected function getArticleCount(Section $section)
    {
        $section->loadCount('articles');
        return $section->articles_count;
    }
}
