<style type="text/css">
table.type2 {
	border: none;
	background: none;
	padding: 0;
}

table.type2 th {
	background: none;
	border-top: none;
	text-align: center;
	color: #115098;
	padding: 2px 0;
}

table.type2 td {
	padding: 0;
	font-size: 1em;
}

table.type2 td.name {
	padding: 2px;
	vertical-align: middle;
}

img {
	border: 0;
}
a.button2, input.button2 {
	width: auto !important;
	padding: 1px 3px 0 3px;
	font-family: "Lucida Grande", Verdana, Helvetica, Arial, sans-serif;
	color: #000;
	font-size: 0.85em;
	background: #EFEFEF url("lib/bbcode/images/bg_button.gif") repeat-x top;
	cursor: pointer;
}

/* Alternative button */
a.button2, input.button2 {
	border: 1px solid #666666;
}

/* <a> button in the style of the form buttons */
a.button2, a.button2:link, a.button2:visited, a.button2:active {
	text-decoration: none;
	color: #000000;
	padding: 4px 8px;
}

/* Hover states */
a.button2:hover, input.button2:hover {
	border: 1px solid #BC2A4D;
	background: #EFEFEF url("lib/bbcode/images/bg_button.gif") repeat bottom;
	color: #BC2A4D;
}

optgroup, select {
	font-family: Verdana, Helvetica, Arial, sans-serif;
	font-size: 0.85em;
	font-weight: normal;
	font-style: normal;
	cursor: pointer;
	vertical-align: middle;
	width: auto;
	color: #000;
}

textarea {
	font-family: Verdana, Helvetica, Arial, sans-serif;
	font-size: 0.85em;
	width: 80%;
	padding: 2px;
	border: 1px solid #0033FF;
}

</style>

		

	<script language="javascript" src="/lib/bbcode/js/editor.js"></script>
		<script type="text/javascript">
// <![CDATA[
	var form_name = 'postform';
	var text_name = 'message';
	var load_draft = false;
	var upload = false;

	// Define the bbCode tags
	var bbcode = new Array();
	var bbtags = new Array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[quote]','[/quote]','[code]','[/code]','[list]','[/list]','[list=]','[/list]','[img]','[/img]','[url]','[/url]','[flash=]', '[/flash]','[size=]','[/size]');
	var imageTag = false;

	// Helpline messages
	var help_line = {
		b: '{LA_BBCODE_B_HELP}',
		i: '{LA_BBCODE_I_HELP}',
		u: '{LA_BBCODE_U_HELP}',
		q: '{LA_BBCODE_Q_HELP}',
		c: '{LA_BBCODE_C_HELP}',
		l: '{LA_BBCODE_L_HELP}',
		o: '{LA_BBCODE_O_HELP}',
		p: '{LA_BBCODE_P_HELP}',
		w: '{LA_BBCODE_W_HELP}',
		a: '{LA_BBCODE_A_HELP}',
		s: '{LA_BBCODE_S_HELP}',
		f: '{LA_BBCODE_F_HELP}',
		e: '{LA_BBCODE_E_HELP}',
		d: '{LA_BBCODE_D_HELP}'
	}

	var panels = new Array('options-panel', 'attach-panel', 'poll-panel');
	var show_panel = 'options-panel';


// ]]>

</script>
 	 <script type="text/javascript">
				// <![CDATA[
					/**
					* Set display of page element
					* s[-1,0,1] = hide,toggle display,show
					*/
					function dE(n, s, type)
					{
						if (!type)
						{
							type = 'block';
						}
					
						var e = document.getElementById(n);
						if (!s)
						{
							s = (e.style.display == '' || e.style.display == 'block') ? -1 : 1;
						}
						e.style.display = (s == 1) ? type : 'none';
					}
					
					function change_palette()
					{
						dE('colour_palette');
						e = document.getElementById('colour_palette');
						
						if (e.style.display == 'block')
						{
							document.getElementById('bbpalette').value = 'Hide font colour';
						}
						else
						{
							document.getElementById('bbpalette').value = 'Font colour';
						}
					}
		
					
				// ]]>
				</script>
