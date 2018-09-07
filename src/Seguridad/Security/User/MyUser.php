<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Seguridad\Security\User;

/**
 * Description of Persona
 *
 * @author joheras
 */
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class MyUser implements UserInterface, EquatableInterface {

    private $username;
    private $password;
    private $salt;
    private $roles;

    function __construct($username, $password, $salt) {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = array('ROLE_PEOPLE');
    }

    public function eraseCredentials() {
        
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getRoles() {
        return $this->roles;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function isEqualTo(UserInterface $user): bool {
        if (!$user instanceof MyUser || $this->password !== $user->getPassword() || $this->salt !== $user->getSalt() || $this->username !== $user->getUsername()) {
            return false;
        }
        return true;
    }

}
