<header class="main-header">
	<a href="" class="logo">
        <img src="<?php echo image_url('hammeslogo-icon.png'); ?>" width="230"/></a>
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
        <a href="<?php echo base_url() ?>admin/capital/entries" class="menu-item" >
            <span>Capital Need List</span>
        </a>
        <a href="<?php echo base_url() ?>admin/panel/admin_user" class="menu-item" >
            <span>Users</span>
        </a>
        <a href="<?php echo base_url() ?>admin/capital/facilities" class="menu-item" >
            <span>Facilities</span>
        </a>
        <a href="<?php echo base_url() ?>admin/capital/components" class="menu-item" >
            <span>Settings</span>
        </a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs"><?php echo $user->first_name; ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<p><?php echo $user->first_name; ?></p>
						</li>
						<li class="user-footer">
							<div class="pull-left">
								<a href="panel/account" class="btn btn-default btn-flat">Account</a>
							</div>
							<div class="pull-right">
								<a href="panel/logout" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>