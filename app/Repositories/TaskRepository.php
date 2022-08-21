<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class TaskRepository extends BaseRepository
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }
}
