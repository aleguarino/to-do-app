<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case PENDING = 'Pendiente';
    case CANCELED = 'Cancelada';
    case COMPLETED = 'Completada';
    case OVERDUE = 'Vencida';

    public function bgColor()
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-300',
            self::CANCELED => 'bg-red-500',
            self::COMPLETED => 'bg-green-500',
            self::OVERDUE => 'bg-gray-500'
        };
    }
}
