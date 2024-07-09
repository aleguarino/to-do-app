@extends('navigation')

@section('navbar')
    <li class="mr-2">
        <a href={{ route('/') }} class="hover:text-gray-600 font-medium">Tareas</a>
    </li>
@endsection

@section('content')
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            @include('task.progress-task-card', ['type' => App\Enums\TaskStatusEnum::PENDING])
            @include('task.progress-task-card', ['type' => App\Enums\TaskStatusEnum::COMPLETED])
            @include('task.progress-task-card', ['type' => App\Enums\TaskStatusEnum::CANCELED])
            @include('task.progress-task-card', ['type' => App\Enums\TaskStatusEnum::OVERDUE])
        </div>

        <livewire:user-tasks />



    </div>
    @push('custom-scripts')
        <script>
            @if (session('success'))
                sendNotification(`{{ session('success') }}`);
            @endif
        </script>
    @endpush
@endsection
