<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<link rel="stylesheet" type="text/css" href="template/default/content/css/style.css">
<script language="javascript" type="text/javascript" src="template/default/js/jquery.min.js"></script>
<script type="text/javascript"> 
filenumber_show()
function filenumber_show()
{
   jQuery.ajax({
      type: 'GET',
      url: 'admin.php?ac=file&fileurl=public&officeid=<?php echo $_GET['fileid']?>&officetype=2&'+new Date(),
      success: function(data){
		  if(data!=''){
			  $("#filenumber").html(data);
		  }else{
			  $("#filenumber").html('还没有附件!');
		  }
      }
   });
}
fileoffice_show()
function fileoffice_show()
{
   jQuery.ajax({
      type: 'GET',
      url: 'admin.php?ac=file&do=office&fileurl=public&officeid=<?php echo $_GET['fileid']?>&officetype=2&'+new Date(),
      success: function(data){
		  if(data!=''){
			  $("#filenumberoffice").html(data);
		  }else{
			  $("#filenumberoffice").html('还没有文档!');
		  }
      }
   });
}
</script>
<title>A办公系统</title>
 <style type="text/css"> 
#div1{
display:none;}
 </style>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
-->
</style>
</head>
<body class="bodycolor">
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="0" class="small">
  <tr>
    <td class="Big"><img src="template/default/content/images/notify_new.gif" align="absmiddle"><span class="big3"> <?php echo $row['title']?></span>&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="font-size:12px; float:right; margin-right:20px;">
	<a href="admin.php?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>&type=1" style="font-size:12px;"><< 返回审批列表</a>&nbsp;|&nbsp;<a href="#" onClick="window.open('admin.php?ac=<?php echo $ac?>&fileurl=<?php echo $fileurl?>&do=appflow&fileid=<?php echo $_GET['fileid']?>&apptype=<?php echo $apptype?>&test=<?php echo $filenumber?>', 'newwindow', 'height=550, width=500, top=6, right=0, toolbar=no, menubar=no, scrollbars=yes, resizable=no,location=no, status=no')">
      <font color="red">查看审批记录</font>
</a></span>
    </td>
  </tr>
</table>

<script Language="JavaScript"> 
function CheckForm()
{
   if(document.save.content.value=="")
   { alert("批示意见不能为空！");
     document.save.content.focus();
     return (false);
   }
   <?php if($wherestr){?>
   var chk=0;
   var chkObjs = document.getElementsByName("pkey");
   for(var i=0;i<chkObjs.length;i++){
	   if(chkObjs[i].checked){
		   chk = i;
		   break;
	   }
   }
   if(document.save.staff.value=="" && chk<1)
   { alert("下一步审批人员不能为空！");
     document.save.staff.focus();
     return (false);
   }
   <?php }?>
   return true;
}
var submitcount=0; 
function sendForm()
{	
if(CheckForm()){
	if(submitcount == 0){   
     submitcount++;  
	 document.save.submit();
     return true;   
		} else{   
    alert("正在操作，请不要重复提交，谢谢！");   
    return false; 
		}  	
}
}


function toggle(targetid){
     if (document.getElementById){
         target=document.getElementById(targetid);
		 target2=document.getElementById('div2');
         target.style.display="none";
		 target2.style.display="block";
     }
}
function toggle2(targetid){
     if (document.getElementById){
         target=document.getElementById(targetid);
		 target2=document.getElementById('div2');
		 target.style.display="block";
		 target2.style.display="none";
     }
}
function toggle3(targetid){
     if (document.getElementById){
         target=document.getElementById(targetid);
		 target2=document.getElementById('div2');
		 target1=document.getElementById('div1');
		 target1.style.display="none";
		 target2.style.display="none";
     }
}
</script>
<style type="text/css"> 
#div1{
display:none;}
</style>
	<form name="save" method="post" action="admin.php?ac=<?php echo $ac?>&do=personnel&fileurl=<?php echo $fileurl?>&apptype=<?php echo $apptype?>">
	<input type="hidden" name="view" value="edit" />
	<input type="hidden" name="fileid" value="<?php echo $row['id']?>" />
	<input type="hidden" name="oldappkey" value="<?php echo $per['appkey']?>" />
	<input type="hidden" name="oldappkey1" value="<?php echo $per['appkey1']?>" />
	<input type="hidden" name="perid" value="<?php echo $per['id']?>" />
	<input type="hidden" name="oldappflow" value="<?php echo $per['appflow']?>" />
