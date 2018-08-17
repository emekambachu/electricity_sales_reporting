<?php

class Sale extends dbObject{

    protected static $db_table = "sales";
    protected static $db_table_fields = array('ev', 'price', 'amount', 'eb', 'date_sold');

    public $id;
    public $ev;
    public $price;
    public $amount;
    public $eb;
    public $date_sold;

    public static function allSales5(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." ORDER BY id DESC LIMIT 5");
    }

}

?>