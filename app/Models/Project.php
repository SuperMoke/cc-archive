<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "adviser_id",
        "description",
    ];

    public function adviser () {
        return $this->belongsTo(User::class);
    }

    public function projectMembers  () {
        return $this->belongsToMany(User::class, "project_members", "project_id", "user_id");
    }

    public function tasks () {
        return $this->hasMany(Task::class);
    }

    public function getProjectMemberIdsAttribute() {
        return $this->projectMembers->pluck("id")->toArray();
    }

    public function getTaskTotalPercentageAttribute() {
        return $this->tasks->sum("percentage");
    }

    public function getTaskTotalPercentageDoneAttribute() {
        $tasks = $this->tasks->where("stage_id", 3);
        return $tasks->sum("percentage");
    }

}
