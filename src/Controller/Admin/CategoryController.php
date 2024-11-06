<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/categories", name: 'admin.category.')]

class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function editCategory(Category $category, Request $request, EntityManagerInterface $em)
    //Cette fois, on ne passe pas l'Id dans la fonction, mais un paramètre de type category
    //Le framework est assez intelligent pour comprendre qu'on recherche un Id, ce qui nous évite
    //d'utiliser la méthode find de la fonction "show" ci-dessus.
    //Quand on a un paramètre qui a un nom, on peut dire au framework directement "donne-moi l'objet"
    //et il fera directement la requête.
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);//Envoie le formulaire en POST
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La categorie a bien été modifiée');
            return $this->redirectToRoute('admin.category.index');
        }
        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form
        ]);
    }
    #[Route('/create', name: 'create')]
    public function createCategory(Request $request, EntityManagerInterface $em)
    {
        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {//automatiquement, on vérifie les contraintes en CategoryType aussi
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'La categorie a bien été créée');
            return $this->redirectToRoute('admin.category.index');
        }
        return $this->render('admin/category/create.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function deleteCategory(Category $category, EntityManagerInterface $em)
    {
        $em->remove($category);
        $em->flush();
        $this->addFlash('success', 'La catégorie a bien été supprimée');
        return $this->redirectToRoute('admin.category.index');
    }
}