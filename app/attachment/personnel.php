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
      url: 'admin.php?ac=file&fileurl=public&officeid=<?php echo $_GET['fileid']?>&officetype=1&'+new Date(),
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
      url: 'admin.php?ac=file&do=office&fileurl=public&officeid=<?php echo $_GET['fileid']?>&officetype=1&'+new Date(),
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
<title>OA办公系统</title>
 
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
   //alert(chk);
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
	 <td class="TableData"><textarea name="content" cols="60" rows="3" id="content"></textarea></td>
    </tr>
<tr>
      <td nowrap class="TableContent"> 附言：</td>
	  <td class="TableData">
	  <textarea name="postscript" cols="60" rows="3" id="postscript"></textarea>			</td>
    </tr>	<tr>
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
		 if(get_realname($_USER->id)==get_realname($row['uid'])){
		  $nodeid=explode(',',$nodeid);
		  $nodename=explode(',',$nodename);
		  for($i=0;$i<sizeof($nodeid);$i++){
			 echo '<input name="node" type="radio" value="'.$nodeid[$i].'" ';
			 if(trim($i)==1){
			    echo ' checked="checked" ';
			 }
			 echo ' style="border:0;" />'.$nodename[$i];
		  }
	}else{
		echo '<input name="node" type="radio" value="1" checked="checked">返回发起人办理</input>';
	
	}
		 
	  ?>
	  </td>
    </tr>
	<?php if($per['node']==3){?>
	<input type="hidden" name="disnode" value="1" />
	<tr>
      <td nowrap class="TableContent"> 指定阅读人员：</td>
      <td class="TableData">
	 <?php get_pubuser(2,"distribution","","+选择阅读人员",40,4);?>
	  <br>
	  注：为空表示所有人员可阅读
	  </td>
    </tr>
	<?php }?>
	<tr>
      <td nowrap class="TableContent"> 下一步办理人员：</td>
      <td class="TableData">
	 <?php
	  if(get_realname($_USER->id)==get_realname($row['uid'])){
		  get_pubuser(2,"staff",$flow['flowuser'],"+选择审批人员",40,4);
	  }else{
		  get_pubuser(2,"staff",get_realname($row['uid']),'+选择审批人员',40,4);
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
		echo '<td nowrap class="TableContent"  width="15%"> 批示意见：</td>';
		echo '<td class="TableData"><textarea name="content" cols="60">';
		echo $per['flownote'].'</textarea></td></tr>';
		echo '<tr><td nowrap class="TableContent"  width="15%"> 操作类型：</td><td class="TableData">';
		echo '<input name="pkey" type="radio" style="border:0;" value="1" checked onClick=toggle("div1") />通过';
		echo '<input name="pkey" type="radio" style="border:0;" value="2" onClick=toggle3("div1") />拒绝';
		echo '<input name="pkey" type="radio" style="border:0;" value="5" onClick=toggle3("div1") />结束';
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
				echo '<input name="updatefid" type="radio" style="border:0;" value="'.$upfid['fid'].'" checked />'.$upfid['flowname'];
			}
			echo '</td></tr></tbody>';
		}
		echo '<tbody id="div2">';
		if($per['flowmovement']==3){
			echo '<tr>';
			echo '<td nowrap class="TableContent"> 指定阅读人员：</td>';
			echo '<td class="TableData">';
			echo '<input type="hidden" name="disnode" value="1" />';
			get_pubuser(2,"distribution","0","+选择阅读人员",40,4);
			echo '<br>';
			echo '注：为空表示所有人员可阅读';
			echo '</td></tr>';
		}
		if($wherestr){
			echo '<tr><td nowrap class="TableHeader"> 下一步审批流程：</td>';
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
			  echo '<br>'.get_smsbox("审批人员","work").'</td></tr></tbody>';
		  }
	
	
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
      <td width="90%" align="right" style="font-size:14px; font-weight:900;">来文日期：<?php echo $row['receiptdate']?></td>
    </tr>
	</table>
