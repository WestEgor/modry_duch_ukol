<?php

namespace App\Controller;

use App\Entity\Kontakty;
use App\Form\Type\KontaktyType;
use App\Repository\KontaktyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Třída pro práci s kontakty
 *
 * Class KontaktyController
 * @package App\Controller
 */
class KontaktyController extends AbstractController
{

    /**
     * Zobrázení všech kontaktů
     *
     * @param KontaktyRepository $kontaktyRepository
     * @return Response
     */
    #[Route('/', name: 'kontakty')]
    public function index(KontaktyRepository $kontaktyRepository): Response
    {
        $kontakty = $kontaktyRepository->findAll();
        return $this->render('kontakt/index.html.twig', [
            'kontakty' => $kontakty
        ]);
    }

    /**
     * Editování zvoleného kontaktu
     *
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param string $celeJmeno
     * @return Response
     */
    #[Route('/identifikator-kontaktu/{celeJmeno}', name: 'identifikator-kontaktu', methods: ['post', 'get'])]
    public function editovatKontakt(ManagerRegistry $doctrine, Request $request, string $celeJmeno): Response
    {
        /** Nastavení session pro id kontaktu */
        if (!$request->getSession()->get('id_kontakt')) {
            /** @var int $kontaktId bereme z formy, kontakt/index.html.twig */
            $kontaktId = (int)$request->get('kontakt-id');
            $request->getSession()->set('id_kontakt', $kontaktId);
        }
        $entityManager = $doctrine->getManager();
        /** @var Kontakty $kontakt nalézání kontaktu dle ID */
        $kontakt = $entityManager->getRepository(Kontakty::class)
            ->find($request->getSession()->get('id_kontakt'));
        $form = $this->createForm(KontaktyType::class, $kontakt);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            /** vymazat id kontaktu z session*/
            $request->getSession()->remove('id_kontakt');
            return $this->redirectToRoute('kontakty');
        }

        return $this->render('kontakt/editovani.html.twig', [
            'form' => $form->createView(),
            'kontakt_id' => $request->getSession()->get('id_kontakt')
        ]);
    }

    /**
     * Jednoduché mazání kontaktu
     *
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     */
    #[ROUTE('/delete_article/{id}', name: 'smazat-kontakt', methods: ['get'])]
    public function smazatKontakt(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        /** @var Kontakty $kontakt nalézání kontaktu dle ID */
        $kontakt = $entityManager->getRepository(Kontakty::class)->find($id);
        $entityManager = $doctrine->getManager();
        if ($kontakt !== null) {
            $entityManager->remove($kontakt);
        }
        $entityManager->flush();
        return $this->redirectToRoute('kontakty');
    }
}
