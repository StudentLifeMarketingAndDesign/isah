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
use SilverStripe\Control\Director;

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
	
}
