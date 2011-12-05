<?php
//@06 - 30 - 10 
//@Start caching
//@author tannv
//Xoá cache
//CacheLib::auto_run();
class CacheLib{   
	static $expire = 3600,$subDir = '',$fileListCache = 'listCache',$cacheKey = '';
	static function auto_run(){
		if(isset($_REQUEST['trigger']) && isset($_REQUEST['cache_key']) && $_REQUEST['trigger'] && $_REQUEST['cache_key']  ){
			CacheLib::removePer();
		}
		return true;
	}
	static function cronjobDel(){
		$hour = date('H',TIME_NOW);
		$done = DIR_CACHE.self::$subDir.'done';
		if($hour>4 && $hour<5){
			if(!file_exists($done)){
				$fileListCache = DIR_CACHE.self::$subDir.self::$fileListCache;
				if(file_exists($fileListCache)){
					$listCache = file_get_contents($fileListCache);
					if($listCache){
						$listCache = substr($listCache,0,-1);
						$fileArr = explode('|',$listCache);
						$listValue = '';
						foreach($fileArr as $v){
							$fileArr = unserialize($v);
							$fileName = array_keys($fileArr);
							if($fileArr[$fileName[0]] < TIME_NOW){// check time expire
								CacheLib::removePer($fileName[0]);
							}
							else{
								$listValue .= $v.'|';
							}
						}
						if($listValue){
							@file_put_contents($fileListCache,$listValue);
						}
						@file_put_contents(DIR_CACHE.self::$subDir.'done',1);
					}
				}
			}
		}
		else{
			if(file_exists($done)){
				@unlink($done);
			}
		}
	}
	static function set($cacheKey = '', $value = '', $expire = 0, $subDir = '',$create = false){
		if(CACHE_ON){
			if($cacheKey!=''){
				self::$cacheKey=$cacheKey;
				self::$expire=$expire;
				self::$subDir=$subDir;
				self::setCache($value,$create);
			}
		}
		return true;
	}
	static function setCache ($value,$create = false){
		$cacheKey=self::$cacheKey;
		if(MEMCACHE_ON){
			memcacheLib::do_put($cacheKey,$value,self::$expire);
		}
		else{
			$expire = TIME_NOW+self::$expire;
			$cacheDir = DIR_CACHE.self::$subDir;
			$cacheFile = $cacheDir.$cacheKey;
			if($create){
				$value = stripslashes($value);
				if(self::CheckDir($cacheDir)){
					file_put_contents($cacheFile,$value); // store cache
					$arrFile = array($cacheKey=>$expire);
					$listValue = serialize($arrFile).'|';
					if(file_exists($cacheDir.self::$fileListCache)){
						file_put_contents($cacheDir.self::$fileListCache, $listValue, FILE_APPEND);
					}
					else{
						file_put_contents($cacheDir.self::$fileListCache,$listValue); // store cache
					}
				}
			}
			else{
				$cacheKey = md5($cacheKey);
				$createCache = false;
				if(file_exists($cacheFile)){
					$create_time = filemtime($cacheFile);
					if( self::$expire > 0 && TIME_NOW > $create_time + self::$expire ){
						$createCache = true;
					}
				}
				else{
					$createCache = true;
				}
				if($createCache){
					$value = @serialize($value);
					if(is_array(CGlobal::$my_server)){
						foreach (CGlobal::$my_server as $server){
							$link = "http://{$server}createCache.php";
							$val = array('cacheKey' => $cacheKey,
										 'value'	=> $value,
										 'expire'	=> $expire,
										 'subDir'	=> base64_encode(self::$subDir)
										 );
							require_once 'core/Curl.php';
							$curl = new CURL();
							$return = $curl->post($link,$val);
						}				
					}
				}
			}
		}
	}
	static function get($cacheKey = '',$expire = 0,$subDir = ''){
		$value = false;
		if(CACHE_ON && $cacheKey!=''){
			$hour = date('H',TIME_NOW);
			self::$subDir = $subDir;
			CacheLib::cronjobDel($subDir);
			if(MEMCACHE_ON){
				$value = memcacheLib::do_get($cacheKey);
			}
			else{
				$cacheKey=md5($cacheKey);
				$cacheFile = DIR_CACHE.self::$subDir.$cacheKey;
				self::$expire = $expire;
				if(file_exists($cacheFile)){
					$create_time = filemtime($cacheFile);
					if( self::$expire ==  0 || ( self::$expire > 0 && TIME_NOW < $create_time + self::$expire) ){
						$value = file_get_contents($cacheFile);
						
						if($value){
							$value = unserialize($value);
						}
						//var_dump($value);
					}
				}
			}
		}
		return $value;
	}
	static function removePer($cacheKey = '',$subDir = ''){
		if($cacheKey!=''){
			self::$subDir = $subDir;
  			if(MEMCACHE_ON){
				memcacheLib::do_remove($cacheKey);
  			}	
  			else{
				$cacheKey = md5($cacheKey);
				if(is_array(CGlobal::$my_server)){
					foreach (CGlobal::$my_server as $server){
						
						$link = "http://{$server}?trigger=1&cache_key={$cacheKey}";
						if(self::$subDir){
							$link .= '&subDir='.base64_encode(self::$subDir);
						}
						
						require_once ROOT_PATH.'core/Curl.php';
						$curl = new CURL();
						$return = $curl->get($link);
						//if(DEBUG){
						//	echo "Deleted cache file : {$cacheKey} => link: {$link}<br>";
						//}
					}				
				}
				
				//@unlink(DIR_CACHE.self::$subDir. $cacheKey);
				
  			}
  			return true;
  		}
		elseif(isset($_REQUEST['trigger']) && isset($_REQUEST['cache_key']) && $_REQUEST['trigger'] && $_REQUEST['cache_key']  ){
			$cacheKey = $_REQUEST['cache_key'];
			self::$subDir = (isset($_REQUEST['subDir'])) ? base64_decode($_REQUEST['subDir']) : '';
			@unlink(DIR_CACHE.self::$subDir. $cacheKey);
			
		}
		return false;
	}
	static function delete($cacheKey='', $subDir = ''){
  		if($cacheKey!=''){
			return CacheLib::removePer($cacheKey, $subDir);
  		}
		return false;
  	}
	function CheckDir($pDir){
		if (is_dir($pDir))
		return true;
		if (!@mkdir($pDir,0777,true)){
			return false;
		}
		self::chmod_dir($pDir,0777);
		return true;
	}
	static function chmod_dir($dir,$mod=0777){
		$parent_dir=dirname(str_replace(ROOT_PATH,'',$dir));
		if($parent_dir!='' && $parent_dir!='.'){
			//echo $parent_dir.'/<br />';
			@chmod($dir,$mod);
			self::chmod_dir($parent_dir,$mod);
		}
		return true;
	}
}
?>
