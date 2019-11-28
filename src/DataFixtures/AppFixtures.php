<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\ProductProperty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Product;

class AppFixtures extends Fixture
{
    public const TEST_PRODUCTS = [
        'Buty Puma' => [
            'kolor' => [
                'niebieski'
            ],
            'kategoria' => [
                'trampki',
                'nowości',
            ],
        ],
        'Trampki Converse' => [
            'kolor' => [
                'czerwony',
            ],
            'kategoria' => [
                'trampki',
            ],
        ],
        'Trampki Vans' => [
            'kolor' => [
                'czarny',
            ],
            'kategoria' => [
                'trampki',
                'outlet',
            ],
        ],
        'Sukienka Fila' => [
            'kolor' => [
                'czerwony'
            ],
            'kategoria' => [
                'sukienka',
            ],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $products = [];

        foreach (self::TEST_PRODUCTS as $name => $propertySets) {
            $product = new Product();

            $product->setName($name);

            $products[$name] = $product;

            $manager->persist($product);
        }

        $manager->flush();

        foreach (self::TEST_PRODUCTS as $name => $propertySets) {
            foreach ($propertySets as $propertyName => $propertyValues) {
                foreach ($propertyValues as $propertyValue) {
                    $property = new ProductProperty();

                    $property->setPropKey($propertyName);
                    $property->setPropValue($propertyValue);
                    $property->setProductId($products[$name]->getId());

                    $manager->persist($property);
                }
            }
        }

        $manager->flush();
    }
}
