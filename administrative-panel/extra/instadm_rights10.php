<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php
	if (isset($_POST['action']) && $_POST['action'] == 'update-record') {
		$InstitutesArray = explode(',', $_POST['InstitutesArray']);
		$RightsArray = explode(',', $_POST['RightsArray']);

		for ($i = 0; $i < count($InstitutesArray); $i++) {
			$sql_q = "UPDATE institutes 
					  SET AdmRights10 = '" . mysql_real_escape_string($RightsArray[$i]) . "' 
					  WHERE Id = " . intval($InstitutesArray[$i]);
			mysql_query($sql_q, $conn1);
		}

		echo "<script>alert('Rights Updated Successfully.');location.replace('instadm_rights10.php');</script>";
	}
	?>

	<div id="content">
		<div class="grid_container">
			<span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Institutes Rights(Adm)(Part-II)</h6>
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
						<input type="hidden" name="InstitutesArray" id="InstitutesArray">
						<input type="hidden" name="RightsArray" id="RightsArray">
						<input type="hidden" name="action" id="action">
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>SrNo</th>
							<th>ID</th>
							<th>Code</th>
							<th>Name</th>
							<th>Allocate Centre/ Create Batch <input type="checkbox" name="checkbox1" id="checkboxa1" value="" onclick="CheckAll(this)"/></th>
							<th>Show Batch <input type="checkbox" name="checkbox2" id="checkboxa2" value="" onclick="CheckAll(this)"/></th>
							<th>Add Student <input type="checkbox" name="checkbox3" id="checkboxa3" value="" onclick="CheckAll(this)"/></th>
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
								$Rights=explode('.',$row['AdmRights10']);
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
								<td class="center">
								<input type="checkbox" name="checkbox3" id="checkbox3_<?php echo $row['Id'];?>" value="30" <?php echo (in_array('30',$Rights))?'checked="checked"':'';?>>
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
							<th>Add Student</th>
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

function assign_value(formId) {
    var form = document.getElementById(formId);
    var InstitutesArray = [];
    var RightsArray = [];

    var hiddenInputs = form.querySelectorAll('input[type="hidden"][name="Id[]"]');
    
    hiddenInputs.forEach(function(input) {
        var Id = input.value;
        var rights = [];

        if (document.getElementById('checkbox1_' + Id).checked)
            rights.push('10');
        if (document.getElementById('checkbox2_' + Id).checked)
            rights.push('20');
        if (document.getElementById('checkbox3_' + Id).checked)
            rights.push('30');

        InstitutesArray.push(Id);
        RightsArray.push(rights.join('.'));
    });

    // Assign values to hidden fields
    document.getElementById('InstitutesArray').value = InstitutesArray.join(',');
    document.getElementById('RightsArray').value = RightsArray.join(',');
    document.getElementById('action').value = 'update-record';

    // Submit form via POST
    form.method = 'post';
    form.action = 'instadm_rights10.php';
    form.submit();

    return false;
}
</script>