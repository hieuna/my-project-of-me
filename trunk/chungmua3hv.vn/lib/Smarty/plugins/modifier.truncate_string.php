<?php
	/* truncate string with space character and limit character 
		@parameter:
			$data: string source.
			$limit_char: get limit character.
		@return : return string with number character greater or equal $limit_char
	*/
function smarty_modifier_truncate_string($string, $limit_char=80)
{
    if( strlen( $string) <= $limit_char) return $string;
		$max_word = 10;
		while ( substr( $string, $limit_char, 1 ) != ' ' && $max_word > 0 && $limit_char > 0) {
			$limit_char --;
			$max_word --;
		}
		
		if( $limit_char <= 0) return $string;
		else return substr( $string, 0, $limit_char);
}
?>
