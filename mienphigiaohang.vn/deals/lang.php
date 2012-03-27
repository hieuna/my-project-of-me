<?
require_once("initsession.php");
$_SESSION["numberQuery"] =0;
$lang_id = 1;
if(isset($lang)) $lang_id	= $lang;
$fs_imagepath		= '/admin/resource/images/';
$lang_path			= '/deals/';
$root_path			= '../';
$glang				= "en";
$sql = '';

$load_header 	 = '<script type="text/javascript" language="javascript" src="'.$root_path.'js/countdown.js"></script>';
$load_header 	.= '<script type="text/javascript" language="javascript" src="'.$root_path.'js/jquery.js"></script>';
$load_header 	.= '<script type="text/javascript" language="javascript" src="'.$root_path.'js/jquery.vslider.js"></script>';
$load_header 	.= '<script type="text/javascript" language="javascript" src="'.$root_path.'js/slide_js.js"></script>';
$load_header 	.= '<script type="text/javascript" language="javascript" src="'.$root_path.'js/deals.js"></script>';
$load_header 	.= '<script type="text/javascript" language="javascript" src="'.$root_path.'js/validate.js"></script>';

$load_header 	.= '<link rel="stylesheet" type="text/css" href="'.$root_path.'style/theme.css"/>';
$load_header 	.= '<link rel="stylesheet" type="text/css" href="'.$root_path.'style/style.css"/>';
$load_header 	.= '<link rel="stylesheet" type="text/css" href="'.$root_path.'style/vslider.css"/>';



require_once("../classes/database.php");
require_once("../functions/functions.php");

////////////////////////////////////////////
require_once("../classes/database.php");

require_once("../classes/html_cleanup.php");
require_once("../classes/denyconnect.php");
require_once("../classes/class.htmldom.php");
require_once("../classes/form.php");

require_once("../functions/date_functions.php");
require_once("../functions/pagebreak.php");
require_once("../functions/replace_fck.php");
require_once("../functions/rewrite_functions.php");   
require_once("../classes/generate_form.php");
require_once("../functions/translate.php");
require_once("../language/lang_" . $lang_id . ".php");
require_once("../functions/file_functions.php");
require_once("../classes/menu.php");
require_once("../classes/upload.php");
require_once("../includes/inc_config.php");

// Get config from database
$db_con    = new db_query("SELECT * from configuration");
if ($row=mysql_fetch_array($db_con->result)){
    while ( list($data_field, $data_value) = each($row)) {
        if (!is_int($data_field)){
            //tao ra cac bien config
            $$data_field = $data_value;
            //echo $data_field . "= $data_value <br>";
        }
    }
}
$db_con->close();
unset($db_con);



////////////////////////////////////////////////
$page_curent    = getURL(0,0,1,0);
$id_child       = getValue("id_child","int","REQUEST","");
$id_current     = getValue("id");
$id_d_current   = getValue("id");
$cat_id = getValue("cat_id","int","REQUEST","");
$city= getValue("city","int","REQUEST",1);
?>