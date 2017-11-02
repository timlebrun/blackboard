<?php

namespace App\Models;

use App\Models\Blackboard\Project;
use App\Models\Blackboard\Role;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Blackboard projects
     *
     * @return $this
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_users', 'user_id', 'project_id')->withPivot('user_role_id');
    }

    /**
     * Blackboard roles
     *
     * @return $this
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'project_users', 'user_id', 'user_role_id')->withPivot('project_id');
    }

    public function getThumbnailAttribute()
    {
        return Gravatar::fallback('https://api.adorable.io/avatars/128/' . $this->email)->get($this->email);
    }
}
