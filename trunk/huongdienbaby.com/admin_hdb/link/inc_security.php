<?
require_once("../security/security.php");
require_once("../../classes/menu.php");
require_once("../../classes/form.php");
require_once("../../functions/functions.php");
require_once("../../functions/pagebreak.php");
//Check user login...
$lang_id = $_SESSION['lang_id'];
$fs_imagepath = '';
$fs_stype_css = '../css/FSPortal.css';
$fs_preview   = ($lang_id == 1) ? '/vn/' : '/2/';
?>