<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
<script language="javascript" type="text/javascript" src="template/default/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="template/default/content/js/common.js"></script>
<title> OA办公系统</title>
</head>
<body class="bodycolor">
<table width="95%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big" style="font-size:12px;"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3">流程办理进度</span>
    </td>
  </tr>
</table>
<?php 
if($type['appkey']==1){
?>
<table class="TableBlock" border="0" width="95%" align="center" style="margin-bottom:20px;">
<?php
$i=0;
foreach ($result as $row) {
$sql = "SELECT * FROM ".DB_TABLEPRE."app_flow  WHERE fid = '".$row['appflow']."'";
$flow = $db->fetch_one_array($sql);
$i++;
?>
	<tr>
      <td nowrap class="TableHeader" width="130">
	  第<b style="font-size:16px;"><?php echo $i?></b>步:<?php echo $flow['flowname']?></td>
      <td class="TableContent"><b>审批人员：</b><?php echo $row['name']?>
	  <?php
	  if($row['pkey']==0){
		  echo '<font color=red>[等待审批中]</font>';
	  }
	  ?>
	  </td>
    </tr>
	<?php if($flow['flownum']==1){?>
	<tr>
      <td nowrap class="TableContent" align="right" width="130">
	  <span style="font-size:16px;"><?php echo $row['name']?></span></td>
      <td class="TableData">
	  <b>日期：</b><?php echo $row['approvaldate']?><br>
	  <b>状态：</b><?php echo app_pkey($row['pkey'])?><br>
	  <b>批示：</b><?php echo $row['lnstructions']?><br>
	  <b>附言：</b><?php echo $row['oapostscript']?><br></td>
    </tr>
	<?php }?>
	<?php
	if($row['pkey']!=0){
		if($row['appkey']==2){?>
	<tr>
      <td nowrap class="TableContent" align="right" width="130">
	  <span style="font-size:16px;"><?php echo $row['name']?></span></td>
      <td class="TableData">
	  <b>日期：</b><?php echo $row['approvaldate']?><br>
	  <b>状态：</b><?php echo app_pkey($row['pkey'])?><br>
	  <b>批示：</b><?php echo $row['lnstructions']?><br>
	  <b>附言：</b><?php echo $row['oapostscript']?><br></td>
    </tr>
	<?php }else{
		$query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel_log where perid='".$row['id']."' ORDER BY lid Asc");
		while ($log = $db->fetch_array($query)) {
	?>
	<tr>
      <td nowrap class="TableContent" align="right" width="130">
	  <span style="font-size:16px;"><?php echo $log['name']?></span></td>
      <td class="TableData">
	  <b>日期：</b><?php echo $log['approvaldate']?><br>
	  <b>状态：</b><?php echo app_pkey_log($log['pkey'])?><br>
	  <b>批示：</b><?php echo $log['lnstructions']?><br>
	  <b>附言：</b><?php echo $log['oapostscript']?><br></td>
    </tr>
	<?php 
			}
		}
	}?>
	
<?}?>	
  </table>
<?php }else{?>
<table class="TableBlock" border="0" width="95%" align="center" style="margin-bottom:20px;">
<?php
$i=0;
foreach ($result as $row) {
//$sql = "SELECT * FROM ".DB_TABLEPRE."app_flow  WHERE fid = '".$row['appflow']."'";
//$flow = $db->fetch_one_array($sql);
$i++;
?>
	<tr>
      <td nowrap class="TableHeader" width="130">
	  第<b style="font-size:16px;"><?php echo $i?></b>步:<?php echo app_movement_1(trim($row['node']))?></td>
      <td class="TableContent"><b>审批人员：</b><?php echo $row['name']?>
	  <?php
	  if($row['pkey']==0){
		  echo '<font color=red>[等待审批中]</font>';
	  }
	  ?>
	  </td>
    </tr>
	
	<?php 
	if($row['pkey']!=0){
		if($row['appkey']=='2'){?>
		<tr>
		  <td nowrap class="TableContent" align="right" width="130">
		  <span style="font-size:16px;"><?php echo $row['name']?></span></td>
		  <td class="TableData">
		  <b>日期：</b><?php echo $row['approvaldate']?><br>
		  <b>状态：</b><?php echo app_pkey($row['pkey'])?><br>
		  <b>批示：</b><?php echo $row['lnstructions']?><br>
		  <b>附言：</b><?php echo $row['oapostscript']?><br></td>
		</tr>
		<?php
		}else{
			$query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel_log where perid='".$row['id']."' ORDER BY lid Asc");
			while ($log = $db->fetch_array($query)) {
		?>
		<tr>
		  <td nowrap class="TableContent" align="right" width="130">
		  <span style="font-size:16px;"><?php echo $log['name']?></span></td>
		  <td class="TableData">
		  <b>日期：</b><?php echo $log['approvaldate']?><br>
		  <b>状态：</b><?php echo app_pkey_log($log['pkey'])?><br>
		  <b>批示：</b><?php echo $log['lnstructions']?><br>
		  <b>附言：</b><?php echo $log['oapostscript']?><br></td>
		</tr>
		<?php 
			}
		}
	}
}?>
		
  </table>
<?php }?>
</body>
</html>
