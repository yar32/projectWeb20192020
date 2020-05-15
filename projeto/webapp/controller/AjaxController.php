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
}