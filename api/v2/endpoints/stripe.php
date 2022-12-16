<?php
include_once('assets/includes/stripe_config.php');
$pro_types_array = array(
                    1,
                    2,
                    3,
                    4
                );
if (empty($_POST['request']) || empty($_POST['token'])) {
	$error_code    = 4;
    $error_message = 'request and token can not be empty';
}
else{
	if (!empty($_POST['token']) && !empty($_POST['request']) && in_array($_POST['request'], array('wallet','fund','pro')) && !empty($_POST['price']) && is_numeric($_POST['price']) && $_POST['price'] > 0) {
		try {

			// $file = fopen("logs_payments.txt", "a");
			// fwrite($file, "\n\n". json_encode($_POST) );
			// fclose($file);
		
			$price = Wo_Secure($_POST['price']);
			//$db->where('user_id',$wo['user']['id'])->update(T_USERS,array('StripeSessionId' => ''));
			$customer = \Stripe\Customer::create(array(
                'source' => $_POST['token']
            ));
            $charge   = \Stripe\Charge::create(array(
                'customer' => $customer->id,
                'amount' => $price * 100,
                'currency' => $wo['config']['stripe_currency']
            ));
            if ($charge) {
            	// $result = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `wallet` = `wallet` + " . $amount . " WHERE `user_id` = '" . $wo['user']['id'] . "'");
	            // if ($result) {
	            //     $create_payment_log = mysqli_query($sqlConnect, "INSERT INTO " . T_PAYMENT_TRANSACTIONS . " (`userid`, `kind`, `amount`, `notes`) VALUES ('" . $wo['user']['id'] . "', 'WALLET', '" . $amount . "', 'stripe')");
	            // }

				$result = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `wallet` = `wallet` + " . $price . " WHERE `user_id` = '" . $wo['user']['id'] . "'");
	            if ($result) {
	                $create_payment_log = mysqli_query($sqlConnect, "INSERT INTO " . T_PAYMENT_TRANSACTIONS . " (`userid`, `kind`, `amount`, `notes`) VALUES ('" . $wo['user']['id'] . "', 'WALLET', '" . $price . "', 'stripe')");


					// Funding Raise Insertion
					if(!empty($_POST['fund_id']) && !empty($_POST['request']) && $_POST['request'] == 'fund'){
						// $fund_raise_id = $db->insert(T_FUNDING_RAISE,array('user_id' => $wo['user']['id'],
                        //                                       'funding_id' => $_POST['fund_id'],
                        //                                       'amount' => $price,
                        //                                       'time' => time()));


						$fund_raise_id = mysqli_query($sqlConnect, "INSERT INTO " . T_FUNDING_RAISE . " (`user_id`, `funding_id`, `amount`, `time`) VALUES ('" . $wo['user']['id'] . "', '".$_POST['fund_id']."', '" . $price . "', '".time()."')");
					}

					// Fund Transfer Insertion
					//$funding_insertion = mysqli_query($sqlConnect, "INSERT INTO " . T_FUNDING . " (`hashed_id`, `title`, `description`, `amount`, `user_id`, `time`) VALUES ('" . $wo['user']['id'] . "', 'Fund Transfer', 'Fund Transfer', '" . $price . "', '" . $wo['user']['id'] . "', '".time()."')");

	            }
				$response_data = array(
	                                'api_status' => 200,
	                                'message' => 'payment successfully'
	                            );
				echo json_encode($response_data, JSON_PRETTY_PRINT);
				exit();

            }
            else{
            	$error_code    = 5;
			    $error_message = 'something went wrong';
            }
		} catch (Exception $e) {
			$error_code    = 8;
			$error_message = $e->getMessage();
		}
	}
	else{
		$error_code    = 4;
	    $error_message = 'request must be wallet , fund , pro and toke and price can not be empty';
	}
}



