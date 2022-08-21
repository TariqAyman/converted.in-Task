<?php

namespace App\Repositories;

use App\Models\Statistic;

use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Support\Facades\DB;

class StatisticRepository extends BaseRepository
{
    /**
     * @param Statistic $model
     */
    public function __construct(Statistic $model)
    {
        parent::__construct($model);
    }

    public function saveStatistic($data)
    {
        $this->model::query()->upsert($data, ['user_id'], ['count']);
    }

    public function getTopUsers()
    {
        return $this->model::query()
            ->orderByDesc('count')
            ->limit(10)
            ->get();
    }
}
