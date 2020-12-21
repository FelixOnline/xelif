<?php

namespace A17\Twill\Models\Enums;

use MyCLabs\Enum\Enum;

class UserRole extends Enum
{
    const EDITOR = 'Editor';
    const ADMIN = 'Admin';
    const PUBLISHER = 'Publisher';
}
