<?php
include("DB.class.php");
if(isset($_POST['mid'])){
    $media_id=$_POST['mid'];
    $uid=$_POST['uid'];
    $review=$_POST['review'];
    $rating=$_POST['rating'];

    $lastId=$db->delete('reviews',"user_id=".$uid." and media_id=".$media_id);
    $lastId=$db->insert('reviews', [
        'media_id' => $media_id,
        'user_id' => $uid,
        'review' => $review,
        'rating' => $rating,
    ]);

	    

}

?>