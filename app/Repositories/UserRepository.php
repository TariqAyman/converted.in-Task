<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllAdmin()
    {
        return $this->model::query()->where('user_type', 'admin')->get();
    }

    public function getAllUser()
    {
        return $this->model::query()->where('user_type', 'user')->get();
    }

    public function getStatistic()
    {
        return $this->model::query()
            ->where('users.user_type', 'user')
            ->join('tasks', 'tasks.assigned_to_id', '=', 'users.id',)
            ->select(['users.id as user_id', DB::raw('count(tasks.id) as count')])
            ->groupBy('users.id')
            ->get()
            ->toArray();
    }
}
