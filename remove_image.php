<?php

/**
* Convert Image to Transparant/ remove background image. use API remove.bg
*
* @author wawan kurniawan
* @email : troey11@gmail.com
*
*/

 
function remove_background($key,$sourcefile,$outputfile)
{
	$fp = fopen ($outputfile.".png", 'w+') or die('Unable to write a file'); 
	$post_data = array();
    	$post_data['image_file'] = "@".$sourcefile;
    	$post_data['size'] = "auto";
	
	$url="https://api.remove.bg/v1.0/removebg";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);  //Post Fields
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$headers = [
    	'X-API-Key: '.$key.''  
	];

	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	$server_output = curl_exec ($ch);
	$errors = curl_error($ch);
	$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close ($ch);
	
	if($response==200 && $server_output==1)
	{
		print "Success";		
	}
	else
	{
		print"Failed :";
		print $errors;
		print $response;	
	}
}