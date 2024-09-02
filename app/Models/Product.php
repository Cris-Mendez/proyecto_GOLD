<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // No es necesario especificar $table, ya que por defecto Laravel busca la tabla 'products'
    // protected $table = 'products';

    // Si tu tabla tiene los campos 'created_at' y 'updated_at'
    public $timestamps = true;

    // Si la clave primaria es 'id', no necesitas definir $primaryKey ni $keyType

    // Si la clave primaria es autoincremental, no necesitas definir $incrementing

    // Campos que pueden ser llenados en masa
    protected $fillable = [
        'nombre',
        'referencia',
        'precio',
        'cantidad',
        'descripcion',
    ];
}
