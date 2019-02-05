<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /**
     * Home page action -> get & display published posts (promoted & all)
     *
     * @Route("/", name="homepage")
     *
     * @param PostRepository $postRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PostRepository $postRepository)
    {
        // get all published & promoted posts
        $promotedPosts = $postRepository->findAllPublishedAndPromoted();

        // get all published posts
        $posts = $postRepository->findAllPublishedOrderedByNewest();

        return $this->render('homepage/index.html.twig', [
            'promotedPosts' => $promotedPosts,
            'posts' => $posts
        ]);
    }
}
