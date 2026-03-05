/**
 * BUS365 Admin Dashboard - Shared JavaScript
 * Centralized JS for common functionality across all pages
 */

// ================================
// Initialize on DOM Ready
// ================================
document.addEventListener('DOMContentLoaded', function() {
  initializeSidebar();
  initializeFullscreen();
  initializeNavigation();
  initializeClock();
  initializeTooltips();
});

// ================================
// Sidebar Toggle
// ================================
function initializeSidebar() {
  const toggleBtn = document.getElementById('toggleSidebar');
  if (!toggleBtn) return;

  toggleBtn.addEventListener('click', function() {
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');
    
    if (sidebar) sidebar.classList.toggle('collapsed');
    if (content) content.classList.toggle('expanded');
  });
}

// ================================
// Fullscreen Toggle
// ================================
function initializeFullscreen() {
  const fullscreenBtn = document.getElementById('fullscreenToggle');
  if (!fullscreenBtn) return;

  fullscreenBtn.addEventListener('click', function() {
    if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen().catch(err => {
        console.log(`Error attempting to enable fullscreen: ${err.message}`);
      });
      this.innerHTML = '<i class="fas fa-compress"></i>';
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
        this.innerHTML = '<i class="fas fa-expand"></i>';
      }
    }
  });
}

// ================================
// Navigation Active State
// ================================
function initializeNavigation() {
  updateActiveNav();
  window.addEventListener('hashchange', updateActiveNav);
}

function updateActiveNav() {
  const currentFile = window.location.pathname.split('/').pop();
  const currentHash = window.location.hash;
  
  // Handle empty filename (root path)
  const fileName = currentFile || 'index.html';
  
  document.querySelectorAll('.sidebar .nav-link').forEach(link => {
    link.classList.remove('active');
    const href = link.getAttribute('href');
    
    if (!href) return;
    
    // Check for .html links
    if (href.includes('.html')) {
      const hrefParts = href.split('#');
      const hrefFile = hrefParts[0];
      const hrefHash = hrefParts[1] || '';
      
      if (hrefFile === currentFile || hrefFile === './' + currentFile || hrefFile === fileName) {
        if (!hrefHash || hrefHash === currentHash.replace('#', '')) {
          link.classList.add('active');
          openParentSubmenu(link);
        }
      }
    }
    // Check for hash links on current page
    else if (href.startsWith('#') && href === currentHash) {
      link.classList.add('active');
      openParentSubmenu(link);
    }
  });
  
  // Handle Dashboard as default
  if (!fileName || fileName === '' || fileName === 'index.html' || fileName === 'Dashboard.html') {
    const dashboardLink = document.querySelector('a[href="Dashboard.html"]');
    if (dashboardLink) dashboardLink.classList.add('active');
  }
}

function openParentSubmenu(link) {
  const submenu = link.closest('.submenu');
  if (submenu) {
    // Check if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
      const bsCollapse = bootstrap.Collapse.getInstance(submenu);
      if (!bsCollapse) {
        new bootstrap.Collapse(submenu, { show: true });
      } else {
        bsCollapse.show();
      }
    }
    
    const toggle = submenu.previousElementSibling;
    if (toggle) {
      toggle.setAttribute('aria-expanded', 'true');
      toggle.classList.add('active');
    }
  }
}

// ================================
// Dynamic Clock
// ================================
function initializeClock() {
  updateClock();
  setInterval(updateClock, 1000);
  
  // Update on visibility change
  document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
      updateClock();
    }
  });
}

function updateClock() {
  const clockElement = document.getElementById('clock');
  if (!clockElement) return;
  
  const now = new Date();
  const hours = String(now.getHours()).padStart(2, '0');
  const minutes = String(now.getMinutes()).padStart(2, '0');
  const seconds = String(now.getSeconds()).padStart(2, '0');
  
  clockElement.textContent = `${hours}:${minutes}:${seconds}`;
}

// ================================
// Bootstrap Tooltips
// ================================
function initializeTooltips() {
  if (typeof bootstrap === 'undefined') return;
  
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
}

// ================================
// Utility Functions
// ================================

/**
 * Show loading screen
 */
function showLoading() {
  const loadingScreen = document.getElementById('loadingScreen');
  if (loadingScreen) {
    loadingScreen.style.display = 'flex';
  }
}

/**
 * Hide loading screen
 */
function hideLoading() {
  const loadingScreen = document.getElementById('loadingScreen');
  if (loadingScreen) {
    loadingScreen.style.display = 'none';
  }
}

/**
 * Hide loading screen after a delay (used on page load)
 */
function hideLoadingAfterDelay(delay = 1500) {
  setTimeout(() => {
    hideLoading();
  }, delay);
}

/**
 * Format currency
 */
function formatCurrency(amount) {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD'
  }).format(amount);
}

/**
 * Format date
 */
function formatDate(date) {
  if (typeof date === 'string') {
    date = new Date(date);
  }
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  });
}

/**
 * Animate counter
 */
function animateCounter(element, target) {
  let current = 0;
  const increment = target / 50;
  const timer = setInterval(() => {
    current += increment;
    if (current >= target) {
      element.textContent = target;
      clearInterval(timer);
    } else {
      element.textContent = Math.floor(current);
    }
  }, 30);
}

/**
 * Show alert notification
 */
function showAlert(message, type = 'info') {
  // Create alert element
  const alertDiv = document.createElement('div');
  alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
  alertDiv.setAttribute('role', 'alert');
  alertDiv.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;
  
  // Add to page
  const container = document.querySelector('.content') || document.body;
  container.insertBefore(alertDiv, container.firstChild);
  
  // Auto-remove after 5 seconds
  setTimeout(() => {
    alertDiv.remove();
  }, 5000);
}

/**
 * Debounce function for search/input handlers
 */
function debounce(func, delay) {
  let timeoutId;
  return function(...args) {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => func.apply(this, args), delay);
  };
}
