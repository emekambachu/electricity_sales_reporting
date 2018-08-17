<?php

class Comment extends dbObject{
	
	protected static $db_table = "comments";
	protected static $db_table_fields = array('post_id', 'author', 'body', 'created');
	
	public $id;
	public $post_id;
	public $author;
	public $body;
    public $created;
    
    
    public static function addComment($post_id, $author = "Anonymous", $body = "", $created=""){
        
        if(!empty($post_id) && !empty($author) && !empty($body)){
            
            $comment = new Comment();
            
            $comment->post_id = (int)$post_id;
            $comment->author = $author;
            $comment->body = $body;
            $comment->created = $created;
            
            return $comment;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public static function findComments($post_id = 0){
        
        global $db;
        
        $sql = "SELECT * FROM " . self::$db_table;
        $sql .= " WHERE post_id = " . $db->escapeString($post_id);
        $sql .= " ORDER BY id ASC";
        
        return self::findByQuery($sql);
        
    }
    

}

?>