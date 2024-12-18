<?php

namespace Company\CustomGrid\Api;

use Company\CustomGrid\Api\Data\CustomItemInterface;
use Company\CustomGrid\Model\CustomItem;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface CustomItemRepositoryInterface
{
    /**
     * @param $id
     * @return CustomItem
     */
    public function getById($id): CustomItem;

    /**
     * @param CustomItemInterface $customGrid
     * @return int
     */
    public function save(CustomItemInterface $customGrid): int;

    /**
     * @param $id
     */
    public function delete($id): void;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultsInterface;
}
