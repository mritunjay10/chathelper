<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 4/7/20
 * Time: 10:23 AM
 */

namespace Chat\model;


use Illuminate\Database\Eloquent\Model;


class Message extends Model
{

    protected $table = 'messages';

    protected $fillable = array(
        'ref', 'sent_from',
        'sent_to', 'message','reply',
        'type','preview','sent','seen'
    );

    public function isStarred(){

        return $this->hasMany('\Indilabz\model\StarredMessage', 'message','id');
    }

    public function reply(){

        return $this->hasOne('\Indilabz\model\Message', 'reply','id');
    }
}