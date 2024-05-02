<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case OPEN = 'Abierto';
    case IN_PROGRESS = 'En progreso';
    case CANCELED = 'Cancelado';
    case COMPLETED = 'Completado';
}
