			<!-- NAVBAR -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="brand">
					<a href="index.html">
						
					</a>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
								<span><?php echo $this->session->userdata('first_name').' <b>'.$this->session->userdata('last_name').'</b> ('.$this->session->userdata('role_name').')' ?></span>
							</a>
							<ul class="dropdown-menu logged-user-menu">
								<li><a href="<?= base_url()?>login/logout"><i class="ti-power-off"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
				
			</nav>
			<!-- END NAVBAR -->
			<!-- LEFT SIDEBAR -->

			
			
			<div id="sidebar-nav" class="sidebar">

				
				<nav>
					<ul class="nav" id="sidebar-nav-menu">
						
						<li class="menu-group">Dashboard</li>
						<li class="dropdown xde">
							<a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="ti-list"></i><span>Summary</span>
							</a>
							<ul class="dropdown-menu logged-user-menu">
								<li><a href="<?= base_url()?>dashboard/daily"> <span>Daily</span></a></li>
								<li><a href="<?= base_url()?>"> <span>Weekly</span></a></li>
								<li><a href="<?= base_url()?>dashboard/monthly"><span>Monthly</span></a></li>
							</ul>
						</li>
						<li class="dropdown xde">
							<a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="ti-list"></i><span>Volume Trend</span>
							</a>
							<ul class="dropdown-menu logged-user-menu">
								<li><a href="<?= base_url()?>trend/daily"> <span>Daily</span></a></li>
								<li><a href="<?= base_url()?>trend"> <span>Weekly</span></a></li>
								<li><a href="<?= base_url()?>trend/monthly"><span>Monthly</span></a></li>
							</ul>
						</li>
						<li class="dropdown xde">
							<a href="index.html#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="ti-list"></i><span>FD Split (COD & N-COD)</span>
							</a>
							<ul class="dropdown-menu logged-user-menu">
								<li><a href="<?= base_url()?>fdsplit/daily"> <span>Daily</span></a></li>
								<li><a href="<?= base_url()?>fdsplit"> <span>Weekly</span></a></li>
								<li><a href="<?= base_url()?>fdsplit/monthly"><span>Monthly</span></a></li>
							</ul>
						</li>
						
						<li><a href="<?= base_url()?>raw_data"><span class="title">Upload Data</span></a></li>
						<li><a href="<?= base_url()?>maintenance"><span class="title">Maintenance</span></a></li>
						<li><a href="<?= base_url()?>user"> <span class="title">User Management</span></a></li>
						
					</ul>
					
				</nav>

				
				
			</div>
			<!-- END LEFT SIDEBAR -->