<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array(
		'FeedbackForm',
	);

	public function init() {
		parent::init();
		Requirements::block("event_calendar/css/calendar_widget.css");

	}

	public function IsahProjects(){

		return IsahProject::get()->sort('Title ASC');
	}
	public function OtherDirectoryResources() {

		return IsahDirectoryPage::get();
	}
	public function Breadcrumbs($maxDepth = 20, $unlinked = false, $stopAtPageType = false, $showHidden = false) {
		return parent::Breadcrumbs(20, false, false, true);
	}
	public function FeedbackForm() {

		$memberName = '';
		$memberEmail = '';

		$fields = new FieldList(

			new TextField('Name', 'Your Name (optional)', $memberName),
			new EmailField('Email', 'Your Email Address (optional)', $memberEmail),
			DropdownField::create('County', 'If your feedback is related to a specific county please select one from below:', IsahProject::get('County')->map('Title'))->setEmptyString('(None)'),
			new TextAreaField('Feedback', '<span>*</span>Your Feedback'),
			new HiddenField('PageID', 'PageID', $this->ID)
			
		);

  		$actions = new FieldList(
			new FormAction('SubmitFeedbackForm', 'Submit Feedback')
		);

		// Create action
		$validator = new RequiredFields('Feedback');

		//Create form
		$Form = new Form($this, 'FeedbackForm', $fields, $actions, $validator);

		//$protector = SpamProtectorManager::update_form($Form, 'Message', null, "Please enter the following words");
		//$Form->enableSpamProtection();

		return $Form;
	}

	public function SubmitFeedbackForm($data, $form) {
	
		$adminEmail = Config::inst()->get('Email', 'admin_email');

		$feedback = new FeedbackItem();
		$form->saveInto($feedback);

		$feedback->write();

		if ($feedback->SpecificPage == "1") {
			$relatedPage = Page::get_by_id("Page", $feedback->PageID);
		}
		
		$subject = "[ISAH Website Feedback] New item submitted";

		//check data for errors
		$name = Convert::raw2sql($data['Name']);
		$userEmail = Convert::raw2sql($data['Email']);
		$feedback = Convert::raw2sql($data['Feedback']);
		$county = Convert::raw2sql($data['County']);
		if($name){
			$body = '<p>' . $name . ' (<a href="mailto:'.$userEmail.'">'.$userEmail.'</a>) has submitted feedback.</p>';
		}else{
			$body = '<p>An anonymous person has submitted feedback:</p>';
		}


		$body.='<p><strong>Feedback:</strong><br />' . $feedback.'</p>';
		$body .= '<p><strong>County:</strong><br />'.$county.'</p>';

		$email = new Email();
		$email->setTo($adminEmail);
		$email->setFrom($adminEmail);
		$email->setSubject($subject);
		$email->setBody($body);
		if (SS_ENVIRONMENT_TYPE == "live") {
			$email->send(); 
		}

		return $this->redirect($this->Link("?FeedbackSuccess=1"));

	}

	public function FeedbackSuccess(){
		if($this->getRequest()->getVar('FeedbackSuccess')) {
			return true;
		}

	}

	

}
