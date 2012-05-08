<?php

class WebScrap{
	private $url;
	private $xpath;
    private $page;

	public function WebScrap($url,$xpath){
		$this->url = $url;
		$this->xpath = $xpath;
        $this->page = "";
	}
    
    public function SetXpath($xpath){
        $this->xpath = $xpath;
    }

	public function GetScrap(){
        $aContent = array();
		// use Tidy to try to make the page well formed
        if (empty($this->page)){
            $this->page = $this->page = $this->TidyIt($this->url);
            $this->page = mb_convert_encoding($this->page, 'HTML-ENTITIES', "UTF-8"); 
        }
		// create a document out of the well formed content
		$domDocument=new DOMDocument('1.0');
		@$domDocument->loadHTML($this->page);

		// create an XPath object out of the document and query it for the supplied xpath
		$domXPath = new DOMXPath($domDocument);
        
        if (is_array($this->xpath)){
            foreach ($this->xpath as $title=>$xpath){
                $domNodeList = $domXPath->query($xpath);
        		// Get the content (HTML) out of the NodeList returned by the DOMXPath::query
        		$content = $this->GetHTMLFromNodeList($domNodeList);
                foreach ($content as $key=>$c){
                    $aContent[$key][$title] = $c;
                }
            }

            return $aContent;
        }else{
            $domNodeList = $domXPath->query($this->xpath);
        	return $this->GetHTMLFromNodeList($domNodeList);
        }
    }
    
    private function GetPageContent($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8"); 
        $output = curl_exec($ch); 
        curl_close($ch);
        
        return $output;
    }

	private function TidyIt($url){
		return $this->GetPageContent($url);
		/*$tidy = new tidy();
		$tidy->parseString($this->GetPageContent($url), array(), "utf8");
		$tidy->cleanRepair();
		return $tidy;*/
	}

	private function GetHTMLFromNodeList($domNodeList){        
        $aNode = array();
        for ($i=0; $i<$domNodeList->length; $i++){
            $node = $domNodeList->item($i);
            $domDocument = new DOMDocument();
            foreach($node->childNodes as $childNode)
                $domDocument->appendChild($domDocument->importNode($childNode, true));
                
            $aNode[] = trim($domDocument->saveHTML());
        }
        
        return $aNode;
    }
}

?>