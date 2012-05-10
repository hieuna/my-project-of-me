<?php

class JFilterInput
{
	var $tagsArray; // default = empty array
	var $attrArray; // default = empty array

	var $tagsMethod; // default = 0
	var $attrMethod; // default = 0

	var $xssAuto; // default = 1
	var $tagBlacklist = array ('applet', 'body', 'bgsound', 'base', 'basefont', 'embed', 'frame', 'frameset', 'head', 'html', 'id', 'iframe', 'ilayer', 'layer', 'link', 'meta', 'name', 'object', 'script', 'style', 'title', 'xml');
	var $attrBlacklist = array ('action', 'background', 'codebase', 'dynsrc', 'lowsrc', 'class', 'id'); // also will strip ALL event handlers

	/**
	 * Constructor for inputFilter class. Only first parameter is required.
	 *
	 * @access	protected
	 * @param	array	$tagsArray	list of user-defined tags
	 * @param	array	$attrArray	list of user-defined attributes
	 * @param	int		$tagsMethod	WhiteList method = 0, BlackList method = 1
	 * @param	int		$attrMethod	WhiteList method = 0, BlackList method = 1
	 * @param	int		$xssAuto	Only auto clean essentials = 0, Allow clean blacklisted tags/attr = 1
	 * @since	1.5
	 */
	function __construct($tagsArray = array(), $attrArray = array(), $tagsMethod = 0, $attrMethod = 0, $xssAuto = 1)
	{
		// Make sure user defined arrays are in lowercase
		$tagsArray = array_map('strtolower', (array) $tagsArray);
		$attrArray = array_map('strtolower', (array) $attrArray);

		// Assign member variables
		$this->tagsArray	= $tagsArray;
		$this->attrArray	= $attrArray;
		$this->tagsMethod	= $tagsMethod;
		$this->attrMethod	= $attrMethod;
		$this->xssAuto		= $xssAuto;
	}

	/**
	 * Returns a reference to an input filter object, only creating it if it doesn't already exist.
	 *
	 * This method must be invoked as:
	 * 		<pre>  $filter = & JFilterInput::getInstance();</pre>
	 *
	 * @static
	 * @param	array	$tagsArray	list of user-defined tags
	 * @param	array	$attrArray	list of user-defined attributes
	 * @param	int		$tagsMethod	WhiteList method = 0, BlackList method = 1
	 * @param	int		$attrMethod	WhiteList method = 0, BlackList method = 1
	 * @param	int		$xssAuto	Only auto clean essentials = 0, Allow clean blacklisted tags/attr = 1
	 * @return	object	The JFilterInput object.
	 * @since	1.5
	 */
	function & getInstance($tagsArray = array(), $attrArray = array(), $tagsMethod = 0, $attrMethod = 0, $xssAuto = 1)
	{
		static $instances;

		$sig = md5(serialize(array($tagsArray,$attrArray,$tagsMethod,$attrMethod,$xssAuto)));

		if (!isset ($instances)) {
			$instances = array();
		}

		if (empty ($instances[$sig])) {
			$instances[$sig] = new JFilterInput($tagsArray, $attrArray, $tagsMethod, $attrMethod, $xssAuto);
		}

		return $instances[$sig];
	}

