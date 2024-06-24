<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\TaskStatusEnum;
use App\Enums\TaskPriorityEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'tasks';
    protected $casts = ['status' => TaskStatusEnum::class, 'priority' => TaskPriorityEnum::class];

    public static function getAllTasks()
    {
        return Task::all();
    }


    public function add($assigned_to, $title, $description,  $status, $deadline, $priority)
    {
        $task = new Task();
        $task->assigned_to = $assigned_to;
        $task->title = $title;
        $task->description = $description;
        $task->status = $status;
        $task->deadline = $deadline;
        $task->priority = $priority;
        $task->save();
    }

    public function updateTask($id, $title, $description, $status, $deadline, $priority)
    {
        $task = Task::find($id);
        if (!isset($task))
            return "Tarea no encontrada";
        $task->title = $title;
        $task->description = $description;
        $task->status = $status;
        $task->deadline = $deadline;
        $task->priority = $priority;
        $task->save();
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);
        if (!isset($task))
            return "Tarea no encontrada";
        $task->delete();
    }

    public function isExpired()
    {
        return $this->status === TaskStatusEnum::PENDING && Carbon::now()->isAfter($this->deadline);
    }

    public function markAsExpired()
    {
        if ($this->isExpired()) {
            $this->status = TaskStatusEnum::OVERDUE;
            $this->save();
        }
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class);
    }
}
