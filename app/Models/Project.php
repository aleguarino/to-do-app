<?php

namespace App\Models;

use App\Models\User;
use App\Enums\ProjectUserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function add($name): int
    {
        $project = new Project();
        $project->name = $name;
        $project->save();

        // ENLAZA EL PROYECTO CON EL USUARIO EN LA TABLA INTERMEDIA
        $user = Auth::id();
        $project->users()->syncWithoutDetaching([$user => ['role' => ProjectUserRole::ADMIN]]);

        return $project->id;
    }

    public function getProjectById($id)
    {
        return Project::find($id);
    }

    public function isAdmin($userId)
    {
        return $this->users()->where('user_id', $userId)->wherePivot('role', ProjectUserRole::ADMIN)->exists();
    }
}
