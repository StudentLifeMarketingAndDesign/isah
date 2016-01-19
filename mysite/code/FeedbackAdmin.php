<?php
class FeedbackAdmin extends ModelAdmin {


  private static $managed_models = array('FeedbackItem'); 
  private static $url_segment = 'feedback';
  private static $menu_title = 'Feedback';
  public $showImportForm = false; 
  


}