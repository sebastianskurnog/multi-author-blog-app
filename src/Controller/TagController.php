<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * Display tag list
     *
     * @Route("/tags", name="tags")
     */
    public function index(TagRepository $tagRepository)
    {
        // get all tags
        $tags = $tagRepository->findAll();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags
        ]);
    }


}
