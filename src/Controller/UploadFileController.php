<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadFileController extends AbstractController
{
    /**
     * @Route("/upload/", name="upload_file")
     */
    public function index(Request $request, ContainerInterface $container): Response
    {
        if ($request->isMethod('POST')) {
            // Save file
            $uploadPath = $container->getParameter('kernel.project_dir') .
                DIRECTORY_SEPARATOR . 'storage' .
            DIRECTORY_SEPARATOR . 'upload';

            /** @var UploadedFile $file */
            $file = $request->files->get('image');

            if ($file) {
                $file->move($uploadPath, $file->getClientOriginalName());
            }
        }

        return $this->render('upload_file/index.html.twig', [
            'controller_name' => 'UploadFileController',
        ]);
    }
}
