/**
 * Navigation utilities
 */

/**
 * Initialize responsive navigation behaviors
 */
document.addEventListener('DOMContentLoaded', () => {
  handleResponsiveLayout();
  
  // Handle window resize
  window.addEventListener('resize', handleResponsiveLayout);
});

/**
 * Handle responsive layout changes
 */
function handleResponsiveLayout() {
  const isMobile = window.innerWidth <= 768;
  
  if (isMobile) {
    setupMobileNavigation();
  } else {
    setupDesktopNavigation();
  }
}

/**
 * Setup mobile-specific navigation
 */
function setupMobileNavigation() {
  // Mobile navigation menu logic if needed
  const sidebarItems = document.querySelectorAll('.sidebar-nav li a');
  
  sidebarItems.forEach(item => {
    item.addEventListener('click', function(e) {
      // Close mobile menu if implemented
    });
  });
}

/**
 * Setup desktop-specific navigation
 */
function setupDesktopNavigation() {
  // Desktop navigation logic if needed
}

/**
 * Add smooth scrolling for in-page navigation
 * @param {string} targetId - The ID of the element to scroll to
 */
function scrollToElement(targetId) {
  const element = document.getElementById(targetId);
  if (element) {
    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }
}

/**
 * Handle animation of elements when they enter the viewport
 */
function setupScrollAnimations() {
  const animatedElements = document.querySelectorAll('.animate-on-scroll');
  
  // Simple scroll detection
  function checkScroll() {
    animatedElements.forEach(el => {
      const elementTop = el.getBoundingClientRect().top;
      const elementVisible = 150; // Pixels from top when animation starts
      
      if (elementTop < window.innerHeight - elementVisible) {
        el.classList.add('visible');
      }
    });
  }
  
  // Run on page load
  checkScroll();
  
  // Run on scroll
  window.addEventListener('scroll', checkScroll);
}

// Initialize scroll animations if needed
document.addEventListener('DOMContentLoaded', () => {
  setupScrollAnimations();
});