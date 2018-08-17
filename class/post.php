<?php

class Post extends dbObject{
    
    protected static $db_table = "posts";
	protected static $db_table_fields = array('cat_id', 'title', 'author', 'keywords', 'description', 'img', 'created');
	
	public $id;
    public $cat_id;
	public $title;
    public $author;
	public $keywords;
	public $description;
    public $img;
    public $created;
    
    public $tmpPath;
    public $uploadDir = "post_img";
    public $imgPlace = "post_img/pic.png";
    
    
    public static function findAllPosts5(){
		return static::findByQuery("SELECT * FROM " . static::$db_table ." ORDER BY id DESC Limit 5 ");
	}
    
    public static function findAllPostsRandom(){
		return static::findByQuery("SELECT * FROM " . static::$db_table ." ORDER BY RAND() Limit 7 ");
	}
    
    public static function findAllPostsR4($id){
		return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE cat_id = '$id' ORDER BY RAND() Limit 4 ");
	}
    
    public static function findByCatId($id){
		return static::findByQuery("SELECT * FROM " . static::$db_table ." WHERE cat_id = '$id' ORDER BY id DESC");
	}
    
public function uploadPostImg(){ //method for saving
    
    if($this->id){
        
        $this->update();
        
    }else{
    
        if(!empty($this->errors)){
            return false; 
        }
        
        if(empty($this->img) || empty($this->tmpPath)){
            $this->errors[] = "the file was not available";
            return false;
        }
        
        $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->uploadDir . DS . $this->img;
        
        if(file_exists($targetPath)){
            $this->errors[] = "The file {$this->img} already exists";
            return false;
        }
        
        if(move_uploaded_file($this->tmpPath, $targetPath)){
            if($this->create()){
                unset($this->tmpPath);
                return true;
            }
        }else{
            
            $this->errors[] = "the file directory does not have permission";
            return false;
            
        }
        
        
    }
    
}
    

public function updatePostImg(){ //method for saving
    
            if(!empty($this->errors)){
                return false; 
            }

            if(empty($this->img) || empty($this->tmpPath)){
                $this->errors[] = "the file was not available";
                return false;
            }

            $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->uploadDir . DS . $this->img;

            if(file_exists($targetPath)){
                $this->errors[] = "The file {$this->img} already exists";
                return false;
            }

            if(move_uploaded_file($this->tmpPath, $targetPath)){
                
                    unset($this->tmpPath);
                    return true;
            
            }else{

                $this->errors[] = "the file directory does not have permission";
                return false;

            }
    }    
    
public function imagePathPlace(){

    return empty($this->img) ? $this->imgPlace : $this->uploadDir.DS.$this->img;

}

public function deletePostPic(){

    if($this->delete()){

        $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->uploadDir . DS . $this->img;

        return unlink($targetPath) ? true : false;
    }else{
        return false;
    }

}
	

}

?>