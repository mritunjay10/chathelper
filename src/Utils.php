<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 6/7/20
 * Time: 1:53 PM
 */

namespace Indilabz;


class Utils
{
    private $ID = 'id';
    private $USER = 'user';
    private $CHANNEL = 'channel';
    private $DELETED = 'deleted';
    private $BLOCKED = 'blocked';

    public function byUser($id, $operator = '='){

        return array(array($this->USER,$operator,$id));
    }

    public function byId($id, $operator = '='){

        return array(array($this->ID,$operator,$id));
    }

    public function byChannel($channel){

        return array($this->CHANNEL=>$channel);
    }

    public function notDeleted(){
        return array($this->DELETED=> 0);
    }

    public function deleted(){
        return array($this->DELETED=> 1);
    }

    public function notBlocked(){
        return array($this->BLOCKED=> 0);
    }

    public function blocked(){
        return array($this->BLOCKED=> 1);
    }
}