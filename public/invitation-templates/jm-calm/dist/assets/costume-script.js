// #################################################################################################################################
// fade animate
document.addEventListener("DOMContentLoaded", function () {
  AOS.init({
    duration: 2000,
    easing: "ease",
    once: true,
    offset: 100,
    debug: true,
  });
});

window.addEventListener("load", function () {
  AOS.refresh();
});

window.addEventListener("scroll", () => {
  if (window.scrollY > 500) {
    AOS.refresh();
  }
});

function reloadAOS() {
  const aosElements = document.querySelectorAll("[data-aos]");
  aosElements.forEach((element) => {
    element.classList.remove("aos-animate");
  });

  AOS.refresh();
}

// #################################################################################################################################
// Hapus fragment URL setelah Fancybox terbuka
Fancybox.bind("[data-fancybox='gallery']", {
  on: {
    ready: (fancybox) => {
      history.replaceState(null, null, " ");
    },
  },
});

// #################################################################################################################################
// fungsi menu dan section
function setActive(element, sectionId, color) {
  // Hapus kelas 'active' dari semua item
  const items = document.querySelectorAll(".menu-item");
  items.forEach((item) => item.classList.remove("bg-gray-700", color));

  // Tambahkan kelas 'active' ke item yang dipilih
  element.classList.add("bg-gray-700", color);

  // Scroll ke tengah elemen yang dipilih
  const menu = document.getElementById("menu");
  const itemRect = element.getBoundingClientRect();
  const menuRect = menu.getBoundingClientRect();

  // Hitung scroll agar elemen aktif berada di tengah
  const scrollPosition = itemRect.left + itemRect.width / 2 - (menuRect.left + menuRect.width / 2);

  // Scroll menu ke posisi yang sesuai
  menu.scrollBy({
    left: scrollPosition,
    behavior: "smooth",
  });

  showSection(sectionId);
}

function showSection(sectionId) {
  // Sembunyikan semua section
  const sections = document.querySelectorAll("section");
  sections.forEach((section) => {
    section.classList.add("hidden");
  });

  // Tampilkan section yang dipilih
  const activeSection = document.getElementById(sectionId);
  if (activeSection) {
    activeSection.classList.remove("hidden");
  }

  reloadAOS();
}

// #################################################################################################################################
let isAudioPausedManually = false;

function openInvitation(color) {
  // Menampilkan menu
  const menu = document.getElementById("bottom-footer");
  menu.classList.remove("hidden");

  // Memutar musik
  const audio = document.getElementById("background-audio");
  audio.play();

  const toggleAudioButton = document.getElementById("toggle-audio");
  toggleAudioButton.classList.remove("hidden");
  toggleAudioButton.innerHTML = '<i class="fas fa-pause"></i>';

  // Menampilkan section dan set active pada menu
  const sectionId = "quote-section";
  showSection(sectionId); // Menampilkan section

  // Temukan item menu untuk 'quote-section'
  const menuItems = document.querySelectorAll(".menu-item");
  menuItems.forEach((item) => {
    if (item.querySelector("span").innerText === "Kutipan") {
      setActive(item, sectionId, color); // Set active pada item menu yang sesuai
    }
  });

  AOS.refresh();
}

function toggleAudio() {
  const audio = document.getElementById("background-audio");
  const toggleAudioButton = document.getElementById("toggle-audio");

  if (audio.paused) {
    audio.play();
    toggleAudioButton.innerHTML = '<i class="fas fa-pause"></i>';
    isAudioPausedManually = false;
  } else {
    audio.pause();
    toggleAudioButton.innerHTML = '<i class="fas fa-music"></i>';
    isAudioPausedManually = true;
  }
}

// Matikan atau hidupkan musik saat tab tidak aktif/aktif, kecuali jika musik dimatikan secara manual
document.addEventListener("visibilitychange", function () {
  const audio = document.getElementById("background-audio");
  const toggleAudioButton = document.getElementById("toggle-audio");

  if (document.hidden) {
    // Jika pengguna pindah tab, matikan musik
    if (!audio.paused) {
      audio.pause();
      toggleAudioButton.innerHTML = '<i class="fas fa-music"></i>';
    }
  } else {
    // Jika pengguna kembali ke tab, hidupkan musik jika tidak dimatikan secara manual
    if (!isAudioPausedManually && audio.paused) {
      audio.play();
      toggleAudioButton.innerHTML = '<i class="fas fa-pause"></i>';
    }
  }
});

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
        text: "Teks berhasil disalin.",
        icon: "success",
        toast: true, // Mengaktifkan mode toast
        position: 'top-end', // Atur posisi toast
        showConfirmButton: false, // Menyembunyikan tombol konfirmasi
        timer: 3000, // Waktu tampil dalam milidetik 
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

// #################################################################################################################################
const countdownElement = document.getElementById('countdown');
const targetDate = countdownElement.getAttribute('data-countdown');

// Jika nearest_date null atau tidak valid, set countdown ke 00
if (!targetDate) {
  document.getElementById('days').innerText = "00";
  document.getElementById('hours').innerText = "00";
  document.getElementById('minutes').innerText = "00";
  document.getElementById('seconds').innerText = "00";
} else {
  const countdownTarget = moment(targetDate);

  // Fungsi untuk memperbarui countdown setiap detik
  function updateCountdown() {
    const now = moment();
    const duration = moment.duration(countdownTarget.diff(now));

    if (duration.asMilliseconds() < 0) {
      document.getElementById('days').innerText = "00";
      document.getElementById('hours').innerText = "00";
      document.getElementById('minutes').innerText = "00";
      document.getElementById('seconds').innerText = "00";
      clearInterval(countdownInterval);
      return;
    }

    const days = Math.floor(duration.asDays());
    const hours = duration.hours();
    const minutes = duration.minutes();
    const seconds = duration.seconds();

    document.getElementById('days').innerText = String(days).padStart(2, '0');
    document.getElementById('hours').innerText = String(hours).padStart(2, '0');
    document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
    document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
  }

  // Memperbarui countdown setiap detik
  const countdownInterval = setInterval(updateCountdown, 1000);
}
