<?php


namespace App\Model;


use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class UserModel extends AModel
{
    protected string $table = 'user';

    public function getPasswordByUser(string $user): ActiveRow|null
    {
        return $this->getTable()->where('user_name', $user)->fetch();
    }

    public function getUsers(): Selection
    {
        return $this->getTable();
    }

    public function deleteUser(int $id): void
    {
        $this->getTable()->where('id', $id)->delete();
    }

    public function getUserDataById(int $id): ActiveRow|null
    {
        return $this->getTable()->where('id', $id)->fetch();
    }

    public function insertUser(array $data): void
    {
        $this->getTable()->insert($data);
    }

    public function modifyUser(int $id, array $data): void
    {
        $this->getTable()->where('id', $id)->update($data);
    }
}