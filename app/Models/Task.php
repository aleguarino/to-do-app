<?php

namespace App\Models;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $casts = ['status' => TaskStatusEnum::class, 'priority' => TaskPriorityEnum::class];

    public function assigned_to()
    {
        return $this->belongsTo(User::class);
    }
}
