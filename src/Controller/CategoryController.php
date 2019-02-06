<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="categories")
     */
    public function index(Category $category)
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }


    /**
     * This method is embedded in a template.
     * Prevents the need to query for categories list (for menu) in every controller in app.
     *
     * @param CategoryRepository $categoryRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoriesList(CategoryRepository $categoryRepository)
    {
        $categoriesList = $categoryRepository->findAll();

        return $this->render('_includes/_menu_categories_list.html.twig', [
           'categoriesList' => $categoriesList
        ]);
    }
}
