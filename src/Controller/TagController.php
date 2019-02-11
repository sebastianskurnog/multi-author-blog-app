<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * Display tag list
     *
     * @Route("/tags", name="tags", methods={"GET"})
     */
    public function index(TagRepository $tagRepository)
    {
        // get all tags
        $tags = $tagRepository->findAll();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/tag/{slug}", name="tag", methods={"GET"})
     *
     * @param Tag $tag
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Tag $tag)
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tag
        ]);
    }


}
