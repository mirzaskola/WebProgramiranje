<?php
require_once dirname(__FILE__)."/BaseDao.class.php";

class CafeDao extends BaseDao{
    public function __construct(){
        parent::__construct("game");
    }
    
}


//image, icon, rating, category, descript, name, preko kategorije listu igara iz kategorije

?>