<?php
require_once('assets/init.php');
$letter=$_POST['alphabet'];

  
  $query="SELECT *  FROM Wo_Users f1 INNER JOIN Wo_Followers f2 ON f1.user_id = f2.follower_id WHERE f1.username LIKE '$letter%' GROUP BY follower_id";
  $result=mysqli_query($sqlConnect,$query);
  while($row=mysqli_fetch_assoc($result)){
$data='';
$data.='<div class="col-xs-6 col-sm-4 nearby_user_wrapper text-center user-data" data-user-id="">';
  $data.='<div class="avatar">';
      $data.='<img src="/' .$row['avatar'] . '" alt="' .$row['name'] . ' Profile Picture" />';
    $data.='</div>';
  $data.='<span class="user-popover" data-id="" data-type="">';
  $data.='<a href="" data-ajax="?link1=timeline&u='.$row['username'].'" class="user_wrapper_link">'.$row['username'].'</a>';
  $data.='</span>';
  
  
  $data.='<div class="user-lastseen">'.date('d', $row['lastseen']).' days ago';
    
  $data.='</div>';
  
  
  $data.='<div class="user-follow-button">';
    
      $data.='<span data-family-member="'.$row['user_id'].'">';
          $data.='<button type="button" class="btn btn-default btn-sm wo_following_btn" onclick="" id="wo_useract_btn">';
             $data.='<i class="fa fa-times progress-icon" data-icon="fa-times"></i>';
             $data.='<span class="button-text">Following</span>';
          $data.='</button>';
      $data.='</span>';
    
  $data.='</div>';
$data.='</div>';
echo $data;}
  

    
    
?>