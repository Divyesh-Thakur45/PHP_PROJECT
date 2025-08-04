// DOM Content Loaded
document.addEventListener("DOMContentLoaded", () => {
  // Mobile Menu Toggle
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const mainNavigation = document.querySelector(".main-navigation");

  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", function () {
      mainNavigation.classList.toggle("active");
      this.classList.toggle("active");
    });
  }

  // Sign In Modal
  const signInBtn = document.getElementById("signInBtn");
  const signInModal = document.getElementById("signInModal");
  const closeModal = document.querySelector(".close");

  if (signInBtn && signInModal) {
    signInBtn.addEventListener("click", (e) => {
      e.preventDefault();
      signInModal.style.display = "block";
    });
  }

  if (closeModal) {
    closeModal.addEventListener("click", () => {
      signInModal.style.display = "none";
    });
  }

  // Close modal when clicking outside
  window.addEventListener("click", (e) => {
    if (e.target === signInModal) {
      signInModal.style.display = "none";
    }
  });

  // Search Functionality
  const searchInput = document.getElementById("searchInput");
  const searchForm = document.querySelector(".search-form");

  if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const searchTerm = searchInput.value.trim();
      if (searchTerm) {
        // Implement search functionality here
        console.log("Searching for:", searchTerm);
        // You can redirect to search results page or implement AJAX search
      }
    });
  }

  // Cart functionality
  let cartCount = 0;
  const cartCountElement = document.querySelector(".cart-count");

  function updateCartCount() {
    if (cartCountElement) {
      cartCountElement.textContent = cartCount;
    }
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });

  // Sticky header effect
  const navbar = document.querySelector(".navbar");
  let lastScrollTop = 0;

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > 100) {
      // Scrolling down
      navbar.style.transform = "translateY(-100%)";
    } else {
      // Scrolling up
      navbar.style.transform = "translateY(0)";
    }

    lastScrollTop = scrollTop;
  });

  // Add loading animation for images
  const images = document.querySelectorAll("img");
  images.forEach((img) => {
    img.addEventListener("load", function () {
      this.style.opacity = "1";
    });

    // Set initial opacity
    img.style.opacity = "0";
    img.style.transition = "opacity 0.3s ease";
  });

  // Form validation
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
      const inputs = form.querySelectorAll("input[required]");
      let isValid = true;

      inputs.forEach((input) => {
        if (!input.value.trim()) {
          isValid = false;
          input.style.borderColor = "#dc3545";
        } else {
          input.style.borderColor = "#28a745";
        }
      });

      if (!isValid) {
        e.preventDefault();
        alert("Please fill in all required fields.");
      }
    });
  });

  // Add to cart function (example)
  function addToCart(productId, productName) {
    // Implement add to cart logic here
    cartCount++;
    updateCartCount();
    showNotification(`${productName} added to cart!`, "success");
  }
});

// Utility functions
function showNotification(message, type = "info") {
  const notification = document.createElement("div");
  notification.className = `notification notification-${type}`;
  notification.textContent = message;

  // Style the notification
  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        z-index: 3000;
        opacity: 0;
        transform: translateX(100%);
        transition: all 0.3s ease;
    `;

  // Set background color based on type
  switch (type) {
    case "success":
      notification.style.backgroundColor = "#28a745";
      break;
    case "error":
      notification.style.backgroundColor = "#dc3545";
      break;
    case "warning":
      notification.style.backgroundColor = "#ffc107";
      notification.style.color = "#333";
      break;
    default:
      notification.style.backgroundColor = "#007bff";
  }

  document.body.appendChild(notification);

  // Animate in
  setTimeout(() => {
    notification.style.opacity = "1";
    notification.style.transform = "translateX(0)";
  }, 100);

  // Remove after 3 seconds
  setTimeout(() => {
    notification.style.opacity = "0";
    notification.style.transform = "translateX(100%)";
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}
