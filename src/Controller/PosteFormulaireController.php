<?php

namespace App\Controller;

use App\Entity\PosteFormulaire;
use App\Form\PosteFormulaireType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Mime\Part\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PosteFormulaireController extends AbstractController
{
    #[Route('/poste/formulaire', name: 'posteformulaire.index')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
    ): Response
    {
        // dd('ok');
        $poste_formulaire = new PosteFormulaire();

        $form = $this->createForm(PosteFormulaireType::class, $poste_formulaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $poste_formulaire = $form->getData();

            $cvFile = $form['cv']->getData();
            $lettreMotivationFile = $form['lettreMotivation']->getData();
            $photoIdentiteFile = $form['photoIdentite']->getData();
            $photoCompleteFile = $form['photoComplete']->getData();

            if ($cvFile) {
                // Handle CV file
                $cvFileName = uniqid().'.'.$cvFile->guessExtension();
                $cvFile->move(
                    $this->getParameter('your_cv_directory'), // Configure this in services.yaml
                    $cvFileName
                );
                $poste_formulaire->setCv($cvFileName);
            }

            if ($lettreMotivationFile) {
                // Handle lettre de motivation file
                $lettreMotivationFileName = uniqid().'.'.$lettreMotivationFile->guessExtension();
                $lettreMotivationFile->move(
                    $this->getParameter('your_lettre_motivation_directory'), // Configure this in services.yaml
                    $lettreMotivationFileName
                );
                $poste_formulaire->setLettreMotivation($lettreMotivationFileName);
            }

            if ($photoIdentiteFile) {
                // Handle photoIdentite file
                $photoIdentiteFileName = uniqid().'.'.$photoIdentiteFile->guessExtension();
                $photoIdentiteFile->move(
                    $this->getParameter('your_photo_directory'), // Configure this in services.yaml
                    $photoIdentiteFileName
                );
                $poste_formulaire->setPhotoIdentite($photoIdentiteFileName);
            }

            if ($photoCompleteFile) {
                // Handle photoComplete file
                $photoCompleteFileName = uniqid().'.'.$photoCompleteFile->guessExtension();
                $photoCompleteFile->move(
                    $this->getParameter('your_photo_directory'), // Configure this in services.yaml
                    $photoCompleteFileName
                );
                $poste_formulaire->setPhotoComplete($photoCompleteFileName);
            }

            // $manager->persist($poste_formulaire);
            // dd($poste_formulaire);
            $manager->flush();

            //Email

            $email = (new Email())
            ->from($poste_formulaire->getEmail())
            ->to('alissouanani@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Demande emploi pour le poste '.$poste_formulaire->getTitre())
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>')
            ->attachFromPath($this->getParameter('your_cv_directory').'/'.$cvFileName, 'Le CV')
            ->attachFromPath($this->getParameter('your_lettre_motivation_directory').'/'.$lettreMotivationFileName, 'La letttre de motivation');
            
          

            try {
                $mailer->send($email);
            } catch (\Exception $e) {
                // Traitez l'exception ici (affichage, journalisation, etc.)
                dd($e->getMessage());
                dd("ok");

            }
            // $manager->flush();


            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès !'
            );

            return $this->redirectToRoute('posteformulaire.index');
        } else {
            // $this->addFlash(
            //     'danger',
            //     $poste_formulaire->getErrors()
            // );
        }

    
        return $this->render('poste_formulaire/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