	/**
	 * Method to be called by another php script. Processes for XSS and
	 * specified bad code.
	 *
	 * @access	public
	 * @param	mixed	$source	Input string/array-of-string to be 'cleaned'
	 * @param	string	$type	Return type for the variable (INT, FLOAT, BOOLEAN, WORD, ALNUM, CMD, BASE64, STRING, ARRAY, PATH, NONE)
	 * @return	mixed	'Cleaned' version of input parameter
	 * @since	1.5
	 * @static
	 */
	function clean($source, $type='string')
	{
		// Handle the type constraint
		switch (strtoupper($type))
		{
			case 'INT' :
			case 'INTEGER' :
				// Only use the first integer value
				preg_match('/-?[0-9]+/', (string) $source, $matches);
				$result = @ (int) $matches[0];
				break;

			case 'FLOAT' :
			case 'DOUBLE' :
				// Only use the first floating point value
				preg_match('/-?[0-9]+(\.[0-9]+)?/', (string) $source, $matches);
				$result = @ (float) $matches[0];
				break;

			case 'BOOL' :
			case 'BOOLEAN' :
				$result = (bool) $source;
				break;

			case 'WORD' :
				$result = (string) preg_replace( '/[^A-Z_]/i', '', $source );
				break;

			case 'ALNUM' :
				$result = (string) preg_replace( '/[^A-Z0-9]/i', '', $source );
				break;

			case 'CMD' :
				$result = (string) preg_replace( '/[^A-Z0-9_\.-]/i', '', $source );
				$result = ltrim($result, '.');
				break;

			case 'BASE64' :
				$result = (string) preg_replace( '/[^A-Z0-9\/+=]/i', '', $source );
				break;

			case 'STRING' :
				// Check for static usage and assign $filter the proper variable
				if(isset($this) && is_a( $this, 'JFilterInput' )) {
					$filter =& $this;
				} else {
					$filter =& JFilterInput::getInstance();
				}
				$result = (string) $filter->_remove($filter->_decode((string) $source));
				break;

			case 'ARRAY' :
				$result = (array) $source;
				break;

			case 'PATH' :
				$pattern = '/^[A-Za-z0-9_-]+[A-Za-z0-9_\.-]*([\\\\\/][A-Za-z0-9_-]+[A-Za-z0-9_\.-]*)*$/';
				preg_match($pattern, (string) $source, $matches);
				$result = @ (string) $matches[0];
				break;

			case 'USERNAME' :
				$result = (string) preg_replace( '/[\x00-\x1F\x7F<>"\'%&]/', '', $source );
				break;

			default :
				// Check for static usage and assign $filter the proper variable
				if(is_object($this) && get_class($this) == 'JFilterInput') {
					$filter =& $this;
				} else {
					$filter =& JFilterInput::getInstance();
				}
				// Are we dealing with an array?
				if (is_array($source)) {
					foreach ($source as $key => $value)
					{
						// filter element for XSS and other 'bad' code etc.
						if (is_string($value)) {
							$source[$key] = $filter->_remove($filter->_decode($value));
						}
					}
					$result = $source;
				} else {
					// Or a string?
					if (is_string($source) && !empty ($source)) {
						// filter source for XSS and other 'bad' code etc.
						$result = $filter->_remove($filter->_decode($source));
					} else {
						// Not an array or string.. return the passed parameter
						$result = $source;
					}
				}
				break;
		}
		return $result;
	}

	/**
	 * Function to determine if contents of an attribute is safe
	 *
	 * @static
	 * @param	array	$attrSubSet	A 2 element array for attributes name,value
	 * @return	boolean True if bad code is detected
	 * @since	1.5
	 */
	function checkAttribute($attrSubSet)
	{
		$attrSubSet[0] = strtolower(@$attrSubSet[0]);
		$attrSubSet[1] = strtolower(@$attrSubSet[1]);
		return (((strpos($attrSubSet[1], 'expression') !== false) && ($attrSubSet[0]) == 'style') || (strpos($attrSubSet[1], 'javascript:') !== false) || (strpos($attrSubSet[1], 'behaviour:') !== false) || (strpos($attrSubSet[1], 'vbscript:') !== false) || (strpos($attrSubSet[1], 'mocha:') !== false) || (strpos($attrSubSet[1], 'livescript:') !== false));
	}

	/**
	 * Internal method to iteratively remove all unwanted tags and attributes
	 *
	 * @access	protected
	 * @param	string	$source	Input string to be 'cleaned'
	 * @return	string	'Cleaned' version of input parameter
	 * @since	1.5
	 */
	function _remove($source)
	{
		$loopCounter = 0;

		// Iteration provides nested tag protection
		while ($source != $this->_cleanTags($source))
		{
			$source = $this->_cleanTags($source);
			$loopCounter ++;
		}
		return $source;
	}

