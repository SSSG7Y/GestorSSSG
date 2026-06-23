<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RecordsActivity;
class Task extends Model
{
    use HasFactory, SoftDeletes;

    public const ESTADOS = [
        'pendiente',
        'en_progreso',
        'completada',
    ];

    public const PRIORIDADES = [
        'baja',
        'media',
        'alta',
    ];
    protected $fillable = [
        'project_id',
        'assignee_id',
        'titulo',
        'descripcion',
        'estado',
        'prioridad',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}