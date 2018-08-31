<?php
namespace Users\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class UsersTable
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

    public function getUsers($id)
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

    public function registerUsers(Users $users) {

        $data = [
            'username' => $users->username,
            'email' => $users->email,
            'password' => $users->password,
            'permission' => 0,
        ];

        $id = (int) $users->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getUsers($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update user with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function saveUsers(Users $users)
    {
        $data = [
            'name' => $users->name,
            'image'  => $users->image,
            'summary'  => $users->summary,
            'title'  => $users->title,
            'link'  => $users->link,
            'artist'  => $users->artist,
            'category'  => $users->category,
            'date'  => $users->date,
        ];

        $id = (int) $users->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }

        if (! $this->getUsers($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update user with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteUsers($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
