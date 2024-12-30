<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\CategoryRepository;
use App\Repository\RecipeRepository;
use App\Security\Voter\RecipeVoter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

#[Route("/admin/recettes", name: 'admin.recipe.')]
//#[IsGranted('ROLE_ADMIN')]

class RecipeController extends AbstractController
{
  #[Route('/', name: 'index')]
  #[IsGranted(RecipeVoter::LIST )]
  public function index(RecipeRepository $recipeRepository, Request $request, Security $security): Response
  {
    //$platPrincipal = $categoryRepository->findOneBy(['slug' => 'plat-principal']);
    //$pates = $recipeRepository->findOneBy(['slug' => 'pates-bolognaises']);
    //Si on veut attacher une categorie au plat, on utilise les setters
    //$pates->setCategory($platPrincipal);
    //$entityManagerInterface->flush();
    //dd($pates);

    //*********** */
    //On veut les recettes dont la durée est inf ou égale à...
    //La méthode est dans le repository -> elle n'est plus appelée
    //*****************************************

    //On recupère la page courante depuis un QueryParameter
    $page = $request->query->getInt('page', 1);
    $userId = $security->getUser()->getId();
    $canListAll = $security->isGranted(RecipeVoter::LIST_ALL);
    $recipes = $recipeRepository->paginateRecipes($page, $canListAll ? null : $userId);

    return $this->render('admin/recipe/index.html.twig', [
      'recipes' => $recipes

    ]);
  }

  #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
  #[IsGranted(RecipeVoter::EDIT, subject: 'recipe')]
  public function editRecipe(Recipe $recipe, Request $request, EntityManagerInterface $em, UploaderHelper $helper)

  //Cette fois, on ne passe pas l'Id dans la fonction, mais un paramètre de type recette
  //Le framework est assez intelligent pour comprendre qu'on recherche un Id, ce qui nous évite
  //d'utiliser la méthode find de la fonction "show" ci-dessus.
  //Quand on a un paramètre qui a un nom, on peut dire au framework directement "donne-moi l'objet"
  //et il fera directement la requête.
  {
    //dd($helper->asset($recipe, 'thumbnailFile'));petit helper pour voir le path du fichier
    $form = $this->createForm(RecipeType::class, $recipe);
    $form->handleRequest($request);//Envoie le formulaire en POST
    if ($form->isSubmitted() && $form->isValid()) {
      $em->flush();//Sauvegarde dans la Bdd
      $this->addFlash('success', 'La recette a bien été modifiée');
      return $this->redirectToRoute('admin.recipe.index');
    }
    return $this->render('admin/recipe/edit.html.twig', [
      'recipe' => $recipe,
      'form' => $form
    ]);
  }

  #[Route('/create', name: 'create')]
  #[IsGranted(RecipeVoter::CREATE)]
  public function createRecipe(Request $request, EntityManagerInterface $em)
  {
    $recipe = new Recipe;
    $form = $this->createForm(RecipeType::class, $recipe);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {//automatiquement, on vérifie les contraintes en RecipeType aussi
      $em->persist($recipe);
      $em->flush();
      $this->addFlash('success', 'La recette a bien été créée');
      return $this->redirectToRoute('admin.recipe.index');
    }
    return $this->render('admin/recipe/create.html.twig', [
      'form' => $form
    ]);
  }
  #[Route('/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
  #[IsGranted(RecipeVoter::EDIT, subject: 'recipe')]
  public function deleteRecipe(Recipe $recipe, EntityManagerInterface $em)
  {
    $em->remove($recipe);
    $em->flush();
    $this->addFlash('success', 'La recette a bien été supprimée');
    return $this->redirectToRoute('admin.recipe.index');
  }
}
