<?php
// Denna fil innehåll kod för att prata med posts.json
// Filen är alltså en modell för vår data som php kan prata med

class Posts{


    public static function getAll(){
        $postsString = file_get_contents("posts.json");
        $posts = json_decode($postsString, true);
        return $posts;
    }
    private static function saveAll($data){
        file_put_contents("posts.json" , json_encode($data, JSON_PRETTY_PRINT) );
    }
    public static function create($title, $text, $uid){

        $id = uniqid();
        $post = [
            "id"=>$id,
            "title"=>$title,
            "text"=>$text,
            "uid"=>$uid
        ];
        // Hämta alla gammal data
        $posts = self::getAll();
        // Lägg till vår nya data
        array_push($posts, $post);
        // spara till fil
        self::saveAll($posts);
        
    }



}