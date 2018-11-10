<?php


//switch ($_GET['function'])
//{
//case 'randomstring':
randomstring();
break;

//}

function randomstring() 
{
//echo 'randomstring';
	header("Content-Type: text/html; charset=utf-8");
	mysql_connect("210.240.194.16","ADT105111S","ADT105111S");
	mysql_select_db("lottery");  //連結資料庫
	//mysql_query("set names utf-8");
	$sqldata = mysql_query("SELECT * FROM 資料表名稱");


	//抓資料
	$arr = array(); //建立arr陣列
	for($i=0;$i<mysql_num_rows($sqldata);$i++) //迴圈取資料
	{
		$rs=mysql_fetch_row($sqldata);//紀錄取出資料
		$arr[$i] = $rs[1];//將資料存進陣列
	
	}

	$r =rand(0, mysql_num_rows($sqldata)-1);//陣列亂數取值
	$t = $arr[$r];//取出資料
	$data = array();//建立data陣列
	$btns = array();//建立btns陣列
	array_push($btns, qrBtn1('TRY AGAIN', 'TEST')); //快速回應按鈕(限英數字)
	array_push($data, quickReply($t, $btns));//機器人輸出資料
	$json = json_encode($data);//轉換json格式
	echo $json;//輸出json格式
}

// JSON item

function qrBtn1($title, $blockname)
{
	$data = array
	(
		'title' => $title,
		'block_names' => array($blockname)
	);
	return $data;
}



// JSON item

function quickReply($t, $arrBtns)
{
	$data = array
	(
		'text' => $t,
		'quick_replies' => $arrBtns
	);
	return $data;
}

?>
