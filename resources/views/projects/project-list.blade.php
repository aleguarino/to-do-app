{{-- COMPONENTE USADO EN EL SIDEBAR; MUESTRA EL LISTADO DE PROYECTOS ASOCIADO AL USUARIO --}}
@php
    $user = auth()->user();
    $projects = $user->projects;
@endphp

@foreach ($projects as $project)
    <li class="mb-4">
        <a href="{{ route('showProyect', $project->id) }}"
            class="text-gray-300 text-sm flex items-center hover:text-gray-100">{{ $project->name }}</a>
    </li>
@endforeach
