<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class PostDao extends BaseDao{
    public function __construct(){
        parent::__construct("post");
    }
    
}

// get post, submit post, (admin-remove) , report??, edit post, 
//registered user moze postat stvari


?>