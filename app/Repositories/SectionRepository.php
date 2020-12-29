<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Section;
use App\Http\Controllers\IssueController;

class SectionRepository extends ModuleRepository
{
    use HandleSlugs;

    public function __construct(Section $model)
    {
        $this->model = $model;
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);

        $fields['browsers']['writers'] = $this->getFormFieldsForBrowser($object, 'writers', null, 'name');

        return $fields;
    }

    public function afterSave($object, $fields)
    {
        parent::afterSave($object, $fields);
        $this->updateBrowser($object, $fields, 'writers');
        $object->save();

        IssueController::clearCacheAllIssues();
    }
}
