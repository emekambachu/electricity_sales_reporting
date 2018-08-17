<?php

class Investment extends dbObject{
    
    protected static $db_table = "investments";
	protected static $db_table_fields = array('user_id', 'amount', 'days', 'days_unix', 'profit', 'pending', 'date_invested', 'date_matched', 'date_completed', 'status', 'profit_status');
	
	public $id;
    public $user_id;
	public $amount;
	public $days;
    public $days_unix;
    public $profit;
    public $pending;
	public $date_invested;
    public $date_matched;
	public $date_completed;
	public $status;
    public $profit_status;
    
    //Check if user has already invested
	public static function checkinv($user_id){
		return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$user_id' AND (status = 'pledged' OR status = 'matched')");
	}

    public static function getAllInv($user_id){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$user_id'");
    }

    //get current pledge and match
    public static function getCurrentInv($pay_id){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$pay_id' AND (status ='pledged' OR status = 'matched') LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    //get current pledge
    public static function checkPledge($id){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$id' AND status ='pledged' LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    //get current Match
    public static function currentMatch($id){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$id' AND status ='matched' LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    //select from investors where status is equal to Pledged
    public static function getInvestors(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'pledged'");
    }

    //select from investors where status is equal to Pledged
    public static function getPledgedInvestments(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'pledged'");
    }

    //select from investors where status is equal to invested
    public static function getPaidInvestments(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'invested'");
    }

    //select from investors where status is equal to Matched
    public static function getMatchedInvestments(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'matched'");
    }

    //select from investors where status is equal to Matched
    public static function getCompleteInvestments(){
        return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'complete'");
    }

    //get payer information
    public static function getPayerInfo($pay_id){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$pay_id' AND status ='pledged' LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    //Get receiver information
    public static function getReceiverInfo($rec_id){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE user_id = '$rec_id' AND status = 'invested' LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    //get payer info for cron
    public static function getPayerCron(){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status ='pledged' ORDER BY RAND() LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }

    //Get receiver info for cron
    public static function getReceiverCron(){
        global $db;
        $theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE status = 'invested' ORDER BY RAND() LIMIT 1");

        return !empty($theResultArray) ? array_shift($theResultArray) : false;
    }


}

?>