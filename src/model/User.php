<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 3/7/20
 * Time: 3:35 PM
 */

namespace Indilabz\Chat\model;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = array(
        'audience_id', 'name',
        'profile_url', 'blocked',
        'meta'
    );
}