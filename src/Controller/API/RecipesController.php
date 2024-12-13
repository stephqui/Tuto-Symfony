<?php

namespace App\Controller\API;

use App\DTO\PaginationDTO;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

//Validation de données qui rentrent (URL ou contenu de requête), les attribut #[MapQueryString]
//et #[MapRequestPayload] sont super intéressants. Ils se cablent par-dessus le système
//de sérialization pour ajouter la logique de validation
class RecipesController extends AbstractController
{

   #[Route("/api/recipes", methods: ["GET"])]
   public function index(
      RecipeRepository $recipeRepository,
      //Request $request, : pour ligne 33
      //SerializerInterface $serializer, : pour ligne 42
      #[MapQueryString]//Prend les paramètres de l'URL et désérialize (ex: ?page=2)
      PaginationDTO $paginationDTO = new PaginationDTO()
   ) {
      //Ancienne méthode avec objet Request pour avoir le num de page:
      //$recipes = $recipeRepository->paginateRecipes($request->query->getInt('page', 1));

      //Pour avoir le num de page, on remplace la ligne ci-dessus par:
      $recipes = $recipeRepository->paginateRecipes($paginationDTO->page);

      //Quand on crée une API, et qu'on veut renvoyer des données, on a cette méthode
      //json si on veut faire du Json, mais on peut créer des méthodes pour d'autres format.

      //Exemple ci-dessous en 'csv'
      /*dd($serializer->serialize($recipes, 'csv', [
         'groups'=>['recipes.index']
      ]));*/
      //On peut utiliser les groupes de serialization pour annoter notre entité pour expliquer
      //quand est-ce qu'on dit renvoyer qqchose. Ca à l'avantage d'utiliser moins de ressources.

      //Là, on utilise abstractController, qui a la méthode 'json' intégrée
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

   #[Route("/api/recipes", methods: ["POST"])]
   public function create(
      Request $request,
      //Les entités ne sont pas dans la partie autowiring, alors il faut dire
      //comment utiliser l'entité 'Recipe' en ajoutant l'attribut MapRequestPayload.
      // Sinon le programme va buguer et ne saura pas d'ou vient l'entité 'Recipe'
      #[MapRequestPayload(
      serializationContext: [
         'groups' => ['recipes.cerate']
      ]
   )]
      Recipe $recipe,
      EntityManagerInterface $em
   ) {
      $recipe->setCreatedAt(new \DateTimeImmutable());
      $recipe->setUpdatedAt(new \DateTimeImmutable());
      $em->persist($recipe);
      $em->flush();
      return $this->json($recipe, 200, [], [
         'groups' => ['recipes.index', 'recipes.show']
      ]);
   }
}