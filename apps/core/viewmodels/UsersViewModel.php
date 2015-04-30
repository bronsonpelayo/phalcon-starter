<?php
namespace Core\ViewModels;
use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\Confirmation;

class UsersViewModel extends BaseViewModel
{
    public $id;
	public $username;
    public $password;
    public $confirmpassword;
    public $firstname;
    public $lastname;
    public $email;

    public function initialize()
    {
        $this->add('username', new PresenceOf(array(
            'message' => 'The username is required'
        )));

        $this->add('password', new PresenceOf(array(
            'message' => 'The password is required'
        )));

        $this->add('password', new Confirmation(array(
            'message' => 'Password doesn\'t match confirmation',
            'with' => 'confirmpassword'
        )));

        $this->add('firstname', new PresenceOf(array(
            'message' => 'The firstname is required'
        )));

        $this->add('lastname', new PresenceOf(array(
            'message' => 'The lastname is required'
        )));

        $this->add('email', new Email(array(
            'message' => 'The e-mail is not valid'
        )));
    }

    public function getFullname()
    {
        return $this->firstname .' '. $this->lastname;
    }
}