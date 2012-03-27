<?php

function chuyen_trang($link)

	{

		?>

			<script type="text/javascript">

				window.location="<?php echo $link?>";

			</script>

		<?php

	} 

$domain	= $_SERVER["HTTP_HOST"];

$domain	= str_replace("www.", "", $domain);

if($domain == 'mienphigiaohang.com') chuyen_trang("http://www.mienphigiaohang.com");

?>

<?

include'deals/ss.php';

//die($sesok);

if($sesok==1){

 header("location: deals/ha-noi");}

else if($sesok==2){

 header("location: deals/ho-chi-minh");}

 else {

	 header("location: deals/ha-noi");

	 }	

  ?>
  