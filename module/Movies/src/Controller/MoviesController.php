<?php

namespace Movies\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Movies\Model\MoviesTable;
use Movies\Form\MoviesForm;
use Movies\Model\Movies;

class MoviesController extends AbstractActionController {

    private $table;

    public function __construct (MoviesTable $table) {
        $this->table = $table;
    }

    public function indexAction () {
        return new ViewModel([
            'movies' => $this->table->fetchAll(),
        ]);
    }
    
    public function addAction()
    {
        $form = new MoviesForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $movies = new Movies();
        $form->setInputFilter($movies->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $movies->exchangeArray($form->getData());

        // Get data from omdbapi
        $movieName = $movies->name;
        $omdbMovie = $this->getOmdbapi($movieName);
        $omdbMovieArr = $this->getApiValues($omdbMovie);
        print_r($omdbMovieArr);
        $movies->exchangeArray($omdbMovieArr);

        $this->table->saveMovies($movies);
        return $this->redirect()->toRoute('movies');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('movies', ['action' => 'add']);
        }

        // Retrieve the Movies with the specified id. Doing so raises
        // an exception if the Movies is not found, which should result
        // in redirecting to the landing page.
        try {
            $movies = $this->table->getMovies($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('movies', ['action' => 'index']);
        }

        $form = new MoviesForm();
        $form->bind($movies);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($movies->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveMovies($movies);

        // Redirect to Movies list
        return $this->redirect()->toRoute('movies', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('movies');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteMovies($id);
            }

            // Redirect to list of Moviess
            return $this->redirect()->toRoute('movies');
        }

        return [
            'id'    => $id,
            'movies' => $this->table->getMovies($id),
        ];
    }

    // Get a movie's data from omdbapi
    public function getOmdbapi($name){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://www.omdbapi.com/?apikey=abe1179d&t=%22$name%22&plot=short",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);
        return $response;
    }

    // Fill movie's data from omdbapi
    public function getApiValues($response){
        $name = $response->Title;
        $image = $response->Poster;
        $summary = $response->Plot;
        $summary = str_replace("\"", "", $summary);
        $title = $response->Title . " - " . $response->Director;
        $link = $response->Website;
        $artist = $response->Director;
        $category = $response->Genre;
        $date = $response->Released;
        $duree = $response->Runtime;
        preg_match_all('!\d+!', $duree, $duree);
        $duree = $duree[0][0];

        return ['name' => $name, 'image' => $image, 'summary' => $summary, 'title' => $title, 'link' => $link, 'artist' => $artist, 'category' => $category, 'date' => $date, 'duree' => $duree];
    }
}

?>