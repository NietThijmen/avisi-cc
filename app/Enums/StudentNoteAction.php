<?php

namespace App\Enums;

enum StudentNoteAction: string
{
    case Read = 'Read';
    case Create = 'Created';
    case Update = 'Updated';
}
