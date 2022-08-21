<?php

namespace App\Http\Controllers;

use App\Repositories\StatisticRepository;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * @var StatisticRepository
     */
    private StatisticRepository $statisticRepository;

    /**
     * @param StatisticRepository $statisticRepository
     */
    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $topUsers = $this->statisticRepository->getTopUsers();

        return view('statistic.index')->with([
            'topUsers' => $topUsers
        ]);
    }
}
