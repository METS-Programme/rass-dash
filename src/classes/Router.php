<?php

/**
 * Created by PhpStorm.
 * User: stephocay
 * Date: 11/01/2017
 * Time: 22:35
 */
class Router
{
    private static $task;
//    private static $infoo;

    public function __construct($option)
    {
        self::$task = $option;
        self::displayContent();
    }

    private static function displayContent()
    {
        switch (self::$task) {
            case 'stocks_stock_status':
                stock_status();
                break;
            case 'stocks_received':
                stocks_received();
                break;
            case 'stocks_ordered':
                stocks_ordered();
                break;
            case 'warehouses_jms':
                warehouses_jms();
                break;
            case 'warehouses_maul':
                warehouses_maul();
                break;
            case 'warehouses_nms':
                warehouses_nms();
                break;
            case 'reports_stockout_rates':
                reports_stockout_rates();
                break;
            case 'reports_art_sites':
                reports_art_sites();
                break;
            case 'reports_warehouse_dist':
                reports_warehouse_dist();
                break;
            default:
                stock_status();
                break;
        }
    }

}