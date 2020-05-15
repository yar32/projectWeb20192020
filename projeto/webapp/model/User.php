<?php


use ActiveRecord\Model;

class User extends Model
{
    static $belongs_to = array(
            array('role', 'class_name' => 'Role')
    );

    static $before_create = array('beforeInsert','encryptpassword'); # new records only

    static $validates_presence_of = array(
        array('name', 'message' => 'Insira o seu nome'),
        array('username', 'message' => 'Insira um username'),
        array('birthdate', 'message' => 'Insira a data de nascimento'),
        array('password', 'message' => 'Insira uma password'),
    );
    #Validar se é unico
    static $validates_uniqueness_of = array(
        array('username','message'=>'Este username já existe'),
        array('email','message'=>'Este email já esta associado a uma conta')
   );

    static $validates_format_of = array(
        array('email', 'with' =>
            '/^[_a-z0-9-]+(.[a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/', 'message' => 'Insira um e-mail inválido')
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
        $this->password = md5($plaintext);
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

}
