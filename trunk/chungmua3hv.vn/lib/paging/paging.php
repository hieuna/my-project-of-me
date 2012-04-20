<?php
	class paging{
		var $iRecordPerpage;
		var $iTotalRecord;
		var $iCurrentPage;
		var $sPagingPath;
		var $iNumberPageShow = 5;	
		
		
		function paging( $iRecordPerpage, $iTotalRecord, $iCurrentPage, $sPagingPath ){
			$this -> iRecordPerpage = $iRecordPerpage;
			$this -> iTotalRecord = $iTotalRecord;
			$this -> iCurrentPage = $iCurrentPage;
			$this -> sPagingPath = $sPagingPath;
		}
		
		function getStringPaging( $iType = 1)
		{
			//var $sPaging = "";
			
			
			if($this -> iTotalRecord <= 0){
				return $sPaging;
			}else{				
				$iNumberPage = ceil($this -> iTotalRecord / $this -> iRecordPerpage);
				if( $iNumberPage < 1){
					return  $sPaging;
				}else{
				
					if( $this -> iCurrentPage <= 0 ) $this -> iCurrentPage = 1;
					if ($this -> iCurrentPage > $iNumberPage ) $this -> iCurrentPage = $iNumberPage;
					
					if( $iType == 1){
						// get first, pre page
						if( $this -> iCurrentPage > $this -> iNumberPageShow){
							$sFirstPage = "<a href='". str_replace('{i}', 1, $this -> sPagingPath)."'>1</a>&nbsp;";
							$sFirstPage .= "<a href='". str_replace('{i}', 2, $this -> sPagingPath)."'>2</a>&nbsp;";
							$iTemp = $this -> iCurrentPage - $this -> iNumberPageShow - (($this -> iCurrentPage - 1) % $this -> iNumberPageShow);							
							$sFirstPage .= "<a href='". str_replace('{i}', $iTemp, $this -> sPagingPath)."'>...</a>&nbsp;";						
						}
						
						if( $this -> iCurrentPage > 1) 
							$sPrePage = "<a href='". str_replace('{i}', $this -> iCurrentPage -1 , $this -> sPagingPath)."'>Trang trước</a>";
						
						// get next, last page
						if( ceil($this -> iCurrentPage / $this -> iNumberPageShow) < ceil($iNumberPage/$this -> iNumberPageShow)){
							$iTemp = $this -> iCurrentPage + $this -> iNumberPageShow - (($this -> iCurrentPage - 1) % $this -> iNumberPageShow);
							$sLastPage = "<a href='". str_replace('{i}', $iTemp, $this -> sPagingPath)."'>...</a>&nbsp;";
							if( $iTemp < $iNumberPage-1)
								$sLastPage .= "<a href='". str_replace('{i}', $iNumberPage-1, $this -> sPagingPath)."'>".($iNumberPage -1)."</a>&nbsp;";						
							$sLastPage .= "<a href='". str_replace('{i}', $iNumberPage, $this -> sPagingPath)."'>{$iNumberPage}</a>&nbsp;";							
						}
						
						if( $this -> iCurrentPage < $iNumberPage )						
							$sNextPage .= "<a href='". str_replace('{i}', $this -> iCurrentPage + 1, $this -> sPagingPath)."'>Trang sau</a>";
						
						// get current page
						
						$iStart = $this -> iCurrentPage -(($this -> iCurrentPage - 1) % $this -> iNumberPageShow);
						for ( $i = $iStart; $i< $iStart + $this -> iNumberPageShow; $i ++){
							if( $i > $iNumberPage){ 							
								break;
							}
							elseif( $this -> iCurrentPage == $i){
								$sPaging .= "<span>{$i}</span>&nbsp;";
							}else{
								$sPaging .= "<a href ='". str_replace('{i}', $i, $this -> sPagingPath)."'>{$i}</a>&nbsp;";
							}
						}
						
						$sStringPaging =  $sPrePage .$sFirstPage ."&nbsp;". $sPaging.$sLastPage. $sNextPage;
					}else{
						// get pre page
						if( $this -> iCurrentPage > 1){							
							$sPrePage = "<a href='". str_replace('{i}', $this -> iCurrentPage -1 , $this -> sPagingPath)."'>&laquo;</a>&nbsp;<a href='". str_replace('{i}', $this -> iCurrentPage -1 , $this -> sPagingPath)."'>Trang trước</a>";											
						}
						
						// get next
						if( $this -> iCurrentPage < $iNumberPage){
							$sNextPage .= "<a href='". str_replace('{i}', $this -> iCurrentPage + 1, $this -> sPagingPath)."'>Trang sau</a>&nbsp;<a href='". str_replace('{i}', $this -> iCurrentPage + 1, $this -> sPagingPath)."'>&raquo;</a>";
						}
						
						$sPaging = "<label style=\"font-weight:normal\">Trang</label> <label id=\"p_current_page\">{$this->iCurrentPage}</label> <label style=\"font-weight:normal\">of</label> {$iNumberPage}";
						
						$sStringPaging =  $sPrePage ."&nbsp;&nbsp;". $sPaging."&nbsp;&nbsp;". $sNextPage;
					}
					
				}
			}
			
			return $sStringPaging;
		}		
		
	}
?>
