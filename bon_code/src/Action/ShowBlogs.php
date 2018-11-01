<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostsBlogRepository;
use App\Service\ArticleService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Zend\Expressive\Template\TemplateRendererInterface;

final class ShowBlogsController
{

    private $post_blog_repository;
    private $articleService;
    private $objectManager;

    public function __construct( PostsBlogRepository $post_blog_repository , ArticleService $articleService , ObjectManager $objectManager)
    {
        $this->post_blog_repository = $post_blog_repository;
        $this->articleService = $articleService;
        $this->objectManager = $objectManager;
    }

    public function index() : Response
    {

        $allposts = $this->articleService->findAll();

        return new Response( $this->renderer->render('show_blogs/index.html.twig', [
            'posts' => $allposts,
        ]) );
    }


    public function articleById (Request $request) : Response
    {
        if ( $request->query->has('id') )
        {
            $id = $request->query->get('id');
            $post = $this->articleService->find($id."");

            return new Response( $this->renderer->render('show_blogs/index.html.twig', [
                'posts' => $post,
            ]) );
        }
        return new Response( $this->renderer->render('error.html.twig') );
    }

    public function articleByIdAndAuthor (Request $request) : Response
    {
        if ( $request->query->has('author') && $request->query->has('id') )
        {
            $author = $request->query->get('author');
            $id = $request->query->get('id');

                $allposts = $this->articleService->findBy([
                    ['author' => $author],
                    ['id' => $id]
                ]);

                return new Response( $this->renderer->render('show_blogs/index.html.twig', [
                    'posts' => $allposts,
                ]));

        }
        return new Response( $this->renderer->render('error.html.twig') );

    }


    public function editArticle (Request $request)
    {
        //...

    }
}
