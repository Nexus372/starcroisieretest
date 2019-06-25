<?php

namespace App\Controller\Admin;

use App\Core\Form\FormFactory;
use App\Entity\Comment;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{

    /**
     * @Route("/posts", name="app_admin_posts")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findBy([], ['createdAt' => 'desc']);

        return $this->render('admin/post/list.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/create", name="app_admin_post_create")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, FormFactory $formFactory)
    {
        return $formFactory->create(
            $request,
            PostType::class,
            new Post(),
            'admin/post/create.html.twig',
            $this->redirectToRoute('app_admin_posts')
        );
    }

    /**
     * Update
     *
     * @Route("/post/update/{id}", name="app_admin_post_update")
     *
     * @param Post $post
     *
     * @return Response
     */
    public function update(Request $request, FormFactory $formFactory, Post $post)
    {
        return $formFactory->create(
            $request,
            PostType::class,
            $post,
            'admin/post/update.html.twig',
            $this->redirectToRoute('app_admin_posts')
        );
    }

    /**
     * Delete
     *
     * @Route("/post/delete/{id}", name="app_admin_post_delete")
     *
     * @param Post $post
     *
     * @return Response
     */
    public function delete(FormFactory $formFactory, Post $post): Response
    {
        return $formFactory->delete(
            $post,
            $this->redirectToRoute('app_admin_posts')
        );
    }

    /**
     * Delete
     *
     * @Route("/post/{post}/comment/delete/{comment}", name="app_admin_comment_delete")
     *
     * @param Post $post
     *
     * @return Response
     */
    public function deleteComment(FormFactory $formFactory, Post $post, Comment $comment)
    {
        return $formFactory->delete(
            $comment,
            $this->redirectToRoute('app_admin_post_update', [
                'id' => $post->getId()
            ])
        );
    }
}