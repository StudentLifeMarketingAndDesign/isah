<?php
use SilverStripe\Core\Config\Config;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextAreaField;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use SilverStripe\Core\Convert;

class PageController extends ContentController {

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

	protected function init() {
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
			new EmailField(Email::class, 'Your Email Address (optional)', $memberEmail),
			DropdownField::create('County', 'If your feedback is related to a specific county please select one from below:', IsahProject::get('County')->map('Title'))->setEmptyString('(None)'),
			new TextAreaField('Feedback', 'Your Feedback'),
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
	
		$adminEmail = Config::inst()->get(Email::class, 'admin_email');

		$feedback = new FeedbackItem();
		$form->saveInto($feedback);

		$feedback->write();

		if ($feedback->SpecificPage == "1") {
			$relatedPage = Page::get_by_id("Page", $feedback->PageID);
		}
		
		$subject = "[ISAH Website Feedback] New item submitted";

		//check data for errors
		$name = Convert::raw2sql($data['Name']);
		$userEmail = Convert::raw2sql($data[Email::class]);
		$feedback = Convert::raw2sql($data['Feedback']);
		$county = Convert::raw2sql($data['County']);
		if($name){
			$body = '<p>' . $name . ' (<a href="mailto:'.$userEmail.'">'.$userEmail.'</a>) has submitted feedback.</p>';
		}else{
			$body = '<p>Someone has submitted feedback:</p>';
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
