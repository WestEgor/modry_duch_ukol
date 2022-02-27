<?php

namespace App\Controller;

use App\Entity\Kontakty;
use App\Form\Type\KontaktyType;
use App\Repository\KontaktyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class KontaktyController extends AbstractController
{

    private RequestStack $requestStack;

    /**
     * KontaktyController constructor.
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }


    #[Route('/', name: 'kontakty')]
    public function index(KontaktyRepository $kontaktyRepository): Response
    {
        $kontakty = $kontaktyRepository->findAll();
        return $this->render('kontakt/index.html.twig', [
            'kontakty' => $kontakty
        ]);
    }

    #[Route('/identifikator-kontaktu/{celeJmeno}', name: 'identifikator-kontaktu', methods: ['post', 'get'])]
    public function editovatKontakt(ManagerRegistry $doctrine, Request $request, string $celeJmeno): Response
    {
        if (!$request->getSession()->get('id_kontakt')) {
            $kontaktId = (int)$request->get('kontakt-id');
            $request->getSession()->set('id_kontakt', $kontaktId);
        }
        $entityManager = $doctrine->getManager();
        $kontakt = $entityManager->getRepository(Kontakty::class)
            ->find($request->getSession()->get('id_kontakt'));
        $form = $this->createForm(KontaktyType::class, $kontakt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $request->getSession()->remove('id_kontakt');
            return $this->redirectToRoute('kontakty');
        }

        return $this->render('kontakt/editovani.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
