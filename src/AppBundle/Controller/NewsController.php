<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/news")
 */
class NewsController extends Controller {
    
    /**
     * @Route("/{id}",name="app_news_view",requirements={"id": "\d+" })
     * @Template
     * @ParamConverter("post", class="AppBundle\Entity\Post")
     */
    public function viewAction(Request $request,Post $post){
        $post->setVisitcount($post->getVisitcount()+1);
        $this->getDoctrine()->getManager();
        $comment=new Comment();
        $form=  $this->createForm(new \AppBundle\Form\CommentType, $comment);
        $form->handleRequest($request);
        if ($form->isValid()){
            $comment=$form->getData();
            $em=  $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute("app_news_view",["id"=>$post->getId()]);
        }
        return ["post" => $post, "form" => $form->createView()];
    }
    
    /**
     * @Route("/index", name="app_news_index")
     * @Template
     */
    public function indexAction(Request $request) {
        $post=  $this->getDoctrine()->getRepository("AppBundle:Post")->findAll();
        return ["posts"=>$post];
    }

    /**
     * @Route("/create",name="app_news_create")
     * @Template;
     * 
     */
    public function createAction(Request $request) {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $post = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute("app_news_create");
        }
        return ["myform" => $form->createView()];
    }
    

}
