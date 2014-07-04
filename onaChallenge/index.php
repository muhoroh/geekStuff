<?php
  include 'classes/DataCalculator.php';

    $input = file_get_contents('php://input');
    
    $input=  json_decode($input,true);
    
    if(isset($input['url']))
    {
    $url = $input['url'];
    }
    else{
    
      echo json_encode("Please supply a parameter called url");exit;
    }
    
    $data = processStuff($url);
    echo $data;
    


function processStuff($url)
{
    
	$calc = new DataCalculator();
	$data = $calc->calculate($url);
    
     return $data;
}



?>
