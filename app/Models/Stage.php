<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "is_done",
        "j_kanban_id",
        "class"
    ];

    public function tasks () {
        return $this->hasMany(Task::class);
    }

}
