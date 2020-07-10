<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 5/7/20
 * Time: 10:44 AM
 */

namespace Indilabz\Chat\model;


use Illuminate\Database\Eloquent\Model;

class StarredMessage extends Model
{

    protected $table = 'starred_messages';

    protected $fillable = array(
        'user', 'message'
    );
}