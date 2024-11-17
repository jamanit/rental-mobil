// #################################################################################################################################
// fade animate
document.addEventListener("DOMContentLoaded", function () {
  AOS.init({
    duration: 2000,
    easing: "ease",
    once: true,
    offset: 100,
  });
});

window.addEventListener('load', function () {
  AOS.refresh();
});

window.addEventListener("scroll", () => {
  if (window.scrollY > 500) {
    AOS.refresh();
  }
});

function reloadAOS() {
  const aosElements = document.querySelectorAll('[data-aos]');
  aosElements.forEach(element => {
    element.classList.remove('aos-animate');
  });

  AOS.refresh();
}

// #################################################################################################################################
// Hapus fragment URL setelah Fancybox terbuka
Fancybox.bind("[data-fancybox='gallery']", {
  on: {
    ready: (fancybox) => {
      history.replaceState(null, null, ' ');
    },
  },
});

// #################################################################################################################################
// Mobile menu toggle script
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const closeMenuButton = document.getElementById('close-menu-button');
const navbar = document.getElementById('navbar');
const navbarLinks = document.getElementById('navbar-links');
const brandName = document.getElementById('brand-name');
const overlay = document.getElementById('overlay');

// Function to close mobile menu
function closeMobileMenu() {
  mobileMenu.classList.remove('slide-left-active');
  overlay.classList.remove('overlay-active');
}

// Open mobile menu
mobileMenuButton.addEventListener('click', function () {
  mobileMenu.classList.add('slide-left-active');
  overlay.classList.add('overlay-active');
});

// Close mobile menu on close button click
closeMenuButton.addEventListener('click', closeMobileMenu);

// Close mobile menu on overlay click
overlay.addEventListener('click', closeMobileMenu);

// Close mobile menu when a link is clicked
const mobileMenuLinks = mobileMenu.querySelectorAll('a'); // Select all links inside the mobile menu
mobileMenuLinks.forEach(link => {
  link.addEventListener('click', closeMobileMenu); // Close menu on link click
});

// Close mobile menu on resize
window.addEventListener('resize', function () {
  if (window.innerWidth >= 768) {
    closeMobileMenu(); // Close menu if window is resized to desktop size
  }
});

// Function to update navbar styles based on scroll position
function updateNavbarStyles() {
  if (window.scrollY > 50) { // Adjust number as needed
    navbar.classList.remove('bg-transparent');
    navbar.classList.add('bg-blue-500', 'shadow-md'); // Add background color and shadow

    mobileMenuButton.classList.remove('hover:text-blue-500');
    mobileMenuButton.classList.add('hover:text-gray-800');

    brandName.classList.remove('hover:text-blue-500');
    brandName.classList.add('hover:text-gray-800');

    navbarLinks.classList.add('hover:text-gray-800'); // Add hover effect class
    navbarLinks.querySelectorAll('a').forEach(link => {
      link.classList.remove('hover:text-blue-500'); // Remove previous hover effect
      link.classList.add('hover:text-gray-800'); // Add new hover effect
    });
  } else {
    navbar.classList.add('bg-transparent');
    navbar.classList.remove('bg-blue-500', 'shadow-md'); // Remove background color and shadow

    mobileMenuButton.classList.add('hover:text-blue-500');
    mobileMenuButton.classList.remove('hover:text-gray-800');

    brandName.classList.add('hover:text-blue-500');
    brandName.classList.remove('hover:text-gray-800');

    navbarLinks.classList.remove('hover:text-gray-800'); // Remove hover effect class
    navbarLinks.querySelectorAll('a').forEach(link => {
      link.classList.add('hover:text-blue-500'); // Restore previous hover effect
      link.classList.remove('hover:text-gray-800'); // Remove gray hover effect
    });
  }
}

// Event listener for scroll
window.addEventListener('scroll', updateNavbarStyles);

// Check scroll position on page load
document.addEventListener('DOMContentLoaded', updateNavbarStyles);

// #################################################################################################################################
// Scrolling Up Down
document.addEventListener("DOMContentLoaded", function () {
  const scrollUpButton = document.getElementById("scrollUp");
  const scrollDownButton = document.getElementById("scrollDown");

  // Fungsi untuk menggulir ke atas
  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }

  // Fungsi untuk menggulir ke bawah
  function scrollToBottom() {
    window.scrollTo({
      top: document.body.scrollHeight,
      behavior: "smooth"
    });
  }

  // Tampilkan atau sembunyikan tombol berdasarkan posisi scroll
  window.addEventListener("scroll", function () {
    const scrollPosition = window.scrollY;
    const documentHeight = document.body.scrollHeight;
    const windowHeight = window.innerHeight;

    // Tampilkan tombol scroll up jika tidak di posisi paling atas
    if (scrollPosition > 0) {
      scrollUpButton.style.display = "block";
    } else {
      scrollUpButton.style.display = "none";
    }

    // Tampilkan tombol scroll down jika tidak di posisi paling bawah
    if (scrollPosition + windowHeight < documentHeight - 10) {
      scrollDownButton.style.display = "block";
    } else {
      scrollDownButton.style.display = "none";
    }
  });

  // Tambahkan event listener untuk tombol scroll up
  scrollUpButton.addEventListener("click", scrollToTop);

  // Tambahkan event listener untuk tombol scroll down
  scrollDownButton.addEventListener("click", scrollToBottom);
});