	/**
	 * Internal method to strip a string of certain tags
	 *
	 * @access	protected
	 * @param	string	$source	Input string to be 'cleaned'
	 * @return	string	'Cleaned' version of input parameter
	 * @since	1.5
	 */
	function _cleanTags($source)
	{
		/*
		 * In the beginning we don't really have a tag, so everything is
		 * postTag
		 */
		$preTag		= null;
		$postTag	= $source;
		$currentSpace = false;
		$attr = '';	 // moffats: setting to null due to issues in migration system - undefined variable errors

		// Is there a tag? If so it will certainly start with a '<'
		$tagOpen_start	= strpos($source, '<');

		while ($tagOpen_start !== false)
		{
			// Get some information about the tag we are processing
			$preTag			.= substr($postTag, 0, $tagOpen_start);
			$postTag		= substr($postTag, $tagOpen_start);
			$fromTagOpen	= substr($postTag, 1);
			$tagOpen_end	= strpos($fromTagOpen, '>');

			// Let's catch any non-terminated tags and skip over them
			if ($tagOpen_end === false) {
				$postTag		= substr($postTag, $tagOpen_start +1);
				$tagOpen_start	= strpos($postTag, '<');
				continue;
			}

			// Do we have a nested tag?
			$tagOpen_nested = strpos($fromTagOpen, '<');
			$tagOpen_nested_end	= strpos(substr($postTag, $tagOpen_end), '>');
			if (($tagOpen_nested !== false) && ($tagOpen_nested < $tagOpen_end)) {
				$preTag			.= substr($postTag, 0, ($tagOpen_nested +1));
				$postTag		= substr($postTag, ($tagOpen_nested +1));
				$tagOpen_start	= strpos($postTag, '<');
				continue;
			}

			// Lets get some information about our tag and setup attribute pairs
			$tagOpen_nested	= (strpos($fromTagOpen, '<') + $tagOpen_start +1);
			$currentTag		= substr($fromTagOpen, 0, $tagOpen_end);
			$tagLength		= strlen($currentTag);
			$tagLeft		= $currentTag;
			$attrSet		= array ();
			$currentSpace	= strpos($tagLeft, ' ');

			// Are we an open tag or a close tag?
			if (substr($currentTag, 0, 1) == '/') {
				// Close Tag
				$isCloseTag		= true;
				list ($tagName)	= explode(' ', $currentTag);
				$tagName		= substr($tagName, 1);
			} else {
				// Open Tag
				$isCloseTag		= false;
				list ($tagName)	= explode(' ', $currentTag);
			}

			/*
			 * Exclude all "non-regular" tagnames
			 * OR no tagname
			 * OR remove if xssauto is on and tag is blacklisted
			 */
			if ((!preg_match("/^[a-z][a-z0-9]*$/i", $tagName)) || (!$tagName) || ((in_array(strtolower($tagName), $this->tagBlacklist)) && ($this->xssAuto))) {
				$postTag		= substr($postTag, ($tagLength +2));
				$tagOpen_start	= strpos($postTag, '<');
				// Strip tag
				continue;
			}

			/*
			 * Time to grab any attributes from the tag... need this section in
			 * case attributes have spaces in the values.
			 */
			while ($currentSpace !== false)
			{
				$attr			= '';
				$fromSpace		= substr($tagLeft, ($currentSpace +1));
				$nextSpace		= strpos($fromSpace, ' ');
				$openQuotes		= strpos($fromSpace, '"');
				$closeQuotes	= strpos(substr($fromSpace, ($openQuotes +1)), '"') + $openQuotes +1;

				// Do we have an attribute to process? [check for equal sign]
				if (strpos($fromSpace, '=') !== false) {
					/*
					 * If the attribute value is wrapped in quotes we need to
					 * grab the substring from the closing quote, otherwise grab
					 * till the next space
					 */
					if (($openQuotes !== false) && (strpos(substr($fromSpace, ($openQuotes +1)), '"') !== false)) {
						$attr = substr($fromSpace, 0, ($closeQuotes +1));
					} else {
						$attr = substr($fromSpace, 0, $nextSpace);
					}
				} else {
					/*
					 * No more equal signs so add any extra text in the tag into
					 * the attribute array [eg. checked]
					 */
					if ($fromSpace != '/') {
						$attr = substr($fromSpace, 0, $nextSpace);
					}
				}

				// Last Attribute Pair
				if (!$attr && $fromSpace != '/') {
					$attr = $fromSpace;
				}

				// Add attribute pair to the attribute array
				$attrSet[] = $attr;

				// Move search point and continue iteration
				$tagLeft		= substr($fromSpace, strlen($attr));
				$currentSpace	= strpos($tagLeft, ' ');
			}

			// Is our tag in the user input array?
			$tagFound = in_array(strtolower($tagName), $this->tagsArray);

			// If the tag is allowed lets append it to the output string
			if ((!$tagFound && $this->tagsMethod) || ($tagFound && !$this->tagsMethod)) {

				// Reconstruct tag with allowed attributes
				if (!$isCloseTag) {
					// Open or Single tag
					$attrSet = $this->_cleanAttributes($attrSet);
					$preTag .= '<'.$tagName;
					for ($i = 0; $i < count($attrSet); $i ++)
					{
						$preTag .= ' '.$attrSet[$i];
					}

					// Reformat single tags to XHTML
					if (strpos($fromTagOpen, '</'.$tagName)) {
						$preTag .= '>';
					} else {
						$preTag .= ' />';
					}
				} else {
					// Closing Tag
					$preTag .= '</'.$tagName.'>';
				}
			}

			// Find next tag's start and continue iteration
			$postTag		= substr($postTag, ($tagLength +2));
			$tagOpen_start	= strpos($postTag, '<');
		}

		// Append any code after the end of tags and return
		if ($postTag != '<') {
			$preTag .= $postTag;
		}
		return $preTag;
	}

