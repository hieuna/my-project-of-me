<?php
error_reporting(E_ALL ^E_NOTICE);
define('CPATH_BASE', dirname(__FILE__));
$site 	= ( isset($_POST['site']) ? $_POST['site'] : ( isset($_GET['site']) ? $_GET['site'] : '' ) );
$step 	= intval( isset($_POST['step']) ? $_POST['step'] : ( isset($_GET['step']) ? $_GET['step'] : 1 ) );
$catid 	= intval( isset($_POST['catid']) ? $_POST['catid'] : ( isset($_GET['catid']) ? $_GET['catid'] : 0 ) );

include "include/database_config.php";
include "include/class_database.php";
include 'include/filterinput.php';

// INITIATE DATABASE CONNECTION
$db =& SEDatabase::getInstance();

// SET LANGUAGE CHARSET
$db->database_set_charset('utf8');

$siteID_current = 0;
	
// GET LIST SITE
$results = $db->database_query("SELECT * FROM web_source");
$list_site = '<option value="">Chọn website</option>';
while ($row = $db->database_fetch_assoc($results)){
	$selected = ($site==$row['name'])?" selected":"";
	if ($site==$row['name']) $siteID_current = $row['id'];
	
	$list_site .= '<option value="'.$row['name'].'" '.$selected.'>'.$row['name'].'</option>';
}

// GET LIST CATEGORY
if ($siteID_current){
	$results = $db->database_query("SELECT id, name FROM categories_source WHERE web_id=".$siteID_current);
	$list_cat = '<option value="">Tất cả chuyên mục</option>';
	while ($row = $db->database_fetch_assoc($results)){
		$selected = ($catid==$row['id'])?" selected":"";
		$list_cat .= '<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  	<title>Tự động lấy Tin Bài</title>
</head>
<script type="text/javascript">
function submitform(){
	if (typeof document.adminForm.onsubmit == "function") {
		document.adminForm.onsubmit();
	}
	document.adminForm.submit();
}
function checkfrom(){
	if (document.adminForm.site.value=='') {
		alert('Bạn phải chọn website');
		return false;
	}
	if (document.adminForm.step.value=='') {
		alert('Bạn phải chọn Bước');
		return false;
	}
	submitform();
}
</script>
<body>

<div style="margin: 100px auto; width: 800px;">
	<form name="adminForm" id="adminForm" action="crawler.php" method="get">
		<fieldset class="adminform">
			<legend>Chương trình tự động quét dữ liệu về Trang tin GDN</legend>
			<table class="admintable">
				<tbody>
					<tr>
						<td class="key">Website:</td>
						<td>
							<select name="site" onchange="return submitform();">
								<?php echo $list_site; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="key">Chuyên mục:</td>
						<td>
							<select name="catid">
								<?php echo $list_cat; ?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="key">Bước:</td>
						<td>
							<select name="step">
								<option value="">Chọn bước</option>
								<option value="1">Bước 1: Lấy links</option>
								<option value="2">Bước 2: Lấy dữ liệu về</option>
								<option value="3">Bước 3: Lọc dữ liệu</option>
								<option value="4">Bước 4: Upload dữ liệu lên server</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input type="button" value="Chọn" onclick="return checkfrom();" /></td>
					</tr>
				</tbody>
			</table>
			
			<hr style="margin: 10px;" />
			<?php
			if ($site && $step>0 && $step<5)
			{
				if ($step>0 && $step<4)
				{
					if (!file_exists('class/class.'.$site.'.php')){
						echo "Không tìm thấy trang ".$site;
						exit();
					}
					
					include "class/class.".$site.".php";
					
					$class = 'crawl_'.str_replace( ".","_", strtolower($site) );
					$crawl = new $class();
					
					$crawl->set_catid=$catid;
					
					// Quét toàn bộ lần đầu tiên
					$crawl->first_crawl = false;
				}
				
				if ($step==1)
				{
					$crawl->getAllCategories();
					$crawl->getPages();
					$crawl->getLinks();
					echo 'Bước 1: Lấy được '.count($crawl->log_links).' link bài viết:<hr style="margin: 10px;" />';
					for ($i=0; $i<count($crawl->log_links); $i++){
						echo '<div>'.$crawl->log_links[$i].'</div>';
					}
				}
				else if ($step==2)
				{
					$crawl->getAllCategories();
					$crawl->getAllContent();
					echo 'Bước 2: Lấy dữ liệu về được '.count($crawl->log_crawl).' bài viết:<hr style="margin: 10px;" />';
					for ($i=0; $i<count($crawl->log_crawl); $i++){
						echo '<div>'.$crawl->log_crawl[$i].'</div>';
					}
				}
				else if ($step==3)
				{
					$crawl->getAllCategories();
					$crawl->getAllCrawled();
					echo 'Bước 3: Lọc dữ liệu được '.count($crawl->log_content).' bài viết:<hr style="margin: 10px;" />';
					for ($i=0; $i<count($crawl->log_content); $i++){
						echo '<div>'.$crawl->log_content[$i].'</div>';
					}
				}
				else if ($step==4) {
					require_once('class/class.up2server.php');
					$up = new crawlUp2Server();
					$up->web_source_id 	= $siteID_current;
					$up->cat_source_id 	= $catid;
					$up->limit_upload	= 500;
					
					$up->getContents();
					$up->getImages();
					$up->upContents();
					$up->getLogs();
					$up->writeLogs();

					echo $up->log;
				}
				
				// Clean Memories
				if ($step>0 && $step<4) $crawl->clean();
				else $up->clean();
			}
			?>
		</fieldset>
		</form>
	</div>
</body>
</html>