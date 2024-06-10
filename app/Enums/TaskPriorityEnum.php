<?php

namespace App\Enums;

enum TaskPriorityEnum: String
{
    case HIGH = 'Alta';
    case LOW = 'Baja';
    case MEDIUM = 'Media';
    case URGENT = 'Urgente';
}
