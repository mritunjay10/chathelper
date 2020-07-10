<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 3/7/20
 * Time: 3:01 PM
 */

namespace Indilabz;


use Indilabz\model\Channel;
use Indilabz\model\Message;
use Indilabz\model\User;


class Chat
{
    protected $conn = null;
    protected $util = null;

    public function __construct()
    {
        $this->util = new Utils();
    }


    public function user($id){

        $user = User::where($this->util->byId($id))->first();

        return $user;
    }

    public function users($user, $page){

        $data = Channel::where($this->util->byUser($user))
            ->where($this->util->notBlocked())
            ->groupBy('channel')
            ->with('user')
            ->with('message')
            ->skip($page*10)
            ->take(10)
            ->get();

        return $data;
    }

    public function chat($id, $channel, $operator ='>', $limit = 10){

        $final = array();

        $next = Message::where('id',$operator,$id)
            ->where($this->util->notDeleted())
            ->where($this->util->byChannel($channel))
            ->with('reply')
            ->withCount('isStarred as starred')
            ->limit($limit)
            ->cursor();

        foreach ($next as $each){

            $each['reply'] = $this->fetchReply($each->reply);

            array_push($final, $each);
        }

        return $final;
    }

    public function goToChatId($id, $channel, $isAfter, $limit = 10){

        $final = array();
        $previous = array();
        $next = array();

        if(!$isAfter){
            $previous = Message::where($this->util->byId($id, '<'))
                ->where($this->util->notDeleted())
                ->where($this->util->byChannel($channel))
                ->withCount('isStarred as starred')
                ->limit($limit)
                ->cursor();
        }

        $current = Message::where($this->util->byId($id))
            ->where($this->util->notDeleted())
            ->where($this->util->byChannel($channel))
            ->withCount('isStarred as starred')
            ->first();

        if($isAfter){

            $next = Message::where($this->util->byId($id, '>'))
                ->where($this->util->notDeleted())
                ->where($this->util->byChannel($channel))
                ->withCount('isStarred as starred')
                ->limit($limit)
                ->cursor();
        }

        foreach ($previous as $each){
            $each['reply'] = $this->fetchReply($each->reply);
            array_push($final, $each);
        }

        $current['reply'] = $this->fetchReply($current->reply);
        array_push($final, $current);

        foreach ($next as $each){
            $each['reply'] = $this->fetchReply($each->reply);
            array_push($final, $each);
        }

        return $final;
    }

    public function sendMessage($data){

        $previous = Message::create($data);

        return $previous;
    }

    public function deleteMessage($id){

        $delete = Message::where($this->util->byId($id))
            ->update($this->util->deleted());

        return $delete;
    }

    public function deleteAllMessage($channel){

        $delete = Message::where($this->util->byChannel($channel))
            ->update($this->util->deleted());

        return $delete;
    }

    public function starMessage($user, $data){

        $insert = array();

        foreach ($data as $each){
            array_push($insert, array('user'=>$user, 'message'=>$each));
        }

        $star = StarredMessage::insert($insert);

        return $star;

    }

    public function blockUser($id, $channel){

        $delete = Channel::where($this->util->byUser($id))
            ->where($this->util->byChannel($channel))
            ->update($this->util->blocked());

        return $delete;
    }

    public function forward($users, $messages){


        foreach ($messages as $message){

        }
    }

    private function fetchReply($id){

        $reply = Message::select('id','ref','message','type')
            ->where($this->util->byId($id))
            ->first();

        return $reply;
    }
}