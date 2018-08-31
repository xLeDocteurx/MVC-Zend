<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public function registerAction()
    {
        return new ViewModel();
    }
    
    public function connectAction()
    {
        return new ViewModel();
    }
}
