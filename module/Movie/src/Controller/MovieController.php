<?php

namespace Movie\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Movie\Model\MovieTable;
use Movie\Form\MovieForm;
use Movie\Model\Movie;

class MovieController extends AbstractActionController {

    private $table;

    public function __construct (MovieTable $table) {
        $this->table = $table;
    }

    public function indexAction () {
        return new ViewModel([
            'movies' => $this->table->fetchAll(),
        ]);
    }
    
    public function addAction()
    {
        $form = new MovieForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $movie = new Movie();
        $form->setInputFilter($movie->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $movie->exchangeArray($form->getData());
        $this->table->saveMovie($movie);
        return $this->redirect()->toRoute('movie');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('movie', ['action' => 'add']);
        }

        // Retrieve the movie with the specified id. Doing so raises
        // an exception if the movie is not found, which should result
        // in redirecting to the landing page.
        try {
            $movie = $this->table->getMovie($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('movie', ['action' => 'index']);
        }

        $form = new MovieForm();
        $form->bind($movie);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($movie->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveMovie($movie);

        // Redirect to movie list
        return $this->redirect()->toRoute('movie', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('movie');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteMovie($id);
            }

            // Redirect to list of movies
            return $this->redirect()->toRoute('movie');
        }

        return [
            'id'    => $id,
            'movie' => $this->table->getmMovie($id),
        ];
    }
}

?>