<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 29/10/2017
 * Time: 23:35
 */

namespace App\Models\Blackboard\Ticket;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{

    protected $table = 'ticket_updates';

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getHtmlAttribute()
    {
        return (new \ParsedownExtra())->text($this->content);
    }
    
}