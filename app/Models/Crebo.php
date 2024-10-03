<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stringable;

class Crebo extends Model implements Stringable
{
    use HasFactory;

    public function __toString(): string
    {
        return sprintf("%05d", $this->crebo);
    }
}
