const overlay = document.getElementById('lightbox-overlay');
const lightboxImg = document.getElementById('lightbox-img');

// Seleziona tutte le immagini dentro i mockup
document.querySelectorAll('.phone-mockup img').forEach(img => {
    img.style.cursor = 'zoom-in';
    img.addEventListener('click', () => {
        const currentSrc = img.currentSrc || img.src;

        lightboxImg.src = currentSrc;
        overlay.style.display = 'flex';
        overlay.classList.add('show');
    });
});

// Chiudi immagine quando clicchi sull'overlay
overlay.addEventListener('click', () => {
    overlay.style.display = 'none';
    lightboxImg.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";
});