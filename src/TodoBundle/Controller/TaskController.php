<?php

namespace TodoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TodoBundle\Entity\Task;
use TodoBundle\Form\Type\TaskType;

class TaskController extends Controller
{
    /**
     * @Route("/task/create")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($task);
            $em->flush();
        }

        return $this->render('TodoBundle:Task:create.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}