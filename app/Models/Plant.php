<?php

namespace App\Models;

use Database\Factories\PlantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    /** @use HasFactory<PlantFactory> */
    use HasFactory;
}
