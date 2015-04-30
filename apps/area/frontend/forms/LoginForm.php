<?php
namespace Frontend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;

class LoginForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $this->add(new Hidden("id"));
        $this->add(new Text("username"));
        $this->add(new Password("password"));
        $this->add(new Hidden('csrf', [
            'value' => $this->security->getToken(),
        ]));
    }
}