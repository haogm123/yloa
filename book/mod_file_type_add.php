<?php
(!defined('IN_TOA') || !defined('IN_ADMIN')) && exit('Access Denied!');
empty($do) && $do = 'list';

if ($do == 'list') {
	include_once('template/file_type_add.php');

} elseif ($do == 'save') {
	$savetype = getGP('savetype','P');
	$title = getGP('title','P');
	$father=getGP('father','P');
	$keyuser=getGP('keyuser','P');
	$book_type = array(
		'title' => $title,
		'father' => $father,
		'keyuser' => $keyuser,
		'date' => get_date('Y-m-d',PHP_TIME),
		'uid' => $_USER->id
	);
	insert_db('book_type',$book_type);
	$id=$db->insert_id();
	$content=serialize($book_type);
	$title='新增图书类别';
	get_logadd($id,$content,$title,22,$_USER->id);
	show_msg('您要处理的信息操作成功！', 'admin.php?ac=file_type&fileurl='.$fileurl.'');

}

//读取部门
function GET_FILE_PUBLIC_LIST($fatherid=0,$selid=0,$layer=0)
{


	$str=""; 
    global $db;
	$query = $db->query("SELECT * FROM ".DB_TABLEPRE."book_type where father='$fatherid'  ORDER BY id Asc  ");
	
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