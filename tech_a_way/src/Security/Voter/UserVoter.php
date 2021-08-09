<?php

namespace App\Security\Voter;


use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    private $security;

    public function __construct(Security $security) 
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        // attribute : USER_EDIT
        // subject : $user
        // dump($attribute, $subject);

        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['USER_EDIT', 'USER_VIEW'])
            && $subject instanceof \App\Entity\User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {

        // if we have passed the test of the supports method, we arrive in the voteOnAttribute method
        $user = $token->getUser();
        // dd($user->getRoles()[0]);
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'USER_EDIT':
                // logic to determine if the user can EDIT
                // return true or false
                if ($user == $subject) {
                    return true;
                }

                if (($subject->getRoles()[0] == "ROLE_USER") && ($this->security->isGranted("ROLE_SUPER_ADMIN") || $this->security->isGranted("ROLE_ADMIN"))) {
                    return true;
                }

                if (($subject->getRoles()[0] == "ROLE_CATALOG_MANAGER") && ($this->security->isGranted("ROLE_SUPER_ADMIN") || $this->security->isGranted("ROLE_ADMIN"))) {
                    return true;
                }

                if (($subject->getRoles()[0] == "ROLE_ADMIN") && ($this->security->isGranted("ROLE_SUPER_ADMIN"))) {
                    return true;
                }


                break;
            case 'USER_VIEW':
                // logic to determine if the user can VIEW
                // return true or false



                break;
        }

        return false;
    }
}
