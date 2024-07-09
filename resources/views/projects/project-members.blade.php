{{-- MUESTRA LA LISTA DE MIEMBROS ASOCIADOS A UN PROYECTO --}}
<div
    class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5 grid-cols-1 lg:min-h-[calc(100vh-64px)] ">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold leading-none text-gray-900 ">Miembros</h3>
    </div>
    <div class="flow-root">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($project->users as $user)
                <li class="py-3 sm:py-4">

                    <div class="flex md:flex-col lg:flex-row items-center space-x-4">
                        <div class="flex-shrink-0">
                            <img class="w-8 h-8 rounded-full" src="{{ $user->getImagePath($user->id) }}"
                                alt="{{ strtoupper($user->name[0]) }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate ">
                                {{ $user->name }}
                            </p>
                            <p class="text-sm text-gray-700 truncate ">
                                {{ $user->email }}
                            </p>
                        </div>
                        <div class="inline-flex items-center text-base font-semibold text-gray-900 ">
                            {{ $user->pivot->role }}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
