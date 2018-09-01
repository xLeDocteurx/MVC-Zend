<?php

namespace Movies\Form;

use Zend\Form\Form;

class MoviesForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('movies');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        // name
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);
        // image
        $this->add([
            'name' => 'image',
            'type' => 'text',
            'options' => [
                'label' => 'Image',
            ],
        ]);
        // summary
        $this->add([
            'name' => 'summary',
            'type' => 'text',
            'options' => [
                'label' => 'Summary',
            ],
        ]);
        // title
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        // link
        $this->add([
            'name' => 'link',
            'type' => 'text',
            'options' => [
                'label' => 'Link',
            ],
        ]);
        // artist
        $this->add([
            'name' => 'artist',
            'type' => 'text',
            'options' => [
                'label' => 'Artist',
            ],
        ]);
        // category
        $this->add([
            'name' => 'category',
            'type' => 'text',
            'options' => [
                'label' => 'Category',
            ],
        ]);
        // date
        $this->add([
            'name' => 'date',
            'type' => 'text', 
            'options' => [
                'label' => 'Date',
            ],
        ]);
         // duree
         $this->add([
            'name' => 'duree',
            'type' => 'text',
            'options' => [
                'label' => 'duree',
            ],
        ]);
        // submit
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