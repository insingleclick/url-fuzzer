<?php

	echo "Enter url:";
	$url = trim(fgets(STDIN, 150));
	echo $url."\n\n";
	// $url = "https://www.google.com";
	echo "Enter keywords file:";
	$file = trim(fgets(STDIN, 150));
	echo $file."\n\n";
	// $file="sample.txt";

	include 'logo.php';

	
$fp = @fopen($file, "r") or die("Unable to open file! or find doesn't exist");

while (!feof($fp)){ 
	$keywords[] = fgets($fp);
}

for ($i=0; $i <count($keywords) ; $i++) { 
	$keywords[$i] = str_replace(",","",$keywords[$i]);
	$link = $url."/".trim($keywords[$i]);
	$handle = curl_init($link);
	curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

	/* Get the HTML or whatever is linked in $url. */
	$response = curl_exec($handle);

	/* Check for 404 (file not found). */
	$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	if($httpCode == 0) {
	    /* Handle 200 here. */
	    echo '*** Ajax Request Cancelled *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} if($httpCode == 200) {
	    /* Handle 200 here. */
	    echo '*** Success *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} else if($httpCode == 301) {
	    /* Handle 301 here. */
	    echo '*** Moved *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} else if($httpCode == 302) {
	    /* Handle 302 here. */
	    echo '*** Moved *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} else if($httpCode == 403) {
	    /* Handle 403 here. */
	    echo '*** Forbidden *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} else if($httpCode == 404) {
	    /* Handle 404 here. */
	    echo '*** NOT EXIST *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} else if($httpCode == 503) {
	    /* Handle 503 here. */
	    echo '*** 503 Service Unavailable *** '.$link.'- HTTP Code:'.$httpCode."\n";
	} else {
		echo '*** Unknown *** '.$link.'- HTTP Code:'.$httpCode."\n";
	}

	curl_close($handle);
}


?>