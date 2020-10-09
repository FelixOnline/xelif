<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Article;

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
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);

        $fields['browsers']['writers'] = $this->getFormFieldsForBrowser($object, 'writers', null, 'name');

        return $fields;
    }
}
