<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 29/10/2017
 * Time: 23:34
 */

namespace App\Models\Blackboard;


use App\Models\Blackboard\Ticket\Status;
use App\Models\Blackboard\Ticket\Update;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Ticket extends Model
{

    use Searchable;

    public function updates()
    {
        return $this->hasMany(Update::class);
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class)->first();
    }

    public function getStatusAttribute()
    {
        return Status::find($this->status_id);
    }

    public function getStatusIdAttribute()
    {
        return $this->updates()->orderByDesc('created_at')->first()->status_id;
    }

    public function is_updatable()
    {
        return $this->project()->role()->can_update_ticket && $this->status_id != 0;
    }

}