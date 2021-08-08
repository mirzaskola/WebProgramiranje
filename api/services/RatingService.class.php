<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/RatingDao.class.php';

class RatingService extends BaseService{

  public function __construct(){
    $this->dao = new RatingDao();
  }

  public function get_ratings($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_ratings($search, $offset, $limit, $order, $total);
  }

  public function get_avg_rating($id){
    return $this->dao->get_avg_rating($id);
  }

  public function add_post_rating($user, $rating){
      if($this->dao->rating_exists($user["id"], $rating["post_id"])){
        throw new Exception("Already rated");
      }
      $data = [
        "user_id" => $user["id"],
        "post_id" => $rating["post_id"],
        "rating_value" => $rating["rating_value"]
      
    ];
      return parent::add($data);
  }

 
}
?>
