<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Seguridad\Security\User;
use App\Seguridad\Security\User\MyUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Seguridad\Domain\Repository\IPersonRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
/**
 * Description of PersonaProvider
 *
 * @author joheras
 */
class MyUserProvider implements UserProviderInterface {

    private $peoplerepository;

    public function __construct(IPersonRepository $repository) {
        $this->peoplerepository = $repository;
    }

    //put your code here
    public function loadUserByUsername($username): UserInterface {

        $userdata = $this->peoplerepository->findPerson($username);
        if ($userdata) {
            $password = $userdata->getPassword();
            $salt = $userdata->getSalt();
            return new MyUser($username, $password, $salt);
        }
        throw new UsernameNotFoundException(sprintf('No existe un usuario con ese nombre de usuario'));
    }

    public function refreshUser(UserInterface $user): UserInterface {
        if (!$user instanceof MyUser) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported', get_class($user)));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool {
        return $class === 'App\Security\MyUser';
    }

}
