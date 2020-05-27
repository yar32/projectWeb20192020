<?php


use ActiveRecord\Model;

class User extends Model
{

    static $has_many = array(array("roles"));
    static $before_create = array('beforeInsert'); # new records only
    static $before_save = array('encryptpassword');

    static $validates_presence_of = array(
        array('name', 'message' => 'Insira o seu nome'),
        array('username', 'message' => 'Insira um username'),
        array('birthdate', 'message' => 'Insira a data de nascimento'),
        array('password', 'message' => 'Insira uma password'),
    );
    static $validates_size_of = array(
        array('password', 'minimum' => 6, 'too_short' => 'Tem de ter no minimo 6 caratéres')
    );
    #Validar se é unico
    static $validates_uniqueness_of = array(
        array('username','message'=>'Este username já existe'),
        array('email','message'=>'Este email já esta associado a uma conta')
   );

    static $validates_format_of = array(
        array('email', 'with' =>
            '/^[_a-z0-9-]+(.[a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/', 'message' => 'Insira um e-mail válido')
    );
    #Custom validaton
    public function validate()
    {
      if (!is_a($this->birthdate, 'DateTime')){
            $this->errors->add('birthdate', "Erro na data");
        }
   }
    //Don't work
    /*public function set_password($plaintext) {
        $this->encrypted_password = md5($plaintext);
    }*/

    #Before Insert in databese
    public function beforeInsert(){
        \Tracy\Debugger::dump("teste");
        $this->activeted = 1;
        $this->idrole=2;
    }

    public function encryptpassword(){
         $this->password=md5($this->password);
    }
    #End Insert

    #OutSide calls
    public function validadePassword($password,$confpassword){
        if ($password != $confpassword)
        {
            \Tracy\Debugger::dump("confpassword");
            $this->errors->add('password', "As password não são identicas");
            \Tracy\Debugger::dump($this->errors);

            return false;
        }
        return true;
    }
    public function readPassword($password){
        return md5($password);
    }

}
