<?php
namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;




class VoyagesController extends AbstractController{

    #[Route('/voyages', name:'voyages')]
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this -> render ("pages/voyages.html.twig",[
            'visites' => $visites
        ]);
    }
    
    #[Route('/voyages/tri/{champ}/{ordre}', name: 'voyages.sort')]
    public function sort ($champ, $ordre): Response{
        $visites = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render ("pages/voyages.html.twig",[
            'visites' => $visites
        ]);
    }
    
    #[Route('/voyages/tri/{champ}', name: 'voyages.findallequal')]
    public function findAllEqual ($champ, Request $request): Response{
        $valeur = $request->get("recherche");
        $visites = $this->repository->findByEqualValue($champ, $valeur);
        return $this->render ("pages/voyages.html.twig",[
            'visites' => $visites
        ]);
    }


    /**
     * 
     * @var VisitRepository
     */
    private $repository;
    
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository) {
        $this->repository = $repository;
    }
    

}

