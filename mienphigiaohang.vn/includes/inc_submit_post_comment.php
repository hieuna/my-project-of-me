<?php
 $pro_id = getValue("id","int","GET",0);
	if(isset($_POST['commit_coment']))
	{
		if(isset($_SESSION['loged'])){ 

		//die($_POST['box_comment_txt']);
		$comment =$_POST["box_comment_txt"];
		if($comment == " " || $comment =="Viết bình luận cho sản phẩm này")
		{
			echo "<script type='text/javascript'>alert('Hãy nhập nội dung comment.');</script>";
			if($city == 1){
				chuyen_trang("../deals/ha-noi-binh-luan-san-pham-".$pro_id.".html#comment_show");
				} 
			else if($city == 2){
				chuyen_trang("../deals/ho-chi-minh-binh-luan-san-pham-".$pro_id.".html#comment_show");
				}
			
			}
		else{
		$datep = time();
		$user_id = $_SESSION['ses_userid'];
				
		$db_insert	       = new db_execute_return();
		$last_id		   = $db_insert->db_execute("
													INSERT INTO `comment_nulti` 
													(
														`pro_id` ,
														`user_id` ,
														`com_text` ,
														`com_date` ,													
														`com_active`
													)
													VALUES
													(
														'$pro_id' , 
														'$user_id', 
														'$_POST[box_comment_txt]',														
														'$datep', 														 
														'1'
													);
												  "); 
		unset($db_insert);						
	if($city == 1){
				chuyen_trang("../deals/ha-noi-binh-luan-san-pham-".$pro_id.".html#comment_show");
				} 
			else if($city == 2){
				chuyen_trang("../deals/ho-chi-minh-binh-luan-san-pham-".$pro_id.".html#comment_show");
				}	
	}
	}
	else{
	chuyen_trang("../deals/dang-nhap");
	}
}

?>