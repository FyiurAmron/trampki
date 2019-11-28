<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductPropertyRepository")
 */
class ProductProperty
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="Product")
     */
    private $productId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $propKey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $propValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getPropKey(): ?string
    {
        return $this->propKey;
    }

    public function setPropKey(string $propKey): self
    {
        $this->propKey = $propKey;

        return $this;
    }

    public function getPropValue(): ?string
    {
        return $this->propValue;
    }

    public function setPropValue(string $propValue): self
    {
        $this->propValue = $propValue;

        return $this;
    }
}
