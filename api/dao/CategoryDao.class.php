<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CafeDao extends BaseDao{
    public function __construct(){
        parent::__construct("category");
    }
    
}

//ime kategorije 



?>