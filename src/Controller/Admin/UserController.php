<?php
/**
 * CRUD Users Symfony for FOSUserBundle
 * @author wilmshorst.tom@gmail.com
 * @copyright Thomas Wilmshorst
 */

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserManagerInterface $userManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userToPersist= $userManager->createUser();
            $userToPersist->setUsername($form->getData()->getUsername());
            $userToPersist->setEmail($form->getData()->getEmail());
            $userToPersist->setEnabled($form->getData()->isEnabled());
            $userToPersist->setPlainPassword($form->getData()->getPassword());

            $userManager->updateUser($userToPersist);

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserManagerInterface $userManager): Response
    {
        $fakeUser = new \stdClass();
        $fakeUser->username = $user->getUsername();
        $fakeUser->email = $user->getEmail();
        $fakeUser->enabled = $user->isEnabled();
        $fakeUser->password = $user->getPassword();

        $form = $this->createForm(UserType::class, $fakeUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userToPersist = $userManager->findUserByUsername($user->getUsername());
            $userToPersist->setUsername($fakeUser->username);
            $userToPersist->setEmail($fakeUser->email);
            $userToPersist->setEnabled($fakeUser->enabled);
            if(null !== $fakeUser->password) $userToPersist->setPlainPassword($fakeUser->password);

            $userManager->updateUser($userToPersist);

            return $this->redirectToRoute('user_index', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user, UserManagerInterface $userManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userManager->deleteUser($userManager->findUserByUsername($user->getUsername()));
        }

        return $this->redirectToRoute('user_index');
    }
}
