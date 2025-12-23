<nav class="navbar navbar-expand-lg pkpal border-bottom">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <x-application-logo class="h-30 w-auto" />
    </a>

    <!-- Hamburger / Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <style>
      :root{
        --color-secondary:#16b3ac; --color-accent:#d2dc02; --color-main:#ffffff;
      }
      .navbar.pkpal {
        background: var(--color-secondary) !important;
      }
      .navbar.pkpal .nav-link, .navbar.pkpal .navbar-brand { color:#fff !important; }
      .navbar.pkpal .nav-link.active { text-decoration: underline; text-underline-offset: 4px; }
    </style>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        @if(Auth::user() && Auth::user()->role === 'admin')
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.penumpang.*') ? 'active' : '' }}" href="{{ route('admin.penumpang.index') }}">Data Penumpang</a>
          </li>
        @endif
      </ul>

      <!-- User Dropdown -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Log Out</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
