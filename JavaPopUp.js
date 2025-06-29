<script>
function togglePopup() {
    const popup = document.getElementById('popup-ecommerce');
    popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
}

// Sembunyikan popup saat klik di luar area popup
document.addEventListener('click', function(event) {
    const popup = document.getElementById('popup-ecommerce');
    const button = document.querySelector('.kunjungi-toko');
    if (!popup.contains(event.target) && !button.contains(event.target)) {
        popup.style.display = 'none';
    }
});

  document.addEventListener('DOMContentLoaded', function () {
    updateKeranjangBadge();
  });
</script>

