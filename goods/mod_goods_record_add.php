<?php
(!defined('IN_TOA') || !defined('IN_ADMIN')) && exit('Access Denied!');

get_key("office_goods_record");
function get_reallists($fid=0)
{
    global $db;
	$html='';
	$query = $db->query("SELECT title FROM ".DB_TABLEPRE."goods_type where id='".$fid."'   ORDER BY id desc limit 0,1");
	while ($rowuser = $db->fetch_array($query)) {
	$html .= $rowuser[title];
	}
	return $html;
}
empty($do) && $do = 'list';
if ($do == 'list') {
	$id = getGP('id','G','int');
	$blog = $db->fetch_one_array("SELECT * FROM ".DB_TABLEPRE."office_goods  WHERE id = '$id'  ");
	include_once('template/goods_record_add.php');

} elseif ($do == 'save') {
	$savetype = getGP('savetype','P');
	$id = getGP('id','P','int');
	$goods_type = getGP('goods_type','P');
	$title=getGP('title','P');
	$specification=getGP('specification','P');
	$unit=getGP('unit','P');
	$price=getGP('price','P');
	$number=getGP('number','P');
	$content=getGP('content','P');
	$recorduser=getGP('recorduser','P');
	$department=getGP('department','P');
	$recordnum=getGP('recordnum','P');
	$office_goods_record = array(
		'goods_type' => $goods_type,
		'title' => $title,
		'specification' => $specification,
		'unit' => $unit,
		'price' => $price,
		'number' => $number,
		'content' => $content,
		'recorduser' => $recorduser,
		'department' => $department,
		'type' => 1,
		'officegoods' => $id,
		'recordnum' => $recordnum,
		'date' => get_date('Y-m-d H:i:s',PHP_TIME),
		'uid' => $_USER->id
	);
	insert_db('office_goods_record',$office_goods_record);
    goto_page('admin.php?ac=goods_record_view&fileurl=goods&mykey=1');

}

//读取部门
function GET_FILE_PUBLIC_LIST($fatherid=0,$selid=0,$layer=0)
{


	$str=""; 
    global $db;
	$query = $db->query("SELECT * FROM ".DB_TABLEPRE."goods_type where father='$fatherid'   ORDER BY id Asc  ");
	
	if(count($query)>0){
	   for($i=0;$i<$layer;$i++){
	   
	   $str.="├";
	   
	   }
	while ($row = $db->fetch_array($query)) {
	$selstr = $row['id'] == $selid ? 'selected="selected"' : '';
	
	$htmlstr= '<option value="'.$row['id'].'"  '.$selstr.'>'.$str.$row['title'].'</option>';
	
	echo $htmlstr;

	GET_FILE_PUBLIC_LIST($row['id'],$selid,$layer+1,$type);
	
	}

	}
	
   return ;

}

?>