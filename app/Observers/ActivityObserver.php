<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ActivityObserver
{
    public function created(Model $model): void
    {
        $name = ($model instanceof Comment) 
            ? Str::limit($model->cuerpo, 20) 
            : ($model->nombre ?? $model->titulo ?? 'elemento');
            
        $description = "Se creó el registro de " . class_basename($model) . ": '{$name}'";
        
        $this->saveActivity($model, $description);
    }

    public function updated(Model $model): void
    {
        $changes = $model->getChanges();
        unset($changes['updated_at']);

        if (empty($changes)) {
            return;
        }

        $changedFields = implode(', ', array_keys($changes));
        $name = $model->nombre ?? $model->titulo ?? 'elemento';
        $description = "Se actualizó '{$name}'. Campos modificados: {$changedFields}";

        $this->saveActivity($model, $description);
    }

    public function deleted(Model $model): void
    {
        $name = $model->nombre ?? $model->titulo ?? 'elemento';
        $description = "Se eliminó " . class_basename($model) . ": '{$name}'";

        $this->saveActivity($model, $description);
    }

    protected function saveActivity(Model $model, string $description)
    {

        $projectId = null;
        
        if ($model->getTable() === 'projects') {
            $projectId = $model->getKey();
        } elseif ($model->getAttribute('project_id')) {
            $projectId = $model->getAttribute('project_id');
        } elseif (method_exists($model, 'project')) {
            $projectId = $model->project->id ?? null;
        } elseif (method_exists($model, 'task') && $model->task) {
            $projectId = $model->task->project_id;
        }

        Activity::create([
            'user_id'      => Auth::id() ?? 1,
            'project_id'   => $projectId,
            'subject_type' => get_class($model),
            'subject_id'   => $model->getKey(),
            'description'  => $description
        ]);
    }
}