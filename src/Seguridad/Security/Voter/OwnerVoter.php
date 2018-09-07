<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Seguridad\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * Description of OwnerVoter
 *
 * @author joheras
 */
class OwnerVoter implements VoterInterface {

    

    public function vote(\Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token, $subject, array $attributes): int {
        $user = $token->getUser();




        if ($attributes[0] === 'edit') {

            if ($user->getUsername() === $subject->getOwner()) {
                return true;
            }
        }

        if ($attributes[0] === 'view') {

            return true;
        }

        return false;
    }

}
