<?php


namespace App\Presenters;


use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Security\AuthenticationException;
use Nette\Security\Passwords;

final class LoginPresenter extends Presenter
{
    public function actionSignOut()
    {
        $this->getUser()->logout();
        $this->redirect('Homepage:');
    }

    protected function createComponentLoginForm()
    {
        $form = new Form();
        $form->addText('username', 'Username')->setRequired("Username can't be empty");
        $form->addPassword('password', 'Password')->setRequired("Password can't be empty");
        $form->addSubmit('submit', 'Submit');

        $form->onSuccess[] = function (Form $form) {
            $values = $form->getValues();

            try {
                $this->getUser()->login($values->username, $values->password);
                $this->flashMessage('Successfully login!');
                $this->redirect('Homepage:');

            } catch (AuthenticationException $e) {
                $form->addError('Wrong username or password!');
            }
        };

        return $form;
    }
}