	/**
	 * Internal method to strip a tag of certain attributes
	 *
	 * @access	protected
	 * @param	array	$attrSet	Array of attribute pairs to filter
	 * @return	array	Filtered array of attribute pairs
	 * @since	1.5
	 */
	function _cleanAttributes($attrSet)
	{
		// Initialize variables
		$newSet = array();

		// Iterate through attribute pairs
		for ($i = 0; $i < count($attrSet); $i ++)
		{
			// Skip blank spaces
			if (!$attrSet[$i]) {
				continue;
			}

			// Split into name/value pairs
			$attrSubSet = explode('=', trim($attrSet[$i]), 2);
			list ($attrSubSet[0]) = explode(' ', $attrSubSet[0]);

			/*
			 * Remove all "non-regular" attribute names
			 * AND blacklisted attributes
			 */
			if ((!preg_match('/[a-z]*$/i', $attrSubSet[0])) || (($this->xssAuto) && ((in_array(strtolower($attrSubSet[0]), $this->attrBlacklist)) || (substr($attrSubSet[0], 0, 2) == 'on')))) {
				continue;
			}

			// XSS attribute value filtering
			if (@$attrSubSet[1]) {
				// strips unicode, hex, etc
				$attrSubSet[1] = str_replace('&#', '', $attrSubSet[1]);
				// strip normal newline within attr value
				$attrSubSet[1] = preg_replace('/[\n\r]/', '', $attrSubSet[1]);
				// strip double quotes
				$attrSubSet[1] = str_replace('"', '', $attrSubSet[1]);
				// convert single quotes from either side to doubles (Single quotes shouldn't be used to pad attr value)
				if ((substr($attrSubSet[1], 0, 1) == "'") && (substr($attrSubSet[1], (strlen($attrSubSet[1]) - 1), 1) == "'")) {
					$attrSubSet[1] = substr($attrSubSet[1], 1, (strlen($attrSubSet[1]) - 2));
				}
				// strip slashes
				$attrSubSet[1] = stripslashes($attrSubSet[1]);
			}

			// Autostrip script tags
			if (JFilterInput::checkAttribute($attrSubSet)) {
				continue;
			}

			// Is our attribute in the user input array?
			$attrFound = in_array(strtolower($attrSubSet[0]), $this->attrArray);

			// If the tag is allowed lets keep it
			if ((!$attrFound && $this->attrMethod) || ($attrFound && !$this->attrMethod)) {

				// Does the attribute have a value?
				if (@$attrSubSet[1]) {
					$newSet[] = $attrSubSet[0].'="'.$attrSubSet[1].'"';
				} elseif (@$attrSubSet[1] == "0") {
					/*
					 * Special Case
					 * Is the value 0?
					 */
					$newSet[] = $attrSubSet[0].'="0"';
				} else {
					$newSet[] = $attrSubSet[0].'="'.$attrSubSet[0].'"';
				}
			}
		}
		return $newSet;
	}

