<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/GameDao.class.php';

class GameService extends BaseService{

  private $categoryDao;

  public function __construct(){
    $this->dao = new GameDao();
  }


  public function get_game($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_game($search, $offset, $limit, $order, $total);
  }


  public function add_game($game){

      $data= [
        "game_name" => $game['game_name'],
        "description" => $game['description'],
        "image" => $game['image'],
        "rating" =>$game['rating']
      ];


       return parent::add($data);

  }
}
?>