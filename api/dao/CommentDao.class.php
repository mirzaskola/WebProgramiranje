<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CommentDao extends BaseDao{
    public function __construct(){
        parent::__construct("comment");
    }
    
}

//submitaj komentar, get comment, user_id za komentatora, comment body


?>