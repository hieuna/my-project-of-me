<?php

/**
 * @package JobBoard
 * @copyright Copyright (c)2010 Tandolin
 * @license GNU General Public License version 2, or later
 */

defined('_JEXEC') or die('Restricted access');   

function com_install()
{
	/*always try to add the version column */
   tblAddColumn('#__jobboard_config','release_ver','TEXT NOT NULL');
   $curr_version = tblCheckColumnValue('#__jobboard_config', 'release_ver', ' WHERE id=1');
   if($curr_version <> '1.5.1'){
   	
	   tblSetColumnValue('#__jobboard_config', 'release_ver', '1.5.1');
	   
	   //update config table
	   echo "Upgrading database to v1.5.1";   
	   //echo "Upgrading table: config <br>";
	   tblAddColumn('#__jobboard_config','allow_applications',' TINYINT NOT NULL DEFAULT 1 AFTER `allow_unsolicited`');
	   tblAddColumn('#__jobboard_config','show_social',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','show_viewcount',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','show_applcount',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','email_cvattach',' TINYINT NOT NULL DEFAULT 0');
	   tblAddColumn('#__jobboard_config','show_job_summary',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','send_tofriend',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','appl_job_summary',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','sharing_job_summary',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','short_date_format',' TINYINT NOT NULL DEFAULT 0');
	   tblAddColumn('#__jobboard_config','date_separator',' TINYINT NOT NULL DEFAULT 0');
	   tblAddColumn('#__jobboard_config','long_date_format',' TINYINT NOT NULL DEFAULT 0');
	   tblAddColumn('#__jobboard_config','jobtype_coloring',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','use_location',' TINYINT NOT NULL DEFAULT 1');
	   tblAddColumn('#__jobboard_config','social_icon_style',' TINYINT NOT NULL DEFAULT 1');
	   tblSetColumnValue('#__jobboard_config','organisation',"My Organisation", ' WHERE `organisation` = "My Organisasion" AND id=1');
	
	   $db =& JFactory::getDBO();
	
	   //echo "Upgrading table: countries<br>";
	   //update countries table
	   if(tblCheckColumnValue('#__jobboard_countries', 'COUNT(country_id)') < 266) {
		   $query = "insert into `#__jobboard_countries`(country_name,dial_prefix,country_region) values ('DB_ANYWHERE_CNAME',0,'DB_ANYWHERE_REGION')";
		   $db->setQuery($query);
		   $result = $db->query();
		   //echo$query.' :: Result:'.$result.'<br />';    	
	   }
	   
	   tblSetColumnValue('#__jobboard_countries', 'country_region', 'Europe', ' WHERE `country_region` = "Ethnic Groups in Eastern Europe,  Europe"');
	   tblSetColumnValue('#__jobboard_countries', 'country_region', 'Central America/Caribbean', ' WHERE `country_region` = "Central America and the Caribbean"');
	
	   //echo "Upgrading table: jobs<br>";
	   //update jobs table
	   //Get existing job type settings
	   $current_jobtypes = tblGetColumAndIDValues('#__jobboard_jobs', 'id', 'job_type');
	   
	   tblModifyColumn('#__jobboard_jobs','job_type'," ENUM('DB_JFULLTIME','DB_JCONTRACT','DB_JPARTTIME','DB_JTEMP','DB_JINTERN','DB_JOTHER') NOT NULL DEFAULT 'DB_JFULLTIME'");
	
	   //Set new job type values
	   if(count($current_jobtypes) > 0) {
	   		tblSetColumValuesByID($current_jobtypes, 'job_type');
	   }
	   
	   tblAddColumn('#__jobboard_jobs','expiry_date'," DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `post_date`");
	   
	   echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--- Done<br>";
   }

}

/* Add column to existing table */
function tblAddColumn($tbl,$col,$defns)
{
	$db =& JFactory::getDBO();

	// php doesn't throw an error here if the column already exists (unlike the sql install script)
	$query = "ALTER TABLE `".$tbl."` ADD `".$col."` ".$defns;
	$db->setQuery($query);
	$result = $db->query();
	//echo$query.' :: Result:'.$result.'<br />'; 
}

/* Modify existing column properties */
function tblModifyColumn($tbl,$col,$defns)
{
	$db =& JFactory::getDBO();

	$query = "ALTER TABLE `".$tbl."` MODIFY `".$col."` ".$defns;
	$db->setQuery($query);
	$result = $db->query();
	//echo$query.' :: Result:'.$result.'<br />'; 
}

/* Check column value */
function tblCheckColumnValue($tbl, $col, $cond='')
{
	$db =& JFactory::getDBO();
	$query = "SELECT ".$col." FROM ".$tbl.' '.$cond;
	$db->setQuery($query);
	$result = $db->loadResult();
	//echo $query.' :: Result:'.$result.'<br />'; 
	return $result;
}

/* Set column value */
function tblSetColumnValue($tbl, $col, $val, $cond='')
{
	$db =& JFactory::getDBO();
	$query = "UPDATE ".$tbl." SET ".$col." = ".$db->Quote($val).' '.$cond;
	$db->setQuery($query);
	$result = $db->query();
	//echo $query.' :: Result:'.$result.'<br />'; 
}

function tblGetColumAndIDValues($tbl, $id_colname, $col){
	
	$db =& JFactory::getDBO();
	$query = "SELECT `".$id_colname."`, `".$col."` FROM ".$tbl;
	$db->setQuery($query);
	$result = $db->loadObjectList();
	//echo '<br /> Object:'.json_encode($result);
	return $result;
}

function tblSetColumValuesByID($obj, $colname){
	
	foreach($obj as $row){
		//echo 'id:'.$row->id.' :: column:'.$row->$colname.'<br />';
		switch($row->$colname) {
        
		//for jobs table
		 case 'Full time/Permanent' : 
			 tblSetColumnValue('#__jobboard_jobs', $colname, 'DB_JFULLTIME', ' WHERE id='.$row->id);
		 break;
		 case 'Part time/Temp' : 
			tblSetColumnValue('#__jobboard_jobs', $colname, 'DB_JPARTTIME', ' WHERE id='.$row->id);
		 break;
		 case 'Contract' : 
			tblSetColumnValue('#__jobboard_jobs', $colname, 'DB_JCONTRACT', ' WHERE id='.$row->id);
		 break;
		}
	}
}

?>