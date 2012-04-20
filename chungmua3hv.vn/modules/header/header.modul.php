<?php 

class header extends VS_Module_Base

{

	function __construct()

	{

			@eval(getGlobalVars()); 

			parent::__construct($oDb,$oSmarty);

	}

	function run($task)

	{				

			

			switch ($task)

			{				

				default:

					$this->view();		

					break;

				

			}

	 }

	 

		function view(){

			

			$destination = $this->getAll("select * from tblgroup where Group_Type='destination' order by Group_Order asc");

			$category = $this->getAll("select * from tblgroup where Group_Type='deal' and Group_Status='1'  order by Group_Order asc");

			$this->assign("destination",$destination);

			$this->assign("category",$category);

			if($_GET["CID"] || $_SESSION["ppcity"]){

				$city= $this->getRow("select * from tblgroup where Group_Mark='".$_GET["CID"]."' or  Group_Mark='". $_SESSION["ppcity"]."'");

				$this->assign("city",$city);

			}

			if($_GET["DID"]){

				$category= $this->getRow("select * from tblgroup where Group_Mark='".$_GET["DID"]."'");

				$this->assign("cate",$category);

			}

			$this->display('header.tpl');

		}

}

?>