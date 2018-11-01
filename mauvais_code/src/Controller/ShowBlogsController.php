<?php

namespace App\Controller;

use App\Repository\PostsBlogRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ShowBlogsController extends Controller
{

    //MAUVAISE PRATIQUE : utilisation des annotations
    /**
     * @Route("/", name="show_all_articles")
     */
    public function index(PostsBlogRepository $post_blog_repository)
    {

        $allposts = $post_blog_repository->findAll();  //MAUVAISE PRATIQUE : utilisation direct de methode repository

        return $this->render('show_blogs/index.html.twig', [
            'posts' => $allposts,
        ]);
    }


    /**
     * @Route("article/{id}", name="show_article")
     */
    public function articleById (Request $request, PostsBlogRepository $post_blog_repository, $id)
    {
        $post = $post_blog_repository->find($id);

        //MAUVAISE PRATIQUE : aucune utilisation de validation

        return $this->render('show_blogs/index.html.twig', [
            'posts' => $post,
        ]);
    }

    /**
     * @Route("/article/{author}/id/{id}", name="show_article_author")
     */
    //MAUVAISE PRATIQUE : trop de passage de paramatres
    public function articleByIdAndAuthor (Request $request, PostsBlogRepository $post_blog_repository, $author, $id)
    {
        if (isset($author))
        {
            if (isset($id)) //MAUVAISE PRATIQUE : le code peut se réduire à une seule condition, un seul if
            {
                $allposts = $post_blog_repository->findBy(
                    ['name' => 'Keyboard'],
                    array('price' => 'ASC')
                );

                return $this->render('show_blogs/index.html.twig', [
                    'posts' => $allposts,
                ]);
            }
        }

        return $this->render('error.html.twig');

    }

    //Side note MAUVAISE PRATIQUE : utilisation de traits, replique de codes


    /**
     * @Route("/edit-article/id/{id}", name="show_article")
     */
    public function editArticle (PostsBlogRepository $post_blog_repository, ObjectManager $manager, $id)
    {
        //...

    }
}
