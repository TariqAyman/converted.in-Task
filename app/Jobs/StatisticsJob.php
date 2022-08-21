<?php

namespace App\Jobs;

use App\Models\User;
use App\Repositories\StatisticRepository;
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UserRepository $userRepository;
    private StatisticRepository $statisticRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, StatisticRepository $statisticRepository)
    {
        $this->userRepository = $userRepository;
        $this->statisticRepository = $statisticRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $statistics = $this->userRepository->getStatistic();

        $this->statisticRepository->saveStatistic($statistics);
    }
}
