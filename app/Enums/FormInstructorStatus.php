<?php

namespace App\Enums;

enum FormInstructorStatus:int
{
    case EN_PROCESO = 0;
    case APROBADO = 1;
    case RECHAZADO = 2;
}
