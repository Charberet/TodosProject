<?php

namespace App\Controller;

use App\Entity\Tasks;
use App\Form\TasksType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class TaskController extends AbstractController
{
    #[Route('/{_locale}/task', name: 'task')]
    public function task(EntityManagerInterface $entity, Request $request): Response
    {
        $locale = $request->getLocale();
        $task = new Tasks();
        $task = $entity->getRepository(Tasks::class)->findBy(['id_user'=>$this->getUser()]);



        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
            'tasks' => $task,
            'locale'=>$locale
        ]);
    }


    #[Route('/{_locale}/addtask', name: 'addtask')]
    public function new(Request $request, EntityManagerInterface $entity): Response
    {
        $task = new Tasks();
        $locale = $request->getLocale();
        $form = $this->createForm(TasksType::class, $task);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

 

            $task->setIdUser($this->getUser());
            $task = $form->getData();
            $entity->persist($task);
            $entity->flush();

            $this->addFlash(
                'success',
                'The task has been added !'
            );

            return $this->redirectToRoute('task');
        }

        return $this->render('task/addtask.html.twig', [
            'form' => $form,
            'locale'=>$locale
        ]);
    }



    #[Route('/{_locale}/deletetask/{id}', name: 'deletetask')]
    public function deleteTask(EntityManagerInterface $entityManager, int $id): Response
    {
        $task = $entityManager->getRepository(Tasks::class)->find($id);
        $entityManager->remove($task);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'The task has been deleted !'
        );

        return $this->redirectToRoute('task');
    }



    #[Route('/{_locale}/edittask/{id}', name: 'edittask')]
    public function editTask(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $locale = $request->getLocale();
        $task = $entityManager->getRepository(Tasks::class)->find($id);

        $form = $this->createForm(TasksType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $entityManager->persist($task);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'The task has been edited !'
            );

            return $this->redirectToRoute('task');
        }

        return $this->render('task/addtask.html.twig', [
            'form' => $form,
            'locale'=>$locale
        ]);
    }  
}
