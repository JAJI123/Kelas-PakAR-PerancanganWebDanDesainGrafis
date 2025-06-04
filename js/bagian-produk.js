// Ganti gambar utama saat thumbnail diklik
function gantiGambar(elem) {
  const mainImage = document.getElementById("mainImage");
  mainImage.src = elem.src;
}

// Handle klik tombol warna agar aktif dan warna gelap
const warnaButtons = document.querySelectorAll(".warna");
warnaButtons.forEach(button => {
  button.addEventListener("click", () => {
    warnaButtons.forEach(btn => btn.classList.remove("active"));
    button.classList.add("active");
  });
});

// Handle tombol KUNJUNGI TOKO untuk toggle logo marketplace
const btnKunjungiToko = document.getElementById("btnKunjungiToko");
const marketplaceLogos = document.getElementById("marketplaceLogos");

btnKunjungiToko.addEventListener("click", () => {
  if (marketplaceLogos.style.display === "none" || marketplaceLogos.style.display === "") {
    marketplaceLogos.style.display = "flex";
    btnKunjungiToko.textContent = "KUNJUNGI TOKO";
  } else {
    marketplaceLogos.style.display = "none";
    btnKunjungiToko.textContent = "KUNJUNGI TOKO";
  }
});

// Ambil elemen gambar utama, modal, gambar di modal, dan tombol close modal
const mainImage = document.getElementById('mainImage');
const modal = document.getElementById('zoomModal');
const zoomedImage = document.getElementById('zoomedImage');
const closeBtn = document.querySelector('.modal .close');

// Saat gambar utama diklik
mainImage.addEventListener('click', () => {
  zoomedImage.src = mainImage.src;  // set gambar di modal sama dengan gambar utama
  modal.style.display = 'block';    // tampilkan modal
});

// Saat tombol close modal diklik
closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';    // sembunyikan modal
});

// Klik di luar gambar modal juga menutup modal
modal.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.style.display = 'none';
  }
});
