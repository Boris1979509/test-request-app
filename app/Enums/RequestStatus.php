<?php

namespace App\Enums;

/**
 * @return String
 */
enum RequestStatus: string
{
    case ACTIVE = 'Active';
    case RESOLVED = 'Resolved';
}
