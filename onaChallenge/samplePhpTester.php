<?php

$data_string = array('url'=>'https://raw.githubusercontent.com/onaio/ona-tech/master/data/water_points.json');
$data_string = json_encode($data_string);

$ch = curl_init("http://ultimatedevelopers.com/ona/index.php");                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);
                                                                    
$result = curl_exec($ch); 
$results = json_decode($result,true);


echo "<pre>".print_r($result,true)."</pre>";

?>
