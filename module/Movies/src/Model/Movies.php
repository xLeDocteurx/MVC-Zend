<?php

namespace Movies\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Movies
{
    public $id;
    public $name;
    public $image;
    public $summary;
    public $title;
    public $link;
    public $artist;
    public $category;
    public $date;
    public $duree;

    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->image = !empty($data['image']) ? $data['image'] : null;
        $this->summary = !empty($data['summary']) ? $data['summary'] : null;
        $this->title  = !empty($data['title']) ? $data['title'] : null;
        $this->link = !empty($data['link']) ? $data['link'] : null;
        $this->artist = !empty($data['artist']) ? $data['artist'] : null;
        $this->category = !empty($data['category']) ? $data['category'] : null;
        $this->date = !empty($data['date']) ? $data['date'] : null;
        $this->duree = !empty($data['duree']) ? $data['duree'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
// name
        $inputFilter->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 255,
                    ],
                ],
            ],
        ]);
// image
        $inputFilter->add([
            'name' => 'image',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
            ],
        ]);
// summary
$inputFilter->add([
    'name' => 'summary',
    'required' => true,
    'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
    ],
    'validators' => [
        [
            'name' => StringLength::class,
            'options' => [
                'encoding' => 'UTF-8',
                'min' => 1,
                'max' => 1000,
            ],
        ],
    ],
]);
// title
$inputFilter->add([
    'name' => 'title',
    'required' => true,
    'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
    ],
    'validators' => [
        [
            'name' => StringLength::class,
            'options' => [
                'encoding' => 'UTF-8',
                'min' => 1,
                'max' => 255,
            ],
        ],
    ],
]);
// link
$inputFilter->add([
    'name' => 'link',
    'required' => true,
    'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
    ],
    'validators' => [
        [
            'name' => StringLength::class,
            'options' => [
                'encoding' => 'UTF-8',
                'min' => 1,
                'max' => 1000,
            ],
        ],
    ],
]);
// artist
$inputFilter->add([
    'name' => 'artist',
    'required' => true,
    'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
    ],
    'validators' => [
        [
            'name' => StringLength::class,
            'options' => [
                'encoding' => 'UTF-8',
                'min' => 1,
                'max' => 255,
            ],
        ],
    ],
]);
// category
$inputFilter->add([
    'name' => 'category',
    'required' => true,
    'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
    ],
    'validators' => [
        [
            'name' => StringLength::class,
            'options' => [
                'encoding' => 'UTF-8',
                'min' => 1,
                'max' => 255,
            ],
        ],
    ],
]);
//date
$inputFilter->add([
    'name' => 'date',
    'required' => true,
    'filters' => [
        ['name' => StripTags::class],
        ['name' => StringTrim::class],
    ],
    'validators' => [
        [
            'name' => StringLength::class,
            'options' => [
                'encoding' => 'UTF-8',
                'min' => 1,
                'max' => 100,
            ],
        ],
    ],
]);
//duree
$inputFilter->add([
    'name' => 'duree',
    'required' => true,
    'filters' => [
        ['name' => ToInt::class],
    ],
]);


        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'name' => $this->name,
            'image'  => $this->image,
            'summary' => $this->summary,
            'title' => $this->title,
            'link' => $this->link,
            'artist' => $this->artist,
            'category' => $this->category,
            'date' => $this->date,
            'duree' => $this->duree,
        ];
    }
}