<?php

class SexualAssaultProjectDirectory extends Page {

	private static $db = array(

	);
	private static $allowed_children = array(
		'SexualAssaultProject',
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$countyGridFieldConfig = GridFieldConfig_RecordEditor::create();
		$countyGridField       = new GridField('Counties', 'Counties', County::get(), $countyGridFieldConfig);

		$fields->addFieldToTab("Root.Counties", $countyGridField, "Content");
		return $fields;
	}
}


class SexualAssaultProjectDirectory_Controller extends Page_Controller {

    private static $allowed_actions = array(
        'CountyForm'
    );

    public function CountyForm() {

    	$fields = new FieldList(
    		DropdownField::create('County','County', SexualAssaultProject::get('County')->map('Title', 'Title'))->setEmptyString('(Select one)'
    		));

    	$actions = new FieldList(
            FormAction::create("getCountyInfo")->setTitle("Submit")
        );

        $required = new RequiredFields('County');

        $form = new Form($this, 'CountyForm', $fields, $actions, $required);

        return $form;
    }

    public function getCountyInfo($data, Form $form) {
    	$County = $data['County'];

    	$form->sessionMessage('Hello '. $data['County'], 'success');

    	return $this->redirectBack();
    }

}