<table class="TableBlock" border="0" width="90%" align="center">
	<tr>
      <td nowrap class="TableHeader" colspan="2"><b>&nbsp;审批操作</b></td>
    </tr>
	<?php
	if($type['appkey']==2){
	?>
    <tr>
      <td nowrap class="TableContent"> 批示意见：</td>
	  <td class="TableData">
	  <?php
		if(get_realname($_USER->id)==get_realname($row['userid'])){
			echo '<textarea name="content" cols="60" rows="3" id="content" disabled="disabled" readonly="readonly">  </textarea></td>';
	}else{
			echo '<textarea name="content" cols="60" rows="3" id="content"></textarea></td>';
	}
	  ?>
    </tr>
	
	   <tr>
      <td nowrap class="TableContent"> 附言：</td>
	  <td class="TableData">
	  <textarea name="postscript" cols="60" rows="3" id="postscript"></textarea>			</td>
    </tr>
	<tr>
      <td nowrap class="TableContent"> 操作类型：</td>
      <td class="TableData">
	  <input name="pkey" type="radio" style="border:0;" value="1" checked="checked" />
	  通过
	 <!-- <input name="pkey" type="radio" style="border:0;" value="2" />拒绝 -->
	  <input name="pkey" type="radio" style="border:0;" value="5" />结束流程

	  </td>
    </tr>
	<?php if($wherestr){?>
	<tr>
      <td nowrap class="TableContent"> 节点动作设定：</td>
      <td class="TableData">
	  <?php
	//登陆用户与发起人相同时直接返回发起人，则否可以选择动作节点
		  $nodeid=explode(',',$nodeid);
		  $nodename=explode(',',$nodename);
		  for($i=0;$i<sizeof($nodeid);$i++){
			 echo '<input name="node" type="radio" value="'.$nodeid[$i].'" ';
			 if(trim($i)==1){
			    echo ' checked="checked" ';
			 }
			 echo ' style="border:0;" />'.$nodename[$i];
		  }
		//  	  	echo '<input name="node" type="radio" value="2"  style="border:0;" checked="checked"  />返回发起人</input>';
	  ?>
	  </td>
    </tr>
	<?php if($per['node']==6){?>
	<input type="hidden" name="disnode" value="1" />
	<tr>
      <td nowrap class="TableContent"> 指定阅读人员：</td>
      <td class="TableData">
	 <?php get_pubuser(2,"distribution","0","+选择阅读人员",40,4);?>
	  <br>
	  注：为空表示所有人员可阅读
	  </td>
    </tr>
	<?php }?>
	<tr>
      <td nowrap class="TableContent"> 执行人员：</td>
      <td class="TableData">
	  <?php 
		 //如果登陆名和发起人相同，则显示选择名单
	  if(get_realname($_USER->id)==get_realname($row['userid'])){
		  get_pubuser(2,"staff",$flow['flowuser'],"+选择审批人员",40,4);
	  }else{
		   //这里设置下一步审批人员，默认为发起人
		  get_pubuser(2,"staff",get_realname($row['userid']),'+选择审批人员',40,4);
	  }
	  ?>
	  <br>
	 <?php get_smsbox("审批人员","work")?>
	  </td>
    </tr>
	<?php
	   }
	}else{
		echo '<tr>';
		echo '<td nowrap class="TableContent" width="15%"> 批示意见：</td>';
		echo '<td class="TableData"><textarea name="content" cols="60" rows="3">';
		echo $per['flownote'].'</textarea></td></tr>';
		echo '<tr><td nowrap class="TableContent"> 操作类型：</td><td class="TableData">';
		echo '<input name="pkey" type="radio" style="border:0;" value="1" checked onClick=toggle("div1") />通过';
		echo '<input name="pkey" type="radio" style="border:0;" value="2" onClick=toggle3("div1") />拒绝';
		echo '<input name="pkey" type="radio" style="border:0;" value="5" onClick=toggle3("div1") />结束流程';
		if($per['flownum']>2){
			echo '<input name="pkey" type="radio" style="border:0;" value="3" onClick=toggle2("div1") />退回';
		}
		//退回
		if($per['flownum']>2){
			echo '<tbody id="div1">';
			echo '<tr><td nowrap class="TableHeader" width="15%"> 选择退回流程步骤：</td>';
			echo '<td class="TableData">';
			//设定下一步审批信息
			$sqlu = "SELECT * FROM ".DB_TABLEPRE."app_flow WHERE apptype = '".$apptype."' and flownum>1 and flownum<".$per['flownum']." order by fid asc";
			$results = $db->query($sqlu);
			while ($upfid = $db->fetch_array($results)) {	
				echo '<input name="updatefid" type="radio" style="border:0;" value="'.$upfid['fid'].'" checked/>'.$upfid['flowname'];
			}
			echo '</td></tr></tbody>';
		}
		echo '<tbody id="div2">';
		if($per['flowmovement']==6){
			echo '<input type="hidden" name="disnode" value="1" />';
			echo '<tr>';
			echo '<td nowrap class="TableContent" width="15%"> 指定阅读人员：</td>';
			echo '<td class="TableData">';
			get_pubuser(2,"distribution","0","+选择阅读人员",40,4);
			echo '<br>';
			echo '注：为空表示所有人员可阅读';
			echo '</td></tr>';
		}
		if($wherestr){
			echo '<tr><td nowrap class="TableHeader" width="15%"> 下一步审批流程：</td>';
			echo '<td class="TableData">';
			//设定下一步审批信息
			echo '<input type="hidden" name="appflow" value="'.$flow['fid'].'" />';
			echo '<input type="hidden" name="appkey" value="'.$flow['flowkey1'].'" />';
			echo '<input type="hidden" name="appkey1" value="'.$flow['flowkey2'].'" />';
			if($flow['flowkey1']=='2'){
			  //单人审批
				  if($flow['flowflag']=='1'){//可选
					  get_pubuser(1,"staff",'',"+选择审批人员",120,20);
				  }else{//不可选
				  
					  get_pubuser(1,"staff",'',"+选择审批人员",120,20,$flow['flowuser']);
				  }
			  }else{
			  //多人审批
				  if($flow['flowflag']=='1'){//可选
					  get_pubuser(2,"staff",$flow['flowuser'],"+选择审批人员",40,4);
				  }else{
					  //不可选
					  echo "<textarea name='staff' cols='40' rows='4'";
					  echo " readonly style='background-color:#F5F5F5;color:#006600;'>";
					  echo $flow['flowuser']."</textarea>";
					  echo "<input type='hidden' name='staffid' value='".get_realid($flow['flowuser'])."' />";
				  }
			  }
			  echo '<br>'.get_smsbox("审批人员","work").'</td></tr>';
		  }
		echo '</tbody>';
	
	}
	?>
	
	<tr align="center" class="TableControl">
      <td colspan="2" nowrap height="35">
