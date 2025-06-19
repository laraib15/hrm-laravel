<header>
    <label for="check">
    <i class="fas fa-bars" id="sidebar_btn"></i>
    </label>
    <div class="left_area">
        <h3>HRM<span>System</span></h3>
    </div>
    <div class="right_area">
    <a href="{{ route('logout') }}" class="logout_btn" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    </div>
    </header>
    <!--header area end-->


    <!--sidebar start-->
    <div class="sidebar">
    <div class="profile_info">
  <img src=<img src="{{asset('assets/images/users/1.jpg')}}"  class="profile_image" alt="">
    <h4>{{Auth::user()->name}}</h4>
    </div>
    <a href="{{ route('user.dashboard') }}"><i class="fas fa-desktop"></i><span>Dashboard</span></a>

   @if(auth()->user()->hasRole('Admin'))
    <button class="dropdown-btn"><a href="#"><i class="fas fa-user-tie"></i><span>Employee</span>
        <i class="fa fa-caret-down"></i></a>
      </button>
      <div class="dropdown-container">
        <a href="{{ route('employee.add') }}"><span>Add Employee</span></a>
        <a href="{{ route('employee.view') }}"><span>List Employee</span></a>

      </div>

      <button class="dropdown-btn"><a  href="#"><i class="fas fa-building"></i><span> Departments</span>
        <i class="fa fa-caret-down"></i></a>
      </button>

      <div class="dropdown-container">
        <a href="{{ route('department.view') }}">Departments</a>
    <a href="{{ route('department.add') }}">Add Department</a>
      </div>
        @endif

      @if( auth()->user()->role_id == 1 )
      <button class="dropdown-btn"><a href="#"><i class="far fa-calendar-check"></i><span>Attendance</span>
        <i class="fa fa-caret-down"></i></a>
      </button>
      <div class="dropdown-container">
        <a href="{{ route('admin.attendance') }}"><span>View Attendance</span></a>
        <a href="{{ route('attendance.report') }}"><span>Attendance Report</span></a>

      </div>

   @endif
   @if( auth()->user()->role_id == 2 )
    <a href="{{ route('attendance.view') }}"><i class="far fa-calendar-check"></i><span>Attendance</span></a>
    @endif

    <button class="dropdown-btn"><a href="#"><i class="fas fa-bed"></i><span>Leave</span>
        <i class="fa fa-caret-down"></i></a>
      </button>
      <div class="dropdown-container">
        <a href="{{ route('leave.add') }}"><span>Apply for Leave</span></a>
        <a href="{{ route('leave.view') }}"><span>Leave</span></a>

      </div>
        @if(auth()->user()->hasRole('Admin'))
      <button class="dropdown-btn"><a href="#"><i class="fas fa-user-lock"></i><span>Roles</span>
        <i class="fa fa-caret-down"></i></a>
      </button>
      <div class="dropdown-container">
        <a href="{{ route('role.create') }}"><span>Create</span></a>
        <a href="{{ route('role.view') }}"><span>View</span></a>

      </div>
        @endif
      @if(auth()->user()->hasRole('Admin'))
      <button class="dropdown-btn"><a href="#"><i class="fas fa-lock"></i><span>Permission</span>
        <i class="fa fa-caret-down"></i></a>
      </button>
      <div class="dropdown-container">
        <a href="{{ route('permission.create') }}"><span>Create</span></a>
        <a href="{{ route('permission.view') }}"><span>View</span></a>

      </div>
@endif

<a href="#"><i class="far fa-money-bill-alt"></i><span>payroll</span></a>
</div>
    <!--sidebar end-->
