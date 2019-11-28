<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\Product;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CurrentSneakerProductsCommand extends Command
{
    protected static $defaultName = 'app:current-sneaker-products';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure() : void
    {
        $this
            ->setDescription('Prints current (not outlet) sneaker products');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $productRepository = $this->entityManager->getRepository(Product::class);

        /** @noinspection PhpUndefinedMethodInspection */
        $products = $productRepository->findCurrentSneakerProducts();

        $text = \print_r($products, true );

        $io->success($text);

        return 0;
    }
}
