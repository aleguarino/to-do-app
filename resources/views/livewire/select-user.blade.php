{{-- COMPONENTE QUE LISTA LOS USUARIOS QUE COINCIDAN CON EL TEXTO INTRODUCIDO --}}
<div class="md:col-span-5 gap-5">
    <!-- Cuadro de Búsqueda -->
    <label for="asignedUser">Asignar usuario</label>
    <div class="mb-6 flex gap-3">
        <input type="text" wire:model="searchUser" class="w-full p-2 border border-gray-300 rounded-md"
            placeholder="Buscar usuario...">
        <input type="button" wire:click="searchUserByName"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer" value="Buscar">
    </div>

    <!-- Select con Foto de Perfil y Nombre de Usuario -->
    @if (isset($users) && !$users->isEmpty())
        <div class="bg-white rounded-md">
            <select id="asignedUser" name="asignedUser" class="w-full border border-gray-300 rounded-md">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" data-img-src="{{ $user->profile_photo_url }}">
                        {{ $user->name }} | {{ $user->email }}
                    </option>
                @endforeach
            </select>
        </div>
    @endif
</div>
