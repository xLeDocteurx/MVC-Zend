<?php

namespace Users\Form;

use Zend\Form\Form;

class UsersForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('users');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        // name
        $this->add([
            'name' => 'username',
            'type' => 'text',
            'options' => [
                'label' => 'Username',
            ],
        ]);
        // image
        $this->add([
            'name' => 'email',
            'type' => 'text',
            'options' => [
                'label' => 'Email',
            ],
        ]);
        // summary
        $this->add([
            'name' => 'password',
            'type' => 'text',
            'options' => [
                'label' => 'Password',
            ],
        ]);
        // title
        $this->add([
            'name' => 'permission',
            'type' => 'text',
            'options' => [
                'label' => 'Permission',
            ],
        ]);
    }
}