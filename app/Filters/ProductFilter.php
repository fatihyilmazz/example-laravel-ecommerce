<?php

namespace App\Filters;

use Illuminate\Support\Collection;

class ProductFilter
{
    public const FETCH_TYPE_PAGINATE   = 1;
    public const FETCH_TYPE_COLLECT    = 2;
    public const FETCH_TYPE_MODEL      = 3;

    /**
     * @var Collection
     */
    private $productIds;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null;
     */
    private $slug;

    /**
     * @var Collection
     */
    private $categoryIds;

    /**
     * @var Collection
     */
    private $brandIds;

    /**
     * @var Collection
     */
    private $rowNumbers;

    /**
     * @var bool|null
     */
    private $isActive;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $fetchType;

    /**
     * @var string
     */
    private $orderBy = 'id';

    /**
     * @var string
     */
    private $sortBy = 'DESC';

    /**
     * @var string
     */
    private $paginateRoute;

    /**
     * ProductFilter constructor
     */
    public function __construct()
    {
        $this->productIds   = new Collection();
        $this->categoryIds  = new Collection();
        $this->brandIds     = new Collection();
        $this->rowNumbers   = new Collection();
    }

    /**
     * @return Collection
     */
    public function getProductIds(): Collection
    {
        return $this->productIds;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param int $productId
     */
    public function addProductId(int $productId): void
    {
        if (!$this->productIds->contains($productId)) {
            $this->productIds->add($productId);
        }
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     *
     * @return $this
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCategoryIds(): Collection
    {
        return $this->categoryIds;
    }

    /**
     * @param int $categoryId
     */
    public function addCategoryId(int $categoryId): void
    {
        if (!$this->categoryIds->contains($categoryId)) {
            $this->categoryIds->add($categoryId);
        }
    }

    /**
     * @return Collection
     */
    public function getBrandIds(): Collection
    {
        return $this->brandIds;
    }

    /**
     * @param int $brandId
     */
    public function addBrandId(int $brandId): void
    {
        if (!$this->brandIds->contains($brandId)) {
            $this->brandIds->add($brandId);
        }
    }

    /**
     * @return Collection
     */
    public function getRowNumbers(): Collection
    {
        return $this->rowNumbers;
    }

    /**
     * @param int $rowNumber
     */
    public function addRowNumber(int $rowNumber): void
    {
        if (!$this->rowNumbers->contains($rowNumber)) {
            $this->rowNumbers->add($rowNumber);
        }
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     *
     * @return $this
     */
    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return int
     */
    public function getFetchType(): int
    {
        return $this->fetchType;
    }

    /**
     * @param int $fetchType
     *
     * @return $this
     */
    public function setFetchType(int $fetchType): self
    {
        $this->fetchType = $fetchType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     *
     * @return $this
     */
    public function setPerPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @param string $orderBy
     *
     * @return $this
     */
    public function setOrderBy(string $orderBy): self
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    /**
     * @param string $sortBy
     *
     * @return $this
     */
    public function setSortBy(string $sortBy): self
    {
        $this->sortBy = $sortBy;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaginateRoute(): ?string
    {
        return $this->paginateRoute;
    }

    /**
     * @param string $paginateRoute
     *
     * @return $this
     */
    public function setPaginateRoute(string $paginateRoute): self
    {
        $this->paginateRoute = $paginateRoute;

        return $this;
    }
}
