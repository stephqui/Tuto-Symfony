<?php

namespace App\Security\Voter;

use App\Entity\Recipe;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

final class RecipeVoter extends Voter
{
    public const EDIT = 'RECIPE_EDIT';
    public const VIEW = 'RECIPE_VIEW';
    public const CREATE = 'RECIPE_CREATE';
    public const LIST = 'RECIPE_LIST';
    public const LIST_ALL = 'RECIPE_ALL';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // Permet de dire si  on supporte cette permission. Est-ce que l'utilisateur
        //a le droit ou non de faire cette telle ou telle action.
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CREATE, self::LIST, self::LIST_ALL]) ||
            (in_array($attribute, [self::EDIT, self::VIEW])
                && $subject instanceof Recipe);
    }
    /**
     * Summary of voteOnAttribute
     * @param Recipe|null $subject
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        //L'objetif est de prendre le nom de la permission ($attribute), le sujet (la recette)
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof User) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
                return $subject->getUser()->getId() === $user->getId();
                break;
            case self::VIEW:
            case self::CREATE:
            case self::LIST:
            return true;

            case self::LIST_ALL:
            return false;
        }
        return false;
    }
}
