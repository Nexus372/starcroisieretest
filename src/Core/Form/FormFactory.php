<?php

namespace App\Core\Form;

use App\Entity\Group;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class FormFactory
{
    protected $template;

    protected $formFactory;

    protected $entityManager;

    protected $session;

    /**
     * @var KernelInterface
     */
    protected $kernel;

    /**
     * Validator
     *
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(EngineInterface $delegatingEngine, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, ValidatorInterface $validator, SessionInterface $session, KernelInterface $kernel)
    {
        $this->template = $delegatingEngine;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->session = $session;
        $this->kernel = $kernel;
    }

    public function create(Request $request, string $formClass, $entity, $template, $redirectRoute, $data = array(), $options = array())
    {
        return $this->update($request, $formClass, $entity, $template, $redirectRoute, $data, $options);
    }

    public function update(Request $request, string $formClass, $entity, $template, $redirectRoute, $data = array(), $options = array())
    {
        $form = $this->formFactory->createBuilder($formClass, $entity, array_merge($options, ['translation_domain' => 'admin']))->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!empty($form['filename'])) {
                $file = $form['filename']->getData();
                $newFileName = time() . $file->getClientOriginalName();
                $file->move($this->kernel->getProjectDir() . '/public/upload/', $newFileName);
                $entity->setFilename($newFileName);
            }

            $this->entityManager->persist($entity);
            $this->entityManager->flush();

            $this->addFlash('success', 'Enregistrement terminée');

            if (!$request->isXmlHttpRequest()) {
                return $redirectRoute;
            }

            return new JsonResponse([
                'type' => 'success',
                'route' => $redirectRoute
            ]);
        }

        if (!$template) {
            return null;
        }

        return new Response($this->template->render($template, [
            'form' => $form->createView(),
            'entity' => $entity,
            'data' => $data
        ]));
    }

    public function delete($entity, $redirectRoute)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        $this->addFlash('success', "L'élément a été supprimé");

        return $redirectRoute;
    }

    protected function addFlash(string $type, string $message)
    {
        if (!$this->session) {
            throw new \LogicException('You can not use the addFlash method if sessions are disabled. Enable them in "config/packages/framework.yaml".');
        }

        $this->session->getFlashBag()->add($type, $message);
    }
}