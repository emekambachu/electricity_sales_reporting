<?php

class dbObject{
    
    public $errors = array();
    public $uploadErrorsArray = array(


	UPLOAD_ERR_OK           => "There is no error",
	UPLOAD_ERR_INI_SIZE		=> "The uploaded file exceeds the upload_max_filesize directive in php.ini",
	UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
	UPLOAD_ERR_PARTIAL      => "The uploaded file was only partially uploaded.",
	UPLOAD_ERR_NO_FILE      => "No file was uploaded.",               
	UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
	UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
	UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."					
												

    );
    
    public function setFile($file){
    
        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file upload here";
            return false;

        }elseif($file['error'] !=0){
            $this->errors[] = $this->uploadErrorsArray[$file['error']];
            return false;

        }else{

            $this->img = basename($file['name']);
            $this->tmpPath = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        }
    
    }
    
    public static function findAll(){
		return static::findByQuery("SELECT * FROM " . static::$db_table ." ORDER BY id DESC ");
	}
	
	public static function findById($id){
		global $db;
		$theResultArray = static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE id = '$id' LIMIT 1");
		
		return !empty($theResultArray) ? array_shift($theResultArray) : false;
	}
    
    public static function findByQuery($sql){
		global $db;
		
		$resultSet = $db->query($sql);
		$theObjectArray = array();
		
		while($row = mysqli_fetch_array($resultSet)){	
			$theObjectArray[] = static::instantiation($row);	
		}
		return $theObjectArray;
	}
    
    public static function instantiation($theRecord){
        
        $callingClass = get_called_class();
		
		$theObject = new $callingClass;
		
		foreach ($theRecord as $theAttribute => $value){
			
			if($theObject->hasTheAttribute($theAttribute)){
				
				$theObject->$theAttribute = $value;
				
			}
		}
		
		return $theObject;	
	}
	
	private function hasTheAttribute($thisAttribute){
		$objectProperties = get_object_vars($this);
		return array_key_exists($thisAttribute, $objectProperties);
	}
    
    protected function properties(){ // start properties
		
		$properties = array();
		foreach(static::$db_table_fields as $db_field){
			
			if(property_exists($this, $db_field)){
				
				$properties[$db_field] = $this->$db_field;
				
			}
		}
		
		return $properties;
	}// end properties
    
    protected function cleanProperties(){
        global $db;
        
        $cleanProperties = array();
        
        foreach($this->properties() as $key => $value){
            
            $cleanProperties[$key] = $db->escapeString($value);
            
        }
        
        return $cleanProperties;
        
    }
    
    //save
	public function save(){
		
		return isset($this->id) ? $this->update() : $this->create();
		
	}
	
	//create
	public function create(){
		global $db;
		
		$properties = $this->properties();
		
		$sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
		
		$sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

		if($db->query($sql)){
			
			$this->id = $db->theInsertId();
			
			return true;
		}else{
			return false;
		}// end create
		
	}
	
	//Update
	public function update(){
		global $db;
		
		$properties = $this->properties();
		
		$propertyPairs = array();
		
		foreach($properties as $key => $value){
			$propertyPairs[] = "{$key}='{$value}'";
		}
		
		$sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $propertyPairs);
		
		$sql .= " WHERE id= " . $db->escapeString($this->id);
		
		$db->query($sql);
		
		return (mysqli_affected_rows($db->conn) == 1) ? true : false;
	} //End of update
	
	
	//Delete
	public function delete(){
		global $db;
		
		$sql = "DELETE FROM " . static::$db_table . " ";
		$sql .= "WHERE id=" . $db->escapeString($this->id);
		$sql .= " LIMIT 1";
		
		$db->query($sql);
		
		return (mysqli_affected_rows($db->conn) == 1) ? true : false;
	} //End of Delete
    
    public static function countAll(){
        
        global $db;
        
        $sql = " SELECT COUNT(*) FROM " . static::$db_table;
        $resultSet = $db->query($sql);
        $row = mysqli_fetch_array($resultSet);
        
        return array_shift($row);  
    }
    
}

?>