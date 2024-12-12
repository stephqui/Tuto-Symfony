<?php

namespace App\Controller\API;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\SerializerInterface;

class RecipesController extends AbstractController
{

   #[Route("/api/recipes")]
   public function index(RecipeRepository $recipeRepository, Request $request, SerializerInterface $serializer)
   {
      $recipes = $recipeRepository->paginateRecipes($request->query->getInt('page', 1));
 
      //Quand on crée une API, et qu'on veut renvoyer des données, on a cette méthode
      //json si on veut faire du Json, mais on peut créer des méthodes pour d'autres format.
      //On peut utiliser les groupes de serialization pour annoter notre entité pour expliquer
      //quand est-ce qu'on dit renvoyer qqchose. Ca à l'avantage d'utiliser moins de ressources.
      return $this->json($recipes, 200, [], [
         'groups' => ['recipes.index']
      ]);
   }

   #[Route("/api/recipes/{id}", requirements: ['id' => Requirement::DIGITS])]
   public function show(Recipe $recipe)
   {
      //Ca, c'est si on veut renvoyer des données plus précises, grace aux groupes
      //de serialization
      return $this->json($recipe, 200, [], [
         'groups' => ['recipes.index', 'recipes.show']
      ]);
   }
}