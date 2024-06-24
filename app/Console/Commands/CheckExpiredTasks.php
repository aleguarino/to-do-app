<?php

namespace App\Console\Commands;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Console\Command;

class CheckExpiredTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update tasks that are expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('status', TaskStatusEnum::PENDING)->get();

        foreach ($tasks as $task) {
            $task->markAsExpired();
        }

        $this->info('Expired tasks have been updated successfully.');
    }
}