<?php
	/*
 * Smarty plugin
 * ------------------------------------------------------------
 * Type:       modifier
 * Name:       bbcode2html
 * Purpose:    Converts BBCode style tags to HTML
 * Author:     Andre Rabold
 * Version:    1.4
 * Remarks:    Notice that this function does not check for
 *             correct syntax. Try not to use it with invalid
 *             BBCode because this could lead to unexpected
 *             results ;-)
 *             It seems that this function ignores manual 
 *             line breaks. IMO this can be fixed by adding 
 *             '/\n/' => "<br>" to $preg
 *
 * What's new: - Rewrote some preg expressions for more
 *               stability.
 *             - renamed CSS classes to be more generic. (Example
 *               CSS file attached.)
 *             - Support for escaped tags. Add a backslash
 *               infront of a tag if you don't want to transform
 *               it. For example: \[b]
 *
 *             Version 1.3c
 *             - Fixed a bug with <li>...</li> tags (thanks
 *               to Rob Schultz for pointing this out)
 *
 *             Version 1.3b
 *             - Added more support for phpBB2:
 *               [list]...[/list:u] unordered lists
 *               [list]...[/list:o] ordered lists
 *             
 *             Version 1.3
 *             - added support for phpBB2 like tag identifier
 *               like [b:b6a0cef7ea]This is bold[/b:b6a0cef7ea]
 *               (thanks to Rob Schultz)
 *             - added support for quotes within the quote tag
 *               so [quote="foo"]bar[/quote] does work now
 *               correctly
 *             - removed str_replace functions
 *
 *             Version 1.2
 *             - now supports CSS classes:
 *                  ng_email      (mailto links)
 *                  ng_url        (www links)
 *                  ng_quote      (quotes)
 *                  ng_quote_body (quotes)
 *                  ng_code       (source code)
 *                  ng_list       (html lists)
 *                  ng_list_item  (list items)
 *             - replaced slow ereg_replace() functions
 *             - Alterned [quote] and [code] to use CSS classes
 *               instead of HTML <blockquote />, <hr />, ... tags.
 *             - Additional BBCode tags [list] and [*] to display
 *               nice HTML lists. Example:
 *                 [list]
 *                   [*]first item
 *                   [*]second item
 *                   [*]third item
 *                 [/list]
 *               The [list] tag can have an additional parameter:
 *                 [list]   unorderer list with bullets
 *                 [list=1] ordered list 1,2,3,4,...
 *                 [list=i] ordered list i,ii,iii,iv,...
 *                 [list=I] ordered list I,II,III,IV,...
 *                 [list=a] ordered list a,b,c,d,...
 *                 [list=A] ordered list A,B,C,D,...
 *             - produces well-formed output
 *             - cleaned up the code
 * ------------------------------------------------------------
 */
