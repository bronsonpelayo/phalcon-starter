<?php
namespace Core\ViewModels;
use Phalcon\Validation\Validator\PresenceOf;

class LoginViewModel extends BaseViewModel
{
    public $id;
	public $username;
    public $password;

    public function initialize()
    {
        //Set the same form as entity
        //$this->setEntity($this);
        $this->add('username', new PresenceOf(array(
            'message' => 'The username is required'
        )));

        $this->add('password', new PresenceOf(array(
            'message' => 'The password is required'
        )));
    }

}