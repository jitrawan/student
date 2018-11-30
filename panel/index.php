<?php session_start();
error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
<title>Student - ระบบบริหารจัดการนักเรียน</title>
<meta charset="utf-8">
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="shortcut icon" href="../media/icons/nav/favicon.ico"/>
<link rel="stylesheet" href="../css/aqua/jquery-ui-1.10.4.custom.css">
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/ui/jquery.ui.core.js"></script>

</head>

<?php
//Require Zone
require("../core/config.core.php");
require("../core/connect.core.php");
require("../core/check_user.core.php");
require("../core/time.core.php");
require("../core/functions.core.php");
$getdata = new clear_db();
$connect = $getdata->my_sql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$getdata->my_sql_set_utf8();
$userinfo = $getdata->my_sql_query(NULL,"user","user_key='".$_SESSION['ukey']."'");
?>
<body>
    <div id="wrapper">
        <div id="header">
        <a href="?p=main"><img src="../media/logos/logo.png" width="178"  border="0"></a></div><!--<div id="search_top_bar">
          <form name="form1" method="get" action="">
            <input type="hidden" name="p" value="search"> 
    	<input name="search" type="text" id="search" autocomplete="off" size="50" placeholder="<?php echo @LA_LB_TYPEFORSEARCH_PATIENT;?>" x-webkit-speech class="txt_search" autofocus>
          </form>
        </div>--><a href="?p=settings_user_info"><div id="image_top_right"><?php echo $userinfo->name."&nbsp;&nbsp;&nbsp;&nbsp;".$userinfo->lastname;?><img src="../resource/users/thumbs/<?php echo $userinfo->photo;?>" height="50" ></div></a>
        <div id="contentliquid"><div id="content">
        <?php
			$page=addslashes(@$_GET['p']);
			$listdata=$getdata->my_sql_query(NULL,"list","cases='".$page."'");
			if($listdata != NULL){
				require($listdata->pages);
			}else{
				require("../modules/main/main.php");
			}
	
    	?>
       </div></div>
      <div id="leftcolumn">
      <?php
	  $cl = array("green","green","green","green","green","green","green","green");
	  $ic = array("1","1","1","1","1","1","1","1");
	  $menu = $getdata->my_sql_query("menu","list","cases='".@$_GET['p']."'");
	  switch($menu->menu){
		  case "main" 			: $cl = array("active","green","green","green","green","green","green","green");
		  			 			$ic = array("2","1","1","1","1","1","1","1");
		  break;
		  case "payaqua" 		: $cl = array("green","active","green","green","green","green","green","green");
		  			   			$ic = array("1","2","1","1","1","1","1","1");
		  break;
		  case "money" 	: $cl = array("green","green","active","green","green","green","green","green");
		  			   			$ic = array("1","1","2","1","1","1","1","1");
		  break;
		  case "members" 			: $cl = array("green","green","green","active","green","green","green","green");
		  			   			$ic = array("1","1","1","2","1","1","1","1");
		  break;
		  case "report" 		: $cl = array("green","green","green","green","active","green","green","green");
		  			   			$ic = array("1","1","1","1","2","1","1","1");
		  break;
		  case "settings" 			: $cl = array("green","green","green","green","green","active","green","green");
		  			   			$ic = array("1","1","1","1","1","2","1","1");
		  break;
		  case "logout" 		: $cl = array("green","green","green","green","green","green","active","green");
		  			   			$ic = array("1","1","1","1","1","1","2","1");
		  break;
		  case "subjects" 		: $cl = array("green","green","green","green","green","green","green","active");
		  			   			$ic = array("1","1","1","1","1","1","1","2");
		  break;
		 
	  }
	  ?>
      		<a href="?p=main"><div class="button_menu <?php echo @$cl[0];?>"><img src="../media/icons/nav/main_<?php echo @$ic[0];?>.png" width="20" height="20">หน้าหลัก<span id="xpatient_today"></span></div></a>
            <a href="?p=payaqua"><div class="button_menu <?php echo @$cl[1];?>"><img src="../media/icons/nav/payaqua_<?php echo @$ic[1];?>.png" width="20" height="20">ข้อมูลการเรียน</div></a>
       		<a href="?p=members"><div class="button_menu <?php echo @$cl[3];?>"><img src="../media/icons/nav/member_<?php echo @$ic[3];?>.png" width="20" height="20">ประวัตินักเรียน</div></a>
            <a href="?p=subjects"><div class="button_menu <?php echo @$cl[7];?>"><img src="../media/icons/nav/book_<?php echo @$ic[7];?>.png" width="20" height="20">วิชาที่เปิดสอน</div></a>
            <a href="?p=money"><div class="button_menu <?php echo @$cl[2];?>"><img src="../media/icons/nav/money_<?php echo @$ic[2];?>.png" width="20" height="20">การจ่ายเงิน</div></a>
            <a href="?p=report"><div class="button_menu <?php echo @$cl[4];?>"><img src="../media/icons/nav/report_<?php echo @$ic[4];?>.png" width="20" height="20">รายงาน</div></a>
            <a href="?p=settings"><div class="button_menu <?php echo @$cl[5];?> "><img src="../media/icons/nav/setting_<?php echo @$ic[5];?>.png" width="20" height="20">ตั้งค่า</div></a>
            <a href="javascript:window.location='../core/logout.core.php';"><div class="button_menu <?php echo @$cl[6];?>"><img src="../media/icons/nav/logout_<?php echo @$ic[6];?>.png" width="20" height="20">ออกจากระบบ</div></a>
        </div>
      <div id="contentliquid"></div>
    </div>
</body>
</html>
