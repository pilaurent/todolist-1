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
     * @Route("/task/create", name="create_task")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $task = new Task($this->getUser());

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($task);
            $em->flush();

            $this->addFlash(
                'notice',
                'Task added with success'
            );

            return $this->redirect('/');
        }

        return $this->render('TodoBundle:Task:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/task/list", name="list_task")
     */
    public function listAction()
    {
        $tasks = $this
            ->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByUser(
                $this->getUser()
            );

        return $this->render('TodoBundle:Task:list.html.twig', array(
            'tasks' => $tasks,
        ));
    }

    /**
     * @Route("/task/category/{id}", requirements={"id" = "\d+"}, name="list_task_category")
     */
    public function listByCategoryAction(Request $request)
    {
        $tasks = $this
            ->getDoctrine()
            ->getRepository('TodoBundle:Task')
            ->findByCategory(
                $request->get('id')
            );

        return $this->render('TodoBundle:Task:list.html.twig', array(
            'tasks' => $tasks,
        ));
    }
}
