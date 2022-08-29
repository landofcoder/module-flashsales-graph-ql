# Mage2 Module Lof FlashSalesGraphQl

    ``landofcoder/module-flashsales-graph-ql``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)

## Main Functionalities
Magento 2 flashsales graphql module

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Lof`
 - Enable the module by running `php bin/magento module:enable Lof_FlashsalesGraphQl`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require landofcoder/module-flashsales-graph-ql`
 - enable the module by running `php bin/magento module:enable Lof_FlashsalesGraphQl`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`



## Get FlashSale By Id
```
{
    flashSale(
        flashsales_id:int
    ){
        flashsales_id
        event_name
        from_date
        to_date
        sort_order
        updated_at
        created_at
        conditions_serialized
        category_id
        is_private_sale
        thumbnail_image
        header_banner_image
        is_default_private_config
        restricted_landing_page
        grant_event_view
        grant_event_product_price
        grant_checkout_items
        grant_checkout_items_groups
        grant_event_view_groups
        grant_event_product_price_groups
        display_cart_mode
        display_product_mode
        cart_button_title
        message_hidden_add_to_cart
        is_active
        status
    }
}
```

### Get flashsale query
```
{
    flashSales(
        filter:{}
    ){
       total_count
       items{
            flashsales_id
            event_name
            from_date
            to_date
            sort_order
            updated_at
            created_at
            conditions_serialized
            category_id
            is_private_sale
            thumbnail_image
            header_banner_image
            is_default_private_config
            restricted_landing_page
            grant_event_view
            grant_event_product_price
            grant_checkout_items
            grant_checkout_items_groups
            grant_event_view_groups
            grant_event_product_price_groups
            display_cart_mode
            display_product_mode
            cart_button_title
            message_hidden_add_to_cart
            is_active
            status
       } 
    }
}
```

### Get config flashsale
```
{
  storeConfig {
    lofflashsale_category_id
  }
}
```
