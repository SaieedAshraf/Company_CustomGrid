<?php

namespace Company\CustomGrid\Ui\DataProvider\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect(): void
    {
        $this->addFilterToMap('id', 'main_table.id');
        $this->addFilterToMap('name', 'main_table.name');
        $this->addFilterToMap('created_at', 'main_table.created_at');
        $this->addFilterToMap('updated_at', 'main_table.updated_at');
        parent::_initSelect();
    }
}
