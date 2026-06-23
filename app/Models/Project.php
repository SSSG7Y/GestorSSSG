<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre', 'descripcion', 'estado', 'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('project_role')
                    ->withTimestamps();
    }

    public function scopeForUser($query, $user)
    {
        if ($user->hasRole(['admin', 'leader'])) {
            return $query;
        }
        return $query->where('owner_id', $user->id)
                     ->orWhereHas('members', fn($q) => $q->where('user_id', $user->id));
    }
    public function activities() {
        return $this->hasMany(Activity::class)->latest();
    }
}