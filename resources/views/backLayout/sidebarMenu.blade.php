<div class="left_col scroll-view">
  <div class="navbar nav_title" style="border: 0;">
  </div>


  <!-- menu profile quick info -->
  <div class="profile" style="text-align: center;">

    <img src="{{ URL::asset('/images/footer-logo.png') }}" alt="..." style="width: 150px;">
  </div>
  <!-- /menu profile quick info -->
  <br />

  <!-- sidebar menu -->
  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <!-- <h3>General</h3> -->
      <ul class="nav side-menu">
        @if (Sentinel::getUser()->hasAnyAccess(['user.*']))
        <li><a><i class="fa fa-users"></i>Users <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('user.index')}}">All users</a></li>
            <li><a href="{{route('user.create')}}">New user</a></li>
          </ul>
        </li>
        @endif
        @if (Sentinel::getUser()->hasAnyAccess(['role.*']))
        <li><a><i class="fa fa-cog"></i> Roles <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('role.index')}}">All Roles</a></li>
            <li><a href="{{route('role.create')}}">New Role</a></li>
          </ul>
        </li>
        @endif
        @if (Sentinel::getUser()->hasAnyAccess(['category.*']))
        <li><a><i class="fa fa-bookmark"></i> Categories <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{route('category.index')}}">All Categories</a></li>
            <li><a href="{{route('category.create')}}">New Category</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
    <div class="menu_section">
      <ul class="nav side-menu">
        <li><a href="{{url('dashboard')}}"><i class="fa fa-sitemap"></i>File Management</a></li>
        <li><a href="{{url('dashboard')}}"><i class="fa fa-book"></i>Products Digital Library</a></li>
        <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span
              class="label label-success pull-right">Coming Soon</span></a></li>
      </ul>
    </div>

  </div>
  <!-- /sidebar menu -->

  <!-- /menu footer buttons -->
  <div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
      <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
      <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
      <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
  </div>
  <!-- /menu footer buttons -->
</div>