function ImgDirContent($img_folder, $numPerRow = 20)
	{
		
		$ar_mili=array (
						 0 => array ( 'code' => ':D', 'smiley_url' => 'icon_e_biggrin.gif', 'emotion' => 'Very Happy' ),
						 1 => array ( 'code' => ':)', 'smiley_url' => 'icon_e_smile.gif', 'emotion' => 'Smile' ),
						 2 => array ( 'code' => ';)', 'smiley_url' => 'icon_e_wink.gif', 'emotion' => 'Wink' ),
						 3 => array ( 'code' => ':(', 'smiley_url' => 'icon_e_sad.gif', 'emotion' => 'Sad' ),
						 4 => array ( 'code' => ':o', 'smiley_url' => 'icon_e_surprised.gif', 'emotion' => 'Surprised' ),
						 5 => array ( 'code' => ':shock:', 'smiley_url' => 'icon_eek.gif', 'emotion' => 'Shocked' ),
						 6 => array ( 'code' => ':?', 'smiley_url' => 'icon_e_confused.gif', 'emotion' => 'Confused' ),
						 7 => array ( 'code' => '8-)', 'smiley_url' => 'icon_cool.gif', 'emotion' => 'Cool' ),
						 8 => array ( 'code' => ':lol:', 'smiley_url' => 'icon_lol.gif', 'emotion' => 'Laughing' ),
						 9 => array ( 'code' => ':x', 'smiley_url' => 'icon_mad.gif', 'emotion' => 'Mad' ),
						 10 => array ( 'code' => ':P', 'smiley_url' => 'icon_razz.gif', 'emotion' => 'Razz' ),
						 11 => array ( 'code' => ':oops:', 'smiley_url' => 'icon_redface.gif', 'emotion' => 'Embarrassed' ), 
						 12 => array ( 'code' => ':cry:', 'smiley_url' => 'icon_cry.gif', 'emotion' => 'Crying or Very Sad' ),
						 13 => array ( 'code' => ':evil:', 'smiley_url' => 'icon_evil.gif', 'emotion' => 'Evil or Very Mad' ),
						 14 => array ( 'code' => ':twisted:', 'smiley_url' => 'icon_twisted.gif', 'emotion' => 'Twisted Evil' ), 
						 15 => array ( 'code' => ':roll:', 'smiley_url' => 'icon_rolleyes.gif', 'emotion' => 'Rolling Eyes' ), 
						 16 => array ( 'code' => ':!:', 'smiley_url' => 'icon_exclaim.gif', 'emotion' => 'Exclamation' ), 
						 17 => array ( 'code' => ':?:', 'smiley_url' => 'icon_question.gif', 'emotion' => 'Question' ), 
						 18 => array ( 'code' => ':idea:', 'smiley_url' => 'icon_idea.gif', 'emotion' => 'Idea' ),
						 19 => array ( 'code' => ':arrow:', 'smiley_url' => 'icon_arrow.gif', 'emotion' => 'Arrow' ), 
						 20 => array ( 'code' => ':|', 'smiley_url' => 'icon_neutral.gif', 'emotion' => 'Neutral' ),
						 21 => array ( 'code' => ':mrgreen:', 'smiley_url' => 'icon_mrgreen.gif', 'emotion' => 'Mr. Green' ), 
						 22 => array ( 'code' => ':geek:', 'smiley_url' => 'icon_e_geek.gif', 'emotion' => 'Geek' ), 
						 23 => array ( 'code' => ':ugeek:', '[smiley_url]' => 'icon_e_ugeek.gif', 'emotion' => 'Uber Geek' ) 
						 ); 
						
						foreach($ar_mili as $ar_mili)
							{
									$i ++;
										if($i % $numPerRow == 1)
											$str .= '<p>';
							
												$str .= '<a href="#" onclick="insert_text(\''.$ar_mili['code'].'\', true); return false;"><img hspace = "3" src = "'.$img_folder.'/'.$ar_mili['smiley_url'].'" border = 0  title="'.$ar_mili['emotion'].'" width="15" height="17" alt="'.$ar_mili['code'].'" /></a>';
										
										if($i % $numPerRow == 0)
											$str .= '</p>';
								
										
										
							
							}			
		
		
		return $str;
	}  
function ReadImgDir($img_folder, $numPerRow = 5, /* number of images per row */ $nameOfRadio = 'name')
	{
		//use the directory class		
		
		if ($handle = opendir($img_folder)) {
					
		$imgs = dir($img_folder);
		
		 // read all files from the  directory, checks if are images and ads them to a list 
		 // (see below how to display flash banners)
		 $i = 1;
		 while ($file = $imgs->read()) {
		 	if (eregi("gif", $file) || eregi("jpg", $file) || eregi("png", $file))
			{
				if($i % $numPerRow == 1)
					$str .= '<p>';
					
				//$imglist .= "$file ";
				$str .= '<input type = "radio" value = "'.$file.'" name = "'.$nameOfRadio.'" id = "'.$nameOfRadio.'"><img hspace = "3" src = "'.$img_folder.'/'.$file.'" border = 0 />';
				
				if($i % $numPerRow == 0)
					$str .= '</p>';
				
				$i ++;

			}
			}
			closedir($handle);
		 }
		 
		 closedir($imgs->handle);		
		
		return $str;
	} 
