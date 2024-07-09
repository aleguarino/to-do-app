<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Collection;

class SelectUser extends Component
{
    public $searchUser = "";
    public $users;

    public function searchUserByName()
    {
        $this->users = User::where('name', $this->searchUser)->get();
    }

    public function render()
    {

        return view('livewire.select-user');
    }
}
