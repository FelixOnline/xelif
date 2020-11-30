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

    /**
     * Annoyingly necessary because ModuleRepository->listAll() will ignore
     * the $orders parameter if the model is instanceof Sortable (why...)
     * Obviously if PHP was less bin programming language we'd just define a new
     * overload with a boolean flag but... alas...
     */
    public function listAllForceOrder($column, $orders = [])
    {
        $query = $this->model->newQuery();

        if (!empty($orders))
            $query = $this->order($query, $orders);

        if ($this->model->isTranslatable())
            $query = $query->withTranslation();

        return $query->get()->pluck($column, 'id');
    }
}
