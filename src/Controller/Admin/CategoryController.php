<?php

namespace App\Controller\Admin;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController{
    #[Route('/category', name: 'category')]
    public function index(CategoryRepository $categoryRepository){
        $category = $categoryRepository->findAll();
        return $this->render('admin/category/index.html.twig',[
            'category'=>$category
        ]);
    }
}