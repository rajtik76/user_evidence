<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\UserModel;
use App\Presenters\Base\BasePresenter;
use App\Service\ModelService;
use http\Exception\InvalidArgumentException;
use Nette\Application\UI\Form;
use Nette\DI\Attributes\Inject;
use Nette\Security\Passwords;


final class HomepagePresenter extends BasePresenter
{
    #[Inject]
    public ModelService $modelService;
    private int $editUserId = 0;

    public function actionEditUser($id)
    {
        $this->editUserId = (int)$id;
    }

    public function handleDelete($id)
    {
        $this->modelService->getModel(UserModel::class)->deleteUser((int)$id);
    }

    protected function createComponentModifyUserForm()
    {
        $form = new Form();
        $form->addText('username', 'User name')->setRequired('Name is required!');
        $form->addPassword('password', 'Password')->setRequired('Password is required!');
        $form->addCheckbox('administrator', 'Administrator');
        $form->addSubmit('submit', 'Submit');

        $form->onSuccess[] = function (Form $form) {
            $values = $form->getValues();
            $model = $this->modelService->getModel(UserModel::class);
            $password = new Passwords();
            $data = [
                'user_name' => $values->username,
                'user_password' => $password->hash($values->password),
                'administrator' => $values->administrator
            ];

            if ($this->editUserId) {
                $model->modifyUser($this->editUserId, $data);
            } else {
                $model->insertUser($data);
            }

            $this->redirect('Homepage:');
        };

        return $form;
    }

    public function renderDefault()
    {
        $this->template->usersData = $this->modelService->getModel(UserModel::class)->getUsers();
    }

    public function renderEditUser()
    {
        $row = $this->modelService->getModel(UserModel::class)->getUserDataById($this->editUserId);
        if ($row === null) {
            throw new InvalidArgumentException('No user data found!');
        }

        $this['modifyUserForm']->setDefaults([
            'username' => $row->user_name,
            'administrator' => (bool)$row->administrator
        ]);
    }
}