function smarty_modifier_bbcode($message) {
		
		//$listImgPost =ReadImgDir('../../bbcode/icons/posts', 10, 'post_icon');
		$listImgPost =ReadImgDir('lib/bbcode/icons/posts', 10, 'post_icon');
		$listImgContent=ImgDirContent('lib/bbcode/icons/contents');
		$output='
<div style="float:left; width:700px;">
<form action="" method="post" name="postform" id="postform">
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="8%">Topic icon </td>
      <td width="92%" align="left">'.$listImgPost.'</td>
    </tr>
    <tr>
      <td>Subject</td>
      <td align="left"><input type="text" name="textfield" /></td>
    </tr>
    <tr>
      <td colspan="2">
				   <div id="colour_palette" style="display: none;">
           
			  <div style="float:left">
			   <script type="text/javascript">
					colorPalette(\'h\', 15, 10);
				</script>
           		</div>        
				</td>
    </tr>
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="75%" valign="top"><div id="format-buttons">
            <input type="button" class="button2" accesskey="b" name="addbbcode0" value=" B " style="font-weight:bold; width: 30px" onclick="bbstyle(0)" title="Bold text: [b]text[/b]" />
            <input type="button" class="button2" accesskey="i" name="addbbcode2" value=" i " style="font-style:italic; width: 30px" onclick="bbstyle(2)" title="Italic text: [i]text[/i]" />
            <input type="button" class="button2" accesskey="u" name="addbbcode4" value=" u " style="text-decoration: underline; width: 30px" onclick="bbstyle(4)" title="Underline text: [u]text[/u]" />
           <input type="button" class="button2" accesskey="q" name="addbbcode6" value="Quote" style="width: 50px" onclick="bbstyle(6)" title="Quote text: [quote]text[/quote]" />
          <!--  <input type="button" class="button2" accesskey="c" name="addbbcode8" value="Code" style="width: 40px" onclick="bbstyle(8)" title="Code display: [code]code[/code]" />-->
        <!--    <input type="button" class="button2" accesskey="l" name="addbbcode10" value="List" style="width: 40px" onclick="bbstyle(10)" title="List: [list]text[/list]" />-->
            <input type="button" class="button2" accesskey="o" name="addbbcode12" value="List=" style="width: 40px" onclick="bbstyle(12)" title="Ordered list: [list=]text[/list]" />
            <!--<input type="button" class="button2" accesskey="t" name="addlitsitem" value="[*]" style="width: 40px" onclick="bbstyle(-1)" title="List item: [*]text[/*]" /-->
            <input type="button" class="button2" accesskey="p" name="addbbcode14" value="Img" style="width: 40px" onclick="bbstyle(14)" title="Insert image: [img]http://image_url[/img]" />
            <input type="button" class="button2" accesskey="w" name="addbbcode16" value="URL" style="text-decoration: underline; width: 40px" onclick="bbstyle(16)" title="Insert URL: [url]http://url[/url] or [url=http://url]URL text[/url]" />
            <input type="button" class="button2" accesskey="d" name="addbbcode18" value="Flash" onclick="bbstyle(18)" title="Flash: [flash=width,height]http://url[/flash]" />
         <!-- <select name="addbbcode20" onchange="bbfontstyle(\'[size=\' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + \']\', \'[/size]\');this.form.addbbcode20.selectedIndex = 2;" title="Font size: [size=85]small text[/size]">
              <option value="50">Tiny</option>
              <option value="85">Small</option>
              <option value="100" selected="selected">Normal</option>
              <option value="150">Large</option>
              <option value="200">Huge</option>
            </select>-->
            <input type="button" class="button2" name="bbpalette" id="bbpalette" value="Font colour" onclick="change_palette();" title="Font colour: [color=red]text[/color]  Tip: you can also use color=#FF0000" />
          </div>
		
            <div style="padding-top:2px;">
              <textarea name="message" id="message" rows="15"  tabindex="3" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" class="inputbox"></textarea>
			 
            </div></td>
         
        </tr>
      </table></td>
    </tr>
	<tr>
      <td colspan="2">'.$listImgContent.'</td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</div>		
			';
return $output;
}


?>