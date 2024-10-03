<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stringable;

class Crebo extends Model implements Stringable
{
    use HasFactory;

    protected $fillable = ['crebo'];

    public function __toString(): string
    {
        return sprintf("%05d", $this->crebo);
    }
}
