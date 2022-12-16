<?php

//echo 'Hello welcome to the dashboard';die;

// print_r($_REQUEST);die;
// $token = explode(".", $_REQUEST['id_token']);
// $id_token = base64_decode($token);
// $token_data = json_decode($id_token);
// $token_array = (array)$token_data;


// print_r($token_array);die;


//$ar = 'eyJraWQiOiJXNldjT0tCIiwiYWxnIjoiUlMyNTYifQ.eyJpc3MiOiJodHRwczovL2FwcGxlaWQuYXBwbGUuY29tIiwiYXVkIjoiY29tLnJldm9sdXMubGxjLnNlcnZpY2UiLCJleHAiOjE2NDc1NTAwNTEsImlhdCI6MTY0NzQ2MzY1MSwic3ViIjoiMDAxOTQzLjgyYjM1YjIxNGNlODQ4NWY4NzUxYjg5YmQ4OGZhY2JmLjE5MDIiLCJjX2hhc2giOiJYaFNBMnZOWVZCWWxMUlNhakg5d0tnIiwiZW1haWwiOiJmNWtiejRoN3A1QHByaXZhdGVyZWxheS5hcHBsZWlkLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjoidHJ1ZSIsImlzX3ByaXZhdGVfZW1haWwiOiJ0cnVlIiwiYXV0aF90aW1lIjoxNjQ3NDYzNjUxLCJub25jZV9zdXBwb3J0ZWQiOnRydWV9.FUBoe4bcEBvU0yW_yDuRtPLYdSNFew2ipApWMCRPzbXpdOboZDIVcWhj8EgzlbvRZWQRKDFZGCiJ_4WE3m5Cy-gucBpHeUNplgUghbt9iUfYR53ZL1x0Mu4v96IcNdS5DSkmNXyRx41dhrk5YG6krf6NoanrzaJL2G-7bq5M7qC-N0lsroZq5CdarHoCOa8tadNgQSaGS9DdBfZt8AOPzQmUca4gUqTC3lG8RLhfnJzQhpQd2djtZEvXezaZ7WTHoQaIDh7CCGClj4c5QqnB7yt6n4WOJvKBSRhmcZ1SWZ9CfWA7ps7bzumv7n5VXxjtRwpC2fQLnUCnEol_8DfC5Q';


if(isset($_REQUEST['id_token'])){
    $tokens = explode(".", $_REQUEST['id_token']);
    if(is_array($tokens) && isset($tokens[0])){
        foreach($tokens as $token){
            $data = json_decode(base64_decode($token));
            if(isset($data->email) && !empty($data->email)){
                echo $data->email;
            }
        }
    }
}

?>



HIDE EMAIL

Array
(
    [link1] => applesignin
    [state] => 8189b80e19
    [code] => c1874b540eea24573b9640d7ed5546c79.0.rrzut.y6M-U92rvJ_IH_uuURzoJg
    [id_token] => eyJraWQiOiJXNldjT0tCIiwiYWxnIjoiUlMyNTYifQ.eyJpc3MiOiJodHRwczovL2FwcGxlaWQuYXBwbGUuY29tIiwiYXVkIjoiY29tLnJldm9sdXMubGxjLnNlcnZpY2UiLCJleHAiOjE2NDc1NTAwNTEsImlhdCI6MTY0NzQ2MzY1MSwic3ViIjoiMDAxOTQzLjgyYjM1YjIxNGNlODQ4NWY4NzUxYjg5YmQ4OGZhY2JmLjE5MDIiLCJjX2hhc2giOiJYaFNBMnZOWVZCWWxMUlNhakg5d0tnIiwiZW1haWwiOiJmNWtiejRoN3A1QHByaXZhdGVyZWxheS5hcHBsZWlkLmNvbSIsImVtYWlsX3ZlcmlmaWVkIjoidHJ1ZSIsImlzX3ByaXZhdGVfZW1haWwiOiJ0cnVlIiwiYXV0aF90aW1lIjoxNjQ3NDYzNjUxLCJub25jZV9zdXBwb3J0ZWQiOnRydWV9.FUBoe4bcEBvU0yW_yDuRtPLYdSNFew2ipApWMCRPzbXpdOboZDIVcWhj8EgzlbvRZWQRKDFZGCiJ_4WE3m5Cy-gucBpHeUNplgUghbt9iUfYR53ZL1x0Mu4v96IcNdS5DSkmNXyRx41dhrk5YG6krf6NoanrzaJL2G-7bq5M7qC-N0lsroZq5CdarHoCOa8tadNgQSaGS9DdBfZt8AOPzQmUca4gUqTC3lG8RLhfnJzQhpQd2djtZEvXezaZ7WTHoQaIDh7CCGClj4c5QqnB7yt6n4WOJvKBSRhmcZ1SWZ9CfWA7ps7bzumv7n5VXxjtRwpC2fQLnUCnEol_8DfC5Q
)