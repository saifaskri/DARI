<?php

namespace App\Controller;

use App\Entity\Advertisment;
use App\Form\AdsFilterFormType;
use App\MyClasses\AdsFilter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {
        /*Passing this Variable to use It To Know The Online Since*/
        $nowTime = new \DateTime();
        $advertisments= null;
        $AdsFilter = new AdsFilter();
        $form = $this->createForm(AdsFilterFormType::class);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid() ){
            $AdsFilter = $form->getData();

            /*if The User didn't Choose An Empty Filter*/
            /*if($AdsFilter->BareSearch_filter != null){
                $advertisments = $this->entityManager->getRepository(Advertisment::class)->findByFilterSearch($AdsFilter);
            }*/
            if($AdsFilter->BareSearch_filter != null || $AdsFilter->Accomodation_filter != null|| $AdsFilter->RentPeriodation_filter != null || $AdsFilter->States_filter!=null){
                $advertisments = $this->entityManager->getRepository(Advertisment::class)->findByFilters($AdsFilter);
            }else{$advertisments = $this->entityManager->getRepository(Advertisment::class)->findAll();}

        }else{
            $advertisments = $this->entityManager->getRepository(Advertisment::class)->findAll();
        }

        return $this->render('advertisments/index.html.twig', [
            'advertisments' => $advertisments,
            'nowTime' => $nowTime,
            'FilterForm' => $form->createView(),

        ]);
    }
}
