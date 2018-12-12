<?php

declare(strict_types=1);

namespace App\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiListController extends AbstractController
{
    /**
     * @Route("/apis", name="api_list", methods={"GET"})
     *
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     *
     * @return Response
     */
    public function issues(): Response
    {
        return $this->render('testio/api.html.twig');
    }
}
