<?php

class Power extends dbObject{
    
    protected static $db_table = "power";
	protected static $db_table_fields = array('tev', 'tev_eb', 'price');
	
	public $id;
    public $tev;
    public $tev_eb;
    public $price;
    
    public static function currTev(){
		global $db;
		$theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE id = '1' LIMIT 1");
		
		return !empty($theResultArray) ? array_shift($theResultArray) : false;
	}
	

}

?>