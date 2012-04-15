<?php 
/** ensure this file is being included by a parent file */ 
defined( '_JEXEC' ) or die( 'Restricted access' );

class ngrabnewsLicense extends JTable {
	/** @var int Primary key */
	var $id=null;
	
	var $serial_number=null;
	var $license_key=null;
	var $license_info=null;
	var $license=null;
	/**
	* @param database A database connector object
	*/
	function ngrabnewsLicense(&$db) {
		parent::__construct( '#__ngrab_lic', 'id', $db );
	}
}


class ngrabnewsFilter extends JTable {
	/** @var int Primary key */
	var $id=null;
	
	var $user_id=null;
	var $filter_name=null;
	var $filter_spec=null;
	var $inc_top=null;
	var $inc_bot=null;
	var $mdate=null;
	var $cdate=null;
	/**
	* @param database A database connector object
	*/
	function ngrabnewsFilter(&$db) {
		parent::__construct( '#__ngrab_filter', 'id', $db );
	}
}

class ngrabnewsCron extends JTable {
	/** @var int Primary key */
	var $id=null;
	
	var $cron_name=null;
	var $parent=null;
	var $filter_id=null;
	var $cron_url=null;
	var $section_id=null;
	var $cat_id=null;
	var $field_title=null;
	var $field_intro=null;
	var $field_full=null;
	var $full_filter=null;
	var $field_unique=null;
	var $field_created=null;
	var $field_state=null;
	var $show_intro=null;
	var $front_page=null;
	var $fix_html=null;
	var $remove_style=null;
	var $remove_link=null;
	var $tag_allowed=null;
	var $get_keyword=null;
	var $black_word=null;
	var $extract_img=null;
	var $thumb_width=null;
	var $thumb_height=null;
	var $image_align=null;
	var $image_hspace=null;
	var $image_vspace=null;
	var $image_border=null;
	var $detail_width=null;
	var $detail_height=null;
	var $detail_align=null;
	var $detail_hspace=null;
	var $detail_vspace=null;
	var $detail_border=null;
	var $content_source=null;
	var $cron_mhdmd=null;
	var $cron_ran=null;
	var $cron_ok=null;
	var $published=null;
	var $mdate=null;
	var $cdate=null;
	/**
	* @param database A database connector object
	*/
	function ngrabnewsCron(&$db) {
		parent::__construct( '#__ngrab_cron', 'id', $db );
	}
}

class ngrabnewsUsage extends JTable {
	/** @var int Primary key */
	var $id=null;
	
	var $cron_id=null;
	var $usage_unique=null;
	var $content_id=null;
	var $cdate=null;
	var $link_detail=null;
	var $is_detail=null;
	/**
	* @param database A database connector object
	*/
	function ngrabnewsUsage(&$db) {
		parent::__construct( '#__ngrab_usage', 'id', $db );
	}
}



?>