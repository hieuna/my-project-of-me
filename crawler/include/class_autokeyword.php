<?php

/******************************************************************
Projectname:   Automatic Keyword Generator
Version:       0.2
Author:        Ver Pangonilo <smp_AT_itsp.info>
Last modified: 21 July 2006
Copyright (C): 2006 Ver Pangonilo, All Rights Reserved

* GNU General Public License (Version 2, June 1991)
*
* This program is free software; you can redistribute
* it and/or modify it under the terms of the GNU
* General Public License as published by the Free
* Software Foundation; either version 2 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will
* be useful, but WITHOUT ANY WARRANTY; without even the
* implied warranty of MERCHANTABILITY or FITNESS FOR A
* PARTICULAR PURPOSE. See the GNU General Public License
* for more details.

Description:
This class can generates automatically META Keywords for your
web pages based on the contents of your articles. This will
eliminate the tedious process of thinking what will be the best
keywords that suits your article. The basis of the keyword
generation is the number of iterations any word or phrase
occured within an article.

This automatic keyword generator will create single words,
two word phrase and three word phrases. Single words will be
filtered from a common words list.

Change Log:
===========
0.2 Ver Pangonilo - 22 July 2005
================================
Added user configurable parameters and commented codes
for easier end user understanding.
						
0.3 Vasilich  (vasilich_AT_grafin.kiev.ua) - 26 July 2006
=========================================================
Added encoding parameter to work with UTF texts, min number 
of the word/phrase occurrences, 

0.4 Peter Kahl, B.S.E.E. (www.dezzignz.com) - 24 May 2009 
=========================================================
To strip the punctuations CORRECTLY, moved the ';' to the
end.

Also added '&nbsp;', '&trade;', '&reg;'.
******************************************************************/

class autokeyword {

	//declare variables
	//the site contents
	var $contents;
	var $encoding;
	//the generated keywords
	var $keywords;
	//minimum word length for inclusion into the single word
	//metakeys
	var $wordLengthMin;
	var $wordOccuredMin;
	//minimum word length for inclusion into the 2 word
	//phrase metakeys
	var $word2WordPhraseLengthMin;
	var $phrase2WordLengthMinOccur;
	//minimum word length for inclusion into the 3 word
	//phrase metakeys
	var $word3WordPhraseLengthMin;
	//minimum phrase length for inclusion into the 2 word
	//phrase metakeys
	var $phrase2WordLengthMin;
	var $phrase3WordLengthMinOccur;
	var $phrase3WordLengthMin;
	
	var $arrKeywords;

	function autokeyword($params, $encoding)
	{
		//get parameters
		$this->encoding = $encoding;
		mb_internal_encoding($encoding);
		$this->contents = $this->replace_chars($params['content']);

		// single word
		$this->wordLengthMin = $params['min_word_length'];
		$this->wordOccuredMin = $params['min_word_occur'];

		// 2 word phrase
		$this->word2WordPhraseLengthMin = $params['min_2words_length'];
		$this->phrase2WordLengthMin = $params['min_2words_phrase_length'];
		$this->phrase2WordLengthMinOccur = $params['min_2words_phrase_occur'];

		// 3 word phrase
		$this->word3WordPhraseLengthMin = $params['min_3words_length'];
		$this->phrase3WordLengthMin = $params['min_3words_phrase_length'];
		$this->phrase3WordLengthMinOccur = $params['min_3words_phrase_occur'];
		
		// 4 word phrase
		$this->word4WordPhraseLengthMin = $params['min_4words_length'];
		$this->phrase4WordLengthMin = $params['min_4words_phrase_length'];
		$this->phrase4WordLengthMinOccur = $params['min_4words_phrase_occur'];
		
		// 5 word phrase
		$this->word5WordPhraseLengthMin = $params['min_5words_length'];
		$this->phrase5WordLengthMin = $params['min_5words_phrase_length'];
		$this->phrase5WordLengthMinOccur = $params['min_5words_phrase_occur'];
		// 6 word phrase
		$this->word6WordPhraseLengthMin = $params['min_6words_length'];
		$this->phrase6WordLengthMin = $params['min_6words_phrase_length'];
		$this->phrase6WordLengthMinOccur = $params['min_6words_phrase_occur'];

		//parse single, two words and three words

	}

	function get_keywords()
	{
		$keywords = array_merge($this->parse_words(),$this->parse_2words(),$this->parse_3words(),$this->parse_4words(),$this->parse_5words(),$this->parse_6words());

		return $keywords;
	}

