<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/PostDao.class.php';

class PostService extends BaseService{

  public function __construct(){
    $this->dao = new PostDao();
  }

  public function get_posts($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_posts($search, $offset, $limit, $order, $total);
  }

  public function add_post($post){

      $data= [
        "title" => $post['title'],
        "content" => $post['content'],
        "icon" => $post['icon']

      ];
       return parent::add($data);

  }
  //removing posts ????

}
?>