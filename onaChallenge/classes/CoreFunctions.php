<?php

/*
 * @Author - George Muhoro
 * 
 * This is the skeleton class that will be inherited by the rest of the classes
 * 
 * 
 */

abstract class CoreFunctions {

    private $url;
    private $dataSet;
    private $groupedDataset;
    
    //constants used 
    const invalidUrl ="You supplied an invalid URL";
    const communityColumn = "communities_villages";
    const functioningColumn ="water_functioning";
    const functioningStatus = "yes";
    const notFunctioningStatus = "no";

    
    abstract public function calculate($url);

    public function getUrl() {
	return $this->url;
    }

    public function getDataSet() {
	
	return $this->dataSet;
    }

    public function getGroupedDataset() {
	return $this->groupedDataset;
	
    }

}


?>
