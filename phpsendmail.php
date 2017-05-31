#!/usr/bin/php
<?php

	
	define('PHPSENDMAIL_FILEPATH','/var/tmp/');
	
	
	$handle = fopen('php://stdin', 'r');
	$count = 0;
 
   $html = false;
 
 
   $content_header = '';
   $content_html = '';
	while(!feof($handle)) 
	{
		$count++;
		$buffer = trim(fgets($handle));
   
       
  		if ($count <= 12 ){       
  			$content_header.= $buffer?$buffer."\n":'';
      }else{
         if(substr($buffer,0,2)!='--'){
           if($html==true && $buffer != 'Content-Transfer-Encoding: 8bit'){
           $content_html.= $buffer;
           }
           if($buffer == 'Content-Type: text/plain; charset=utf-8'){
           
           }
           if($buffer == 'Content-Type: text/html; charset=utf-8'){
           $content_html.= $buffer."\n\n";
             $html=true;
           }
         }
      }
	}
  			$log_output = $content_header.$content_html;
	
	$logfile = PHPSENDMAIL_FILEPATH."/mail_".date('U').'.eml';
	
	file_put_contents($logfile, $log_output);
?>
	
