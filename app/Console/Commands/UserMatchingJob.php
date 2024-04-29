<?php

namespace App\Console\Commands;

use App\Http\Traits\CalculateUserMatchingJob;
use App\Models\Job;
use Illuminate\Console\Command;

class UserMatchingJob extends Command
{
    use CalculateUserMatchingJob;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:matching {--user_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user then add job matching.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appUserId = $this->option('user_id');

        if ($appUserId != null && $appUserId != '') {
            $jobs = Job::where(['status' => 1])->get()->toArray();
            foreach ($jobs as $value) {
                $this->saveJobMatch($value['id'], $appUserId);
            }
        }
    }
}
