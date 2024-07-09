<?php

namespace App\Models;

use Carbon\Carbon;
use App\Enums\TaskStatusEnum;
use App\Enums\ProjectUserRole;
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

    public function add($user_id, $title, $description,  $status, $deadline, $priority, $project)
    {
        $task = new Task();
        $task->user_id = $user_id;
        $task->title = $title;
        $task->description = $description;
        $task->status = $status;
        $task->deadline = $deadline;
        $task->priority = $priority;
        $task->project_id = $project;
        $task->save();


        // VERIFICA SI YA EXISTE EN LA TABLA INTERMEDIA PARA NO SISTITUIR EL VALOR
        $projectObj = Project::find($project);
        $existingRole = $projectObj->users()->where('user_id', $user_id)->first();

        if (!$existingRole) {
            // ENLAZA EL PROYECTO CON EL USUARIO EN LA TABLA INTERMEDIA CON EL ROLE PREDETERMINADO
            $projectObj->users()->attach($user_id, ['role' => ProjectUserRole::DEVELOPER]);
        }
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

    public function markAsCompleted()
    {
        $this->status = TaskStatusEnum::COMPLETED;
        $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
