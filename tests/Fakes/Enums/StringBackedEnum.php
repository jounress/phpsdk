<?php

declare(strict_types=1);

namespace Tests\Fakes\Enums;

use Jounress\PhpSdk\Traits\HandlesEnums;

enum StringBackedEnum: string
{
    use HandlesEnums;

    case Published = 'published';
    case Draft = 'draft';
}
