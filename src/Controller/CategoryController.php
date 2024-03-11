<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\Type\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    //Add new cat
    #[Route('/new-cat', name: 'category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('');
        }
        return $this->render('category/newCat.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    //Get all cat
    #[Route('/category', name: 'category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response|NotFoundHttpException
    {
        $categories = $categoryRepository->getAllCategories();

        if (!$categories) {
            return $this->createNotFoundException('Catégories introuvables');
        }
        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    //Get cat by id
    #[Route('/category/{id}', name: 'category_show', methods: ['GET'])]
    public function show(int $id, CategoryRepository $categoryRepository): Response|NotFoundHttpException
    {
        $category = $categoryRepository->find($id);
        if (!$category) {
            return $this->createNotFoundException('Catégorie introuvable');
        }
        return $this->render('category/show.html.twig', [
            'category' => $category
        ]);
    }

    //Update cat by id
    #[Route('/category/{id}', name: 'category_update', methods: ['PUT'])]
    public function update(int $id, Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response|NotFoundHttpException
    {
        $category = $categoryRepository->find($id);

        if (!$category) {
            return $this->createNotFoundException(`Catégorie $id n'existe pas`);
        }

        $data = json_decode($request->getContent(), true);
        if (isset($data['name'])) {
            $category->setName($data['name']);
        }
        //Ajout d'autres champs à modifier

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->json([
            'message' => 'Catégorie mise à jour avec succès.',
            'data' => [
                'id' => $category->getId(),
                'name' => $category->getName(),
                // Incluez ici d'autres propriétés de Category si nécessaire
            ]
        ]);
    }

    //delete cat by id
    #[Route('/category/{id}', name: 'category_delete', methods: ['DELETE'])]
    public function delete(int $id, Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response|NotFoundHttpException
    {
        $category = $categoryRepository->find($id);
        if(!$category) {
            return $this->createNotFoundException(`Catégorie $id introuvable.`);
        }

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->json([
            'message' => 'Action réussie'],
            Response::HTTP_OK);
    }
};
