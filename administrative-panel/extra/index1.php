<?php include('includes/top.php');?>
<script>
	$(function () {
    $.jqplot._noToImageButton = true;
    var prevYear = [["2011-08-01",398], ["2011-08-02",255.25], ["2011-08-03",263.9], ["2011-08-04",154.24],
    ["2011-08-05",210.18], ["2011-08-06",109.73], ["2011-08-07",166.91], ["2011-08-08",330.27], ["2011-08-09",546.6],
    ["2011-08-10",260.5], ["2011-08-11",330.34], ["2011-08-12",464.32], ["2011-08-13",432.13], ["2011-08-14",197.78],
    ["2011-08-15",311.93], ["2011-08-16",650.02], ["2011-08-17",486.13], ["2011-08-18",330.99], ["2011-08-19",504.33],
    ["2011-08-20",773.12], ["2011-08-21",296.5], ["2011-08-22",280.13], ["2011-08-23",428.9], ["2011-08-24",469.75],
    ["2011-08-25",628.07], ["2011-08-26",516.5], ["2011-08-27",405.81], ["2011-08-28",367.5], ["2011-08-29",492.68],
    ["2011-08-30",700.79], ["2011-08-31",588.5], ["2011-09-01",511.83], ["2011-09-02",721.15], ["2011-09-03",649.62],
    ["2011-09-04",653.14], ["2011-09-06",900.31], ["2011-09-07",803.59], ["2011-09-08",851.19], ["2011-09-09",2059.24],
    ["2011-09-10",994.05], ["2011-09-11",742.95], ["2011-09-12",1340.98], ["2011-09-13",839.78], ["2011-09-14",1769.21],
    ["2011-09-15",1559.01], ["2011-09-16",2099.49], ["2011-09-17",1510.22], ["2011-09-18",1691.72],
    ["2011-09-19",1074.45], ["2011-09-20",1529.41], ["2011-09-21",1876.44], ["2011-09-22",1986.02],
    ["2011-09-23",1461.91], ["2011-09-24",1460.3], ["2011-09-25",1392.96], ["2011-09-26",2164.85],
    ["2011-09-27",1746.86], ["2011-09-28",2220.28], ["2011-09-29",2617.91], ["2011-09-30",3236.63]];
    var currYear = [["2011-08-01",796.01], ["2011-08-02",510.5], ["2011-08-03",527.8], ["2011-08-04",308.48],
    ["2011-08-05",420.36], ["2011-08-06",219.47], ["2011-08-07",333.82], ["2011-08-08",660.55], ["2011-08-09",1093.19],
    ["2011-08-10",521], ["2011-08-11",660.68], ["2011-08-12",928.65], ["2011-08-13",864.26], ["2011-08-14",395.55],
    ["2011-08-15",623.86], ["2011-08-16",1300.05], ["2011-08-17",972.25], ["2011-08-18",661.98], ["2011-08-19",1008.67],
    ["2011-08-20",1546.23], ["2011-08-21",593], ["2011-08-22",560.25], ["2011-08-23",857.8], ["2011-08-24",939.5],
    ["2011-08-25",1256.14], ["2011-08-26",1033.01], ["2011-08-27",811.63], ["2011-08-28",735.01], ["2011-08-29",985.35],
    ["2011-08-30",1401.58], ["2011-08-31",1177], ["2011-09-01",1023.66], ["2011-09-02",1442.31], ["2011-09-03",1299.24],
    ["2011-09-04",1306.29], ["2011-09-06",1800.62], ["2011-09-07",1607.18], ["2011-09-08",1702.38],
    ["2011-09-09",4118.48], ["2011-09-10",1988.11], ["2011-09-11",1485.89], ["2011-09-12",2681.97],
    ["2011-09-13",1679.56], ["2011-09-14",3538.43], ["2011-09-15",3118.01], ["2011-09-16",4198.97],
    ["2011-09-17",3020.44], ["2011-09-18",3383.45], ["2011-09-19",2148.91], ["2011-09-20",3058.82],
    ["2011-09-21",3752.88], ["2011-09-22",3972.03], ["2011-09-23",2923.82], ["2011-09-24",2920.59],
    ["2011-09-25",2785.93], ["2011-09-26",4329.7], ["2011-09-27",3493.72], ["2011-09-28",4440.55],
    ["2011-09-29",5235.81], ["2011-09-30",6473.25]];
    var plot1 = $.jqplot("chart1", [prevYear, currYear], {
        seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
        title: 'Monthly Revenue',
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
            {
                fill: true,
                label: '2010'
            },
            {
                label: '2011'
            }
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%b %e",
                    angle: -30,
                    textColor: '#dddddd'
                },
                min: "2011-08-01",
                max: "2011-09-30",
                tickInterval: "7 days",
                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    formatString: "$%'d",
                    showMark: false
                }
            }
        }
    });
});
/*=================
CHART 8
===================*/
$(function(){
  var plot2 = $.jqplot ('chart8', [[3,7,9,1,5,3,8,2,5]], {
      // Give the plot a title.
      title: 'Plot With Options',
      // You can specify options for all axes on the plot at once with
      // the axesDefaults object.  Here, we're using a canvas renderer
      // to draw the axis label which allows rotated text.
      axesDefaults: {
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer
      },
      // Likewise, seriesDefaults specifies default options for all
      // series in a plot.  Options specified in seriesDefaults or
      // axesDefaults can be overridden by individual series or
      // axes options.
      // Here we turn on smoothing for the line.
      seriesDefaults: {
		  shadow: false,   // show shadow or not.
          rendererOptions: {
              smooth: true
          }
      },
      // An axes object holds options for all axes.
      // Allowable axes are xaxis, x2axis, yaxis, y2axis, y3axis, ...
      // Up to 9 y axes are supported.
      axes: {
        // options for each axis are specified in seperate option objects.
        xaxis: {
          label: "X Axis",
          // Turn off "padding".  This will allow data point to lie on the
          // edges of the grid.  Default padding is 1.2 and will keep all
          // points inside the bounds of the grid.
          pad: 0
        },
        yaxis: {
          label: "Y Axis"
        }
      },
		grid: {
         borderColor: '#ccc',     // CSS color spec for border around grid.
        borderWidth: 2.0,           // pixel width of border around grid.
        shadow: false               // draw a shadow for grid.
    }
    });
});
</script>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<?php include('includes/switch_bar.php');?>
	<div id="content">
		<div class="grid_container">
        	<?php /*?>
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<div class="data_widget black_g chart_wrap">
							<div id="chart1">
							</div>
						</div>
					</div>
				</div>
			</div>
			<span class="clear"></span>
            <?php */?>
			<?php
				
				$month = date ("m");
				$year= date ("Y");
				 
				$sql1="SELECT COALESCE(SUM(salary_sheet_detail.net_salary), 0) AS payable_salary FROM salary_sheet, salary_sheet_detail WHERE MONTH(salary_sheet.salary_dated) = '".$month."' AND YEAR(salary_sheet.salary_dated) = '".$year."' AND salary_sheet_detail.salary_id=salary_sheet.salary_id";
				$res1=mysql_query($sql1, $conn1);
				$row1=mysql_fetch_array($res1);
				
				$sql2="SELECT COALESCE(SUM(payment_amount), 0) AS paid_salary FROM payments WHERE payment_type='Salary' AND MONTH(payment_dated) = '".$month."' AND YEAR(payment_dated) = '".$year."'";
				$res2=mysql_query($sql2, $conn1);
				$row2=mysql_fetch_array($res2);
				
				$sql3="SELECT COALESCE(SUM(fund_amount), 0) AS cash_inflow FROM funds WHERE MONTH(fund_dated) = '".$month."' AND YEAR(fund_dated) = '".$year."'";
				$res3=mysql_query($sql3, $conn1);
				$row3=mysql_fetch_array($res3);
				
				$sql4="SELECT COALESCE(SUM(ex_amount), 0) AS total_expenses FROM expenses WHERE MONTH(ex_dated) = '".$month."' AND YEAR(ex_dated) = '".$year."'";
				$res4=mysql_query($sql4, $conn1);
				$row4=mysql_fetch_array($res4);
					
				/*
				$net_salary=0; $net_sum=0;				
				$sql4="SELECT * FROM general_info WHERE id='1'";
				$res4=mysql_query($sql4, $conn1);
				$row4=mysql_fetch_array($res4);
						
				$sql="SELECT * FROM employee WHERE emp_id<>'1' AND emp_status='1' ORDER BY emp_id ASC";
				$res=mysql_query($sql, $conn1);
				while($row=mysql_fetch_array($res))
				{	
					$sql1="SELECT COALESCE(SUM(amount), 0) AS total_allowance FROM employee_allowances WHERE emp_id='".$row['emp_id']."' AND allowance_id!=1 AND allowance_id!=2";
					$res1=mysql_query($sql1, $conn1);
					$row1=mysql_fetch_array($res1);
					
					$sql3="SELECT COALESCE(SUM(amount), 0) AS allowance FROM employee_allowances WHERE emp_id='".$row['emp_id']."' AND allowance_id=2";
					$res3=mysql_query($sql3, $conn1);
					$row3=mysql_fetch_array($res3);	
					
					$net_salary=($row1['total_allowance'] + $row['emp_pay_scale'] + round(($row4['working_days'] * ($row3['allowance'])),2));
					
					$net_sum=$net_sum+$net_salary;
				}
				*/
			?>
			<div class="social_activities" align="center">
			<img src="images/banner.jpg" width="40%" height="150px" />
			</div>
			<div class="social_activities">
				<div class="views_s">
					<div class="block_label">
						Payable Salary<span style="color:#FF0000;"><?php echo number_format($row1['payable_salary'], 2, '.', '');?></span>
					</div>
					<span class="badge_icon bank_sl"></span>
				</div>
				<div class="views_s">
					<div class="block_label">
						Paid Salary<span style="color:#FF0000;"><?php echo number_format($row2['paid_salary'], 2, '.', '');?></span>
					</div>
					<span class="badge_icon bank_sl"></span>
				</div>	
				<div class="views_s">
					<div class="block_label">
						Cash Inflow<span style="color:#FF0000;"><?php echo number_format($row3['cash_inflow'], 2, '.', '');?></span>
					</div>
					<span class="badge_icon bank_sl"></span>
				</div>
				<div class="views_s">
					<div class="block_label">
						Expense <span style="color:#FF0000;"><?php echo number_format($row4['total_expenses'], 2, '.', '');?></span>
					</div>
					<span class="badge_icon bank_sl"></span>
				</div>	
				<div class="views_s">
					<div class="block_label">
						Incentive<span style="color:#FF0000;">0.00</span>
					</div>
					<span class="badge_icon bank_sl"></span>
				</div>
				<!--
				<div class="user_s">
					<div class="block_label">
						New User's<span>12000</span>
					</div>
					<span class="badge_icon customers_sl"></span>
				</div>
				-->
			</div>
			<!--
			<div class="grid_12">
				<div class="widget_wrap collapsible_widget">
					<div class="widget_top active">
						<span class="h_icon"></span>
						<h6>Active Collapsible Widget</h6>
					</div>
					<div class="widget_content">
						<h3>Header</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>
						<div id="chart8" class="chart_block">
						</div>
					</div>
				</div>
			</div>
			
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list_images"></span>
						<h6>Task List</h6>
					</div>
					<div class="widget_content">
						<h3>Task list with label badge</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>
						<table class="display" id="action_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox" type="checkbox" value="" class="checkall">
							</th>
							<th>
								 Id
							</th>
							<th>
								 Task
							</th>
							<th>
								 Dead Line
							</th>
							<th>
								 Priority
							</th>
							<th>
								 Status
							</th>
							<th>
								 Complete Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_low">Low</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_medium">Medium</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_low">Low</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_medium">Medium</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_low">Low</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_medium">Medium</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_low">Low</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_medium">Medium</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_low">Low</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_medium">Medium</span>
							</td>
							<td class="center">
								<span class="badge_style b_done">Done</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						<tr>
							<td class="center tr_select">
								<input name="checkbox" type="checkbox" value="">
							</td>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								<span class="badge_style b_high">High</span>
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Done</a></span>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox" type="checkbox" value="" class="checkall">
							</th>
							<th>
								 Id
							</th>
							<th>
								 Task
							</th>
							<th>
								 Dead Line
							</th>
							<th>
								 Priority
							</th>
							<th>
								 Status
							</th>
							<th>
								 Complete Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<span class="clear"></span>
			
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon users"></span>
						<h6>Recent Users</h6>
					</div>
					<div class="widget_content">
						<div class="user_list">
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="User">
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
										<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
										<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="#">Edit</a></li>
									<li><a class="p_del" href="#">Delete</a></li>
									<li><a class="p_reject" href="#">Suspend</a></li>
									<li class="right"><a class="p_approve" href="#">Approve</a></li>
								</ul>
							</div>
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
										<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
										<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="#">Edit</a></li>
									<li><a class="p_del" href="#">Delete</a></li>
									<li><a class="p_reject" href="#">Suspend</a></li>
									<li class="right"><a class="p_approve" href="#">Approve</a></li>
								</ul>
							</div>
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
										<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
										<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="#">Edit</a></li>
									<li><a class="p_del" href="#">Delete</a></li>
									<li><a class="p_reject" href="#">Suspend</a></li>
									<li class="right"><a class="p_approve" href="#">Approve</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon users"></span>
						<h6>Recent Users</h6>
					</div>
					<div class="widget_content">
						<div class="user_list">
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="User">
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
										<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
										<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="#">Edit</a></li>
									<li><a class="p_del" href="#">Delete</a></li>
									<li><a class="p_reject" href="#">Suspend</a></li>
									<li class="right"><a class="p_approve" href="#">Approve</a></li>
								</ul>
							</div>
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
										<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
										<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="#">Edit</a></li>
									<li><a class="p_del" href="#">Delete</a></li>
									<li><a class="p_reject" href="#">Suspend</a></li>
									<li class="right"><a class="p_approve" href="#">Approve</a></li>
								</ul>
							</div>
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
										<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
										<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="#">Edit</a></li>
									<li><a class="p_del" href="#">Delete</a></li>
									<li><a class="p_reject" href="#">Suspend</a></li>
									<li class="right"><a class="p_approve" href="#">Approve</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			-->
			<?php /*?>
            <span class="clear"></span>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon documents"></span>
						<h6>Content</h6>
					</div>

					<div class="widget_content">
						<h3>Content Table</h3>
						<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>
						<table class="display data_tbl">
						<thead>
						<tr>
							<th>
								 Id
							</th>
							<th>
								 Details
							</th>
							<th>
								 Submit Date
							</th>
							<th>
								 Submited By
							</th>
							<th>
								 Status
							</th>
							<th>
								 Publish Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>
								<a href="#">01</a>
							</td>
							<td>
								<a href="#">Pellentesque ut massa ut ligula ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Jaman
							</td>
							<td class="center">
								<span class="badge_style b_done">Publish</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#">02</a>
							</td>
							<td>
								<a href="#">Nulla non ante dui, sit amet ... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Jhon
							</td>
							<td class="center">
								<span class="badge_style b_done">Publish</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#">03</a>
							</td>
							<td>
								<a href="#">Aliquam eu pellentesque... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Mike
							</td>
							<td class="center">
								<span class="badge_style b_done">Publish</span>
							</td>
							<td class="center sdate">
								 3rd FEB 2012
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#">04</a>
							</td>
							<td>
								<a href="#">Maecenas egestas alique... </a>
							</td>
							<td class="sdate center">
								 1st FEB 2012
							</td>
							<td class="center">
								 Sam
							</td>
							<td class="center">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="center sdate">
								 -
							</td>
							<td class="center">
								<span><a class="action-icons c-edit" href="#" title="Edit">Edit</a></span><span><a class="action-icons c-delete" href="#" title="delete">Delete</a></span><span><a class="action-icons c-approve" href="#" title="Approve">Publish</a></span>
							</td>
						</tr>
						</tbody>
						<tfoot>
						<tr>
							<th>
								 Id
							</th>
							<th>
								 Details
							</th>
							<th>
								 Submit Date
							</th>
							<th>
								 Submited By
							</th>
							<th>
								 Status
							</th>
							<th>
								 Publish Date
							</th>
							<th>
								 Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<span class="clear"></span>            
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon shopping_cart_3"></span>
						<h6>Recent Order</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 Order ID
							</th>
							<th>
								 Titile
							</th>
							<th>
								 Status
							</th>
							<th>
								 Amount
							</th>
						</tr>
						</thead>
						<tbody>
						<tr class="tr_even">
							<td>
								 #36542
							</td>
							<td>
								 Gold Pack
							</td>
							<td>
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td>
								 $50/m
							</td>
						</tr>
						<tr class="tr_odd">
							<td>
								 #38544
							</td>
							<td>
								 Silver Pack
							</td>
							<td>
								<span class="badge_style b_confirmed">Confirmed</span>
							</td>
							<td>
								 $20/m
							</td>
						</tr>
						<tr class="tr_even">
							<td class="noborder_b round_l">
								 #39542
							</td>
							<td class="noborder_b">
								<span>Platinum Pack</span>
							</td>
							<td class="noborder_b">
								<span class="badge_style b_pending">Pending</span>
							</td>
							<td class="noborder_b round_r">
								 $80/m
							</td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon bended_arrow_right"></span>
						<h6>Tabby Widget</h6>
						<div id="widget_tab">
							<ul>
								<li><a href="#tab1" class="active_tab">Recent Users<span class="alert_notify blue">25</span></a></li>
								<li><a href="#tab2">Recent Comments<span class="alert_notify orange">25</span></a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
						<div id="tab1">
							<div class="user_list">
								<div class="user_block">
									<div class="info_block">
										<div class="widget_thumb">
											<img src="images/user-thumb1.png" width="40" height="40" alt="User">
										</div>
										<ul class="list_info">
											<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
											<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
											<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
										</ul>
									</div>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Suspend</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
								<div class="user_block">
									<div class="info_block">
										<div class="widget_thumb">
											<img src="images/user-thumb1.png" width="40" height="40" alt="user">
										</div>
										<ul class="list_info">
											<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
											<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
											<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
										</ul>
									</div>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Suspend</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
								<div class="user_block">
									<div class="info_block">
										<div class="widget_thumb">
											<img src="images/user-thumb1.png" width="40" height="40" alt="user">
										</div>
										<ul class="list_info">
											<li><span>Name: <i><a href="#">Zara Zarin</a></i></span></li>
											<li><span>IP: 194.132.12.1 Date: 13th Jan 2012</span></li>
											<li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li>
										</ul>
									</div>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Suspend</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div id="tab2">
							<div class="post_list">
								<div class="post_block">
									<h6><a href="#">Sed eu adipiscing nisi. Maecenas dapibus lacinia pretium. Praesent eget lectus ac odio euismod consequat. </a></h6>
									<ul class="post_meta">
										<li><span>Posted By:</span><a href="#">Joe Smith</a></li>
										<li><span>Date:</span><a href="#"> 30th April 2012</a></li>
										<li class="total_post"><span>Total Post: </span><a href="#">30</a></li>
									</ul>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Reject</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
								<div class="post_block">
									<h6><a href="#">Sed eu adipiscing nisi. Maecenas dapibus lacinia pretium. Praesent eget lectus ac odio euismod consequat. </a></h6>
									<ul class="post_meta">
										<li><span>Posted By:</span><a href="#">Joe Smith</a></li>
										<li><span>Date:</span><a href="#"> 30th April 2012</a></li>
										<li class="total_post"><span>Total Post: </span><a href="#">30</a></li>
									</ul>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Reject</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
								<div class="post_block">
									<h6><a href="#">Sed eu adipiscing nisi. Maecenas dapibus lacinia pretium. Praesent eget lectus. </a></h6>
									<ul class="post_meta">
										<li><span>Posted By:</span><a href="#">Joe Smith</a></li>
										<li><span>Date:</span><a href="#"> 30th April 2012</a></li>
										<li class="total_post"><span>Total Post: </span><a href="#">30</a></li>
									</ul>
									<ul class="action_list">
										<li><a class="p_edit" href="#">Edit</a></li>
										<li><a class="p_del" href="#">Delete</a></li>
										<li><a class="p_reject" href="#">Reject</a></li>
										<li class="right"><a class="p_approve" href="#">Approve</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <?php */?>
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>