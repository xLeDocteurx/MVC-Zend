<?php

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Users\Model\UsersTable;
use Users\Form\UsersForm;
use Users\Model\Users;

class UsersController extends AbstractActionController
{

    private $table;

    public function registerAction()
    {
        return new ViewModel();
    }
    
    public function connectAction()
    {
        return new ViewModel();
    }
}
