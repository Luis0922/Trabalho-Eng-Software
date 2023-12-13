<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prontuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'prontuario_eletronico';
}
