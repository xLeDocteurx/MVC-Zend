<?php
namespace Movies\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class MoviesTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getMovies($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveMovies(Movies $movies)
    {
        $data = [
            'name' => $movies->name,
            'image'  => $movies->image,
            'summary'  => $movies->summary,
            'title'  => $movies->title,
            'link'  => $movies->link,
            'artist'  => $movies->artist,
            'category'  => $movies->category,
            'date'  => $movies->date,
        ];

        $id = (int) $movies->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getMovies($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update movie with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteMovies($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
