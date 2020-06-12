<?php


use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class BackofficeController
{
    public function backusers(){
        if(!Session::has("role")){
            return Redirect::toRoute("user/login");
        }
        else{
            if(Session::get("role")!="ADMIN"){
                return View::make("backoffice.errors.403");
            }
        }
        ///Doesn't work
        //$role = Role::find_by_name("User");
        //$users=User::all(array('condition'=>"role_id =".$role->idrole));

        $users = User::find('all', array('conditions' => "role_id != 1"));
        //\Tracy\Debugger::barDump($users->roles);
        return View::make("backoffice.users.allusers",["users"=>$users]);

    }
    public function backadmins(){
        if(!Session::has("role")){
            return Redirect::toRoute("user/login");
        }
        else{
            if(Session::get("role")!="ADMIN"){
                return View::make("backoffice.errors.403");
            }
        }
        ///Doesn't work
        //$role = Role::find_by_name("User");
        //$users=User::all(array('condition'=>"role_id =".$role->idrole));

        $users = User::find('all', array('conditions' => "role_id = 1"));
        //\Tracy\Debugger::barDump($users->roles);
        return View::make("backoffice.users.alladmins",["users"=>$users]);

    }
}