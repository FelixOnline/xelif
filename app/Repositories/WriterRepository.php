<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Writer;
use App\Http\Controllers\IssueController;

class WriterRepository extends ModuleRepository
{
    use HandleSlugs, HandleMedias;

    public function __construct(Writer $model)
    {
        $this->model = $model;
    }

    public function afterSave($object, $fields)
    {
        IssueController::clearCacheAllIssues();
    }
}
