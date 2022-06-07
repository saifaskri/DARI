<?php

namespace App\Controller;

use App\Entity\Advertisment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class AdvertismentsController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/advertisments', name: 'app_advertisments')]
    public function index(): Response
    {
        $advertisments = $this->entityManager->getRepository(Advertisment::class)->findAll();
        $nowTime = new \DateTime();
        return $this->render('advertisments/index.html.twig', [
            'advertisments' => $advertisments,
            'nowTime' => $nowTime,
        ]);
    }
}
