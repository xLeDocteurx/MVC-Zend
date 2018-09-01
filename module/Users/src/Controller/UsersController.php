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

    public function indexAction () {
        return new ViewModel([
            'users' => $this->table->fetchAll(),
        ]);
    }

    public function registerAction()
    {
        $form = new UsersForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $users = new Users();
        $form->setInputFilter($users->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $users->exchangeArray($form->getData());

        // Get data from omdbapi
        $userName = $users->name;
        $omdbUser = $this->getOmdbapi($userName);
        $omdbUserArr = $this->getApiValues($omdbUser);
        print_r($omdbUserArr);
        $users->exchangeArray($omdbUserArr);

        $this->table->saveUsers($users);
        return $this->redirect()->toRoute('users');

        // return new ViewModel();
    }
    
    public function connectAction()
    {
        return new ViewModel();
    }
}
