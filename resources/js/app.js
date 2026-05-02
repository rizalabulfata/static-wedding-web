import { DotLottie } from '@lottiefiles/dotlottie-web';

// Lottie Animation
if (document.querySelector('#lottie-bird')) {
    new DotLottie({
        autoplay: true,
        loop: true,
        canvas: document.querySelector('#lottie-bird'),
        src: "https://lottie.host/5118d18a-3b00-4340-88b8-354c5c26c6dc/HaMsHTmpNH.lottie",
    });
}

// Guest name logic
const urlParams = new URLSearchParams(window.location.search);
const guestName = urlParams.get('to');
if (guestName && document.getElementById('guestName')) {
    document.getElementById('guestName').innerText = guestName;
}

// Opening Logic
const btnOpen = document.getElementById('btnOpen');
const cover = document.getElementById('cover');
const mainContent = document.getElementById('mainContent');
const bgMusic = document.getElementById('bgMusic');
const bottomNav = document.getElementById('bottomNav');
const btnAudio = document.getElementById('btnAudio');

if (btnOpen) {
    btnOpen.addEventListener('click', () => {
        cover.classList.add('opacity-0');
        setTimeout(() => {
            cover.style.display = 'none';
            document.body.classList.remove('locked');
            mainContent.classList.remove('opacity-0');
            btnAudio.classList.remove('opacity-0');

            // Mobile nav show
            bottomNav.classList.remove('translate-y-[200%]');
            // Desktop nav show
            bottomNav.classList.add('nav-visible');

            // Unlock right panel scroll on desktop
            const desktopRight = document.getElementById('desktopRight');
            if (desktopRight) {
                desktopRight.classList.add('unlocked');
            }

            if (bgMusic) {
                bgMusic.play().catch(e => console.log("Autoplay blocked"));
            }
        }, 1000);
    });
}

// Intersection Observer for Reveal Animations
const observerOptions = {
    threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('is-active');

            if (entry.target.classList.contains('reveal-right')) {
                entry.target.classList.add('animate-slide-right');
            }
            if (entry.target.classList.contains('reveal-left')) {
                entry.target.classList.add('animate-slide-left');
            }
        }
    });
}, observerOptions);

document.querySelectorAll('.reveal-up, .reveal-zoom, .reveal-right, .reveal-left').forEach(el => observer.observe(el));

// Countdown Timer
const targetDate = new Date("June 02, 2026 08:00:00").getTime();

function updateCountdown() {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance < 0) return;

    const d = Math.floor(distance / (1000 * 60 * 60 * 24));
    const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const s = Math.floor((distance % (1000 * 60)) / 1000);

    const daysEl = document.getElementById('days');
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');

    if (daysEl) daysEl.innerText = d.toString().padStart(2, '0');
    if (hoursEl) hoursEl.innerText = h.toString().padStart(2, '0');
    if (minutesEl) minutesEl.innerText = m.toString().padStart(2, '0');
    if (secondsEl) secondsEl.innerText = s.toString().padStart(2, '0');
}

if (document.getElementById('days')) {
    setInterval(updateCountdown, 1000);
    updateCountdown();
}

// Gift Modal Logic
const btnShowGift = document.getElementById('btnShowGift');
const btnCloseGift = document.getElementById('btnCloseGift');
const giftModal = document.getElementById('giftModal');

if (btnShowGift && btnCloseGift && giftModal) {
    const modalContent = giftModal.querySelector('div');

    btnShowGift.addEventListener('click', () => {
        giftModal.classList.remove('opacity-0', 'pointer-events-none');
        modalContent.classList.remove('scale-90');
    });

    btnCloseGift.addEventListener('click', () => {
        giftModal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.add('scale-90');
    });

    window.addEventListener('click', (event) => {
        if (event.target == giftModal) {
            btnCloseGift.click();
        }
    });
}

// Copy to Clipboard
window.copyToClipboard = function(text) {
    navigator.clipboard.writeText(text);
    alert('Nomor rekening berhasil disalin!');
}

// Audio Control Logic
if (btnAudio && bgMusic) {
    btnAudio.addEventListener('click', () => {
        if (bgMusic.paused) {
            bgMusic.play();
            document.getElementById('iconPlay').classList.add('hidden');
            document.getElementById('iconPause').classList.remove('hidden');
        } else {
            bgMusic.pause();
            document.getElementById('iconPlay').classList.remove('hidden');
            document.getElementById('iconPause').classList.add('hidden');
        }
    });
}

const scrollContainer = window.innerWidth >= 768
    ? document.getElementById('desktopRight')
    : window;

if (scrollContainer) {
    scrollContainer.addEventListener('scroll', () => {
        const scrollTop = window.innerWidth >= 768
            ? document.getElementById('desktopRight').scrollTop
            : window.scrollY;

        // Progress Line
        const storySection = document.getElementById('story');
        const progressLine = document.getElementById('progressLine');
        if (storySection && progressLine) {
            const storyTop = storySection.offsetTop;
            const storyHeight = storySection.offsetHeight;
            const scrollPos = scrollTop + window.innerHeight / 2;
            if (scrollPos > storyTop && scrollPos < storyTop + storyHeight) {
                const progress = ((scrollPos - storyTop) / storyHeight) * 100;
                progressLine.style.height = `${Math.min(progress, 100)}%`;
            }
        }

        // Scroll Spy
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('#bottomNav a');
        let current = '';
        sections.forEach(section => {
            if (scrollTop >= section.offsetTop - 100) {
                current = section.getAttribute('id');
            }
        });
        navLinks.forEach(link => {
            link.classList.remove('text-forest-900', 'font-bold');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('text-forest-900', 'font-bold');
            }
        });
    });
}
