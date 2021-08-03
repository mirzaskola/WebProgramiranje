<?php 
require_once dirname(__FILE__)."/BaseDao.class.php";

class RatingDao extends BaseDao{
    public function __construct(){
        parent::__construct("rating");
    }
    


// get rating, submit rating, (admin-delete)

public function get_post_rating($id){

    return $this->query_unique("SELECT * FROM post p LEFT JOIN rating r ON p.id = r.post_id WHERE p.id = :id",["id"=>$id]);

}

public function get_comment_rating($id){
    return $this->query_unique("SELECT * FROM comment c LEFT JOIN rating r ON c.id = r.comment_id WHERE c.id = :id",["id"=>$id]);
}

public function get_game_rating($id){
    return $this->query_unique("SELECT * FROM game g LEFT JOIN rating r ON g.id = r.comment_id WHERE g.id = :id",["id"=>$id]);

}


public function delete_rating($id, $table, $fk){

} 
/*
base dao extends insert function

public function add_post_rating(id, post_id, user_id){
    return $this->query_unique("INSERT INTO rating (rating_value,post_id,user_id) VALUES ('3','2','2');  ",["id"=>$id]);
}

*/
}

 ?>