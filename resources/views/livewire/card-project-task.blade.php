{{-- COMPONENTE QUE MUESTRA UNA TARJETA PARA CADA TAREA CON PROYECTO --}}
@php
    use Carbon\Carbon;
@endphp
{{-- <div class="dropdown">
    <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
            class="ri-more-fill"></i></button>
    <ul
        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
        <li>
            <a href="{{ route('newTask') }}"
                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Nueva
                tarea</a>
        </li>
        <li>
            <a href="#"
                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Settings</a>
        </li>
        <li>
            <a href="#"
                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Logout</a>
        </li>
    </ul>
</div> --}}
<div class="shadow-md border border-gray-100 shadow-black/5 rounded-md p-4 bg-white min-h-64 overflow-auto">
    <div class="flex items-center border-b-2 mb-2 py-2">

        <img class="w-10 h-10 object-cover rounded-full" src="{{ $task->user->getImagePath($task->user->id) }}"
            alt="{{ strtoupper($task->user->name[0]) }}">
        <div class="pl-3 flex-1 place-items-end w-auto ">
            <div class="flex justify-between">
                <div>
                    <div class="font-medium px-2">
                        {{ $task->user->name }}
                    </div>

                </div>
                {{-- MENÚ EDICIÓN --}}
                <div
                    class="dropdown mr-4
                    @if (!($task->user->id == auth()->id() || $project->isAdmin(auth()->id()))) hidden @endif
                    ">
                    <button type="button" class="dropdown-toggle "><i class="ri-more-fill"></i></button>
                    <ul
                        class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <span
                                class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50 cursor-pointer"
                                wire:click="completeTask()">Completar</span>
                        </li>
                        <li>
                            <span
                                class="edit-btn flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50 cursor-pointer">Editar</span>
                        </li>
                        @if ($project->isAdmin(auth()->id()))
                            <li>
                                <button
                                    class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50 cursor-pointer"
                                    wire:confirm="¿Está seguro?" wire:click="deleteTask()">Borrar</button>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="{{ $task->priority->bgColor() }} flex-1 text-sm font-bold px-2 py-1 rounded-md ">
                Prioridad {{ $task->priority }}
            </div>

        </div>
    </div>
    <div class="w-full">
        <p class="text-gray-800 text-sm font-medium mb-2">
            Estado: <span
                class="font-bold px-2 py-1 rounded-md {{ $task->status->bgColor() }}">{{ $task->status }}</span>
        </p>
        <p class="text-gray-800 text-xl font-medium mb-2">
            {{ $task->title }}
        </p>
        <p class="text-blue-600 text-xs font-medium mb-2">
            Vencimiento: {{ Carbon::parse($task->deadline)->translatedFormat('j F, Y') }}
        </p>
        <p class="text-gray-400 text-sm mb-4">
            {{ $task->description }}
        </p>
    </div>
    </a>
    <livewire:edit-project-task :$task :key="$task->key" />
</div>
@script
    <script>
        let editBtns = document.querySelectorAll(".edit-btn");
        let cancelBtns = document.querySelectorAll('.cancel-btn');
        cancelBtns.forEach((button) => {
            button.addEventListener("click", () => {
                hideContainers();
            })
        })
        const taskInfoContainers = document.querySelectorAll('.task-info-container');
        editBtns.forEach((button, index) => {
            button.addEventListener("click", () => {
                // Oculta todos los contenedores de información de tarea
                hideContainers();

                // Muestra el contenedor correspondiente al botón de edición clicado
                taskInfoContainers[index].classList.remove('hidden');
                taskInfoContainers[index].classList.add('transition', 'transform', 'duration-500',
                    'ease-in-out', 'opacity-0', 'scale-75');

                // Reflow
                void taskInfoContainers[index].offsetWidth;

                taskInfoContainers[index].classList.remove('opacity-0', 'scale-75');
                taskInfoContainers[index].classList.add('opacity-100', 'scale-100');
            });
        });

        function hideContainers() {
            taskInfoContainers.forEach(container => {
                container.classList.add('hidden');
            });
        };
    </script>
@endscript
