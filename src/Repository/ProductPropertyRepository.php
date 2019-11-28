<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProductProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProductProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductProperty[]    findAll()
 * @method ProductProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductProperty::class);
    }
}
