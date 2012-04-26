<?
define('EXPR_WARNING','Error in regular expresion %s');
define('P_STRING',0);
define('P_VARIABLE',2);
class url_rewriter {
    var $base;
    var $actual;
    var $path;
    var $rules;
    var $variables;
    var $e404;
	 var $rootPath;
	 var $lang_id=1;
	 
    function url_rewriter($base) {
        $this->path = parse_url($_SERVER['REQUEST_URI']);
        $this->actual = $this->path ==  "/" ?  array("") : explode("/",$this->path['path']);
        $this->base = $base;
    }
    
    function error404() {
         if ( $this->e404 != '') require $this->base."".$this->e404;
			//header('HTTP/1.1 404 Not Found');
         //header('Status: 404 Not Found');
    }

    function add_rule($action, $expr, $params = array()) {
	 	  $expr=$this->rootPath . $expr;
        $rule['action'] = $action;
        $rule['expr']   = explode('/',$expr);
        $rule['params'] = $params;
        $this->rules[] = $rule;
     }
    /**
     */
    function _exec($id) {
        $actual   = &$this->rules[$id];
        $action   = &$this->rules[$id]['action'];
        $GLOBALS['urlVars'] = & $this->variables;
		  $GLOBALS['lang']= & $this->lang_id;
        //$GLOBALS['urlHandler'] = & $this;
        if ( is_callable($action) ) {
            call_user_func($action);
        } else {
			  	$lang		= &$GLOBALS['lang'];
            $urlVars = &$GLOBALS['urlVars'];
            //$urlHandler = &$GLOBALS['urlHandler'];
				require $this->base."/".$action;
        }
    }
    /**
     *    Find
     *
     *
     */
    function execute() {
 		  if(!isset($this->rules)) {
				$this->error404();
				return;
		  }
        foreach($this->rules as $id=>$rule) {
            $f = true;
            $i=0;
            $var=array();
            
            foreach($rule['expr'] as $expr)  {
                $variable=$compiled=array();
                $this->expr_compile($expr,$compiled);
					 //if(!isset($this->actual[$i++])) return;
                $f = @$this->expr_cmp($this->actual[$i++],$compiled,$variable);
                //echo "<pre>/".print_r($variable,true).print_r($compiled,true).$this->actual[$i-1]."=$expr</pre><hr/>";
                if (!$f) {
                    break;
                }
                foreach($variable as $k => $v) {
                    $f = substr($k,0,7) == ":number" ? is_numeric($v) : true;
                    if ( !$f ) { 
                        break 2;
                    }
                    if ( isset($rule['params'][$k])  ) {        
                        $f = array_search($v,$rule['params'][$k]) !== false;
                        if (!$f) {
                            break 2; /* break foreach &&  foreach*/
                        }
                    }
                    $var[$k]=$v;
                }
            }
            if ($f && $i == count($this->actual)) {
                $this->variables = & $var;
                $this->_exec($id);
                break; /* found, so break. */
            }
        }
        if (!$f) {
            $this->error404();
        }
        return $f;
    }
    /**
     *    Return new Parse object
     *
     *    @return object
     *    @access private
     */
    function newParser() {
        $obj = new stdClass;
        $obj->string='';
        $obj->type=P_STRING;
        $obj->optional = null;
        $obj->next = null;    
        return $obj;
    }
    /**
     *    Compare Expressions
     *
     *    Compare an string with an Regular expression.
     *
     *    @param string $string String to compare
     *    @param array $obj Parsed regular expression
     *    @param array $var Variables.
     *    @access private
     *    @return bool
     */
    function expr_cmp($string, $obj,&$vars) {
        if ( !is_object($obj)) return false;
        $t = & $obj;
        $offset=0;
        $found=true;
        $varPos = -1;
        $fghsd=0;
        while ($t) {
            if ($t->string!='')
            switch($t->type){ 
                case P_STRING:
                    if (  $varPos==-1 &&   strpos($string,$t->string,$offset)!==$offset) {
                        $found=false;
                    
                        break 2; /* break swich && while */
                    } else if ( $varPos >= 0  ) {
                        $tmpCounter=strpos($string,$t->string,$offset);
                        
                        if ($tmpCounter==false){ 
                            $found=false;    
                            break 2;
                        }
                        $vars[$varName] = substr($string,$varPos,$tmpCounter-$varPos);
                        $varPos=-1;
                        $offset=$tmpCounter;
                    }
                    $offset+=strlen($t->string);
                    break;
                case P_VARIABLE:
                    $varName = $t->string;
                    $varPos = $offset;
                    break;
            }
            /* now check for optional tokens */
            $e = & $t->optional;
            $f=count($e);
            
            for($i=0;$i<$f; $i++) { 
                $h = & $e[$i];
                while($h) {
                    switch($h->type){ 
                        case P_STRING:
                            if ( $varPos==-1 && strpos($string,$h->string,$offset)!==$offset) {
                                
                                if ($offset==0 && $string!='') {
                                    $found=false;
                                    break 4;
                                }
                                break 3; /* break swich,while,for */
                                /* do, nothing, this block is optional */
                            }    else if ( $varPos >= 0) {
                                $tmpCounter=strpos($string,$h->string,$offset);
                                if ($tmpCounter==false)break 3;
                                $vars[$varName]  = substr($string,$varPos,$tmpCounter-$varPos);
                                $varPos=-1;
                                $offset=$tmpCounter;
                            }
                            $offset+=strlen($h->string);
                            break;
                        case P_VARIABLE:
                            $varName = $h->string;
                            $varPos = $offset;
                            break;
                    }
                    $h=&$h->next;
                }
            }
            $t = $t->next;
        }
        
        if ( $varPos > -1) {
            $vars[$varName]  = substr($string,$varPos);
        }


        return $found;
    }
    
