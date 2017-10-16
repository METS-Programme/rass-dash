<?php

/**
 * Created by PhpStorm.
 * User: stephocay
 * Date: 14/02/2017
 * Time: 16:41
 */
class Content
{
    public function __construct()
    {
        @$this->category = $_GET['category'];
        @$this->option = $_GET['option'];
    }

    public function controlPanel()
    {
        $task = $this->getTask();
        @$category = ($_GET['category'] != "") ? $_GET['category'] : "stocks";
        $option = $category . "_" . $task;
        new Router($option);
    }

    public function getTask()
    {
        @$task = $this->option;

        if ($task == "") {
            if (@$_GET['category'] != "") {
                $task = $this->defaultTask($_GET['category']);
            }
        }
        return $task;
    }

    public function defaultTask($category)
    {
        switch ($category) {
            case 'stocks':
                $task = "stock_status";
                break;
            case 'warehouses':
                $task = "nms";
                break;
            case 'reports':
                $task = "stockout_rates";
                break;
            default:
                $task = "stock_status";
                break;
        }
        return $task;
    }

}