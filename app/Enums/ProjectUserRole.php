<?php

namespace App\Enums;

enum ProjectUserRole: string
{
    case ADMIN = 'Administrador';
    case DEVELOPER = 'Desarrollador';
}
