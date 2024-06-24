<?php

namespace App\Enums;

enum TaskPriorityEnum: String
{
    case HIGH = 'Alta';
    case LOW = 'Baja';
    case MEDIUM = 'Media';
    case URGENT = 'Urgente';

    public function bgColor()
    {
        return match ($this) {
            self::HIGH => 'bg-orange-200',
            self::LOW => 'bg-green-200',
            self::MEDIUM => 'bg-yellow-200',
            self::URGENT => 'bg-red-200'
        };
    }
}
