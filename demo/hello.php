<?php
/**
 * *************************************************************************
 *
 * Copyright (c) 2014 Baidu.com, Inc. All Rights Reserved
 *
 * ************************************************************************
 */
/**
 *
 * @file hello.php
 * @encoding UTF-8
 * 
 * 
 *         @date 2015年3月10日
 *        
 */

require_once '../sdk.php';

if(isset($_GET['func'])) {
	if ($_GET['func'] == 'single') {
		singleDevicePush();
	} else if ($_GET['func'] == 'multi') {
		multiDevicePush();
	}
}

function singleDevicePush() {
	if(isset($_GET['channel_id'])) {
		$channelId = $_GET['channel_id'];
	
		// message content
		$message = array (
			// The title of the message
			'title' => 'Hi!',
			// Message content
			'description' => "hello, this message from baidu push service." 
		);

		// Set the message type to notification type or any other custome variables
		$opts = array (
			'msg_type' => 1 
		);

		// Create an SDK object
		$sdk = new PushSDK();

		// Send a message to the target device
		$rs = $sdk -> pushMsgToSingleDevice($channelId, $message, $opts);

		// To determine the return value, when the send fails, the result of $rs is false. You can obtain the error message through getError
		if($rs === false){
		   print_r($sdk->getLastErrorCode()); 
		   print_r($sdk->getLastErrorMsg()); 
		} else{
			// Will print out the message id, send time and other related information
			print_r($rs);
		}

		echo "done!";
	} else {
		echo "missing channel id";
	}
}

function multiDevicePush() {
	if(isset($_GET['channel_ids'])) {
		$channelIds = explode(",",$_GET['channel_ids']);
	
		// message content
		$message = array (
			// The title of the message
			'title' => 'Hi!',
			// Message content
			'description' => "hello, this message from baidu push service." 
		);

		// Set the message type to notification type or any other custome variables
		$opts = array (
			'msg_type' => 1 
		);

		// Create an SDK object
		$sdk = new PushSDK();

		// Send a message to the target device
		$rs = $sdk -> pushBatchUniMsg($channelIds, $message, $opts);

		// To determine the return value, when the send fails, the result of $rs is false. You can obtain the error message through getError
		if($rs === false){
		   print_r($sdk->getLastErrorCode()); 
		   print_r($sdk->getLastErrorMsg()); 
		} else{
			// Will print out the message id, send time and other related information
			print_r($rs);
		}

		echo "done!";
	} else {
		echo "missing channel id";
	}
}

 