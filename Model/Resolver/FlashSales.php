<?php
/**
 * FlashSales
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

class FlashSales extends ResolverInterface
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

}
