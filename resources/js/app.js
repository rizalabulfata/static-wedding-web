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

// Save the Date Logic
const btnSaveDate = document.getElementById('btnSaveDate');
if (btnSaveDate) {
    btnSaveDate.addEventListener('click', (e) => {
        e.preventDefault();

        const event = {
            title: "Pernikahan Mila & Rizal",
            start: "20260602T070000",
            end: "20260602T170000",
            location: "https://maps.app.goo.gl/weVDW2Ubi4gurfu36",
            description: "Acara Akad dan Resepsi Pernikahan Mila & Rizal"
        };

        const icsContent = [
            "BEGIN:VCALENDAR",
            "VERSION:2.0",
            "BEGIN:VEVENT",
            `DTSTART:${event.start}`,
            `DTEND:${event.end}`,
            `SUMMARY:${event.title}`,
            `LOCATION:${event.location}`,
            `DESCRIPTION:${event.description}`,
            "END:VEVENT",
            "END:VCALENDAR"
        ].join("\n");

        const blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8' });
        const url = window.URL.createObjectURL(blob);
        const anchor = document.createElement('a');
        anchor.setAttribute('href', url);
        anchor.setAttribute('download', 'wedding-mila-rizal.ics');
        document.body.appendChild(anchor);
        anchor.click();
        document.body.removeChild(anchor);
        window.URL.revokeObjectURL(url);
    });
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
window.copyToClipboard = function (number, btn) {
    navigator.clipboard.writeText(number);
    const icon = `<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`;
    const original = btn.innerHTML;
    btn.innerHTML = icon + ' Tersalin!';
    btn.classList.add('!bg-forest-700', '!border-forest-700', '!text-white');
    setTimeout(() => {
        btn.innerHTML = original;
        btn.classList.remove('!bg-forest-700', '!border-forest-700', '!text-white');
    }, 2000);
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

// RSVP and Comments Logic
const rsvpForm = document.getElementById('rsvpForm');
const btnHadir = document.getElementById('btnHadir');
const btnTidakHadir = document.getElementById('btnTidakHadir');
const attendanceInput = document.getElementById('attendanceInput');
const wishesList = document.getElementById('wishesList');
const commentsSentinel = document.getElementById('commentsSentinel');
const commentsLoading = document.getElementById('commentsLoading');

let nextCommentsPage = 2;
let isLoadingComments = false;
let hasMoreComments = true;

const createCommentEl = (comment) => {
    const commentEl = document.createElement('div');
    commentEl.className = 'comment-item w-full p-3 rounded-lg bg-[#abb5a5]/10 text-left border border-white/5';

    const attendanceHtml = comment.rsvp?.attendance
        ? `<span class="px-1.5 py-0.5 rounded text-[8px] font-bold uppercase ${comment.rsvp.attendance === 'hadir' ? 'bg-green-900/50 text-green-200' : 'bg-red-900/50 text-red-200'}">${comment.rsvp.attendance}</span>`
        : '';

    commentEl.innerHTML = `
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-forest-700 flex items-center justify-center text-[10px] font-bold text-white uppercase">
                ${comment.name.substring(0, 1)}
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2 mb-1">
                    <p class="text-[11px] font-bold text-white truncate">${comment.name}</p>
                    ${attendanceHtml}
                </div>
                <p class="text-[10px] text-white/80 leading-relaxed break-words">${comment.comment}</p>
                <p class="comment-date text-[8px] text-white/40 mt-1.5">baru saja</p>
            </div>
        </div>
    `;
    return commentEl;
};

if (btnHadir && btnTidakHadir && attendanceInput) {
    btnHadir.addEventListener('click', () => {
        attendanceInput.value = 'hadir';
        btnHadir.classList.replace('bg-[#1a2b1a]', 'bg-green-900');
        btnTidakHadir.classList.replace('bg-red-900', 'bg-[#1a2b1a]');
    });

    btnTidakHadir.addEventListener('click', () => {
        attendanceInput.value = 'tidak hadir';
        btnTidakHadir.classList.replace('bg-[#1a2b1a]', 'bg-red-900');
        btnHadir.classList.replace('bg-green-900', 'bg-[#1a2b1a]');
    });
}

if (rsvpForm) {
    rsvpForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(rsvpForm);
        const data = Object.fromEntries(formData.entries());

        if (!data.unique_id) {
            Swal.fire({
                icon: 'error',
                title: 'Akses Tidak Valid',
                text: 'Silakan gunakan link undangan pribadi Anda.'
            });
            return;
        }

        try {
            // First submit RSVP
            const rsvpRes = await fetch('/rsvp', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': data._token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    unique_id: data.unique_id,
                    attendance: data.attendance
                })
            });

            if (!rsvpRes.ok) {
                const err = await rsvpRes.json();
                throw new Error(err.message || 'Gagal menyimpan konfirmasi.');
            }

            // Then submit comment if exists
            if (data.comment.trim()) {
                const commentRes = await fetch('/comments', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': data._token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        unique_id: data.unique_id,
                        comment: data.comment
                    })
                });

                if (commentRes.ok) {
                    const result = await commentRes.json();
                    const newComment = result.comment;

                    // Add current attendance state for UI
                    newComment.rsvp = { attendance: data.attendance };

                    const commentEl = createCommentEl(newComment);
                    wishesList.insertBefore(commentEl, wishesList.firstChild);
                    wishesList.scrollTop = 0;
                    rsvpForm.querySelector('textarea').value = '';

                    Swal.fire({
                        icon: 'success',
                        title: 'Terima Kasih!',
                        text: 'Konfirmasi dan ucapan Anda telah kami terima.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    const err = await commentRes.json();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: err.message || 'Gagal mengirim komentar.'
                    });
                }
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    });
}

// Infinite Scroll for Comments
if (wishesList && commentsSentinel) {
    const commentsObserver = new IntersectionObserver(async (entries) => {
        const entry = entries[0];
        if (entry.isIntersecting && hasMoreComments && !isLoadingComments) {
            isLoadingComments = true;
            commentsLoading.classList.remove('hidden');

            try {
                const response = await fetch(`/api/comments?page=${nextCommentsPage}`);
                const data = await response.json();

                if (data.data.length > 0) {
                    data.data.forEach(comment => {
                        const commentEl = createCommentEl(comment);
                        // Fix time display for historical comments
                        commentEl.querySelector('.comment-date').innerText = new Date(comment.created_at).toLocaleDateString();
                        wishesList.insertBefore(commentEl, commentsSentinel);
                    });
                    nextCommentsPage++;
                }

                if (!data.next_page_url) {
                    hasMoreComments = false;
                    commentsSentinel.classList.add('hidden');
                }
            } catch (error) {
                console.error('Error fetching comments:', error);
            } finally {
                isLoadingComments = false;
                commentsLoading.classList.add('hidden');
            }
        }
    }, {
        root: wishesList,
        threshold: 0.1
    });

    commentsObserver.observe(commentsSentinel);
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
