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
						<li><a href="<?= base_url()?>"><i class="ti-list"></i> <span class="title">Weekly Summary</span></a></li>
						<li><a href="<?= base_url()?>dashboard/daily"><i class="ti-list"></i> <span class="title">Daily Summary</span></a></li>
						<li><a href="<?= base_url()?>dashboard/monthly"><i class="ti-list"></i> <span class="title">Monthly Summary</span></a></li>
						<li><a href="<?= base_url()?>trend"><i class="ti-list"></i> <span class="title">Weekly Volume Trend</span></a></li>
						<li><a href="<?= base_url()?>trend/daily"><i class="ti-list"></i> <span class="title">Daily Volume Trend</span></a></li>
						<li><a href="<?= base_url()?>trend/monthly"><i class="ti-list"></i> <span class="title">Monthly Volume Trend</span></a></li>
						<li><a href="<?= base_url()?>fdsplit"><i class="ti-list"></i> <span class="title">Weekly FD Split (COD & N-COD)</span></a></li>
						<li><a href="<?= base_url()?>fdsplit/daily"><i class="ti-list"></i> <span class="title">Daily FD Split (COD & N-COD)</span></a></li>
						<li><a href="<?= base_url()?>fdsplit/monthly"><i class="ti-list"></i> <span class="title">Monthly FD Split (COD & N-COD)</span></a></li>
						<li><a href="<?= base_url()?>raw_data"><i class="ti-list"></i> <span class="title">Upload Data</span></a></li>
						<li><a href="<?= base_url()?>user"><i class="ti-list"></i> <span class="title">User</span></a></li>
						
					</ul>
					
				</nav>

				
				
			</div>
			<!-- END LEFT SIDEBAR -->