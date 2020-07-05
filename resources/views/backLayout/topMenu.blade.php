<nav class="" role="navigation">
  <div class="nav toggle">
    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
  </div>

  <ul class="nav navbar-nav navbar-right">
    <li class="">
      <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        Account
        <span class=" fa fa-angle-down"></span>
      </a>
      <ul class="dropdown-menu dropdown-usermenu pull-right">
        <li><a href="{{route('user.edit', Sentinel::getUser()->id)}}" class="edit-profile">Edit Profile</a></li>
        {!! Form::open(['url' => url('logout'),'class'=>'form-inline', 'id'=>'toplogoutform']) !!}
        {!! csrf_field() !!}
        <li><button class="btn btn-primary btn-block" type="submit">Log Out</button> </li>
        {!! Form::close() !!}
      </ul>
    </li>

    <li role="presentation" class="dropdown">
      <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-green">5</span>
      </a>
      <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        <li>
          <a>
            <span>
              <span class="time">3 mins ago</span>
            </span>
            <br/>
            <span class="message">
              Film festivals used to be do-or-die moments for movie makers. They were where...
            </span>
          </a>
        </li>
        <li>
          <a>
            <span>
              <span class="time">3 mins ago</span>
            </span>
            <br/>
            <span class="message">
              Film festivals used to be do-or-die moments for movie makers. They were where...
            </span>
          </a>
        </li>
        <li>
          <a>
            <span>
              <span class="time">3 mins ago</span>
            </span>
            <br/>
            <span class="message">
              Film festivals used to be do-or-die moments for movie makers. They were where...
            </span>
          </a>
        </li>
        <li>
          <div class="text-center">
            <a>
              <strong>See All Alerts</strong>
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</nav>