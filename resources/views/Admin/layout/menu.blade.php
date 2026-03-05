<div class="header">
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-secondary d-md-none me-3" id="toggleSidebar">
          <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="langDropdown" data-bs-toggle="dropdown">
            English
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">English</a></li>
            <li><a class="dropdown-item" href="#">Français</a></li>
            <li><a class="dropdown-item" href="#">Español</a></li>
          </ul>
        </div>
        <button class="btn btn-outline-secondary ms-2" id="fullscreenToggle">
          <i class="fas fa-expand"></i>
        </button>
      </div>
      <div class="btn-group">
        <button class="btn btn-outline-secondary">
          <i class="fas fa-user"></i>
        </button>
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
            <i class="fas fa-cog"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><h6 class="dropdown-header">Super Admin</h6></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Account Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Sign Out</a></li>
          </ul>
        </div>
        <!-- Horloge dynamique -->
        <span class="time-display" id="clock">12:27:31</span>
      </div>
    </div>
