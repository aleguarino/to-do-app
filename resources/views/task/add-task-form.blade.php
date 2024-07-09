{{-- MUESTRA EL FORMULARIO DE AGREGACIÓN DE TAREA; /proyecto/nuevo; /tarea/nueva --}}
@extends('navigation')

{{-- NAVEGACION --}}
@section('navbar')
    @if (!isset($project))
        <li class="mr-2">
            <a href={{ route('/') }} class="text-gray-400 hover:text-gray-600 font-medium">Tareas</a>
        </li>
    @else
        <li class="mr-2">
            <a href={{ route('showProyect', $project->id) }}
                class="text-gray-400 hover:text-gray-600 font-medium">{{ $project->name }}</a>
        </li>
    @endif

    <li class="text-gray-600 mr-2 font-medium">/</li>
    <li class="text-gray-600 mr-2 font-medium">Nueva tarea</li>
@endsection

{{-- FORMULARIO --}}
@section('content')
    <form action="{{ route('addTask') }}" method="POST" class="form">
        @csrf
        @if (isset($project))
            <input type="text" hidden name="project" value="{{ $project->id }}" />
        @endif
        <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
            <div class="container max-w-screen-lg mx-auto">
                <div>
                    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Nueva tarea</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                                    {{-- TITULO --}}
                                    <div class="md:col-span-5">
                                        <label for="title">Título</label>
                                        <input type="text" name="title" id="title"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ old('title') }}" required />
                                        @error('title')
                                            <div class="alert alert-danger text-red-700">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- DESCRIPCION --}}
                                    <div class="md:col-span-5">
                                        <label for="description">Descripción</label>
                                        <textarea name="description" id=description" class="h-20 border mt-1 rounded px-4 w-full bg-gray-50" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger text-red-700">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- FECHA DE VENCIMIENTO --}}
                                    <div class="md:col-span-5">
                                        <label for="deadline">Fecha de vencimiento</label>
                                        <input type="date" name="deadline" id="deadline"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ old('deadline') }}" required />
                                        @error('deadline')
                                            <div class="alert alert-danger text-red-700">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- PRIORIDAD --}}
                                    <div class="md:col-span-5 gap-5">
                                        <p>Prioridad</p>

                                        <label for="priority-low"
                                            class="relative flex flex-col bg-white p-5 rounded-lg shadow-md cursor-pointer mb-3 ">
                                            <span class="font-semibold text-gray-500 leading-tight uppercase">Baja</span>
                                            <input type="radio" name="priority" id="priority-low" value="Baja"
                                                class="absolute h-0 w-0 appearance-none" checked="checked" />
                                            <span aria-hidden="true"
                                                class="hidden absolute inset-0 border-2 border-green-500 bg-green-200 bg-opacity-10 rounded-lg">
                                                <span
                                                    class="absolute top-4 right-4 h-6 w-6 inline-flex items-center justify-center rounded-full bg-green-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="h-5 w-5 text-green-600">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <label for="priority-medium"
                                            class="relative flex flex-col bg-white p-5 rounded-lg shadow-md cursor-pointer mb-3">
                                            <span class="font-semibold text-gray-500 leading-tight uppercase">Media</span>
                                            <input type="radio" name="priority" id="priority-medium" value="Media"
                                                class="absolute h-0 w-0 appearance-none" />
                                            <span aria-hidden="true"
                                                class="hidden absolute inset-0 border-2 border-yellow-500 bg-yellow-200 bg-opacity-10 rounded-lg">
                                                <span
                                                    class="absolute top-4 right-4 h-6 w-6 inline-flex items-center justify-center rounded-full bg-yellow-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="h-5 w-5 text-yellow-600">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <label for="priority-high"
                                            class="relative flex flex-col bg-white p-5 rounded-lg shadow-md cursor-pointer mb-3">
                                            <span class="font-semibold text-gray-500 leading-tight uppercase">Alta</span>
                                            <input type="radio" name="priority" id="priority-high" value="Alta"
                                                class="absolute h-0 w-0 appearance-none" />
                                            <span aria-hidden="true"
                                                class="hidden absolute inset-0 border-2 border-orange-500 bg-orange-200 bg-opacity-10 rounded-lg">
                                                <span
                                                    class="absolute top-4 right-4 h-6 w-6 inline-flex items-center justify-center rounded-full bg-orange-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="h-5 w-5 text-orange-600">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>
                                        <label for="priority-urgent"
                                            class="relative flex flex-col bg-white p-5 rounded-lg shadow-md cursor-pointer">
                                            <span class="font-semibold text-gray-500 leading-tight uppercase">Urgente</span>
                                            <input type="radio" name="priority" id="priority-urgent" value="Urgente"
                                                class="absolute h-0 w-0 appearance-none" />
                                            <span aria-hidden="true"
                                                class="hidden absolute inset-0 border-2 border-red-500 bg-red-200 bg-opacity-10 rounded-lg">
                                                <span
                                                    class="absolute top-4 right-4 h-6 w-6 inline-flex items-center justify-center rounded-full bg-red-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="h-5 w-5 text-red-600">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </span>
                                        </label>

                                    </div>

                                    {{-- ASIGNAR USUARIO --}}
                                    @if (isset($project))
                                        <livewire:select-user />
                                    @endif

                                    <div class="md:col-span-5 text-right">
                                        <div class="inline-flex items-end">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
@endsection
@push('custom-scripts')
    <script>
        document.onkeydown = function() {
            if (event.keyCode == 13) {
                if (document.activeElement.tagName.toLowerCase() != "textarea") {
                    event.preventDefault();
                    return false;
                }
            }
        }
    </script>
@endpush
