{{-- COMPONENTE QUE MUESTRA LA INFORMACIÓN DE UN PROYECTO; /proyecto/{id} --}}
@extends('navigation')

@section('navbar')
    <li class="mr-2">
        <h3 class="font-medium">{{ $project->name }}</h3>
    </li>
@endsection

@if ($project->isAdmin(Auth::id()))
    @section('action-menu')
        <a href="{{ route('newTask', $project) }}"
            class="button bg-[#190b0f] hover:bg-gray-700 text-white cursor-pointer py-2 px-4 mx-5 rounded">Nueva
            tarea</a>
        <form action="{{ route('deleteProject', $project->id) }}" method="POST" class="form">
            @csrf
            <button type="submit"
                class="button bg-[#61332a] hover:bg-red-700 text-white cursor-pointer py-2 px-4 rounded">Borrar
                proyecto</button>
        </form>
    @endsection
@endif


@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-y-2 lg:gap-4">
        @include('projects.project-members')
        <div class="grid col-span-3 gap-4 content-start">
            @foreach ($project->tasks as $task)
                <livewire:card-project-task :$task :$project :key="$task->key">
            @endforeach
        </div>
    </div>

    @push('custom-scripts')
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
        <script>
            @if (session('success'))
                sendNotification(`{{ session('success') }}`);
            @endif
        </script>
    @endpush
@endsection
