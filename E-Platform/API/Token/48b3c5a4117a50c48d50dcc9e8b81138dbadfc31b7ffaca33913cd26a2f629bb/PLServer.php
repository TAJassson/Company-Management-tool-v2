<?php
header('Access-Control-Allow-Origin:*');  
class PLServer{
	function GET($parameters) {
		$apiType = array_shift($parameters);
		if ($apiType==='GETPID') {
			$PID = array_shift($parameters);
			if ($PID===null)
			{
				returnError (' Parameters are null','ErrCode: 0110');
			}else if ($PID==='')
			{
				returnError (' Parameters are null','ErrCode: 0111');
			}
			else {
				$sql = "SELECT * FROM 4pl_warehouse WHERE p_id='$PID'";
	
				require_once 'db.php';
				$dbresult = $conn->query($sql);
				$output = array();
				while ($row = $dbresult->fetch_assoc() ) {
					$output[] = $row;
				}
				echo json_encode($output);
			}
		}
		else{ //No API calling
			returnError(' Missing API, fail to get the data', 'ErrCode: 2012');
		}
	}
	
	function POST($parameters) {
    $body = file_get_contents('php://input');
    $dataArray = json_decode($body, true);
    if (!empty($dataArray['whs_name'])) {
        $whs_name = $dataArray['whs_name'];
    } else {	
		returnError(' Missing or empty whs_name parameter, failed add record', 'ErrCode: 2111');
    }

    if (!empty($dataArray['whs_address'])) {
        $whs_address = $dataArray['whs_address'];
    } else {
		returnError(' Missing or empty whs_address parameter, failed add record', 'ErrCode: 2112');
    }

    if (!empty($dataArray['whs_token'])) {
        $whs_token = $dataArray['whs_token'];
    } else {
		returnError(' Missing or empty whs_token parameter, failed add record', 'ErrCode: 2117');
    }

    if (!empty($dataArray['p_id'])) {
        $p_id = $dataArray['p_id'];
    } else {
    returnError(' Missing or empty Product ID parameter, failed add record', 'ErrCode: 2113');
    }

    if (!empty($dataArray['p_name'])) {
        $p_name = $dataArray['p_name'];
    } else {
		returnError(' Missing or empty Product name parameter, failed add record', 'ErrCode: 2114');
    }
    if (!empty($dataArray['p_stock'])) {
        $p_stock = $dataArray['p_stock'];
    } else {
		returnError(' Missing or empty Product stock parameter, failed add record', 'ErrCode: 2115');
    }
    if (!empty($dataArray['p_img'])) {
        $p_img = $dataArray['p_img'];
    } else {
		returnError(' Missing or empty Product image parameter, failed add record', 'ErrCode: 2115');
    }
	if (!empty($dataArray['p_cashpoint'])) {
        $p_cashpoint = $dataArray['p_cashpoint'];
    } else {
		returnError(' Missing or empty Product price parameter, failed add record', 'ErrCode: 2117');
    }
    // Proceed with the database insertion
	
	//Check data
	$sqlCheck = "SELECT COUNT(*) FROM 4pl_warehouse WHERE p_id = '$p_id'";
    require_once 'db.php';
    $resultCheck = $conn->query($sqlCheck);
	$rowCheck = $resultCheck->fetch_row()[0];
    if ($rowCheck > 0) {
        returnError('failed add record - Data already exists', 'ErrCode: 2101');
    }
	else
	{
        $sql = "INSERT INTO `4pl_warehouse` (`whs_name`, `whs_address`, `whs_token`, `p_id`, `p_name`, `p_stock`, `p_img`, `p_cashpoint`, `p_state`) VALUES ('$whs_name', '$whs_address', '$whs_token', '$p_id', '$p_name', '$p_stock', '$p_img', '$p_cashpoint', 'enable')";

    require_once 'db.php';
    try {
        $dbresult = $conn->query($sql);
        $output = array();
        $output['status'] = 'success';
        $output['remark'] = "inserted successfully";
        echo json_encode($output);
        exit;
    } catch (Exception $e) {
        $output = array();
        $output['status'] = 'error';
        $output['errcode'] = '3020';
        $output['errmsg'] = 'SQL failure - failed to insert';
        $output['errDetails'] = $e->getMessage();
       echo json_encode($output);
        exit;
    }
	}
}
	
function PUT($parameters) {
    $body = file_get_contents('php://input');
    $dataArray = json_decode($body, true);

    if (!empty($dataArray['whs_name'])) {
        $whs_name = $dataArray['whs_name'];
    } else {    
        returnError('Missing or empty whs_name parameter, failed to update record', 'ErrCode: 3111');
    }

    if (!empty($dataArray['whs_address'])) {
        $whs_address = $dataArray['whs_address'];
    } else {
        returnError('Missing or empty whs_address parameter, failed to update record', 'ErrCode: 3112');
    }

    if (!empty($dataArray['whs_token'])) {
        $whs_token = $dataArray['whs_token'];
    } else {
        returnError('Missing or empty whs_token parameter, failed to update record', 'ErrCode: 3117');
    }

    if (!empty($dataArray['p_id'])) {
        $p_id = $dataArray['p_id'];
    } else {
        returnError('Missing or empty Product ID parameter, failed to update record', 'ErrCode: 3113');
    }

    if (!empty($dataArray['p_name'])) {
        $p_name = $dataArray['p_name'];
    } else {
        returnError('Missing or empty Product name parameter, failed to update record', 'ErrCode: 3114');
    }

    if (!empty($dataArray['p_stock'])) {
        $p_stock = $dataArray['p_stock'];
    } else {
        returnError('Missing or empty Product stock parameter, failed to update record', 'ErrCode: 3115');
    }

    if (!empty($dataArray['p_img'])) {
        $p_img = $dataArray['p_img'];
    } else {
        returnError('Missing or empty Product image parameter, failed to update record', 'ErrCode: 3116');
    }

    if (!empty($dataArray['p_cashpoint'])) {
        $p_cashpoint = $dataArray['p_cashpoint'];
    } else {
        returnError('Missing or empty Product price parameter, failed to update record', 'ErrCode: 3117');
    }

    // Check data
    $sqlCheck = "SELECT COUNT(*) FROM 4pl_warehouse WHERE p_id = '$p_id'";
    require_once 'db.php';
    $resultCheck = $conn->query($sqlCheck);
    $rowCheck = $resultCheck->fetch_row()[0];
    if ($rowCheck == 0) {
        returnError('Failed to update record - Data does not exist', 'ErrCode: 2101');
    } else {
        $sql = "UPDATE `4pl_warehouse` 
                SET `whs_name` = '$whs_name', 
                    `whs_address` = '$whs_address', 
                    `whs_token` = '$whs_token', 
                    `p_name` = '$p_name', 
                    `p_stock` = '$p_stock', 
                    `p_img` = '$p_img', 
                    `p_cashpoint` = '$p_cashpoint', 
                    `p_state` = 'enable' 
                WHERE `p_id` = '$p_id'";

        require_once 'db.php';
        try {
            $dbresult = $conn->query($sql);
            $output = array();
            $output['status'] = 'success';
            $output['remark'] = "updated successfully";
            echo json_encode($output);
            exit;
        } catch (Exception $e) {
            $output = array();
            $output['status'] = 'error';
            $output['errcode'] = '3020';
            $output['errmsg'] = 'SQL failure - failed to update';
            $output['errDetails'] = $e->getMessage();
            echo json_encode($output);
            exit;
        }
    }
}
}
function returnError($errorMessage, $errorCode) {
    $output = array(
        'status' => 'error',
        'errcode' => $errorCode,
        'errmsg' => $errorMessage
    );
    echo json_encode($output);
    exit;
}
