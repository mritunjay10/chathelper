<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 4/7/20
 * Time: 11:00 AM
 */

namespace Indilabz\model;


use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    protected $table = 'channels';

    protected $fillable = array(
        'channel', 'user'
    );

    public function user(){
        return $this->hasOne('\Indilabz\model\User', 'id','user')->where('blocked','=',0);
    }

    public function message(){
        return $this->hasOne('\Indilabz\model\Message', 'channel','channel')->orderBy('id', 'DESC');
    }
}