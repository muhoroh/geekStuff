<?php

/*
 * @Author - George Muhoro
 * 
 * 
 * 
 * 
 */
require_once('CoreFunctions.php');

class DataCalculator extends CoreFunctions {
    
    /*
     * its the primary function. Responsible for calling all other methods 
     */

    public function calculate($url) {

	$this->setUrl($url);

	//validate this url so as not to waste time downwards
	$validUrl = $this->validateData();

	if (!$validUrl) {

	    $response = array('error' => self::invalidUrl);

	    return json_encode($response);
	} else {

	    $interpretData = $this->interpretDataSet();

            //if the URl returns somehting useful
	    if ($interpretData) {
		$functionalWaterPoints = $this->computeFunctionalWaterPoints();
		$waterPointsPerCommunity = $this->computeCommunityWaterPoints();
		$communityRanking = $this->communityRanking();

		$resultArray = array
		    (
		    'number_functional' => $functionalWaterPoints,
		    'number_water_points' => $waterPointsPerCommunity,
		    'community_ranking' => $communityRanking
		);
	    } else {
		//if the URL doesnt have data , return error
		$resultArray = array('error' => "Probably an empty set or a connection probelem .Please retry.");
		
	    }

	    //return $resultArray;
	     return json_encode($resultArray);
	}
    }

     /*
     * if the high level validate didnt work , validate here
     * 
     */
    public function validateData() {

	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $this->url)) {

	    return false;
	} else {
	    return true;
	}
    }

    /*
     * Break the data into some sensible stuff
     * 
     */

    public function interpretDataSet() {
	$villages = "";
	$groupedData = array();

	$ch = curl_init($this->url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($ch);
	$results = json_decode($result, true);

	//make the whole dataset available globally -within the class ie
	$this->setDataSet($results);

	if (empty($results)) {
	    return FALSE;
	}

	foreach ($results as $key => $value) {
	    $groupedData[$value[self::communityColumn]][$key] = $value;
	}

	//make this per community based data available to other functions
	$this->setGroupedDataset($groupedData);
	return $this->groupedDataset;
    }

    /*
     * compute the number of functioning water points 
     * 
     */

    public function computeFunctionalWaterPoints() {

	$counter = 0;

	$dataset = $this->dataSet;

	foreach ($dataset as $community) {
	    if ($community[self::functioningColumn] == self::functioningStatus) {
		$counter++;
	    }
	}

	return $counter;
    }

    
    /*
     * Compute the number of water points per community
     * 
     */

    public function computeCommunityWaterPoints() {

	$villages = array();

	$comunities = $this->groupedDataset;

	foreach ($comunities as $key => $value) {

	    $villages[$key] = count($value);
	}
	
		    $communityPoints = array();

	    foreach ($villages as $key => $value) {
		$communityPoints[$key] = $value;
	    }
	    array_multisort($communityPoints, SORT_DESC, $villages);


	return $villages;
    }

    /*
     * 
     * 
     */

    public function communityRanking() {

	$villages = "";
	$rankingArray = array();


	$comunities = $this->groupedDataset;

	foreach ($comunities as $key => $value) {

	    $totalWaterPoints = count($value);

	    //find out how many dont work
	    $counter = 0;
	    foreach ($value as $waterPoint) {
		if ($waterPoint[self::functioningColumn] != self::functioningStatus) {
		    $counter++;
		}
	    }

	    //compute the percentage of the ones not working
	    $percentage = ($counter / $totalWaterPoints) * 100;
	    $percentage = round($percentage, 0);
	    $percentage = $percentage;

	    $rankingArray[$key] = $percentage;

	    $villageRanking = array();

	    //arrange the points from the highest with broken water
	    foreach ($rankingArray as $key => $value) {
		$villageRanking[$key] = $value;
	    }
	    array_multisort($villageRanking, SORT_DESC, $rankingArray);
	}


	return $villageRanking;
    }
    
    

    public function setUrl($url) {
	$this->url = $url;
    }

    public function setDataSet($data) {
	$this->dataSet = $data;
    }

    public function setGroupedDataset($data) {
	$this->groupedDataset = $data;
    }

}

?>