<input type="button" name="Submit" value="提交审批" class="BigButtonBHover" onclick="sendForm();"> 	  </td>
    </tr>
</table>

<table class="TableBlock" border="0" width="90%" align="center" style="margin-top:20px;">
	<tr>
      <td nowrap class="TableHeader" colspan="2" id="m2"><b>&nbsp;附件设置</b></td>
    </tr>  
	<tr>
      <td nowrap class="TableContent" width="15%">附件文档：</td>
      <td class="TableData" id="filenumber">
	  
	  </td>
    </tr>
	
  
  <?php if($_CONFIG->config_data('configoffice')=='1'){?>
  
	 <tr>
      <td nowrap class="TableHeader" colspan="2"><b>&nbsp;正文设置</b></td>
    </tr>  
	<tr>
      <td nowrap class="TableContent" width="15%">文档：</td>
      <td class="TableData" id="filenumberoffice">
	 </td>
    </tr>
	<input type="hidden" name="fileofficeid" class="BigInput"  onpropertychange="fileoffice_show();" />
	 <? }?>
	</table>
<table border="0" width="90%" align="center" style="margin-top:20px;">
	<tr>
      <td width="90%" align="right" style="font-size:14px; font-weight:900;">发文日期：<?php echo $row['receiptdate']?></td>
    </tr>
	</table>
