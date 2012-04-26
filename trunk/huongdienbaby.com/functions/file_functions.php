<?
function getExtension($filename){
	$sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
	$sExtension = strtolower($sExtension);
	return $sExtension;
}
function generate_name($filename)
{
	$name = "";
	for($i=0; $i<3; $i++){
		$name .= chr(rand(97,122));
	}
	$today= getdate();
	$name.= $today[0];
	$ext	= @mb_substr($filename, (@mb_strrpos($filename, ".") + 1));
	return $name . "." . $ext;
}
?>
<?
function delete_file($table_name,$id_field,$id_field_value,$field_select,$ff_imagepath){
	$db_select = new db_query("SELECT " . $field_select . " " .
									"FROM " . $table_name . " " .
									"WHERE " . $id_field . "=" . $id_field_value
									);
	if($row=mysql_fetch_array($db_select->result)){
		if(file_exists($ff_imagepath . $row[$field_select])) @unlink($ff_imagepath . $row[$field_select]);
		if(file_exists($ff_imagepath . "small_" . $row[$field_select])) @unlink($ff_imagepath . "small_" . $row[$field_select]);
	}	
	unset($db_select);					
}
function check_upload_extension($filename,$allow_list){
	
	$sExtension = substr( $filename, ( strrpos($filename, '.') + 1 ) ) ;
	$sExtension = strtolower( $sExtension ) ;
	
	$allow_arr = explode(",",$allow_list);
	$pass = 0;
	
	for ($i=0;$i<count($allow_arr);$i++){
		if ($sExtension == $allow_arr[$i]) $pass = 1;
	}
	return $pass;
}
function get_file($filename,$contents)
{
    #if file exist -> open -> get number for var -> var++ -> write back -> close file
    #if file !exist -> create -> set var = 0 -> write back -> close file
    if(is_file($filename))
    {
        $fd = fopen($filename, "r"); 
        if($fd)
        {
            fclose ($fd); 
        
            $contents++; 
        
            $fp = fopen ($filename, "w"); 
            if($fp)
            {
                fwrite ($fp,$contents); 
                fclose ($fp); 
            }
            return $contents;
        }
    }else{
        $fp = fopen ($filename, "w"); 
        if($fp)
        {
            fwrite ($fp,$contents); 
            fclose ($fp); 
        }
        return $contents;
    }
	return get_file($filename,$contents);
}
/**
 * Removes the directory and all its contents.
 *
 * @param string the directory name to remove
 * @param boolean whether to just empty the given directory, without deleting the given directory.
 * @return boolean True/False whether the directory was deleted.
 */
function deleteDirectory($dirname,$only_empty=false) {
   if (!is_dir($dirname))
       return false;
   $dscan = array(realpath($dirname));
   $darr = array();
   while (!empty($dscan)) {
       $dcur = array_pop($dscan);
       $darr[] = $dcur;
       if ($d=opendir($dcur)) {
           while ($f=readdir($d)) {
               if ($f=='.' || $f=='..')
                   continue;
               $f=$dcur.'/'.$f;
               if (is_dir($f))
                   $dscan[] = $f;
               else
                   unlink($f);
           }
           closedir($d);
       }
   }
   $i_until = ($only_empty)? 1 : 0;
   for ($i=count($darr)-1; $i>=$i_until; $i--) {
       echo "\nDeleting '".$darr[$i]."' ... ";
       if (rmdir($darr[$i]))
           echo "ok";
       else
           echo "FAIL";
   }
   return (($only_empty)? (count(scandir)<=2) : (!is_dir($dirname)));
}
function mk_dir($dirName, $rights=777){
   $dirs = explode('/', $dirName);
   $dir='';
   foreach ($dirs as $part) {
       $dir.=$part.'/';
       if (!is_dir($dir) && strlen($dir)>0)
           mkdir($dir, $rights);
   }
}
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use diff. tyoes here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (@mail($mailto, $subject, "", $header)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
    }
}
/*// vi du
$my_file = "somefile.zip";
$my_path = "";
$my_name = "Olaf Lederer";
$my_mail = "dinhtoan1905@gmail.com";
$my_replyto = "dinhtoan1905@gmail.com";
$my_subject = "This is a mail with attachment.";
$my_message = "Hallo,\r\ndo you like this script? I hope it will help.\r\n\r\ngr. Olaf";
mail_attachment($my_file, $my_path, "dinhtoan1905@gmail.com", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);
*/
?>