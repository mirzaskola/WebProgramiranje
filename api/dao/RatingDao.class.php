<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CafeDao extends BaseDao{
    public function __construct(){
        parent::__construct("rating");
    }
    
}

// get rating, submit rating, (admin-delete)



?>