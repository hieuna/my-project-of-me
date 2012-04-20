<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
{loadModule name=control task=css}
<body>
<div class="bgBody">
<div class="all">
    <!-- HEADER-->
    {loadModule name=header}
    <!-- CONTENT-->
    <div id="pageContent">
    	<div id="pageLeft">
            <!--Phan noi dung-->
            {loadModule name=info task=$smarty.get.task}
        </div>
<!--RIGHT-->        
       {loadModule name=control task=right}
    <!--ket thuc #pageContent-->
    </div>
    <!-- FOOTER-->
    {loadModule name=footer}
    <div class ="clr"></div>
</div>
</div>
</body>
</html>
