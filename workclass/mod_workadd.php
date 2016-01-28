<?php
(!defined('IN_TOA') || !defined('IN_ADMIN')) && exit('Access Denied!');
get_key("workclass_add");
$typeid=$_GET['typeid'];
$tplid=$_GET['tplid'];
empty($do) && $do = 'list';
if ($do == 'list') {
	if($tplid==''){
		global $_CACHE;
		get_cache('workclass_type');
		include_once('template/tpllist.php');
	}else{
		//生成流水号
		$number=get_date('YmdHis',PHP_TIME);
		$filenumber=random(6,'0123456789').get_date('ymdHis',PHP_TIME);
		//获取模板
		$tpl = $db->fetch_one_array("SELECT * FROM ".DB_TABLEPRE."workclass_template  WHERE tplid = '".$tplid."'  ");
		$typeid=$tpl['typeid'];
		$tplid=$tpl['tplid'];
		//读取流程数据
		$flow = $db->fetch_one_array("SELECT * FROM ".DB_TABLEPRE."workclass_flow  WHERE tplid = '".$tplid."' and flownum>1");
		if($flow['fid']==''){
			show_msg('无审批流程信息，不可用！', 'admin.php?ac='.$ac.'&fileurl='.$fileurl.'');
		}
		if($tpl['tplkey']=='3'){
			include_once('tpl/'.$tplid.'_'.$tpl['tpladdr']);
		}else{
			include_once('template/workadd.php');
		}
	}

}elseif ($do == 'add') {
	//固定选项
	$number = check_str(getGP('number','P'));
	$numberview = check_str(getGP('numberview','P'));
	$title = check_str(getGP('title','P'));
	$uid = $_USER->id;
	$date=get_date('Y-m-d H:i:s',PHP_TIME);
	$type=0;
	//处理个别流程丢失的问题
	if($_POST['userkeyid']=='' || $_POST['userkeyid']=='0'){
		show_msg('审批人员数据不正确,请检查填写的数据是否完整或刷新浏览器重新提交！', 'admin.php?ac=workadd&fileurl=workclass&typeid='.$typeid.'&tplid='.$tplid);
	}
	//写入主表信息
	$workclass = array(
		'number' => $number,
		'typeid' => $typeid,
		'tplid' => $tplid,
		'title' => $title,
		'uid' => $uid,
		'date' => $date,
		'type' => $type,
		'numberview' => $numberview
	);
	insert_db('workclass',$workclass);
	$id=$db->insert_id();
	//更新附件
	$fileoffice = array(
		'officeid' => $id
	);
	update_db('fileoffice',$fileoffice, array('number' =>$_POST['filenumber']));
	//写入单项数据
	global $db;
	$query = $db->query("SELECT * FROM ".DB_TABLEPRE."workclass_from where tplid='".$tplid."' and typeid='".$typeid."' and formtype=1 and inputtype!='6' ORDER BY fromid Asc");
	while ($row = $db->fetch_array($query)) {
		if($row['inputtype1']=='4'){
			$inputvalues='';
			$inputvalue=getGP(''.$row["inputname"].'','P','array');
			foreach ($inputvalue as $arrsave) {
				$inputvalues.=$arrsave.',';
			}
			$inputvalue=substr($inputvalues, 0, -1);
		}else{
			$inputvalue=trim(getGP(''.$row["inputname"].'','P'));
		}
		$workclass_db = array(
				'inputname' => $row["inputname"],
				'content' => $inputvalue,
				'workid' => $id,
				'tplid' => $tplid,
				'fromid' => $row["fromid"],
				'typeid' => $typeid,
				'type' => 1
			);
		insert_db('workclass_db',$workclass_db);
	
	}
	//写入数组
	global $db;
	$query = $db->query("SELECT * FROM ".DB_TABLEPRE."workclass_from where tplid='".$tplid."' and typeid='".$typeid."' and formtype=1 and inputtype='6' ORDER BY fromid Asc");
	while ($row = $db->fetch_array($query)) {
			$inputvalue=getGP(''.$row["inputname"].'','P','array');
			$workclass_db = array(
			'inputname' => $row["inputname"],
			'content' => serialize($inputvalue),
			'workid' => $id,
			'tplid' => $tplid,
			'fromid' => $row["fromid"],
			'typeid' => $typeid,
			'type' => 1
		);
		insert_db('workclass_db',$workclass_db);
	}
	//处理流程
	$sql = "SELECT * FROM ".DB_TABLEPRE."workclass_flow  WHERE tplid = '".$tplid."' and flownum=1 and typeid= '".$typeid."' order by fid asc";
	$flow = $db->fetch_one_array($sql);
	$personnel1 = array(
		'name' => get_realname($_USER->id),
		'uid' =>$_USER->id,
		'designationdate' =>get_date('Y-m-d H:i:s',PHP_TIME),
		'approvaldate' =>get_date('Y-m-d H:i:s',PHP_TIME),
		'lnstructions' =>'生成流程申请单，系统自动完成该步骤',
		'pertype' =>1,
		'workid' => $id,
		'typeid' =>$typeid,
		'flowid' => $flow['fid'],
		'appkey' => 2,
		'appkey1' => 2,
		'flowdatetype' => 0,
		'flowdate' => get_date('Y-m-d H:i:s',PHP_TIME)
		);
	insert_db('workclass_personnel',$personnel1);
	//写入审批流程
	if(getGP('flowdatetype','P')==1){
		$flowdate=get_date('Y-m-d H:i:s',PHP_TIME+getGP('flowdate','P')*60);
	}
	$personnel2 = array(
		'name' => getGP('userkey','P'),
		'uid' =>getGP('userkeyid','P'),
		'designationdate' =>get_date('Y-m-d H:i:s',PHP_TIME),
		'pertype' =>0,
		'workid' => $id,
		'typeid' =>$typeid,
		'flowid' => getGP('flowid','P'),
		'appkey' => getGP('appkey','P'),
		'appkey1' => getGP('appkey1','P'),
		'flowdatetype' => getGP('flowdatetype','P'),
		'flowdate' => $flowdate
		);
	//echo var_dump($personnel2);
	//exit;
	insert_db('workclass_personnel',$personnel2);
	$pid=$db->insert_id();
	if(getGP('appkey','P')=='1'){
		$userkey=explode(',',getGP('userkey','P'));
		$userkeyid=explode(',',getGP('userkeyid','P'));
		for($i=0;$i<sizeof($userkeyid);$i++){
			$personnel_log = array(
				'name' => $userkey[$i],
				'uid' =>$userkeyid[$i],
				'pertype' =>0,
				'perid' =>$pid,
				'workid' =>$id,
				'typeid' =>$typeid
				);
			insert_db('workclass_personnel_log',$personnel_log);
		}
	}
	//提示
	if(getGP('sms_info_box_work','P')!=''){
		$content='您有一个新"'.$title.'"需要审批,请点击查看!<a href="admin.php?ac=list&fileurl=workclass&type=1">点击审批>></a>';
		//接收人；内容；类型（1：有返回回值;0：无返回值）;URL
		SMS_ADD_POST(getGP('userkey','P'),$content,0,0,$_USER->id);
	}
	//手机短信
	if(getGP('sms_phone_box_work','P')!=''){
		$content='您有一个新工作流编号为"'.$number.'"需要审批,请登录OA进行审批!';
		PHONE_ADD_POST(getGP('userkeyphone','P'),$content,getGP('userkey','P'),0,0,$_USER->id);
	}
	//通知其它人员
	if(getGP('viewuser','P')!=''){
		$content2='您接收到一条工作流程为"'.$title.'"的通知,请点击“<a href="admin.php?ac=list&do=view&fileurl=workclass&workid='.$id.'">查看</a>”!';
		SMS_ADD_POST(getGP('viewuser','P'),$content2,0,0,$_USER->id);
	}
	//手机短信
	if(getGP('sms_phone_box_work','P')!=''){
		$content2='您有一个工作流程需要审批,请登录OA进行审批!';
		PHONE_ADD_POST(getGP('viewuserphone','P'),$content2,getGP('viewuser','P'),0,0,$_USER->id);
	}
	//更新LOG
	$content=serialize($workclass);
	$title='新建工作流程';
	get_logadd($id,$content,$title,35,$_USER->id);
	show_msg($title.' 审批流程提交成功！', 'admin.php?ac=list&fileurl='.$fileurl);
}
?>