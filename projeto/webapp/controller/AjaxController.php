<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\View;

class AjaxController extends BaseController
{
    public function infouser(){
        $user=User::find(Post::get("userId"));
        return View::make("ajax.user.modalUserInfo",["user"=>$user]);
    }
    public function banneduser(){
        $user=User::find(Post::get("userId"));
        return View::make("ajax.user.modalBannedUser",["user"=>$user]);
    }
    public function unbanneduser(){
        $user=User::find(Post::get("userId"));
        return View::make("ajax.user.modalUnbannedUser",["user"=>$user]);
    }
    public function finduser(){
        if(!empty(Post::get("username")))
            $user = User::find('all', array('conditions' => "username LIKE '%".Post::get("username")."%'"));
        else
            $user = User::all();
        return View::make("ajax.user.finduser",["users"=>$user]);
    }
}