<table class="TableBlock" border="0" width="90%" align="center" style="margin-top:10px;">
	<tr>
      <td nowrap class="TableHeader" colspan="2"><b>&nbsp;发文内容处理</b></td>
    </tr>
	
	<tr>
      <td colspan="2" style="padding-left:30px; background:#ffffff;padding-right:30px;padding-top:10px;padding-bottom:10px;"> 

<TABLE width="735" HEIGHT=60 BORDER=0 ALIGN=center class="STYLE1">
	<TR>
		<TD align="center" height=60 STYLE="font-size:24px; font-weight:bold;"><span class="STYLE1">四川省扶贫和移民工作局发文稿笺</span>
	</TABLE>
      <table width="781" border="2" align="center" cellspacing="0" bordercolor="#FF0000"  STYLE="font-size:14px; bordercolor="#FF0000">
        <tr>
          <td height="49" bordercolor="#FF0000" bgcolor="#FFFFFF">紧急程度</td>
          <td height="49" bordercolor="#FF0000" bgcolor="#FFFFFF"><?php echo $row['jjcd']?></td>
          <td height="49" bordercolor="#FF0000" bgcolor="#FFFFFF">密级</td>
          <td height="49" bordercolor="#FF0000" bgcolor="#FFFFFF"><?php echo $row['secrecy']?></td>
          <td height="49" bordercolor="#FF0000" bgcolor="#FFFFFF">发文字号</td>
          <td height="49" bordercolor="#000000" bgcolor="#FFFFFF"><?php echo $row['fontsize']?></td>
        </tr>
        <tr>
          <td colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF"><table width="831" border="1" cellspacing="0" bordercolor="#FF0000">
              <tr>
                  <td width="253" rowspan="2" valign="top" bordercolor="#FF0000">
				  <TABLE BORDER=0 WIDTH=100% CELLSPACING=0 CELLPADDING=3>
				<TR>
					<TD HEIGHT=20 CLASS=titleFont>领导签发：</TD>
				</TR>
				<TR>
					<TD HEIGHT=100 VALIGN=TOP>
					

					<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			   global $db;
			 $query=$db->query("SELECT * from ".DB_TABLEPRE."personnel WHERE fileid = '".$_GET['fileid']."' and type=2 and pkey!=0  order by id desc");
		 	while ($rowper = $db->fetch_array($query)) {

			 if($rowper['appkey']=='1'){ // 多人通过
				 app_view_zg($rowper['id']);
				 }else{					//单人通过
					 if($rowper['name']=='张谷'){
					echo "<TD WIDTH=100>".$rowper['lnstructions']."</td>";	
					echo "<TD WIDTH=45>".$rowper['name']."</TD>";
					echo "<TD>".$rowper['approvaldate']."</TD>";
					 }
				 	 }
					 }  
			?>
			  </TABLE>
					
					</TD>
				</TR>
			</TABLE>
				  </td>
                  <td width="255" rowspan="2" valign="top">
				  <TABLE BORDER=0 WIDTH=100% CELLSPACING=0 CELLPADDING=3>
				<TR>
					<TD HEIGHT=20 CLASS=titleFont>领导审签</TD>
				</TR>
				<TR>
					<TD HEIGHT=100 CLASS=ItemTitleFontBlack>
					<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			   global $db;
			  	 $query = $db->query("SELECT a.*,b.positionid FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."user b WHERE a.fileid = '".$_GET['fileid']."' and a.type=2 and a.pkey!=0  and a.name=b.username and b.positionid=16 order by a.id desc");
			 while ($rowper = $db->fetch_array($query)) {
				   if($rowper['lnstructions']!=''){
			 ?>
		   <TR HEIGHT=25>
				<TD><?php echo $rowper['lnstructions']?></TD>
				<TD WIDTH=80><?php echo $rowper['name']?></TD>
				<TD WIDTH=80><?php echo $rowper['approvaldate']?></TD>
			</TR>
		<?php 
				}
			}
			//如果是多人审核
				$query = $db->query("SELECT a.*,b.*,c.positionid FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."personnel_log b,".DB_TABLEPRE."user c WHERE a.fileid = '".$_GET['fileid']."' and a.appkey=1 and  a.id=b.perid and b.name=c.username and c.positionid=16 and a.type=2 order by a.id desc");
			 while ($rowper = $db->fetch_array($query)) {
				   if($rowper['lnstructions']!=''){
				   echo " <TR HEIGHT=25>
				<TD>{$rowper['lnstructions']}</TD>
				<TD WIDTH=80>{$rowper['name']}</TD>
				<TD WIDTH=80>{$rowper['approvaldate']}</TD>
			</TR>" ;
				   }
			 }

		?>
			  </TABLE>
					
					
					</TD>
				</TR>
			</TABLE>
				  </td>
                  <td width="309" valign="top"><TABLE BORDER=0 WIDTH=100% CELLSPACING=0 CELLPADDING=3>
				<TR>
					<TD HEIGHT=20 CLASS=titleFont>局处室委负责人核稿</TD>
				</TR>
				<TR>
					<TD HEIGHT=100 CLASS=ItemTitleFontBlack>
					<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			if($type['appkey']==1){
				global $db;
				$query = $db->query("SELECT a.*,b.flownum,b.flowkey1,b.flowkey,b.flowkey2,b.flownote FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."app_flow b  WHERE a.appflow=b.fid and a.fileid = '".$_GET['fileid']."' and a.type=2 and a.pkey!=0  and b.flowmovement=2 order by a.id desc");
				while ($rowper = $db->fetch_array($query)) {
					if($rowper['lnstructions']!=''){
						if($rowper['appkey']==1){
							app_view_per($rowper['id']);
						}else{
				?>
						
							<TR HEIGHT=25>
								<TD><?php echo $rowper['lnstructions']?></TD>
								<TD WIDTH=60><?php echo $rowper['name']?></TD>
								<TD WIDTH=100><?php echo $rowper['approvaldate']?></TD>
							</TR>
				<?php
					   }
				   }
			   }
		   }else{
			   global $db;
			   $query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel WHERE fileid = '".$_GET['fileid']."' and type=2 and pkey!=0  and node=2 order by id desc");
			   while ($rowper = $db->fetch_array($query)) {
			   if($rowper['lnstructions']!='' and get_pos(get_userid($rowper['name']))>1){
				   if($rowper['appkey']==1){
					   app_view_per($rowper['id']);
				   }else{
		   ?>
		   <TR HEIGHT=25>
				<TD><?php echo $rowper['lnstructions']?></TD>
				<TD WIDTH=60><?php echo $rowper['name']?></TD>
				<TD WIDTH=100><?php echo $rowper['approvaldate']?></TD>
			</TR>
		<?php 
				}
			}
			}
		}?>
			  </TABLE>
					
					
					</TD>
				</TR>
			</TABLE>
				  </td>
              </tr>
              <tr>
                  <td height="97" valign="top">
					<TABLE BORDER=0 WIDTH=104% CELLSPACING=0 CELLPADDING=3>
				<TR>
					<TD HEIGHT=20 CLASS=titleFont>局办公室核稿</TD>
				</TR>
				<TR>
					<TD HEIGHT=100 CLASS=ItemTitleFontBlack VALIGN=TOP>
					<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			if($type['appkey']==1){
				global $db;
				$query = $db->query("SELECT a.*,b.flownum,b.flowkey1,b.flowkey,b.flowkey2,b.flownote FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."app_flow b  WHERE a.appflow=b.fid and a.fileid = '".$_GET['fileid']."' and a.type=2 and a.pkey!=0  and b.flowmovement=1 order by a.id desc");
				while ($rowper = $db->fetch_array($query)) {
				if($rowper['lnstructions']!=''){
					if($rowper['appkey']==1){
						app_view_per($rowper['id']);
					}else{
			?>
					
						<TR HEIGHT=25>
							<TD><?php echo $rowper['lnstructions']?></TD>
							<TD WIDTH=60><?php echo $rowper['name']?></TD>
							<TD WIDTH=100><?php echo $rowper['approvaldate']?></TD>
						</TR>
			<?php
				   }
			   }
			   }
		   }else{
			   global $db;
			   $query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel WHERE fileid = '".$_GET['fileid']."' and type=2 and pkey!=0  and node=1 order by id desc");
			   while ($rowper = $db->fetch_array($query)) {
			   if($rowper['lnstructions']!=''){
				   if($rowper['appkey']==1){
					   app_view_per($rowper['id']);
				   }else{
		   ?>
		   <TR HEIGHT=25>
				<TD><?php echo $rowper['lnstructions']?></TD>
				<TD WIDTH=60><?php echo $rowper['name']?></TD>
				<TD WIDTH=100><?php echo $rowper['approvaldate']?></TD>
			</TR>
		<?php 
				}
			}
			}
		}?>
			  </TABLE>
					
					
					</TD>
				</TR>
			</TABLE>
				  </td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="89" colspan="6" bordercolor="#000000" bgcolor="#FFFFFF"><table width="802" border="0" cellspacing="0">
            <tr>
              <td width="67" height="85">会签：</td>
              <td width="731">	<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
				$query = $db->query("SELECT a.*,b.*,c.positionid FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."personnel_log b,".DB_TABLEPRE."user c WHERE a.fileid = '".$_GET['fileid']."' and a.appkey=1 and  a.id=b.perid and b.name=c.username and (c.positionid=2 or c.positionid=5 or c.positionid=9 or c.positionid=10) and a.type=2 order by a.id desc");
			 while ($rowper = $db->fetch_array($query)) {
				   if($rowper['lnstructions']!=''){
				   echo " <TR HEIGHT=25>
				<TD>{$rowper['lnstructions']}</TD>
				<TD WIDTH=80>{$rowper['name']}</TD>
				<TD WIDTH=80>{$rowper['approvaldate']}</TD>
			</TR>" ;
				   }
			 }
			?>
			  </TABLE></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td width="76" height="61" bordercolor="#FF0000" bgcolor="#FFFFFF">拟稿单位</td>
          <td width="205" bordercolor="#FF0000" bgcolor="#FFFFFF"><?php echo $row['sponsor']?></td>
          <td width="51" bordercolor="#FF0000" bgcolor="#FFFFFF">拟稿人</td>
          <td width="89" bordercolor="#FF0000" bgcolor="#FFFFFF"><?php echo get_realname($row['userid'])?></td>
          <td width="112" bordercolor="#FF0000" bgcolor="#FFFFFF">份数</td>
          <td width="273" bordercolor="#FF0000" bgcolor="#FFFFFF"><?php echo $row['gwnum']?></td>
        </tr>
        <tr align="center">
          <td height="57" colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF"><table width="826" border="0" cellspacing="0">
              <tr>
                  <td width="117" height="65">是否党政网发布:</td>
                  <td width="218"><?php echo $row['fb']?></td>
                  <td width="145">本部门网站公开意见:</td>
                  <td width="269"><?php echo $row['gkyj']?></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF">文件标题：<?php echo $row['title']?></td>
        </tr>
        <tr>
          <td height="65" colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF">主送机关：
            <?php echo $row['delivers']?></td>
        </tr>
        <tr>
          <td height="57" colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF">抄送机关：
            <?php echo $row['sending']?></td>
        </tr>
        <tr>
          <td height="57" colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF"> 主 题 词： <?php echo $row['keyword']?></td>
        </tr>
        <tr>
          <td height="40" colspan="6" bordercolor="#FF0000" bgcolor="#FFFFFF"><table width="752" border="0" cellspacing="0">
              <tr>
                  <td width="156" height="63">主办处室委校核人:</td>
                  <td width="160"><?php echo $row['proofread']?></td>
                  <td width="57">缮印人:</td>
                  <td width="131"><?php echo $row['repairs']?></td>
                  <td width="61">用印人:</td>
                  <td width="175"><?php echo $row['sealing']?></td>
              </tr>
          </table></td>
        </tr>
      </table></td>
	</tr>
  </table>
</form>

</body>
</html>
