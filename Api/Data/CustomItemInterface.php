<?php

namespace Company\CustomGrid\Api\Data;

interface CustomItemInterface
{
    public const ID = 'id';
    public const NAME = 'name';
    public const STATUS = 'status';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param int|null $id
     *
     * @return void
     */
    public function setId(?int $id): void;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool;

    /**
     * @param bool|null $status
     *
     * @return void
     */
    public function setStatus(?bool $status): void;

    /**
     * @return int|null
     */
    public function getCreatedAt(): ?int;

    /**
     * @param int|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?int $createdAt): void;

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int;

    /**
     * @param int|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?int $updatedAt): void;
}
