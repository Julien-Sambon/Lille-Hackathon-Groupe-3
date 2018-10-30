<?php

/**
 * StaffController file
 *
 * PHP Version 7.2
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */

namespace Controller;

use Model\User\User;
use Model\User\UserManager;

/**
 * Staff class controller
 *
 * @category Controller
 * @package  Controller
 * @author   Gaëtan Rolé-Dubruille <gaetan@wildcodeschool.fr>
 */
class StaffController extends AbstractController
{
    /**
     * Display staff's index
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function index()
    {
        $userManager = new UserManager($this->getPdo());
        $users = $userManager->selectAll();

        return $this->twig->render('Staff/index.html.twig', ['users' => $users]);
    }

    /**
     * Staff's form for creating student
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string The rendered template
     */
    public function userAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager($this->getPdo());
            $user = new User();
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $userManager->add($user);
            header('Location:/staff');
        }

        return $this->twig->render(
            'Staff/add.html.twig', [
            'status' => 0
            ]
        );
    }

    /**
     * Staff's form for editing student
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected user's id
     *
     * @return string The rendered template
     */
    public function userEdit(int $id)
    {
        $userManager = new UserManager($this->getPdo());
        $userArray = $userManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager($this->getPdo());
            $user = new User();
            $user->setId($userArray['id']);
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $userManager->edit($user);
            header('Location:/staff');
        }

        return $this->twig->render(
            'Staff/edit.html.twig', [
            'user' => $user = $userArray == null ? null : $userArray,
            'status' => 1
            ]
        );
    }

    /**
     * Staff's route for deleting student
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @param int $id Selected user's id
     *
     * @return void None is returned
     */
    public function userDelete(int $id): void
    {
        $userManager = new UserManager($this->getPdo());
        $userManager->delete($id);

        header('Location: /staff');
    }
}