<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use App\BusinessObjects\Product as BusinessProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{

    private const CURRENT_SNEAKER_PRODUCTS_QUERY = '
SELECT
    name,
    product_id,
    prop_key,
    prop_value
FROM
    product 
LEFT JOIN
    product_property 
  ON
    product_id = product.id 
WHERE
    product_id
  IN (
    SELECT
        product_id 
    FROM
        product_property 
    WHERE
        prop_key = \'kategoria\' 
      AND
        prop_value = \'trampki\'
      AND
        product_id
          NOT IN (
            SELECT DISTINCT
                product_id 
            FROM
                product_property 
            WHERE 
                prop_key = \'kategoria\' 
            AND
                prop_value = \'outlet\'
          )
  )
  ';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findCurrentSneakerProducts(): array
    {
        $connection = $this->getEntityManager()->getConnection();

        $resultsRaw = $connection->fetchAll(self::CURRENT_SNEAKER_PRODUCTS_QUERY);

        $results = BusinessProduct::createCollectionFromDbRows($resultsRaw);

        return $results;
    }
}
