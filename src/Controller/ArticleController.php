<?php
namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ArticleController extends AbstractController {
    
    /**
     * @Route("/", name="article_list")
     * @Method({"GET"})
     */
    public function index(){
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('articles/index.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("/newarticle", name="article_new")
     * @Method({"GET"})
     */
    public function newForm()
    {
        // creates a task object and initializes some data for this example
        $task = new Article();

        $form = $this->createForm(ArticleType::class, $task);

        return $this->render('articles/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/new", name="new_article")
     * @Method({"GET", "POST"})
     */
    public function newArticle(Request $request){
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, [
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('body', TextareaType::class, [
                'required' => false,
                'attr'=> [
                    'class' => 'form-control'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => [
                    'class' => 'btn btn-primary mt-3'
                ]
            ])
            ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $article = $form->getData();

                $mgr = $this->getDoctrine()->getManager();
                $mgr->persist($article);
                $mgr->flush();

                return $this->redirectToRoute('article_list');
            }

            return $this->render('articles/new.html.twig', [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/article/{id}", name="show_article")
     * @Method({"GET"})
     */
    public function showArticle($id){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('articles/show.html.twig', [
            'article' => $article
        ]);
    }
}

        // $mgr = $this->getDoctrine()->getManager();

        // $article = new Article();
        // $article->setName("Articletest");
        // $article->setBody("bodytest");
        // $article->setTitle("Titletest");

        // $mgr->persist($article);
        // $mgr->flush($article);

        // return new Response('Saved an article with an id of '
        //     .$article->getId());