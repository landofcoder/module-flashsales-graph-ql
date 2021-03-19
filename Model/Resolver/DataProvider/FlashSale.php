<?php
/**
 * FlashSale
 *
 * @copyright Copyright © 2021 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

namespace Lof\FlashSalesGraphQl\Model\Resolver\DataProvider;

use Lof\FlashSales\Api\FlashSalesRepositoryInterface;
use Lof\FlashSales\Api\Data\FlashSalesInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\Store;
use Magento\Widget\Model\Template\FilterEmulate;

class FlashSale
{
    /**
     * @var FlashSalesRepositoryInterface
     */
    private $flashsalesRepository;

    /**
     * @var FilterEmulate
     */
    private $widgetFilter;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param FlashSalesRepositoryInterface $flashsalesRepository
     * @param FilterEmulate $widgetFilter
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        FlashSalesRepositoryInterface $flashsalesRepository,
        FilterEmulate $widgetFilter,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->flashsalesRepository = $flashsalesRepository;
        $this->widgetFilter = $widgetFilter;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Get flash sales data by flashsales_id
     *
     * @param int $flashsalesId
     * @param int $storeId
     * @return array
     * @throws NoSuchEntityException
     */
    public function getFlashSaleById(int $flashsalesId, int $storeId): array
    {
        $flashSaleData = $this->fetchFlashSaleData($flashsalesId, FlashSalesInterface::FLASHSALES_ID, $storeId);

        return $flashSaleData;
    }

    /**
     * Fetch black data by either id or identifier field
     *
     * @param mixed $flashsalesId
     * @param string $field
     * @param int $storeId
     * @return array
     * @throws NoSuchEntityException
     */
    private function fetchFlashSaleData($flashsalesId, string $field, int $storeId): array
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter($field, $flashsalesId)
            ->addFilter(Store::STORE_ID, [$storeId, Store::DEFAULT_STORE_ID], 'in')
            ->addFilter(FlashSalesInterface::IS_ACTIVE, true)->create();

        $flashSaleResults = $this->flashsalesRepository->getList($searchCriteria)->getItems();

        if (empty($flashSaleResults)) {
            throw new NoSuchEntityException(
                __('The Flash Sale with the "%1" ID doesn\'t exist.', $flashsalesId)
            );
        }
        $block = current($flashSaleResults);
        return [
            FlashSalesInterface::FLASHSALES_ID => $block->getFlashsalesId(),
            FlashSalesInterface::EVENT_NAME => $block->getEventName(),
            FlashSalesInterface::STATUS => $block->getStatus(),
        ];
    }

}
