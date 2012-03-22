<?php
/** Mod ty gia thoi tiet cho website joomlaa
*** Cai dat don gian de hieu
*** Version 1.080911.654
*** Viet boi Le Duy. Website kiethuc.vn2up.com
*** Support duyle.2oco@gmail.com hoac tham khao tai website kienthuc.vn2up.com
**/
$Link = array();
$Link[] = 'http://vnexpress.net/ListFile/Weather/hcm.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Sonla.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Haiphong.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Hanoi.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Vinh.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Danang.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Nhatrang.xml';
$Link[] = 'http://vnexpress.net/ListFile/Weather/Pleicu.xml';

$id= isset($_GET['id'])?intval($_GET['id']):0;
$content =  file_get_contents($Link[$id]);
$p = xml_parser_create();
xml_parse_into_struct($p, $content, $xml);
xml_parser_free($p);
?>
<img width="23px" height="18px" src="http://vnexpress.net/Images/Weather/<?php echo $xml[1]['value']; ?>" align="left" />
<img src="http://vnexpress.net/Images/Weather/<?php echo $xml[3]['value']; ?>" align="left" />
<img src="http://vnexpress.net/Images/Weather/<?php echo $xml[5]['value']; ?>" align="left" />
<p><?php echo $xml[13]['value']; ?></p>