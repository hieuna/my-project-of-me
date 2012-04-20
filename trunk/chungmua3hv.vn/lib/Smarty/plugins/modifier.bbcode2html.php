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
function smarty_modifier_bbcode2html($message) {

$message = str_replace(":1rm3zafo", "", $message);
$message = str_replace("{SMILIES_PATH}", "/forum/images/smilies", $message);
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
								$message = str_replace($ar_mili['code'],'<img hspace = "3" src = "lib/bbcode/icons/contents/'. $ar_mili['smiley_url'].'" border = 0 />', $message);
							}				 
  $preg = array(
          '/(?<!\\\\)\[color(?::\w+)?=(.*?)\](.*?)\[\/color(?::\w+)?\]/si'   => "<span style=\"color:\\1\">\\2</span>",
          '/(?<!\\\\)\[size(?::\w+)?=(.*?)\](.*?)\[\/size(?::\w+)?\]/si'     => "<span style=\"font-size:\\1\">\\2</span>",
          '/(?<!\\\\)\[font(?::\w+)?=(.*?)\](.*?)\[\/font(?::\w+)?\]/si'     => "<span style=\"font-family:\\1\">\\2</span>",
          '/(?<!\\\\)\[align(?::\w+)?=(.*?)\](.*?)\[\/align(?::\w+)?\]/si'   => "<div style=\"text-align:\\1\">\\2</div>",
          '/(?<!\\\\)\[b(?::\w+)?\](.*?)\[\/b(?::\w+)?\]/si'                 => "<span style=\"font-weight:bold\">\\1</span>",
          '/(?<!\\\\)\[i(?::\w+)?\](.*?)\[\/i(?::\w+)?\]/si'                 => "<span style=\"font-style:italic\">\\1</span>",
          '/(?<!\\\\)\[u(?::\w+)?\](.*?)\[\/u(?::\w+)?\]/si'                 => "<span style=\"text-decoration:underline\">\\1</span>",
          '/(?<!\\\\)\[center(?::\w+)?\](.*?)\[\/center(?::\w+)?\]/si'       => "<div style=\"text-align:center\">\\1</div>",

          // [code] & [php]
          '/(?<!\\\\)\[code(?::\w+)?\](.*?)\[\/code(?::\w+)?\]/si'           => "<div class=\"bb-code\">\\1</div>",
          '/(?<!\\\\)\[php(?::\w+)?\](.*?)\[\/php(?::\w+)?\]/si'             => "<div class=\"bb-php\">\\1</div>",
          // [email]
          '/(?<!\\\\)\[email(?::\w+)?\](.*?)\[\/email(?::\w+)?\]/si'         => "<a href=\"mailto:\\1\" class=\"bb-email\">\\1</a>",
          '/(?<!\\\\)\[email(?::\w+)?=(.*?)\](.*?)\[\/email(?::\w+)?\]/si'   => "<a href=\"mailto:\\1\" class=\"bb-email\">\\2</a>",
          // [url]
          '/(?<!\\\\)\[url(?::\w+)?\]www\.(.*?)\[\/url(?::\w+)?\]/si'        => "<a href=\"http://www.\\1\" target=\"_blank\" class=\"bb-url\">\\1</a>",
          '/(?<!\\\\)\[url(?::\w+)?\](.*?)\[\/url(?::\w+)?\]/si'             => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\1</a>",
          '/(?<!\\\\)\[url(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si'      => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\2</a>",
          // [img]
          '/(?<!\\\\)\[img(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si'             => "<img src=\"\\1\" alt=\"\\1\" class=\"bb-image\" />",
          '/(?<!\\\\)\[img(?::\w+)?=(.*?)x(.*?)\](.*?)\[\/img(?::\w+)?\]/si' => "<img width=\"\\1\" height=\"\\2\" src=\"\\3\" alt=\"\\3\" class=\"bb-image\" />",
          // [quote]
          '/(?<!\\\\)\[quote(?::\w+)?\](.*?)\[\/quote(?::\w+)?\]/si'         => "<div>Quote:<div class=\"bb-quote\">\\1</div></div>",
          '/(?<!\\\\)\[quote(?::\w+)?=(?:&quot;|"|\')?(.*?)["\']?(?:&quot;|"|\')?\](.*?)\[\/quote\]/si'   => "<div>Quote \\1:<div class=\"bb-quote\">\\2</div></div>",
          // [list]
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\*(?::\w+)?\](.*?)(?=(?:\s*<br\s*\/?>\s*)?\[\*|(?:\s*<br\s*\/?>\s*)?\[\/?list)/si' => "\n<li class=\"bb-listitem\">\\1</li>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\/list(:(?!u|o)\w+)?\](?:<br\s*\/?>)?/si'    => "\n</ul>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\/list:u(:\w+)?\](?:<br\s*\/?>)?/si'         => "\n</ul>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\/list:o(:\w+)?\](?:<br\s*\/?>)?/si'         => "\n</ol>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(:(?!u|o)\w+)?\]\s*(?:<br\s*\/?>)?/si'   => "\n<ul class=\"bb-list-unordered\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list:u(:\w+)?\]\s*(?:<br\s*\/?>)?/si'        => "\n<ul class=\"bb-list-unordered\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list:o(:\w+)?\]\s*(?:<br\s*\/?>)?/si'        => "\n<ol class=\"bb-list-ordered\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=1\]\s*(?:<br\s*\/?>)?/si' => "\n<ol class=\"bb-list-ordered,bb-list-ordered-d\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=i\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-lr\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=I\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-ur\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=a\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-la\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=A\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-ua\">",
          // escaped tags like \[b], \[color], \[url], ...
          '/\\\\(\[\/?\w+(?::\w+)*\])/'                                      => "\\1"

  );
  $message = preg_replace(array_keys($preg), array_values($preg), $message);
  return $message;
}

?>