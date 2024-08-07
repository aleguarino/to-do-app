{{-- VARIABLES --}}
@php
    use App\Http\Controllers\TaskController;
    use App\Enums\TaskStatusEnum;

    if (isset($type)) {
        switch ($type) {
            case TaskStatusEnum::PENDING:
                $title = 'Tareas pendientes';
                $tasks = TaskController::listPendingTasks();
                break;
            case TaskStatusEnum::COMPLETED:
                $title = 'Tareas completadas';
                $tasks = TaskController::listCompletedTasks();
                break;
            case TaskStatusEnum::CANCELED:
                $title = 'Tareas canceladas';
                $tasks = TaskController::listCanceledTasks();
                break;
            case TaskStatusEnum::OVERDUE:
                $title = 'Tareas vencidas';
                $tasks = TaskController::listOverduesTasks();
                break;
            default:
                $title = 'Tareas';
                $tasks = $tasks = TaskController::listTaks();
        }
    }
    $totalTasks = TaskController::countTotalTasks();

@endphp

{{-- TARJETA --}}
<div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
    <div class="flex justify-between mb-6">
        <div>
            <div class="text-2xl font-semibold mb-1">{{ count($tasks) }}</div>
            <div class="text-sm font-medium text-gray-400">{{ $title }}</div>
        </div>
    </div>
    {{-- BARRA DE PROGRESO --}}
    @if (count($tasks) > 0)
        <div class="flex items-center">
            <div class="w-full bg-gray-100 rounded-full h-4">
                <div class="h-full bg-blue-500 rounded-full p-1"
                    style="width: {{ (count($tasks) / $totalTasks) * 100 }}%;">
                    <div class="w-2 h-2 rounded-full bg-white ml-auto"></div>
                </div>
            </div>
            <span class="text-sm font-medium text-gray-600 ml-4">{{ count($tasks) }}/{{ $totalTasks }}</span>
        </div>
    @endif
</div>