	//turn the site contents into an array
	//then replace common html tags.
	function replace_chars($content)
	{
		//convert all characters to lower case
		$content = mb_strtolower($content);
		//$content = mb_strtolower($content, "UTF-8");
		$content = strip_tags($content);

      //updated in v0.3, 24 May 2009
		$punctuations = array(',', ')', '(', '.', "'", '"', '“', '”',
		'<', '>', '!', '?', '/', '-',
		'_', '[', ']', ':', '+', '=', '#',
		'$', '&quot;', '&copy;', '&gt;', '&lt;', 
		'&nbsp;', '&trade;', '&reg;', ';', 
		chr(10), chr(13), chr(9));

		$content = str_replace($punctuations, " ", $content);
		// replace multiple gaps
		$content = preg_replace('/ {2,}/si', " ", $content);

		return $content;
	}

	//single words META KEYWORDS
	function parse_words()
	{
		//list of commonly used words
		// this can be edited to suit your needs
		$common = array();
		//create an array out of the site contents
		$s = split(" ", $this->contents);
		//initialize array
		$k = array();
		//iterate inside the array
		foreach( $s as $key=>$val ) {
			//delete single or two letter words and
			//Add it to the list if the word is not
			//contained in the common words list.
			if(mb_strlen(trim($val)) >= $this->wordLengthMin  && !in_array(trim($val), $common)  && !is_numeric(trim($val))) {
				$k[] = trim($val);
			}
		}
		//count the words
		$k = array_count_values($k);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($k, $this->wordOccuredMin);
		arsort($occur_filtered);

		//$imploded = $this->implode(", ", $occur_filtered);
		//release unused variables
		unset($k);
		unset($s);

		return $occur_filtered;
	}

