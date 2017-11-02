<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 29/10/2017
 * Time: 23:33
 */

namespace App\Models\Blackboard;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users');
    }

    public function role()
    {
        $user = Auth::user()->id;
        return $this->belongsToMany(Role::class, 'project_users', 'project_id', 'user_role_id')->withPivot('user_id')->wherePivot('user_id', $user)->first();
    }
}