	/**
	 * Try to convert to plaintext
	 *
	 * @access	protected
	 * @param	string	$source
	 * @return	string	Plaintext string
	 * @since	1.5
	 */
	function _decode($source)
	{
		// entity decode
		$trans_tbl = get_html_translation_table(HTML_ENTITIES);
		foreach($trans_tbl as $k => $v) {
			$ttr[$v] = utf8_encode($k);
		}
		$source = strtr($source, $ttr);
		// convert decimal
		$source = preg_replace('/&#(\d+);/me', "utf8_encode(chr(\\1))", $source); // decimal notation
		// convert hex
		$source = preg_replace('/&#x([a-f0-9]+);/mei', "utf8_encode(chr(0x\\1))", $source); // hex notation
		return $source;
	}
	
	function stringURLSafe($string, $gachduoi=false)
	{
		$trans = array(
		"đ"=>"d","ă"=>"a","â"=>"a","á"=>"a","à"=>"a","ả"=>"a","ã"=>"a","ạ"=>"a",
		"ấ"=>"a","ầ"=>"a","ẩ"=>"a","ẫ"=>"a","ậ"=>"a",
		"ắ"=>"a","ằ"=>"a","ẳ"=>"a","ẵ"=>"a","ặ"=>"a",
		"é"=>"e","è"=>"e","ẻ"=>"e","ẽ"=>"e","ẹ"=>"e",
		"ế"=>"e","ề"=>"e","ể"=>"e","ễ"=>"e","ệ"=>"e","ê"=>"e",
		"í"=>"i","ì"=>"i","ỉ"=>"i","ĩ"=>"i","ị"=>"i",
		"ú"=>"u","ù"=>"u","ủ"=>"u","ũ"=>"u","ụ"=>"u",
		"ứ"=>"u","ừ"=>"u","ử"=>"u","ữ"=>"u","ự"=>"u","ư"=>"u",
		"ó"=>"o","ò"=>"o","ỏ"=>"o","õ"=>"o","ọ"=>"o",
		"ớ"=>"o","ờ"=>"o","ở"=>"o","ỡ"=>"o","ợ"=>"o","ơ"=>"o",
		"ố"=>"o","ồ"=>"o","ổ"=>"o","ỗ"=>"o","ộ"=>"o","ô"=>"o",
		"ú"=>"u","ù"=>"u","ủ"=>"u","ũ"=>"u","ụ"=>"u",
		"ứ"=>"u","ừ"=>"u","ử"=>"u","ữ"=>"u","ự"=>"u","ư"=>"u",
		"ý"=>"y","ỳ"=>"y","ỷ"=>"y","ỹ"=>"y","ỵ"=>"y",
		"Đ"=>"d","Ă"=>"a","Â"=>"a","Á"=>"a","À"=>"a","Ả"=>"a","Ã"=>"a","Ạ"=>"a",
		"Ấ"=>"a","Ầ"=>"a","Ẩ"=>"a","Ẫ"=>"a","Ậ"=>"a",
		"Ắ"=>"a","Ằ"=>"a","Ẳ"=>"a","Ẵ"=>"a","Ặ"=>"a",
		"É"=>"e","È"=>"e","Ẻ"=>"e","Ẽ"=>"e","Ẹ"=>"e",
		"Ế"=>"e","Ề"=>"e","Ể"=>"e","Ễ"=>"e","Ệ"=>"e","Ê"=>"e",
		"Í"=>"i","Ì"=>"i","Ỉ"=>"i","Ĩ"=>"i","Ị"=>"i",
		"Ú"=>"u","Ù"=>"u","Ủ"=>"u","Ũ"=>"u","Ụ"=>"u",
		"Ứ"=>"u","Ừ"=>"u","Ử"=>"u","Ữ"=>"u","Ự"=>"u","Ư"=>"u",
		"Ó"=>"o","Ò"=>"o","Ỏ"=>"o","Õ"=>"o","Ọ"=>"o",
		"Ớ"=>"o","Ờ"=>"o","Ở"=>"o","Ỡ"=>"o","Ợ"=>"o","Ơ"=>"o",
		"Ố"=>"o","Ồ"=>"o","Ổ"=>"o","Ỗ"=>"o","Ộ"=>"o","Ô"=>"o",
		"Ú"=>"u","Ù"=>"u","Ủ"=>"u","Ũ"=>"u","Ụ"=>"u",
		"Ứ"=>"u","Ừ"=>"u","Ử"=>"u","Ữ"=>"u","Ự"=>"u","Ư"=>"u",
		"Ý"=>"y","Ỳ"=>"y","Ỷ"=>"y","Ỹ"=>"y","Ỵ"=>"y");
		
		//remove any '-' from the string they will be used as concatonater
		$str = str_replace('-', ' ', $string);

		//$lang =& JFactory::getLanguage();
		//$str = $lang->transliterate($str);
		$str = strtr($str, $trans);
		// remove any duplicate whitespace, and ensure all characters are alphanumeric
		$str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array("-",''), $str);

