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
// Variabel untuk melacak status audio apakah dimatikan secara manual
let isMusicPausedManually = false;

// Fungsi untuk membuka undangan dan memutar audio
function openInvitation() {
  const content = document.getElementById("content");
  content.classList.remove("overflow-y-hidden");
  content.classList.remove("h-screen");
  content.classList.add("h-full");

  const additionalSection = document.getElementById("secondary-section");
  additionalSection.scrollIntoView({ behavior: "smooth" });

  const audio = document.getElementById("background-audio");
  audio.play();

  const toggleMusicButton = document.getElementById("toggle-audio");
  toggleMusicButton.style.display = "block";
  toggleMusicButton.innerHTML = '<i class="fas fa-pause"></i>';
}

// Fungsi untuk mengontrol audio (play/pause)
function toggleMusic() {
  const audio = document.getElementById("background-audio");
  const toggleMusicButton = document.getElementById("toggle-audio");

  if (audio.paused) {
    audio.play();
    toggleMusicButton.innerHTML = '<i class="fas fa-pause"></i>';
    isMusicPausedManually = false; // Reset karena audio dimainkan
  } else {
    audio.pause();
    toggleMusicButton.innerHTML = '<i class="fas fa-music"></i>';
    isMusicPausedManually = true; // Tandai bahwa audio dimatikan secara manual
  }
}

// Event listener untuk tombol buka undangan
document.getElementById("open-invitation").addEventListener("click", openInvitation);

// Event listener untuk tombol toggle audio
document.getElementById("toggle-audio").addEventListener("click", toggleMusic);

// Matikan atau hidupkan audio saat tab tidak aktif/aktif, kecuali jika audio dimatikan secara manual
document.addEventListener("visibilitychange", function () {
  const audio = document.getElementById("background-audio");
  const toggleMusicButton = document.getElementById("toggle-audio");

  if (document.hidden) {
    // Jika pengguna pindah tab, matikan audio
    if (!audio.paused) {
      audio.pause();
      toggleMusicButton.innerHTML = '<i class="fas fa-music"></i>';
    }
  } else {
    // Jika pengguna kembali ke tab, hidupkan audio jika tidak dimatikan secara manual
    if (!isMusicPausedManually && audio.paused) {
      audio.play();
      toggleMusicButton.innerHTML = '<i class="fas fa-pause"></i>';
    }
  }
});

// #################################################################################################################################
// Fungsi untuk mengelola slideshow
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");

function showSlide(index) {
  slides.forEach((slide, i) => {
    if (i === index) {
      slide.classList.remove("hidden");
    } else {
      slide.classList.add("hidden");
    }
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

showSlide(currentSlide);
setInterval(nextSlide, 5000);

// #################################################################################################################################
// gift modal
document.addEventListener("DOMContentLoaded", function () {
  const openModalBtn = document.getElementById("open-modal");
  const modal = document.getElementById("gift-modal");
  const closeModalBtn = document.getElementById("close-modal");

  if (openModalBtn && modal && closeModalBtn) {
    openModalBtn.addEventListener("click", function () {
      modal.classList.remove("hidden");
    });

    closeModalBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
    });

    window.addEventListener("click", function (event) {
      if (event.target === modal) {
        modal.classList.add("hidden");
      }
    });
  }
});

// #################################################################################################################################
// Fungsi untuk menyalin teks ke clipboard
function copyToClipboard(color, text) {
  navigator.clipboard
    .writeText(text)
    .then(() => {
      Swal.fire({
        title: "Berhasil!",
        text: "Data berhasil disalin.",
        icon: "success",
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
      });

    })
    .catch((err) => {
      console.error("Gagal menyalin teks", err);
      Swal.fire({
        title: "Gagal!",
        text: "Gagal menyalin teks",
        icon: "error",
        customClass: {
          confirmButton: color,
        },
      });
    });
}

// #################################################################################################################################
// Fungsi guest presence 
function toggleGuestInput(isHadir) {
  const guestInputDiv = document.getElementById('guest_input');
  const guestTotalsInput = document.getElementById('guest_totals');

  if (isHadir) {
    guestInputDiv.style.display = 'block';
  } else {
    guestInputDiv.style.display = 'none';
    guestTotalsInput.value = '';
  }
}


