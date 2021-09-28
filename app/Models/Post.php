<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nombres', 'Apellidos','Sexo','Direccion',
        'NumerodeCelular','Fechadenacimiento','Nacionalidad'
    ];
}
