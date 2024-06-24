<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public static function countTotalTasks(): int
    {
        return Task::count();
    }

    public static function listTaks(): Collection
    {
        return Task::all();
    }

    public static function listPendingTasks(): Collection
    {
        return Task::where('status', TaskStatusEnum::PENDING)->get();
    }

    public static function listCompletedTasks(): Collection
    {
        return Task::where('status', TaskStatusEnum::COMPLETED)->get();
    }

    public static function listCanceledTasks(): Collection
    {
        return Task::where('status', TaskStatusEnum::CANCELED)->get();
    }

    public static function listOverduesTasks(): Collection
    {
        return Task::where('status', TaskStatusEnum::OVERDUE)->get();
    }

    public function addTask(Request $request)
    {
        $messages = [
            'after'    => 'La fecha de vencimiento debe ser mayor a la fecha actual',
        ];

        $validatedData = $request->validate([
            'deadline' => 'required|date|after:today',
        ], $messages);
        $user = Auth::user()->id;
        $title = $request->input('title');
        $description = $request->input('description');
        $deadline = $request->input('deadline');
        $priority = $request->input('priority');
        $this->task->add($user, $title, $description, TaskStatusEnum::PENDING, $deadline, $priority);
        return redirect('/')->with('success', 'Tarea creada con éxito');
    }

    public function editTask(Request $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $deadline = $request->input('deadline');
        $priority = $request->input('priority');
        $this->task->updateTask($request->input('id'), $title, $description, TaskStatusEnum::PENDING, $deadline, $priority);
        return redirect()->route('/');
    }

    public function deleteTask(Request $request)
    {
        if (isset($_POST['delete'])) {
            $id = $request->input('id');
            $this->task->deleteTask($id);
        }
        return redirect()->route('/');
    }
}
