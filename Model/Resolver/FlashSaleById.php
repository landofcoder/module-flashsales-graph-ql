<?php
/**
 * FlashSaleById
 *
 * @copyright Copyright © 2021 Landofcoder. All rights reserved.
 * @author    landofcoder@gmail.com
 */

namespace Lof\FlashSalesGraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Lof\FlashSalesGraphQl\Model\Resolver\DataProvider\FlashSale as FlashSaleDataProvider;
use function is_numeric;

class FlashSaleById implements ResolverInterface
{
    /**
     * @var FlashSaleDataProvider
     */
    private $flashSaleDataProvider;

    /**
     * @param FlashSaleDataProvider $flashSaleDataProvider
     */
    public function __construct(
        FlashSaleDataProvider $flashSaleDataProvider
    ) {
        $this->flashSaleDataProvider = $flashSaleDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $storeId = (int)$context->getExtensionAttributes()->getStore()->getId();
        $flashSaleId = $this->getFlashSalesIds($args);
        $flashSalesData = $this->getFlashSalesData($flashSaleId, $storeId);

        return [
            'items' => $flashSalesData,
        ];
    }

    /**
     * Get Flash Sales Id
     *
     * @param array $args
     * @return string[]
     * @throws GraphQlInputException
     */
    private function getFlashSalesIds($args)
    {
        if (!isset($args['flashsales_id']) || is_array($args['flashsales_id'])) {
            throw new GraphQlInputException(__('"flashsales_id" of flash sales should be specified'));
        }

        return $args['flashsales_id'];
    }

    /**
     * Get blocks data
     *
     * @param array $flashSalesIds
     * @param int $storeId
     * @return array
     * @throws GraphQlNoSuchEntityException
     */
    private function getFlashSalesData($flashSalesIds, int $storeId)
    {
        $flashSaleData = [];
        foreach ($flashSalesIds as $flashSaleId) {
            try {
                if (!is_numeric($flashSaleId)) {
                    $flashSaleData[$flashSaleId] = $this->flashSaleDataProvider
                        ->getFlashSaleById($flashSaleId, $storeId);
                } else {
                    $flashSaleData[$flashSaleId] = $this->flashSaleDataProvider
                        ->getFlashSaleId((int)$flashSaleId, $storeId);
                }
            } catch (NoSuchEntityException $e) {
                $flashSaleData[$flashSaleId] = new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
            }
        }
        return $flashSaleData;
    }
}
