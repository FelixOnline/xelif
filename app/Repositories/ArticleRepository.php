<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use Illuminate\Support\Facades\Cache;

use App\Models\Article;
use App\Models\Issue;
use App\Http\Controllers\IssueController;

class ArticleRepository extends ModuleRepository
{
    use HandleBlocks, HandleSlugs, HandleMedias, HandleRevisions;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    public function afterSave($object, $fields)
    {
        parent::afterSave($object, $fields);

        if (isset($fields['section_id']))
            $object->section_id = $fields['section_id'];

        if (isset($fields['issue_id']))
            $object->issue_id = $fields['issue_id'];

        $this->updateBrowser($object, $fields, 'writers');
        $object->save();

        IssueController::clearCache($object->issue_id);
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);

        $fields['browsers']['writers'] = $this->getFormFieldsForBrowser($object, 'writers', null, 'name');

        return $fields;
    }

    public function filter($query, $scopes = [])
    {
        if (isset($scopes['issue_id']) && $scopes['issue_id'] == -1)
        {
            unset($scopes['issue_id']);
            $query->where('issue_id', function($q)
            {
                $q->from('issues')->select('id')->orderBy('issue', 'DESC')->limit(1);
            });
        }
        else if (isset($scopes['issue_id']) && $scopes['issue_id'] == 0)
        {
            unset($scopes['issue_id']);
            $query->where('issue_id', null);
        }

        return parent::filter($query, $scopes);
    }

    public function getAdditionalArticles(\App\Models\Issue $priorToIssue,
                                            \App\Models\Section $section,
                                            $count)
    {
        $query = $this->model->newQuery();

        $query->whereHas('section', function($q) use ($section) {
            $q->where('id', $section->id);
        })->whereHas('issue', function($q) use ($priorToIssue) {
            $q->where('issue', '<', $priorToIssue->issue)
                ->published();
        })->published()->ordered()->limit($count);

        return $query->get();
    }
}
