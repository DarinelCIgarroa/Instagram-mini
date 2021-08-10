<?php
    $images = Image::all();
    
    foreach($images as $image){
        echo $image->image_path     . "</br>";
        echo $image->description    . "</br>";
        echo $image->user->name . ' ' . $image->user->surname;

        if(count($image->comments) >= 1){
            echo "<h4>Comentarios</h4>";
            foreach($image->comments as $comment){
                
                echo $comment->user->name . '' . $comment->user->username . ': ' . $comment->content . "<br>";
            }
        }else{
            echo "<h4>NO HAY COMENTARIOS</h4>";
        }
     
        if(count($image->likes) >= 1){
            echo 'likes:' . count($image->likes);
        }else{
            echo "likes: 0";
        }
       
        echo "<hr>";

    }
        
   
    