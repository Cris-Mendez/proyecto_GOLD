<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'is_used']; // Asegúrate de que el nombre de la columna coincida con el de la base de datos

    // Si quieres personalizar el nombre de la tabla en caso de que no siga la convención
    protected $table = 'employee_codes';
}
