<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Task extends Model implements Sortable
{
    use HasFactory;

    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'priority',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'title',
        'priority',
        'order',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