<table class="TableBlock" border="0" width="90%" align="center" style="margin-top:10px;">
	<tr>
      <td nowrap class="TableHeader" colspan="2"><b>&nbsp;来文内容处理</b></td>
    </tr>
	
	<tr>
      <td colspan="2" style="padding-left:30px; background:#ffffff;padding-right:30px;padding-top:10px;padding-bottom:10px;"> 
<style>
.tdtop{
 	font-size: 20pt;
 	color: #FC3C03;
 	font-family: 宋体;
 	font-weight: bold;
}

.titleFont{
 	font-size: 11pt;
	color: #FC3C03;
	font-family: 楷体_GB2312;
}

.inputDocStyle {
	BORDER-TOP: #8B8B8B 0px solid; 
	BORDER-BOTTOM: #8B8B8B 0px solid; 
	BORDER-LEFT: #8B8B8B 0px solid; 
	BORDER-RIGHT: #8B8B8B 0px solid; 
 	font-size: 14pt;
	width: 100%;
	HEIGHT: 25px; 
	BACKGROUND-COLOR: #F8E5E4;
}

.inputTextDocStyle {
	BORDER-TOP: #8B8B8B 0px solid; 
	BORDER-BOTTOM: #8B8B8B 0px solid; 
	BORDER-LEFT: #8B8B8B 0px solid; 
	BORDER-RIGHT: #8B8B8B 0px solid; 
 	font-size: 14pt;
	width: 100%;
	HEIGHT: 100%; 
	BACKGROUND-COLOR: #F8E5E4;
}

.Selectdocstyle {
	width: 100%;
	HEIGHT: 100%; 
	BORDER-TOP: #7F9DB9 0px solid; 
	BORDER-BOTTOM: #7F9DB9 0px solid; 
	BORDER-LEFT: #7F9DB9 0px solid; 
	BORDER-RIGHT: #7F9DB9 0px solid; 
	BACKGROUND-COLOR: #F8E5E4;
}

.sendTableStyle{
  	border-top:solid 2px #FC3C03; 
  	border-left:solid 2px #FC3C03; 
  	border-right:solid 1px #FC3C03; 
  	border-bottom:solid 2px #FC3C03; 
}

.sendTd{
  	border-bottom:solid 1px #FC3C03; 
  	border-right:solid 1px #FC3C03; 
 	PADDING-TOP: 6px; 
	PADDING-LEFT: 6px; 
 	font-size: 11pt;
	color: #FC3C03;
	font-family: 楷体_GB2312;
}

.sendTdBottom{
  	border-right:solid 1px #FC3C03; 
 	PADDING-TOP: 6px; 
	PADDING-LEFT: 6px; 
 	font-size: 11pt;
	color: #FC3C03;
	font-family: 楷体_GB2312;
}

.ReceiveTableStyle {
  	border-top:solid 2px #000000; 
  	border-left:solid 2px #000000; 
  	border-right:solid 1px #000000; 
  	border-bottom:solid 1px #000000; 
}

.ReceiveTd{
  	border-bottom:solid 1px #000000; 
  	border-right:solid 1px #000000; 
 	font-size: 11pt;
	color: #000000;
	font-family: 楷体_GB2312;
}





.head {
	font-size: 18pt; 
	font-family:楷体_GB2312; 
	color:red; 
	padding:5px
}

.littlehead {
	font-size: 11pt; 
	font-family:楷体_GB2312; 
	color:red;
}

.top {
	font-size: 11pt; 
	font-family:楷体_GB2312; 
	color:red; 
	border-top: 1 solid red;
}

.bottom {
	font-size: 11pt; 
	font-family:楷体_GB2312; 
	color:red; 
}

.lefttop {
	font-size: 11pt; 
	font-family:楷体_GB2312; 
	color:red; 
	border-left: 1 solid red; 
	border-top: 1 solid red;
}

