<?php

namespace App\Repositories;


use A17\Twill\Repositories\ModuleRepository;
use App\Models\PuzzleTeam;

class PuzzleTeamRepository extends ModuleRepository
{
    

    public function __construct(PuzzleTeam $model)
    {
        $this->model = $model;
    }
}
