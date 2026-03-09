<script>
  function settings()
  {
	//alert('sfsfa');
	 $("#settings_li").trigger("click");
  }
  
  function transactions()
  {
	//alert('sfsfa');
	 $("#transactions_li").trigger("click");
  }
				
</script>
<div class="switch_bar">
		<ul>
			<?php /*?><li>
			<a href="#"><span class="stats_icon current_work_sl"></span><span class="label">Analytics</span></a>
			</li><?php */?>
			<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><span class="stats_icon user_sl"></span><span class="label"><?php echo USERS;?></span></a>
			<?php /*?><div class="notification_list dropdown-menu blue_d">
				<div class="white_lin nlist_block">
					<ul>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Cras erat diam, consequat quis tincidunt nec, eleifend.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Donec neque leo, ullamcorper eget aliquet sit amet.</a>
						</div>
						</li>
						<li>
						<div class="nlist_thumb">
							<img src="images/photo_60x60.jpg" width="40" height="40" alt="img">
						</div>
						<div class="list_inf">
							<a href="#">Nam euismod dolor ac lacus facilisis imperdiet.</a>
						</div>
						</li>
					</ul>
					<span class="btn_24_blue"><a href="#">View All</a></span>
				</div>
			</div><?php */?>
			</li>
			<!--
			<li><a href="#"><span class="stats_icon administrative_docs_sl"></span><span class="label"><?php echo CONTENT;?></span></a></li>
			<li><a href="#"><span class="stats_icon finished_work_sl"><span class="alert_notify blue">30</span></span><span class="label"><?php echo TASK_LIST;?></span></a></li>
			-->
			<li onclick="settings();"><a href="#"><span class="stats_icon config_sl"></span><span class="label">Settings</span></a></li>
            <li onclick="transactions();"><a href="#"><span class="stats_icon bank_sl"></span><span class="label">Transactions</span></a></li>
			<?php /*?>
			<li><a href="#"><span class="stats_icon archives_sl"></span><span class="label">Archive</span></a></li>
			<li><a href="#"><span class="stats_icon address_sl"></span><span class="label">Contact</span></a></li>
			<li><a href="#"><span class="stats_icon folder_sl"></span><span class="label">Media</span></a></li>
			<li><a href="#"><span class="stats_icon category_sl"></span><span class="label">Explorer</span></a></li>
			<li><a href="#"><span class="stats_icon calendar_sl"><span class="alert_notify orange">30</span></span><span class="label">Events</span></a></li>
			<li><a href="#"><span class="stats_icon lightbulb_sl"></span><span class="label">Support</span></a></li>
			
            <?php */?>
		</ul>
	</div>