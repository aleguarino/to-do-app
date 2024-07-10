{{-- COMPONENTE QUE MUESTRA EL LISTADO DE LAS TAREAS DEL USUARIO; / --}}
<div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md task-container">


    {{-- NAVEGACIÓN --}}
    <div class="w-full p-4 mb-4">
        <div class="flex justify-between mb-4 items-start">
            <div class="font-medium">Mis tareas</div>
            <div class="dropdown">
                <button type="button" class="dropdown-toggle text-gray-400 hover:text-gray-600"><i
                        class="ri-more-fill"></i></button>
                <ul
                    class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                    <li>
                        <a href="{{ route('newTask') }}"
                            class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-gray-50">Nueva
                            tarea</a>
                    </li>
                </ul>
            </div>


        </div>
        <div class="flex flex-wrap items-center mb-4 order-tab">
            <button type="button"
                class="bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 md:rounded-tl-md md:rounded-bl-md lg:rounded-tl-md lg:rounded-bl-md hover:text-gray-600 task-button {{ $isAllClicked ? 'active' : '' }}"
                wire:click="showAllTasks">Todas</button>
            <button type="button"
                class="bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 hover:text-gray-600 task-button  {{ $isActiveClicked ? 'active' : '' }}"
                wire:click="showActivesTasks">Activas</button>
            <button type="button"
                class="bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 hover:text-gray-600 task-button  {{ $isCompletedClicked ? 'active' : '' }}"
                wire:click="showCompletedTasks">Completadas</button>
            <button type="button"
                class="bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 hover:text-gray-600 task-button  {{ $isCanceledClicked ? 'active' : '' }}"
                wire:click="showCanceledTasks">Canceladas</button>
            <button type="button"
                class="bg-gray-50 text-sm font-medium text-gray-400 py-2 px-4 md:rounded-tr-md md:rounded-br-md lg:rounded-tr-md lg:rounded-br-md hover:text-gray-600 task-button  {{ $isOverdueClicked ? 'active' : '' }}"
                wire:click="showOverduesTasks">Vencidas</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- LISTADO TAREAS --}}
        <div class="col-span-3 p-4 task-container">

            <div class="overflow-x-auto">
                <table class="w-full md:min-w-[540px] fold-table">
                    <thead class="hidden md:table-header-group">
                        <tr>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">
                                TAREA</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                VENCIMIENTO</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                ESTADO</th>
                            <th
                                class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">
                                PRIORIDAD</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!isset($tasks) || empty($tasks))
                            No tiene ninguna tarea
                        @else
                            @foreach ($tasks as $index => $task)
                                @php
                                    $today = new Datetime(date('Y-m-d'));
                                    $deadline = new Datetime($task->deadline);
                                    $days = $today->diff($deadline)->days;
                                @endphp
                                <tr id="{{ $task->id }}"
                                    class="view md:table-row @if ($index % 2 != 0) bg-slate-100 @endif"
                                    onclick="openDetail({{ $task->id }})">
                                    <!-- Columnas para pantallas medianas y grandes -->
                                    <td class="py-2 px-4 border-b border-b-gray-50 hidden md:table-cell">
                                        <div class="flex items-center">
                                            <a href="#"
                                                class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $task->title }}</a>
                                        </div>
                                    </td>
                                    @if ($task->status->value != 'Vencida')
                                        <td class="py-2 px-4 border-b border-b-gray-50 hidden md:table-cell">
                                            <span class="text-[13px] font-medium text-gray-400">
                                                @if ($days == 0)
                                                    Hoy
                                                @else
                                                    {{ $days == 1 ? $days . ' día' : $days . ' días' }}
                                                @endif
                                            </span>
                                        </td>
                                    @endif
                                    <td class="py-2 px-4 border-b border-b-gray-50 hidden md:table-cell"
                                        @if ($task->status->value == 'Vencida') colspan="2" text-align="right" @endif>
                                        <span
                                            class="inline-block p-1 rounded {{ $task->status->bgColor() }} font-medium text-[12px] leading-none">{{ $task->status }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50 hidden md:table-cell">
                                        <span
                                            class="inline-block p-1 {{ $task->priority->bgColor() }} rounded font-medium text-[12px] leading-none">{{ $task->priority }}</span>
                                    </td>
                                </tr>

                                <!-- Filas para pantallas pequeñas -->
                                <tr onclick="openDetail({{ $task->id }})"
                                    class="md:hidden @if ($index % 2 != 0) bg-slate-100 @endif">
                                    <td class="py-2 px-4 border-b border-b-gray-50">{{ $task->title }}</td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="font-medium text-[12px]">Prioridad: </span><span
                                            class="inline-block p-1 {{ $task->priority->bgColor() }} rounded font-medium text-[12px] leading-none">{{ $task->priority }}</span>
                                    </td>
                                </tr>
                                <tr class="md:hidden @if ($index % 2 != 0) bg-slate-100 @endif">
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        @if ($task->status->value != 'Vencida')
                                            <span class="text-[13px] font-medium text-gray-400">Vencimiento:
                                                @if ($days == 0)
                                                    Hoy
                                                @else
                                                    {{ $days == 1 ? $days . ' día' : $days . ' días' }}
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <span class="font-medium text-[12px]">Estado: </span>
                                        <span
                                            class="inline-block p-1 rounded {{ $task->status->bgColor() }} font-medium text-[12px] leading-none">{{ $task->status->value }}</span>
                                    </td>
                                </tr>
                                {{-- <tr id="{{ $task->id }}" class="view" onclick="openDetail({{ $task->id }})">
                                    <td class="py-2 px-4 border-b border-b-gray-50">
                                        <div class="flex items-center">
                                            <a href="#"
                                                class="text-gray-600 text-sm font-medium hover:text-blue-500 ml-2 truncate">{{ $task->title }}</a>
                                        </div>
                                    </td>

                                    @if ($task->status->value != 'Vencida')
                                        <td class="py-2 px-4 border-b border-b-gray-50">
                                            <span class="text-[13px] font-medium text-gray-400">
                                                @if ($days == 0)
                                                    Hoy
                                                @else
                                                    {{ $days == 1 ? $days . ' día' : $days . ' días' }}
                                                @endif
                                            </span>
                                        </td>
                                    @endif
                                    <td class="py-2 px-4 border-b border-b-gray-50"
                                        @if ($task->status->value == 'Vencida') colspan="2" text-align="right" @endif>
                                        <span
                                            class="inline-block p-1 rounded {{ $task->status->bgColor() }} font-medium text-[12px] leading-none">{{ $task->status }}</span>
                                    </td>
                                    <td class="py-2 px-4 border-b border-b-gray-50">

                                        <span
                                            class="inline-block p-1 {{ $task->priority->bgColor() }} rounded font-medium text-[12px] leading-none">{{ $task->priority }}</span>
                                    </td>
                                </tr> --}}
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>


        </div>

        @foreach ($tasks as $task)
            <livewire:task-info :$task :key="$task->key" />
        @endforeach
    </div>
</div>


@push('custom-scripts')
    <script>
        function openDetail(id) {
            if ($(`#${id}`).hasClass("open")) {
                $(".task-info-container").removeClass("open");
                $(".task-info-container").addClass("hidden");
                $(`#${id}`).removeClass("open");
                $(".task-container").removeClass("col-span-2");
                $(".task-container").addClass("col-span-3");
            } else {
                $(".fold-table tr.view").removeClass("open");
                $(".task-info-container").removeClass("open");
                $(".task-info-container").addClass("hidden");
                $(`#${id}`).addClass("open");
                $(`#${id}.task-info-container`).addClass("open");
                $(`#${id}.task-info-container`).removeClass("hidden");
                $(".task-container").removeClass("col-span-3");
                $(".task-container").addClass("col-span-2");
            }
        }
    </script>
@endpush
@script
    <script>
        Livewire.on('validationError', ({

        }) => {
            sendNotification('error', 'La fecha de vencimiento no puede ser anterior a la actual');
        });
    </script>
@endscript
