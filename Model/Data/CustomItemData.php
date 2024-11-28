<?php

namespace Company\CustomGrid\Model\Data;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Magento\Framework\DataObject;

class CustomItemData extends DataObject implements CustomItemInterface
{
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->getData(self::ID) === null ? null
            : (int)$this->getData(self::ID);
    }

    /**
     * @param int|null $id
     *
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->setData(self::ID, $id);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->getData(self::STATUS) === null ? null
            : (bool)$this->getData(self::STATUS);
    }

    /**
     * @param bool|null $status
     *
     * @return void
     */
    public function setStatus(?bool $status): void
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->getData(self::CREATED_AT) === null ? null
            : (int)$this->getData(self::CREATED_AT);
    }

    /**
     * @param int|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->getData(self::UPDATED_AT) === null ? null
            : (int)$this->getData(self::UPDATED_AT);
    }

    /**
     * @param int|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?int $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