	function parse_2words()
	{
		//create an array out of the site contents
		$x = split(" ", $this->contents);
		//initilize array

		//$y = array();
		for ($i=0; $i < count($x)-1; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($x[$i])) >= $this->word2WordPhraseLengthMin ) && (mb_strlen(trim($x[$i+1])) >= $this->word2WordPhraseLengthMin) )
			{
				$y[] = trim($x[$i])." ".trim($x[$i+1]);
			}
		}

		//count the 2 word phrases
		$y = array_count_values($y);

		$occur_filtered = $this->occure_filter($y, $this->phrase2WordLengthMinOccur);
		//sort the words from highest count to the lowest.
		arsort($occur_filtered);
		/*
		if (count($occur_filtered)>0){
			foreach ($occur_filtered as $k => $v){
				if (!is_array($this->arrKeywords[3])) continue;
				foreach ($this->arrKeywords[3] as $keywords3){
					if (strpos($keywords3, $k)!==false) unset($occur_filtered[$k]);
				}
			}
		}
		*/
		//$imploded = $this->implode(", ", $occur_filtered);
		//release unused variables
		unset($y);
		unset($x);

		return $occur_filtered;
	}

	function parse_3words()
	{
		//create an array out of the site contents
		$a = split(" ", $this->contents);
		//initilize array
		$b = array();

		for ($i=0; $i < count($a)-2; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($a[$i])) >= $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i+1])) >= $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i+2])) >= $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i]).trim($a[$i+1]).trim($a[$i+2])) >= $this->phrase3WordLengthMin) )
			{
				$b[] = trim($a[$i])." ".trim($a[$i+1])." ".trim($a[$i+2]);
			}
		}

		//count the 3 word phrases
		$b = array_count_values($b);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($b, $this->phrase3WordLengthMinOccur);
		arsort($occur_filtered);
		/*
		if (count($occur_filtered)>0){
			foreach ($occur_filtered as $k => $v){
				$this->arrKeywords[3][] = $k;
				if (!is_array($this->arrKeywords[4])) continue;
				foreach ($this->arrKeywords[4] as $keywords4){
					if (strpos($keywords4, $k)!==false) unset($occur_filtered[$k]);
				}
			}
		}
		*/
		//$imploded = $this->implode(", ", $occur_filtered);
		//release unused variables
		unset($a);
		unset($b);

		return $occur_filtered;
	}

	function parse_4words()
	{
		//create an array out of the site contents
		$a = split(" ", $this->contents);
		//initilize array
		$b = array();

		for ($i=0; $i < count($a)-3; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($a[$i])) >= $this->word4WordPhraseLengthMin) && (mb_strlen(trim($a[$i+1])) >= $this->word4WordPhraseLengthMin) && (mb_strlen(trim($a[$i+2])) >= $this->word4WordPhraseLengthMin) && (mb_strlen(trim($a[$i+3])) >= $this->word4WordPhraseLengthMin) && (mb_strlen(trim($a[$i]).trim($a[$i+1]).trim($a[$i+2]).trim($a[$i+3])) >= $this->phrase4WordLengthMin) )
			{
				$b[] = trim($a[$i])." ".trim($a[$i+1])." ".trim($a[$i+2])." ".trim($a[$i+3]);
			}
		}

		//count the 3 word phrases
		$b = array_count_values($b);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($b, $this->phrase4WordLengthMinOccur);
		arsort($occur_filtered);
		/*
		if (count($occur_filtered)>0){
			foreach ($occur_filtered as $k => $v){
				$this->arrKeywords[4][] = $k;
				if (!is_array($this->arrKeywords[5])) continue;
				foreach ($this->arrKeywords[5] as $keywords5){
					if (strpos($keywords5, $k)!==false) unset($occur_filtered[$k]);
				}
			}
		}
		*/
		//$imploded = $this->implode(", ", $occur_filtered);
		//release unused variables
		unset($a);
		unset($b);

		return $occur_filtered;
	}

	function parse_5words()
	{
		//create an array out of the site contents
		$a = split(" ", $this->contents);
		//initilize array
		$b = array();

		for ($i=0; $i < count($a)-4; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($a[$i])) >= $this->word5WordPhraseLengthMin) && (mb_strlen(trim($a[$i+1])) >= $this->word5WordPhraseLengthMin) && (mb_strlen(trim($a[$i+2])) >= $this->word5WordPhraseLengthMin) && (mb_strlen(trim($a[$i+3])) >= $this->word5WordPhraseLengthMin) && (mb_strlen(trim($a[$i+4])) >= $this->word5WordPhraseLengthMin) && (mb_strlen(trim($a[$i]).trim($a[$i+1]).trim($a[$i+2]).trim($a[$i+3]).trim($a[$i+4])) >= $this->phrase5WordLengthMin) )
			{
				$b[] = trim($a[$i])." ".trim($a[$i+1])." ".trim($a[$i+2])." ".trim($a[$i+3])." ".trim($a[$i+4]);
			}
		}

		//count the 3 word phrases
		$b = array_count_values($b);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($b, $this->phrase5WordLengthMinOccur);
		arsort($occur_filtered);
		/*
		if (count($occur_filtered)>0){
			foreach ($occur_filtered as $k => $v){
				$this->arrKeywords[5][] = $k;
				if (!is_array($this->arrKeywords[6])) continue;
				foreach ($this->arrKeywords[6] as $keywords6){
					if (strpos($keywords6, $k)!==false) unset($occur_filtered[$k]);
				}
			}
		}
		*/
		//$imploded = $this->implode(", ", $occur_filtered);
		//release unused variables
		unset($a);
		unset($b);

		return $occur_filtered;
	}

	function parse_6words()
	{
		//create an array out of the site contents
		$a = split(" ", $this->contents);
		//initilize array
		$b = array();

		for ($i=0; $i < count($a)-5; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($a[$i])) >= $this->word6WordPhraseLengthMin) && (mb_strlen(trim($a[$i+1])) >= $this->word6WordPhraseLengthMin) && (mb_strlen(trim($a[$i+2])) >= $this->word6WordPhraseLengthMin) && (mb_strlen(trim($a[$i+3])) >= $this->word6WordPhraseLengthMin) && (mb_strlen(trim($a[$i+4])) >= $this->word6WordPhraseLengthMin) && (mb_strlen(trim($a[$i+5])) >= $this->word6WordPhraseLengthMin) && (mb_strlen(trim($a[$i]).trim($a[$i+1]).trim($a[$i+2]).trim($a[$i+3]).trim($a[$i+4]).trim($a[$i+5])) >= $this->phrase6WordLengthMin) )
			{
				$b[] = trim($a[$i])." ".trim($a[$i+1])." ".trim($a[$i+2])." ".trim($a[$i+3])." ".trim($a[$i+4])." ".trim($a[$i+5]);
			}
		}

		//count the 3 word phrases
		$b = array_count_values($b);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($b, $this->phrase5WordLengthMinOccur);
		arsort($occur_filtered);
		/*
		if (count($occur_filtered)>0){
			foreach ($occur_filtered as $k => $v){
				$this->arrKeywords[5][] = $k;
				if (!is_array($this->arrKeywords[6])) continue;
				foreach ($this->arrKeywords[6] as $keywords6){
					if (strpos($keywords6, $k)!==false) unset($occur_filtered[$k]);
				}
			}
		}
		*/
		
		//release unused variables
		unset($a);
		unset($b);

		return $occur_filtered;
	}

	function occure_filter($array_count_values, $min_occur)
	{
		$occur_filtered = array();
		foreach ($array_count_values as $word => $occured) {
			if ($occured >= $min_occur) {
				$occur_filtered[$word] = $occured;
			}
		}

		return $occur_filtered;
	}

	function implode($gule, $array)
	{
		$c = "";
		foreach($array as $key=>$val) {
			@$c .= $key.$gule;
		}
		return $c;
	}
}
?>
