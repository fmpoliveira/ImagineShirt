<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $primaryKey = 'abreviatura';
    public $incrementing= false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = ['abreviatura', 'nome', 'tipo', 'semestres', 'ECTS', 'vagas', 'contato', 'objetivos'];
}
