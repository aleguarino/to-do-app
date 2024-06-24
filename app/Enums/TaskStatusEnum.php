<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case PENDING = 'Pendiente';
    case CANCELED = 'Cancelado';
    case COMPLETED = 'Completada';
    case OVERDUE = 'Vencida';
}
