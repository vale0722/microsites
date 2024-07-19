<?php

namespace App\Constants;

use App\Concerns\EnumToArray;

enum Permission: string
{
    use EnumToArray;

    case SITES_INDEX = 'sites.index';
    case SITES_CREATE = 'sites.create';
    case SITES_EDIT = 'sites.edit';
    case SITES_SHOW = 'sites.show';
    case SITES_DELETE = 'sites.delete';
    case SITES_TOGGLE = 'sites.toggle';
}
