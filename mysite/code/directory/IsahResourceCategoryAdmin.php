<?php

class IsahResourceCategoryAdmin extends ModelAdmin {

	private static $menu_title = 'Resource Categories';

	private static $url_segment = 'resource-categories';

	private static $managed_models = array(
		'IsahResourceCategory',
	);
}