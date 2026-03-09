	<div id="header" class="blue_lin">
		<div class="header_left">
			<div class="logo">
				<img src="images/logo.png" width="160" height="60" alt="Ekra">
			</div>
			<div id="responsive_mnu">
				<a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
				<div id="responsive_menu" class="hidden">
					<ul>
						<li><a href="#"> Dashboard</a>
						<ul>
							<li><a href="dashboard.html">Dashboard Main</a></li>
							<li><a href="dashboard-01.html">Dashboard 01</a></li>
							<li><a href="dashboard-02.html">Dashboard 02</a></li>
							<li><a href="dashboard-03.html">Dashboard 03</a></li>
							<li><a href="dashboard-04.html">Dashboard 04</a></li>
						</ul>
						</li>
						<li><a href="#"> Forms</a>
						<ul>
							<li><a href="form-elements.html">All Forms Elements</a></li>
							<li><a href="left-label-form.html">Left Label Form</a></li>
							<li><a href="top-label-form.html">Top Label Form</a></li>
							<li><a href="form-xtras.html">Additional Forms (3)</a></li>
							<li><a href="form-validation.html">Form Validation</a></li>
							<li><a href="signup-form.html">Signup Form</a></li>
							<li><a href="content-post.html">Content Post Form</a></li>
							<li><a href="wizard.html">wizard</a></li>
						</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="header_right">
			<div id="top_notification">
			</div>
			<div id="user_nav">
				<ul>
                
					<li class="user_thumb"><a href="#"><span class="icon">
                    <img src="images/user_thumb.png" width="30" height="30" alt="User">
                    </span></a></li>
					<li class="user_info">
						<span class="user_name">
							<?php 
							if(isset($_SESSION['emp_full_name'])) {
								echo $_SESSION['emp_full_name'];
							} else if(isset($_SESSION['EmpFullName'])) {
								echo $_SESSION['EmpFullName'];
							} else {
								echo 'User';
							}
							?>
						</span>
						<span><a href="change_password.php">Change Password</a></span>
					</li>
					<li class="logout"><a href="login.php"><span class="icon"></span>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="page_title">
	</div>