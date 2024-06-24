@php
    $disabled = '';
    if ($task->status->value == 'Vencida') {
        $disabled = 'disabled';
    }
@endphp

<div id="{{ $task->id }}" wire:ignore
    class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md hidden task-info-container">
    <div class="flex justify-between mb-5">
        <div class="text-2xl font-bold mb-2">
            {{ $task->title }}
        </div>
        <div class="{{ $task->priority->bgColor() }}  text-sm font-bold px-2 py-1 rounded-md mb-4 self-start">
            {{ $task->priority }}
        </div>

    </div>
    <form class="w-full max-w-lg" wire:submit.prevent="updateTask" method="POST">
        @csrf
        <input type="text" value="{{ $task->id }}" name="id" wire:model="id" class="hidden" />
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-title">
                    Título
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-title" name="title" type="text" value="{{ $task->title }}" wire:model="title"
                    required {{ $disabled }}>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-description">
                    Descripción
                </label>
                <textarea rows="8"
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="description" id="grid-description" name="description" required {{ $disabled }}>{{ $task->description }}</textarea>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-deadline">
                    Fecha vencimiento
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="deadline" id="grid-deadline" type="date" required value="{{ $task->deadline }}"
                    {{ $disabled }}>
                @error('deadline')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-status">
                    Estado
                </label>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="status" id="grid-status" name="status" required
                    @if ($task->status->value == 'Vencida') disabled><option>Vencida</option>
                    @else
                        ><option @if ($task->status->value == 'Pendiente') selected @endif>Pendiente
                    </option>
                    <option @if ($task->status->value == 'Cancelado') selected @endif>Cancelado</option>
                    <option @if ($task->status->value == 'Completada') selected @endif>Completada</option>
                    @endif

                </select>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-priority">
                    Prioridad
                </label>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    wire:model="priority" id="grid-priority" name="priority" {{ $disabled }} required>

                    <option @if ($task->priority->value == 'Baja') selected @endif>Baja</option>
                    <option @if ($task->priority->value == 'Media') selected @endif>Media</option>
                    <option @if ($task->priority->value == 'Alta') selected @endif>Alta</option>
                    <option @if ($task->priority->value == 'Urgente') selected @endif>Urgente</option>

                </select>
            </div>
        </div>
        @if ($task->status->value != 'Vencida')
            <div class="md:col-span-5 text-right">
                <div>
                    <input type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-10 cursor-pointer"
                        value="Actualizar" />
                </div>
            </div>
        @endif

    </form>
</div>
