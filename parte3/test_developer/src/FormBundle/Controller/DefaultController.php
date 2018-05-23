<?php

namespace FormBundle\Controller;

use FormBundle\Document\DataForm;
use FormBundle\Document\Input\EmailInput;
use FormBundle\Document\Input\MessageInput;
use FormBundle\Document\Input\NameInput;
use FormBundle\Document\Input\PhoneInput;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/formulario")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/guardar")
     * @Method({"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function saveAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $dataForm = DataForm::create(
            new NameInput($data['name']),
            new EmailInput($data['email']),
            new PhoneInput($data['phone']),
            new MessageInput($data['message'])
        );

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($dataForm);
        $dm->flush();

        return new JsonResponse([
            'message' => 'DataForm creado correctamente.',
            'data' => [
                'id' => $dataForm->getId()
            ]
        ]);
    }
}