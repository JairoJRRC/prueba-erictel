<?php

namespace FormBundle\Controller;

use FormBundle\Document\DataForm;
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

        $dataForm = new DataForm();
        $dataForm->setName($data['name']);
        $dataForm->setEmail($data['email']);
        $dataForm->setPhone($data['phone']);
        $dataForm->setMessage($data['message']);

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