.lefttopnored {
	font-size: 11pt; 
	font-family:楷体_GB2312; 
	border-left: 1 solid red; 
	border-top: 1 solid red;
}

.topbottom {
	font-size: 11pt; 
	font-family:楷体_GB2312;
	border-top: 1 double red;  
	border-bottom: 1 double red; 
	color:red; 
	padding:5px
}

.lefttopbottom {
	font-size: 11pt; 
	font-family:楷体_GB2312; 
	color:red; 
	border-left: 1 solid red; 
	border-top: 1 solid red;
	border-bottom: 1 solid red;
}


</style>
	  <TABLE CLASS=ReceiveTableStyle ALIGN=center BORDER=0 CELLSPACING=0 CELLPADDING=0 ID=docTable>
	<TR HEIGHT=30 ALIGN=center>
		<TD CLASS=ReceiveTd WIDTH=80>来文编号</TD>
		<TD CLASS=ReceiveTd WIDTH=200><?php echo $row['number']?></TD>
		<TD CLASS=ReceiveTd WIDTH=60>份数</TD>
		<TD CLASS=ReceiveTd WIDTH=100><?php echo $row['shares']?></TD>
		<TD CLASS=ReceiveTd WIDTH=60>附件</TD>
		<TD CLASS=ReceiveTd WIDTH=100><?php echo $row['annex']?></TD>
	</TR>
	<TR HEIGHT=30 ALIGN=center>
		<TD CLASS=ReceiveTd>来文机关</TD>
		<TD CLASS=ReceiveTd><?php echo $row['organ']?></TD>
		<TD CLASS=ReceiveTd>来文字号</TD>
		<TD CLASS=ReceiveTd COLSPAN=3><?php echo $row['fontsize']?></TD>
	</TR>
	<TR HEIGHT=30 ALIGN=center>
		<TD CLASS=ReceiveTd>来文标题</TD>
		<TD CLASS=ReceiveTd COLSPAN=5><?php echo $row['title']?></TD>
	</TR>
	<TR HEIGHT=100>
		<TD CLASS=ReceiveTd ALIGN=center>拟办意见</TD>
		<TD CLASS=ReceiveTd COLSPAN=5>
		
		<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			if($type['appkey']==1){
				global $db;
				$query = $db->query("SELECT a.*,b.flownum,b.flowkey1,b.flowkey,b.flowkey2,b.flownote FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."app_flow b  WHERE a.uid not in(".$row['uid'].") a.appflow=b.fid and a.fileid = '".$_GET['fileid']."' and a.type=1 and a.pkey!=0  and b.flowmovement=1 order by a.id desc");
				while ($rowper = $db->fetch_array($query)) {
					if($rowper['appkey']==1){
						app_view_per($rowper['id']);
					}else{
			?>
					
						<TR HEIGHT=25>
							<TD><?php echo $rowper['lnstructions']?></TD>
							<TD WIDTH=100><?php echo $rowper['name']?></TD>
							<TD WIDTH=120><?php echo $rowper['approvaldate']?></TD>
						</TR>
			<?php
				   }
			   }
		   }else{
			   global $db;
			   $query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel WHERE fileid = '".$_GET['fileid']."' and type=1 and pkey!=0  and node=1 order by id desc");
			   while ($rowper = $db->fetch_array($query)) {
				   if($rowper['appkey']==1){
					    //app_view_per($rowper['id']);//显示科员意见
					   app_view_post($rowper['id']); //不显示科员意见书
				   }else{
		   ?>
           <?php if(get_gangwei($rowper['uid'])!=14){ ?>
		   <TR HEIGHT=25>
				<TD><?php echo $rowper['lnstructions']?></TD>
				<TD WIDTH=100><?php echo $rowper['name']?></TD>
				<TD WIDTH=120><?php echo $rowper['approvaldate']?></TD>
			</TR>
            <?php } ?>
		<?php 
				}
			}
		}?>
			  </TABLE>
		
		
		</TD>
	</TR>
	<TR HEIGHT=300>
		<TD CLASS=ReceiveTd ALIGN=center>领导批示</TD>
		<TD CLASS=ReceiveTd VALIGN=TOP COLSPAN=5>
		
		<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			if($type['appkey']==1){
				global $db;
				$query = $db->query("SELECT a.*,b.flownum,b.flowkey1,b.flowkey,b.flowkey2,b.flownote FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."app_flow b  WHERE a.appflow=b.fid and a.fileid = '".$_GET['fileid']."' and a.type=1 and a.pkey!=0  and b.flowmovement=2 order by a.id desc");
				while ($rowper = $db->fetch_array($query)) {
					if($rowper['appkey']==1){
						app_view_per($rowper['id']);
					}else{
			?>
					
						<TR HEIGHT=25>
							<TD><?php echo $rowper['lnstructions']?></TD>
							<TD WIDTH=100><?php echo $rowper['name']?></TD>
							<TD WIDTH=120><?php echo $rowper['approvaldate']?></TD>
						</TR>
			<?php
				   }
			   }
		   }else{
			   global $db;
			   $query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel WHERE fileid = '".$_GET['fileid']."' and type=1 and pkey!=0  and node=2 order by id desc");
			   while ($rowper = $db->fetch_array($query)) {
				   if($rowper['appkey']==1){
					   app_view_per($rowper['id']);
				   }else{
		   ?>
		   <TR HEIGHT=25>
				<TD><?php echo $rowper['lnstructions']?></TD>
				<TD WIDTH=100><?php echo $rowper['name']?></TD>
				<TD WIDTH=120><?php echo $rowper['approvaldate']?></TD>
			</TR>
		<?php 
				}
			}
		}?>
			  </TABLE>
		
			</TD>
	</TR>
	<TR HEIGHT=100>
		<TD CLASS=ReceiveTd ALIGN=center>承办结果</TD>
		<TD CLASS=ReceiveTd COLSPAN=5>
		
		<TABLE BORDER=0 CELLPADDING=2 CELLSPACING=0 WIDTH=98% ALIGN=CENTER>
					
			<?php
			if($type['appkey']==1){
				global $db;
				$query = $db->query("SELECT a.*,b.flownum,b.flowkey1,b.flowkey,b.flowkey2,b.flownote FROM ".DB_TABLEPRE."personnel a,".DB_TABLEPRE."app_flow b  WHERE a.appflow=b.fid and a.fileid = '".$_GET['fileid']."' and a.type=1 and a.pkey!=0  and b.flowmovement=4 order by a.id desc");
				while ($rowper = $db->fetch_array($query)) {
					if($rowper['appkey']==1){
						app_view_per($rowper['id']);
					}else{
			?>
					
						<TR HEIGHT=25>
							<TD><?php echo $rowper['lnstructions']?></TD>
							<TD WIDTH=100><?php echo $rowper['name']?></TD>
							<TD WIDTH=120><?php echo $rowper['approvaldate']?></TD>
						</TR>
			<?php
				   }
			   }
		   }else{
			   global $db;
			   $query = $db->query("SELECT * FROM ".DB_TABLEPRE."personnel WHERE fileid = '".$_GET['fileid']."' and type=1 and pkey!=0  and node=4 order by id desc");
			   while ($rowper = $db->fetch_array($query)) {
				   if($rowper['appkey']==1){
					   app_view_per($rowper['id']);
				   }else{
		   ?>
		   <TR HEIGHT=25>
				<TD><?php echo $rowper['lnstructions']?></TD>
				<TD WIDTH=100><?php echo $rowper['name']?></TD>
				<TD WIDTH=120><?php echo $rowper['approvaldate']?></TD>
			</TR>
		<?php 
				}
			}
		}?>
			  </TABLE>
		
			</TD>
	</TR>
</TABLE>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  </td>
    </tr>
	
 
    
  </table>
</form>

</body>
</html>
