<?php
$test = "0000";

$p =  password_encrypt($test);
echo $p."<br/>";
echo password_check($test, $p);

function password_encrypt($password){
	$hash_format="$2y$10$";
	$salt_length=22;
	$salt=generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash=crypt($password,$format_and_salt);
	return $hash;
}
		
function password_check($try_password, $password){		
	
	$hash=crypt($try_password, $password);
	if($hash === $password){
		return true;
	}
	else{
		return false;
	}
}

function generate_salt($salt_length){
	$unique_random_string=md5(uniqid(mt_rand(), true));
	$base64_string=base64_encode($unique_random_string);
	$modified_base64_string=str_replace('+','.',$base64_string);
	$modified_base64_string=str_replace('+','.',$base64_string);
	$salt=substr($modified_base64_string, 0, $salt_length);
	return $salt;
}
?>