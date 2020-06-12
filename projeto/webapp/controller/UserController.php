<?php


use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class UserController extends BaseController implements ResourceControllerInterface
{
    public function login(){
        if(!Session::has("userid"))
            return View::make("users.login",["error"=>0,"ban"=>false]);
        else
            return Redirect::toRoute("home/index");
    }
    public function makelogin(){

        $error=1;
        $user=User::find_by_username(Post::get("username"));
        if(!empty($user)){
            $ecrypted_password=$user->readPassword(Post::get("password"));
            if($user->password== $ecrypted_password)
            {
                if($user->activeted == 1)
                {
                    $this->userSessions($user->iduser,$user->role->name);
                    return Redirect::toRoute("home/");
                }
                else{
                    $error=2;

                }

            }
        }
        return Redirect::flashToRoute("user/login",["error"=>$error]);
    }
    public function logout(){
        Session::destroy();
        return Redirect::toRoute("home/");
    }




    /**
     * index (default route)
     * Responds to HTTP: GET
     * Responds to REST: GET
     *
     * Returns a view with a list of the models
     *
     * @return Returns a view with a list of the models
     */
    public function index()
    {

    }

    /**
     * create
     * Responds to HTTP: GET
     * Responds to REST: GET
     *
     * Returns a view with a form to create a new model
     *
     * @return Returns a view with a form to create a new model
     */
    public function create()
    {
        if(!Session::has("userid"))
            return View::make("users.register");
        else
            return Redirect::toRoute("home/index");
    }

    /**
     * store
     * Responds to HTTP: POST
     * Responds to REST: POST
     * Validate post data
     * if valid:
     * Save data from new model form
     * @return Returns a view with a list of the models
     *
     * if not valid:
     * Return form to client with data and validation errors
     */
    public function store()
    {
        $user = new User();

        $user->username = Post::get("username") ;
        $user->email = Post::get("email");
        $user->password = Post::get("password");
        $user->name = Post::get("name");
        $user->birthdate = Post::get("birthdate");

       /* $user->username = "username";
        $user->email = "email@gmail.com";
        $user->password = "password";
        $user->name = "name";
        $user->birthdate = date("y-m-d");*/

        //Todo: erro no validade unique
        if($user->is_valid() && $user->validadePassword(Post::get("password"),Post::get("confpassword"))){
            $user->encryptpassword();
            $user->save();
            $user=User::find_by_username($user->username);
            $this->userSessions($user->iduser,$user->role->name);
            return Redirect::toRoute("home/index");
        }
        else{
            \Tracy\Debugger::barDump($user->errors);
            return Redirect::flashToRoute("user/register",["user"=>$user]);
        }

    }

    public function show($id)
    {

        $user = User::find($id);
        $games=$user->gameinfo();
        $position=$user->getposition();
        return View::make("users.profile",["user"=>$user,"games"=>$games,"position"=>$position]);
    }

    public function edit($id)
    {
        $user=User::first($id);
        $user->activeted=1;
        $user->save();
        return Redirect::toRoute("backoffice/allusers");
    }

    public function update($id)
    {
        $user=User::find($id);
        if(!empty(Post::get("name")))
        {
            $user->name=Post::get("name");
        }
        if(!empty(Post::get("birthdate")))
        {
            $user->birthdate=Post::get("birthdate");
        }
        if(!empty(Post::get("email")))
        {
            $user->email=Post::get("email");
        }
        if(!empty(Post::get("password")))
        {
            $user->password=Post::get("password");
        }
        if($user->is_valid())
        {
            if(!empty(Post::get("password")))
            {
                if($user->validadePassword(Post::get("password"),Post::get("confpassword"))){
                    $user->encryptpassword();
                    $user->save();
                    return View::make("ajax.user.notifyedit",["errors"=>false]);
                }
                else
                {
                    $errors["password"]="Tem algum erro";
                    return View::make("ajax.user.notifyedit",["errors"=>true]);
                }
            }
            $user->save();
            return View::make("ajax.user.notifyedit",["errors"=>false]);
        }
        return View::make("ajax.user.notifyedit",["errors"=>true]);
    }

    public function destroy($id)
    {
        $user=User::find($id);
        $user->activeted=0;
        $user->save();
        return Redirect::toRoute("backoffice/allusers");
    }


    private function userSessions($userid,$role){
        Session::set("userid",$userid);
        Session::set("role", strtoupper($role));
    }
}