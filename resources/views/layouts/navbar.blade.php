<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar container">
  <ul class="navbar-nav navbar-right ml-auto">
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user mr-auto">
        @if (auth()->user())
        <img alt="image" src="{{ asset('storage') }}/image/profille/{{ auth()->user()->image }}" class="rounded-circle mr-1">
        @else
        <img alt="image" src="{{ asset('storage') }}/image/profille/{{ auth()->guard('muzakki')->user()->image ?? auth()->user()->image }}" class="rounded-circle mr-1">
        @endif
      <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->guard('muzakki')->user()->name ?? auth()->user()->name }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        @if (auth()->user())
        <a href="{{ route('amil.profile') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        @else
        <a href="{{ route('muzakki.profile') }}" class="dropdown-item has-icon">
          <i class="far fa-user"></i> Profile
        </a>
        @endif
     
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item has-icon text-danger" onclick="logOut()">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>