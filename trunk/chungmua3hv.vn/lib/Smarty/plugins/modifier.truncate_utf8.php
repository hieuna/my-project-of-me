<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate-utf8 function plugin
 *
 * @param string: string source
 * @param integer: leng of string result in current encoding
 * @param integer: Offset in allow
 */
function smarty_modifier_truncate_utf8($string, $len = 50, $limit=0)
{
	echo '<script>function ToggleTextView(s, l, t, b)
	{
	  var $ = function (id) {return document.getElementById(id); };
	  s=$(s); l=$(l); t=$(t); b=$(b);
	  if (t) { t.detailView = !t.detailView; t.innerHTML=t.detailView?l.innerHTML:s.innerHTML; b.innerHTML=t.detailView?"[-]":"[+]"; }
	}</script>';

  $outputPattern =
 "<span id=\"%1\$s_s\" style=\"display:none\">%2\$s</span>
	<span id=\"%1\$s_l\" style=\"display:none\">%3\$s</span>
	<span id=\"%1\$s_t\">%2\$s</span>&nbsp;
	<a style='text-decoration: none;' id=\"%1\$s_b\" href=\"javascript:void(0);\" onclick=\"ToggleTextView('%1\$s_s', '%1\$s_l', '%1\$s_t', '%1\$s_b')\">[+]</a>";

  $retVal = $string;

  /* get current encoding:
  	"auto" is expanded to: ASCII,JIS,UTF-8,EUC-JP,SJIS
  */
  $encoding=mb_detect_encoding($string, "auto");

  // leng of string in current encoding
  $strlen=mb_strlen($string, $encoding);

  $delta = $strlen-$len;
  if (($delta>0) && ($limit < $delta))
  {
    $shortText = "";

    // trim it by length in current encoding
    $shortText=mb_substr($string, 0, $len, $encoding);

    // find the last break word
    $breakPos=$len;
    $breakPatten=array(" ", ",", ".", ":", "_", "-", "+");
    foreach($breakPatten as $id => $breakKey)
    {
    	if(mb_strrpos($shortText, $breakKey, $encoding))
		{
			if($id=="0") {
				$breakPos=mb_strrpos($shortText, $breakKey, $encoding);
			} else {
				$breakPos=($breakPos > mb_strrpos($shortText, $breakKey, $encoding)) ? $breakPos : mb_strrpos($shortText, $breakKey, $encoding);
			}
		}
	}

    //remove break word
    $shortText=mb_substr($shortText, 0, $breakPos, $encoding);

    // generate unique id
    $id = "div_detail_".str_replace(" ", "_", microtime());

    // generate return value
    $retVal = sprintf($outputPattern, $id, $shortText."...", $string);
  }
  return $retVal;
}
?>
