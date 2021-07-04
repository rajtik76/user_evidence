<?php


namespace App\Presenters\Base;


use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
    protected function startup()
    {
        parent::startup();

        if ($this->getUser()->isLoggedIn() === false) {
            $this->redirect('Login:signIn');
        }
    }
}