<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>&nbsp;</h3>
		<ul class="nav side-menu">
			<li {{ (Request::is('dash') ? 'class="active"' : '') }} ><a href="{{ url ('dash') }}"><i class="fa fa-home"></i> Dashboard </a></li>
			<li {{ (Request::is('request') ? 'class="active"' : '') }} ><a href="{{ url ('request') }}"><i class="fa  fa-circle-o-notch"></i> Request <span class="label label-success pull-right">5</span></a></li>
			<li {{ (Request::is('project') ? 'class="active"' : '') }} ><a href="{{ url ('project') }}" ><i class="fa fa-th-large"></i> Project </a></li>
			<li {{ (Request::is('employee') ? 'class="active"' : '') }} ><a href="{{ url ('employee') }}"><i class="fa fa-users"></i> Employee</a></li>
			<li {{ (Request::is('coffee') ? 'class="active"' : '') }} ><a href="{{ url ('coffee') }}"><i class="fa fa-coffee"></i> Coffee</a></li>
		</ul>
	</div>
</div>