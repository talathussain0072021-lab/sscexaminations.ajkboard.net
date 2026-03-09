<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if(isset($_REQUEST['action']) && $_REQUEST['action']=='update-record')
	{
		$InstitutesArray=explode(',', $_REQUEST['InstitutesArray']);
		$RightsArray=explode(',', $_REQUEST['RightsArray']);
		
		for($i=0; $i < sizeof($InstitutesArray); $i++)
		{
			$sql_q="UPDATE institutes SET
			AdmRights10s	=		'".$RightsArray[$i]."'
			WHERE Id		=		".$InstitutesArray[$i]."";
			$res_q=mysql_query($sql_q, $conn1);
		}
		
		?><script>alert('Rights Updated Successfully.');location.replace('instadm_rights10s.php');</script><?php
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Institutes Rights(Adm)(Supply)</h6>
					</div>

					<div class="widget_content">
						<div class="invoice_action_bar" style="float: right;">
							<div class="btn_30_blue">
                            	<a href="javascript:;" onclick="assign_value('form1');"><span class="icon add_co"></span><span class="btn_link">Update Rights</span></a>
                            </div>
                        </div>
						<div class="invoice_action_bar" style="float: left;">
                        <table class="search">
						<form method="post">
						<tr>
                            <td><strong>Institutes Range:</strong></td>
                            <td>
								<input name="SrTo" id="SrTo" type="text" value="<?php echo $_REQUEST['SrTo'];?>" class="small limiter" onkeypress="return isNumber()" maxlength="4" tabindex="1"/> -
								<input name="SrFrom" id="SrFrom" type="text" value="<?php echo $_REQUEST['SrFrom'];?>" class="small limiter" onkeypress="return isNumber()" maxlength="4" tabindex="2"/>
								&nbsp;<input type="submit" name="search1" id="search1" value="Search" tabindex="3"/>
							</td>
						</tr>
						</form>
                        </table>
                        </div>
						
						<form name="form1" id="form1" action="" method="post">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Allocate Centre/ Create Batch <input type="checkbox" name="checkbox1" id="checkboxa1" value="" onclick="CheckAll(this)"/></th>
							<th>Show Batch <input type="checkbox" name="checkbox2" id="checkboxa2" value="" onclick="CheckAll(this)"/></th>
						</tr>
						</thead>
						<tbody>
                        <?php
						if(isset($_REQUEST['search1']))
						{
							$SrNo=1; $P=0;
							
							$sql="SELECT * FROM institutes";
							
							if(isset($_REQUEST['SrTo']) && $_REQUEST['SrTo']!='' && isset($_REQUEST['SrFrom']) && $_REQUEST['SrFrom']!='')
							{ $sql.=" WHERE Code BETWEEN ".$_REQUEST['SrTo']." AND ".$_REQUEST['SrFrom'].""; }
							
							$sql.=" ORDER BY Code ASC";
							$res=mysql_query($sql, $conn1);
							while($row=mysql_fetch_array($res))
							{
								$Rights=explode('.',$row['AdmRights10s']);
							?>
							<tr>
								<input type="hidden" name="Id[]" id="Id_<?php echo ++$P;?>" value="<?php echo $row['Id'];?>"/>
								<td class="center"><?php echo $SrNo;?></td>
								<td class="center"><?php echo $row['Id'];?></td>
								<td class="center"><?php echo $row['Code'];?></td>
								<td class="left"><?php echo $row['Name'];?></td>
								<td class="center">
								<input type="checkbox" name="checkbox1" id="checkbox1_<?php echo $row['Id'];?>" value="10" <?php echo (in_array('10',$Rights))?'checked="checked"':'';?>>
								</td>
								<td class="center">
								<input type="checkbox" name="checkbox2" id="checkbox2_<?php echo $row['Id'];?>" value="20" <?php echo (in_array('20',$Rights))?'checked="checked"':'';?>>
								</td>
							</tr>
							<?php
							$SrNo++;
							}
						}//if(isset($_REQUEST['search1']))
						?>
						</tbody>
						<tfoot>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Allocate Centre/Create Batch</th>
							<th>Show Batch</th>
						</tr>
						</tfoot>
						</table>
						</form>
					</div>
				</div>
			</div>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
<script>
function CheckAll(x)
{
    var allInputs = document.getElementsByName(x.name);
    for(var i = 0, max = allInputs.length; i < max; i++)
    {
        if(allInputs[i].type == 'checkbox')
        if(x.checked == true) allInputs[i].checked = true;
        else allInputs[i].checked = false;
    }
}

function assign_value(form)
{
	var InstitutesArray=[]; var InstRights=[]; var RightsArray=[]; var Count=0;
	form = document.getElementById(form);
	
	for(var i = 0; i < form.elements.length; i++)
	{
		if(form.elements[i].type === "hidden")
		{
			var Id=form.elements[i].value;
			
			if(document.getElementById('checkbox1_'+Id).checked == true)
			{ InstRights+=document.getElementById('checkbox1_'+Id).value; InstRights+='.'; }
			
			if(document.getElementById('checkbox2_'+Id).checked == true)
			{ InstRights+=document.getElementById('checkbox2_'+Id).value; InstRights+='.'; }
			
			InstitutesArray.push(Id); RightsArray.push(InstRights); Count++; var InstRights=[];
		}//if(form.elements[i].type === "hidden")
	}//for(var i = 0; i < form.elements.length; i++)
	
	if(Count > 0)
	{
		location.replace('instadm_rights10s.php?InstitutesArray='+InstitutesArray+'&RightsArray='+RightsArray+'&action=update-record');
	}
	return false;
}
</script>