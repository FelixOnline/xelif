<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleRepeaters;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Issue;

class IssueRepository extends ModuleRepository
{
    use HandleSlugs;

    public function __construct(Issue $model)
    {
        $this->model = $model;
    }

    public function afterSave($object, $fields)
    {
        $this->updateRepeater($object, $fields, 'article', 'Article');
        parent::afterSave($object, $fields);
    }

    public function getFormFields($object)
    {
        return parent::getFormFields($object);
    }
}
