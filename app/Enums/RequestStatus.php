<?php

namespace App\Enums;

/**
 * @return String
 */
enum RequestStatus: string
{
    case ACTIVE = 'active';
    case RESOLVED = 'resolved';
}
