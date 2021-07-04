<?php


namespace App\Model;


final class UserModel extends AModel
{
    protected const TABLE = 'user';

    public function getPasswordByUser(string $user)
    {
        return $this->explorer->table(self::TABLE)->where('user_name', $user)->fetch();
    }
}