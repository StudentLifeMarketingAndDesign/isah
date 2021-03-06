<?php

use SilverStripe\ORM\DataObject;
/**
 * Defines the HomePage page type
 */
 
class FeedbackItem extends DataObject {
   private static $db = array(
   'Feedback' => 'Text',
   'Name' => 'Varchar',
   'Email' => 'Varchar',
   'County' => 'Text'
   );
   
   private static $has_one = array(
   'Page' => 'Page'
   );
   
   private static $searchable_fields = array('ID', 'Feedback', 'Name', 'County');
  
   private static $summary_fields = array('PageID', 'Page.Title', 'Feedback', 'Name', 'Created', 'County');
   //No ID, Email address, Feedback, Specific Page, PageID + Page Title see summary_fields docs
   	            

}