<?php


namespace App\Auth;

use App\Model\UserModel;
use App\Service\ModelService;
use Nette;
use Nette\Security\IIdentity;

class MyAuthenticator implements Nette\Security\Authenticator
{
    public function __construct(private ModelService $modelService, private Nette\Security\Passwords $passwords)
    {

    }
    function authenticate(string $user, string $password): IIdentity
    {
        $row = $this->modelService->getModel(UserModel::class)->getPasswordByUser($user);

        if (!$row) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->user_password)) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        return new Nette\Security\SimpleIdentity(
            $row->id,
            $row->administrator ? 'admin' : null,
            ['name' => $row->user_name]
        );
    }

}
