{{-- COMPONENTE PARA LA CREACIÓN DE UN NUEVO PROYECTO A TRAVÉS DE UN FORMULARIO; /proyecto/nuevo --}}
@extends('navigation')

{{-- NAVEGACION --}}
@section('navbar')
    <li class="mr-2">
        <a href={{ route('/') }} class="text-gray-400 hover:text-gray-600 font-medium">Proyectos</a>
    </li>
    <li class="text-gray-600 mr-2 font-medium">/</li>
    <li class="text-gray-600 mr-2 font-medium">Nuevo</li>
@endsection

{{-- FORMULARIO --}}
@section('content')
    <form action="{{ route('addProject') }}" method="POST" class="form">
        @csrf
        <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
            <div class="container max-w-screen-lg mx-auto">
                <div>
                    <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3" id="parentDiv">
                            <div class="text-gray-600">
                                <p class="font-medium text-lg">Nuevo proyecto</p>
                            </div>

                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                                    {{-- NOMBRE --}}
                                    <div class="md:col-span-5">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name"
                                            class="h-10 border mt-1 rounded px-4 w-full bg-gray-50"
                                            value="{{ old('name') }}" required />
                                        @error('name')
                                            <div class="alert alert-danger text-red-700">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-5 text-right" id="buttons">
                                        <div class="inline-flex items-end">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear
                                                proyecto</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
@endsection
