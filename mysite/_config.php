<?php

global $project;
$project = 'mysite';

global $database;
$database = 'isah';
 
// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");

MySQLDatabase::set_connection_charset('utf8');

// Set the site locale
i18n::set_locale('en_US');
FulltextSearchable::enable();
// Enable nested URLs for this site (e.g. page/sub-page/)
if (class_exists('SiteTree')) SiteTree::enable_nested_urls();

if(Director::isLive()) {
	Director::forceSSL();
	
}
Authenticator::unregister('MemberAuthenticator');
Authenticator::set_default_authenticator('SAMLAuthenticator');


global $customDateTemplates;
$customDateTemplates = array(

	// You can modify the date display by assigning new date templates to any of the following
	//   date scenarios. Use the above date format keys.

	'OneDay' => '$StartMonthNameShort $StartDayNumberShort, $StartYearLong',
	'SameMonthSameYear' => '$StartMonthNameShort $StartDayNumberShort - $EndDayNumberShort, $EndYearLong',
	'DiffMonthSameYear' => '$StartMonthNameShort $StartDayNumberShort - $EndMonthNameShort $EndDayNumberShort, $EndYearLong',
	'DiffMonthDiffYear' => '$StartMonthNameShort $StartDayNumberShort, $StartYearLong- $EndMonthNameShort $EndDayNumberShort, $EndYearLong',

	'OneDayHeader' => '$StartMonthNameLong $StartDayNumberShort$StartDaySuffix, $StartYearLong',
	'MonthHeader' => '$StartMonthNameLong, $StartYearLong',
	'YearHeader' => '$StartYearLong',

);