    /**
     *    Parse Regular Expression
     *
     *    Parse a the URL regular expression.
     *    @param string $expr Regular Expression to parse
     *    @param object $first Object parsed.
     *    @param integer $i Number to start.
     *    @return bool
     *    @access private
     */
    function expr_compile($expr, &$first, $i=0) {
        
        /* Create new parser object */
        $first = $this->newParser();
        $maxLen = strlen($expr); 
        $obj = &$first;
        if ($expr=='') return true;
        for(;$i<$maxLen; $i++) {
            switch($expr[$i]) {
                case '[':
                    $max=0;
                    $starLetter = '[';
                    $closeLetter =  ']' ;
                    $e=$i+1;
                    for(;$i<$maxLen; $i++) {
                        switch($expr[$i]) {
                            case $starLetter:
                                $max++;
                                if ($max>1) 
                                    trigger_error(printf(EXPR_WARNING,$expr),E_USER_ERROR);
                                break;
                            case $closeLetter:
                                $max--;
                                if ($max==0) {
                                    if ($obj->string!='' || $obj->optional!=null ) {
                                        $obj->next = $this->newParser();
                                        $obj = & $obj->next;
                                    }
                                    $obj->type = P_VARIABLE;
                                    $obj->string = substr($expr,$e,$i-$e);
                                    $obj->next = $this->newParser();
                                    $obj = & $obj->next;
                                    break 2;
                                } else
                                    trigger_error(printf(EXPR_WARNING,$expr),E_USER_ERROR);
                        }
                    }
                    break;
                case '{':
                    $starLetter = '{';
                    $closeLetter =  '}' ; 
                    $tmp='';
                    $max=0;
                    $e=$i+1;
                    for(;$i<$maxLen; $i++) {
                        switch($expr[$i]) {
                            case $starLetter:
                                $max++;
                                break;
                            case $closeLetter:
                                $max--;
                                if ($max==0) {
                                    $tmp = substr($expr,$e,$i-$e);
                                    $i++;
                                    $this->expr_compile($tmp,$tmpObj);
                                    
                                    $tmpObj1 = &$tmpObj;
                                    //print_r($tmpObj1);die();
                                    $tmpCnt=0;
                                    while ($tmpObj1) {
                                        $obj->optional[$tmpCnt] = & $tmpObj1;
                                        /* move next element*/
                                        $tmpObj1 = &$tmpObj1->next;    
                                        /* unlink direction */
                                        unset($obj->optional[$tmpCnt++]->next); 
                                    }
                                    //$obj->child->optional=$starLetter=='{';
                                    /* Create new parse. */
                                    $obj->next = $this->newParser();
                                    $obj = &$obj->next;
                                    $i--;
                                    break 2; /* break switch & while */
                                }
                                break;
                        }
                    }
                    break;
                default:
                    $obj->string.=$expr[$i];
                    break;
            }
        }
        if ($obj->string=='' && $obj->optional==null ) 
            $obj=false;
        return true;
    }
}
?>