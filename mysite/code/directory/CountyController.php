<?php

class CountyController extends Controller {

    private static $allowed_actions = array(
        'go'
    );

    private static $url_handlers = array(
        'go/$Name' => 'go',
    );

    public function go() {
    	$countyName = $this->getRequest()->param('Name');

    	$county = County::get()->filter(array(
    			'Title' => $countyName
    		))->First();

    	$countyData = $county->toMap();

    	$project = $county->getComponent('Project');
   		$projectData = $project->toMap();

   		$resources = $county->Resources();
    	$resourceData = $resources->toNestedArray();



    	$output = array(
    			"County" => $countyData,
    			"Project" => $projectData,
 				"Resources" => $resourceData
    		);

    	return json_encode($output);
    }

}