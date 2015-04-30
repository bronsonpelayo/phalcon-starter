<?php
namespace Core\ViewModels;
use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength,
    Phalcon\Validation\Validator\Email,
    Phalcon\Validation\Validator\Confirmation;

class EditUserViewModel extends BaseViewModel
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;

    public function initialize()
    {
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

}