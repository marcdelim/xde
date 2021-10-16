
<body>
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">pro sidebar</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name"><?php echo $this->session->userdata('first_name') ?>
            <strong><?php echo $this->session->userdata('last_name') ?></strong>
          </span>
          <span class="user-role"><?php echo $this->session->userdata('role_name') ?></span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>Dashboard</span>
          </li>
          <li>
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
        
          <li class="header-menu">
            <span>Payment Request</span>
          </li>
          <li>
            <a href="<?php echo base_url()?>payment_request">
              <i class="fa fa-book"></i>
              <span>Payment Request</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="<?php echo base_url() ?>login/logout">
        <i class="fas fa-sign-out-alt">Logout</i>
      </a>
      
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  
  <!-- page-content" -->
