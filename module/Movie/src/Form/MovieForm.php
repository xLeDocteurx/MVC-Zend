<?php

namespace Movie\Form;

use Zend\Form\Form;

class MovieForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('Movie');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        $this->add([
            'name' => 'image',
            'type' => 'text',
            'options' => [
                'label' => 'Image',
            ],
        ]);
        $this->add([
            'name' => 'summary',
            'type' => 'text',
            'options' => [
                'label' => 'Summary',
            ],
        ]);
        $this->add([
            'name' => 'link',
            'type' => 'text',
            'options' => [
                'label' => 'Link',
            ],
        ]);
        $this->add([
            'name' => 'artist',
            'type' => 'text',
            'options' => [
                'label' => 'Artist',
            ],
        ]);
        $this->add([
            'name' => 'category',
            'type' => 'text',
            'options' => [
                'label' => 'Category',
            ],
        ]);
        $this->add([
            'name' => 'date',
            'type' => 'text',
            'options' => [
                'label' => 'Date',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}

?>