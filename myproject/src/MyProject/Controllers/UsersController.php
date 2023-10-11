<?php

namespace MyProject\Controllers;

use MyProject\Exception\InvalidArgumentException;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Models\Users\UsersAuthService;
use MyProject\Services\EmailSender;
use MyProject\View\View;

class UsersController extends AbstractController
{

    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $exception) {
                $this->view->renderHtml('users/login.php', ['error' => $exception->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

    public function uploadAvatar()
    {
        if (!empty($_FILES['attachment'])) {
            $users = $this->user;
            $users->uploadAvatar($_FILES, $users->getId());
        }
        $this->view->renderHtml('upload/upload.php');
    }

    public function logout()
    {
        if ($this->user !== null) {
            UsersAuthService::deleteCookie();
        }

        header('Location: /');
        return;
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSucc.php');
                return;
            }
        }

        $this->view->renderHtml('users/signUp.php');
    }

    public function activate(int $userId, string $activationCode)
    {
        $user = User::getById($userId);
        if ($user === null) {
            $this->view->renderHtml('errors/activationError.php', ['error' => 'Пользователь не найден!']);
            return;
        }
        $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
        if ($isCodeValid) {
            $user->activate();
            UserActivationService::deleteActivationCode($user, $activationCode);
            $this->view->renderHtml('users/activationSucc.php');

        } else {
            $this->view->renderHtml('errors/activationError.php', ['error' => 'Код активации не найден ил неверный!']);
        }
    }
}