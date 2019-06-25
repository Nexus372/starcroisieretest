<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['createdAt' => 'desc']);

        return $this->render('base.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/{id}", name="app_post_view")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewPost(Post $post)
    {
        $form = $this->createForm(CommentType::class, new Comment(), [
            'action' => $this->generateUrl('app_post_comment_create', [
                'id' => $post->getId()
            ])
        ]);

        return $this->render('post.html.twig', [
            'post' => $post,
            'formComment' => $form->createView()
        ]);
    }

    /**
     * @Route("/post/{id}/comment/create", name="app_post_comment_create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addComment(Request $request, Post $post)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $comment->setPost($post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            $this->redirectToRoute('app_post_view', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('post.html.twig', [
            'post' => $post,
            'formComment' => $form->createView()
        ]);
    }
}