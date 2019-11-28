<?php
declare(strict_types=1);

namespace App\BusinessObjects;

class Product implements \JsonSerializable
{
    /** @var string */
    private $name;
    /** @var array */
    private $categories = [];
    /** @var array */
    private $colours = [];

    /**
     * Constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        /** @noinspection UnusedConstructorDependenciesInspection */
        $this->name = $name;
    }

    /**
     * @param array $rows
     *
     * @return Product[]
     */
    public static function createCollectionFromDbRows(array $rows): array // TODO use typed collection etc.
    {
        $products = [];

        foreach ($rows as $row) {
            $name = $row['name'];
            $product = $products[$name] ?? null;

            if ($product === null) {
                $product = new Product($name);
                $products[$name] = $product;
            }

            switch ( $row['prop_key']) {
                case 'kategoria':
                    $product->categories[] = $row['prop_value'];
                    break;
                case 'kolor':
                    $product->colours[] = $row['prop_value'];
                    break;
            }
        }

        return $products;
    }

    public function jsonSerialize()
    {
        // return \get_object_vars($this);
        return [
            'categories' => $this->categories,
            'colours' => $this->colours,
        ];
    }
}