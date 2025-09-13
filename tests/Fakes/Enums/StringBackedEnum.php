<?php

declare(strict_types=1);

namespace Tests\Fakes\Enums;

use Jounress\PhpSdk\Traits\HandlesEnum;

enum StringBackedEnum: string
{
    use HandlesEnum;

    case Published = 'published';
    case Draft = 'draft';
}