		// lowercase and trim
		$str = trim(strtolower($str));
		
		if ($gachduoi) $str = str_replace('-', '_', $str);
		
		return $str;
	}
	
	function convertUnicode($str)
	{
		$trans = array(
			"&#225;" => "á", 
			"&#224;" => "à", 
			"&#7843;" => "ả", 
			"&#227;" => "ã", 
			"&#7841;" => "ạ", 
			"&#259;" => "ă", 
			"&#7855;" => "ắ", 
			"&#7857;" => "ằ", 
			"&#7859;" => "ẳ", 
			"&#7861;" => "ẵ", 
			"&#7863;" => "ặ", 
			"&#226;" => "â", 
			"&#7845;" => "ấ", 
			"&#7847;" => "ầ", 
			"&#7849;" => "ẩ", 
			"&#7851;" => "ẫ", 
			"&#7853;" => "ậ", 
			"&#233;" => "é", 
			"&#232;" => "è", 
			"&#7867;" => "ẻ", 
			"&#7869;" => "ẽ", 
			"&#7865;" => "ẹ", 
			"&#234;" => "ê", 
			"&#7871;" => "ế", 
			"&#7873;" => "ề", 
			"&#7875;" => "ể", 
			"&#7877;" => "ễ", 
			"&#7879;" => "ệ", 
			"&#237;" => "í", 
			"&#236;" => "ì", 
			"&#7881;" => "ỉ", 
			"&#297;" => "ĩ", 
			"&#7883;" => "ị", 
			"&#243;" => "ó", 
			"&#242;" => "ò", 
			"&#7887;" => "ỏ", 
			"&#245;" => "õ", 
			"&#7885;" => "ọ", 
			"&#244;" => "ô", 
			"&#7889;" => "ố", 
			"&#7891;" => "ồ", 
			"&#7893;" => "ổ", 
			"&#7895;" => "ỗ", 
			"&#7897;" => "ộ", 
			"&#417;" => "ơ", 
			"&#7899;" => "ớ", 
			"&#7901;" => "ờ", 
			"&#7903;" => "ở", 
			"&#7905;" => "ỡ", 
			"&#7907;" => "ợ", 
			"&#250;" => "ú", 
			"&#249;" => "ù", 
			"&#7911;" => "ủ", 
			"&#361;" => "ũ", 
			"&#7909;" => "ụ", 
			"&#432;" => "ư", 
			"&#7913;" => "ứ", 
			"&#7915;" => "ừ", 
			"&#7917;" => "ử", 
			"&#7919;" => "ữ", 
			"&#7921;" => "ự", 
			"&#253;" => "ý", 
			"&#7923;" => "ỳ", 
			"&#7927;" => "ỷ", 
			"&#7929;" => "ỹ", 
			"&#7925;" => "ỵ", 
			"&#273;" => "đ", 
			"&#193;" => "Á", 
			"&#192;" => " ﻿À", 
			"&#7842;" => "Ả", 
			"&#195;" => "Ã", 
			"&#7840;" => "Ạ", 
			"&#258;" => "Ă", 
			"&#7854;" => "Ắ", 
			"&#7856;" => "Ằ", 
			"&#7858;" => "Ẳ", 
			"&#7860;" => "Ẵ", 
			"&#7862;" => "Ặ", 
			"&#194;" => "Â", 
			"&#7844;" => "Ấ", 
			"&#7846;" => "Ầ", 
			"&#7848;" => "Ẩ", 
			"&#7850;" => "Ẫ", 
			"&#7852;" => "Ậ", 
			"&#201;" => "É", 
			"&#200;" => "È", 
			"&#7866;" => "Ẻ", 
			"&#7868;" => "Ẽ", 
			"&#7864;" => "Ẹ", 
			"&#202;" => "Ê", 
			"&#7870;" => "Ế", 
			"&#7872;" => "Ề", 
			"&#7874;" => "Ể", 
			"&#7876;" => "Ễ", 
			"&#7878;" => "Ệ", 
			"&#205;" => "Í", 
			"&#204;" => "Ì", 
			"&#7880;" => "Ỉ", 
			"&#296;" => "Ĩ", 
			"&#7882;" => "Ị", 
			"&#211;" => "Ó", 
			"&#210;" => "Ò", 
			"&#7886;" => "Ỏ", 
			"&#213;" => "Õ", 
			"&#7884;" => "Ọ", 
			"&#212;" => "Ô", 
			"&#7888;" => "Ố", 
			"&#7890;" => "Ồ", 
			"&#7892;" => "Ổ", 
			"&#7894;" => "Ỗ", 
			"&#7896;" => "Ộ", 
			"&#416;" => "Ơ", 
			"&#7898;" => "Ớ", 
			"&#7900;" => "Ờ", 
			"&#7902;" => "Ở", 
			"&#7904;" => "Ỡ", 
			"&#7906;" => "Ợ", 
			"&#218;" => "Ú", 
			"&#217;" => "Ù", 
			"&#7910;" => "Ủ", 
			"&#360;" => "Ũ", 
			"&#7908;" => "Ụ", 
			"&#431;" => "Ư", 
			"&#7912;" => "Ứ", 
			"&#7914;" => "Ừ", 
			"&#7916;" => "Ử", 
			"&#7918;" => "Ữ", 
			"&#7920;" => "Ự", 
			"&#221;" => "Ý", 
			"&#7922;" => "Ỳ", 
			"&#7926;" => "Ỷ", 
			"&#7928;" => "Ỹ", 
			"&#7924;" => "Ỵ", 
			"&#272;" => "Ð",
			"&#39;" => "'",
			
			"&ecirc;" => "ê",
			"&eacute;" => "é",
			"&agrave;" => "à",
			"&ugrave;" => "ỳ",
			"&otilde;" => "õ",
			"&igrave;" => "ì",
			"&iacute;" => "í",
			"&Aacute;" => "Á",
			"&ocirc;" => "ô",
			"&oacute;" => "ó",
			"&aacute;" => "á",
			"&yacute;" => "ý",
			"&acirc;" => "â",
			"&atilde;" => "ã",
			"&ograve;" => "ò",
			"&uacute;" => "ú",
			"&egrave;" => "è",
			"&Ocirc;" => "Ô",
		);
		$str = strtr($str, $trans);
		return $str;
	}
	
	function strip_only($str, $tags, $stripContent = false) {
	    $content = '';
	    if(!is_array($tags)) {
	        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
	        if(end($tags) == '') array_pop($tags);
	    }
	    foreach($tags as $tag) {
	        if ($stripContent)
	             $content = '(.+</'.$tag.'[^>]*>|)';
	         $str = preg_replace('#</?'.$tag.'[^>]*>'.$content.'#is', '', $str);
	    }
	    return $str;
	} 
}
