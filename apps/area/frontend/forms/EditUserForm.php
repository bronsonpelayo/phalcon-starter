<?php
namespace Frontend\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Vokuro\Models\Profiles;

class EditUserForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $this->add(new Hidden("id"));
        $this->add(new Text("firstname"));
        $this->add(new Text("lastname"));
        $this->add(new Text("email"));

        // CSRF
        $this->add(new Hidden('csrf', [
            'value' => $this->security->getToken(),
        ]));
    }
}