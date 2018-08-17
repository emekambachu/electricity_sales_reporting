<?php

class User extends dbObject{
	
	protected static $db_table = "users";
	protected static $db_table_fields = array('uname', 'pword');
	
	public $id;
	public $uname;
	public $pword;


    public static function getActiveUsers(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'active' ORDER BY id DESC ");
    }
    
	public static function verifyUser($uname, $pword){
		global $db;
		
		$uname = $db->escapeString($uname);
		$pword = $db->escapeString($pword);
		
		$sql = "SELECT * FROM " . self::$db_table ." WHERE ";
		$sql .= "uname = '{$uname}' ";
		$sql .= "AND pword = '{$pword}' ";
		$sql .= " LIMIT 1 ";
		
		$theResultArray = self::findByQuery($sql);
		
		return !empty($theResultArray) ? array_shift($theResultArray) : false;
	}
	

}

?>