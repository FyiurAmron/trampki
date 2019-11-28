<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use /** @noinspection PhpUnusedAliasInspection */
    Symfony\Component\Routing\Annotation\Route;

class ProductController
{
    /**
     * @Route("/currentSneakerProducts", name="current_sneaker_products")
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function currentSneakerProductsAction(EntityManagerInterface $entityManager): Response
    {
        $productRepository = $entityManager->getRepository(Product::class);

        /** @noinspection PhpUndefinedMethodInspection */
        $results = $productRepository->findCurrentSneakerProducts();

        return new JsonResponse($results);
    }
}