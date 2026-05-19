<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan Mila & Rizal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Montserrat:wght@300;400;500&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    
    <!-- Preload Critical Assets -->
    <link rel="preload" href="{{ asset('assets/main-bg.webp') }}" as="image">
    <link rel="preload" href="{{ asset('assets/header-main-bg.webp') }}" as="image">
    <link rel="preload" href="{{ asset('assets/butterfly-second.webp') }}" as="image">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-800 locked">

    <!-- LEFT PANEL (desktop only) -->
    <div id="desktopLeft" class="hidden md:flex flex-1 relative overflow-hidden">
        <img src="{{ asset('assets/ARV_9022.JPG-compress.webp') }}" 
             class="w-full h-full object-cover" 
             alt="Mila & Rizal" 
             fetchpriority="high"
             decoding="async">
        <!-- Optional overlay branding -->
        <div class="absolute bottom-16 left-12 text-white">
            <p class="text-sm tracking-[0.3em] uppercase font-light mb-2">The Wedding of</p>
            <h1 class="font-sans text-6xl">Mila & Rizal</h1>
            <p class="mt-3 text-sm tracking-widest text-white/70">2 . 6 . 26</p>
        </div>
        <!-- Dark gradient at bottom -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
    </div>

    <div id="desktopRight">
        <!-- Audio Element -->
        <audio id="bgMusic" loop preload="none">
            <source src="{{ asset('assets/bg-audio-2.mp3') }}" type="audio/mpeg">
        </audio>

        <!-- Cover Section -->
        <section id="cover"
            class="fixed inset-0 z-[100] flex flex-col items-center bg-forest-pattern transition-opacity duration-1000">
            <img src="{{ asset('assets/butterfly-second.webp') }}"
                class="absolute bottom-40 right-10 z-40 w-20 animate-fade-up opacity-60" 
                alt="Butterfly Decoration"
                loading="eager"
                decoding="async">

            <!-- Floating Assets -->
            <img src="{{ asset('assets/cloud.webp') }}" 
                class="absolute top-20 w-32 animate-cloud-slow"
                alt="Animated Cloud"
                loading="eager"
                decoding="async">
            <img src="{{ asset('assets/header-main-bg.webp') }}" 
                class="absolute top-0 left-0" 
                alt="Header Background"
                fetchpriority="high"
                loading="eager"
                decoding="async">

            <!-- Decorative Birds -->
            <canvas id="lottie-bird" class="absolute top-30 right-10"></canvas>

            <!-- Top: Title + Date (absolute so it doesn't affect flow) -->
            <div class="absolute top-32 md:top-40 left-0 right-0 text-center z-10 text-white">
                <h2 class="font-sans text-lg tracking-widest italic font-semibold">Invitation Wedding</h2>
                <p class="mt-2 text-base font-bold tracking-[0.4em] text-[#e8e0c8]">2 . 6 . 2 6</p>
            </div>

            <!-- Spacer to push content down past the mountain -->
            <div class="flex-none h-[32%]"></div>

            <!-- Names -->
            <div class="relative z-10 text-white text-center leading-none text-7xl font-violetbee">
                <h1 class="">Mila &</h1>
                <h1 class="">Rizal</h1>
            </div>

            <!-- Guest + Button -->
            <div class="flex-none h-[10%]"></div>
            <div class="text-center relative z-10 text-white mt-4 mb-56">
                <p class="text-sm font-bold tracking-wide">Kepada Yth.</p>
                <p id="guestName" class="text-sm tracking-wide mt-1">{{ $rsvp?->name ?? 'Tamu Undangan' }}</p>

                <button id="btnOpen"
                    class="mt-5 inline-flex items-center px-8 py-3 bg-white text-green-900 rounded-full shadow-lg hover:bg-gray-100 transition-all transform hover:scale-105 font-semibold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L22 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Buka Undangan
                </button>
            </div>

            <!-- Footer Birds -->
            <div class="section-footer w-full">

                <!-- Bird -->
                <!-- Bird Wrapper handles the final position -->
                <div class="relative translate-y-60">
                    <!-- Image handles the animation -->
                    <img src="{{ asset('assets/footer-bird-compress.webp') }}"
                        class="w-56 mx-auto animate-fade-up [animation-delay:0.4s] opacity-0" 
                        alt="Footer Bird" 
                        loading="lazy"
                        decoding="async" />
                </div>
                <!-- Flowers -->
                <img src="{{ asset('assets/main-footer.webp') }}"
                    class="w-full h-auto object-cover opacity-90 -mt-20
               animate-fade-up opacity-0" 
                    alt="Footer Flowers"
                    loading="lazy"
                    decoding="async" />

            </div>
        </section>

        <!-- Main Content (Hidden until unlocked) -->
        <main id="mainContent" class="opacity-0 transition-opacity duration-1000">

            <!-- Home Section -->
            <section id="home"
                class="min-h-screen flex flex-col items-center justify-center pt-20 pb-40 bg-forest-pattern relative overflow-hidden">

                <!-- Floating Decorations -->
                <img src="{{ asset('assets/butterfly-one.webp') }}"
                    class="absolute top-30 left-10 w-16 animate-pulse opacity-90 z-30" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/butterfly-second.webp') }}"
                    class="absolute bottom-83 md:bottom-99 right-5 w-20 opacity-90 z-30" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">

                <img src="{{ asset('assets/cloud.webp') }}" 
                    class="absolute top-20 w-32 animate-cloud-slow"
                    alt="Animated Cloud"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/header-main-bg.webp') }}" 
                    class="absolute top-0 left-0" 
                    alt="Header Background"
                    loading="lazy"
                    decoding="async">

                <div class="container mx-auto px-6 text-center z-4">
                    <div class="mt-10">
                        <h2 class="font-sans text-2xl md:text-2xl text-white mb-2 reveal-up">The Wedding of</h2>
                        <h1 class="font-violetbee text-6xl text-white mb-10 reveal-up">Mila & Rizal</h1>
                    </div>

                    <div class="animate-fade-up mb-8 translate-y-10 z-10">
                        <div class="relative inline-block">
                            <img src="{{ asset('assets/foto/main-content-cover.webp') }}" 
                                 class="mx-auto object-cover"
                                 alt="Main Content Cover"
                                 loading="lazy"
                                 decoding="async">
                        </div>
                    </div>
                </div>

                <!-- Footer Birds -->
                <div class="section-footer w-full">
                    <img src="{{ asset('assets/footer-bird-compress.webp') }}"
                        class="w-56 mx-auto relative translate-y-60" 
                        alt="Footer Bird"
                        loading="lazy"
                        decoding="async" />
                    <img src="{{ asset('assets/main-footer.webp') }}"
                        class="w-full h-auto object-cover opacity-90 -mt-20 animate-fade-up [animation-delay:0.4s] opacity-0" 
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async" />
                </div>
            </section>

            <!-- Couple Section -->
            <section id="couple"
                class="py-32 bg-forest-pattern relative overflow-hidden min-h-screen flex items-center justify-center">
                <!-- Decorative Leaves -->
                <img src="{{ asset('assets/cloud.webp') }}" 
                    class="absolute top-20 w-32 animate-cloud-slow"
                    alt="Animated Cloud"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/header-main-bg.webp') }}" 
                    class="absolute top-0 left-0" 
                    alt="Header Background"
                    loading="lazy"
                    decoding="async">

                <!-- Arch Container -->
                <div class="relative z-10 mx-auto px-6 w-full max-w-sm">
                    <div class="relative rounded-[50%_50%_50%_50%_/_10%_10%_10%_10%] overflow-hidden"
                        style="border-radius: 50% 50% 50% 50% / 8% 8% 8% 8%; background: rgba(255,255,255,0.18); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.35); padding: 3rem 2rem 3rem;">

                        <!-- Top text -->
                        <div class="text-center mb-4 reveal-up text-white font-violetbee text-5xl">
                            <h2>We Are</h2>
                            <h2>Getting Married</h2>
                        </div>

                        <div class="w-16 h-px bg-white mx-auto mb-4"></div>

                        <!-- Ayat -->
                        <div class="reveal-up text-center mb-6 px-2 text-white">
                            <p class="text-sm text-white mb-3 leading-relaxed font-semibold">
                                السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللَّهِ وَبَرَكَاتُهُ
                            </p>
                            <p class="text-xs leading-relaxed italic">
                                Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah semoga
                                ridho-Mu tercurah mengiringi pernikahan kami:
                            </p>
                        </div>

                        <div class="w-16 h-px bg-white mx-auto mb-8"></div>

                        <!-- Bride -->
                        <div class="reveal-up text-center mb-8">
                            <div class="relative w-64 h-64 mx-auto mb-4">
                                <div
                                    class="w-full h-full rounded-full overflow-hidden border-4 border-white/60 shadow-lg">
                                    <img src="{{ asset('assets/foto/couple-woman_compressed_2.webp') }}"
                                        class="w-full h-full object-cover" 
                                        alt="Bride Mila"
                                        loading="lazy"
                                        decoding="async">
                                </div>
                            </div>
                            <h3 class="font-violetbee text-5xl text-white mb-1">Mila</h3>
                            <p class="font-bold text-white text-xl">Jamilatul Aisyiah</p>
                            <p class="text-xs text-white mt-1">Putri Bapak Jamak dan Ibu Hafidatul Aini</p>
                            <a href="https://www.instagram.com/jaaisyh" target="_blank"
                                class="mt-3 inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs text-white font-medium"
                                style="background: rgba(50,74,50,0.7);">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44-1.44-.645-1.44-1.44.644-1.44 1.44-1.44z" />
                                </svg>
                                @jaaisyh
                            </a>
                        </div>

                        <!-- Divider with hearts -->
                        <div class="flex items-center justify-center gap-2 mb-8 reveal-up">
                            <div class="h-px w-10 bg-white"></div>
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <div class="h-px w-10 bg-white"></div>
                        </div>

                        <!-- Groom -->
                        <div class="reveal-up text-center">
                            <div class="relative w-64 h-64 mx-auto mb-4">
                                <div
                                    class="w-full h-full rounded-full overflow-hidden border-4 border-white/60 shadow-lg">
                                    <img src="{{ asset('assets/foto/couple-man_compressed_2.webp') }}"
                                        class="w-full h-full object-cover" 
                                        alt="Groom Rizal"
                                        loading="lazy"
                                        decoding="async">
                                </div>
                            </div>
                            <h3 class="font-violetbee text-5xl text-white mb-1">Rizal</h3>
                            <p class="font-bold text-white text-xl">Rizal Abul Fata</p>
                            <p class="text-xs text-white mt-1">Putra Bapak Abd. Wasit dan Ibu Siti Hasilah</p>
                            <a href="https://www.instagram.com/rizalabulfata" target="_blank"
                                class="mt-3 inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs text-white font-medium"
                                style="background: rgba(50,74,50,0.7);">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44-1.44-.645-1.44-1.44.644-1.44 1.44-1.44z" />
                                </svg>
                                @rizalabulfata
                            </a>
                        </div>

                    </div>
                </div>

                <div class="section-footer">
                    <img src="{{ asset('assets/main-footer.webp') }}" 
                        class="w-full h-auto object-cover opacity-80"
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async">
                </div>
            </section>

            <!-- Event Section -->
            <section id="event"
                class="min-h-screen flex flex-col items-center justify-center bg-forest-two relative overflow-hidden py-10">

                <!-- Floating Decorations -->
                <img src="{{ asset('assets/butterfly-one.webp') }}"
                    class="absolute top-16 left-4 w-12 animate-pulse opacity-70 z-10" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/butterfly-second.webp') }}"
                    class="absolute top-32 right-6 w-14 animate-bounce opacity-60 z-10" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/cloud.webp') }}" 
                    class="absolute top-4 right-10 w-28 opacity-30 z-10"
                    alt="Animated Cloud"
                    loading="lazy"
                    decoding="async">

                <div class="relative z-20 w-full flex flex-col items-center justify-center px-5">

                    <!-- SVG Border Card -->
                    <div class="reveal-zoom relative w-full max-w-[340px]">

                        <!-- Octagon Border image -->
                        <img src="{{ asset('assets/foto/border-save-date.webp') }}"
                            class="w-full h-auto object-contain absolute inset-0 z-0 pointer-events-none scale-110"
                            alt="Border Save Date"
                            loading="lazy"
                            decoding="async">

                        <!-- Content -->
                        <div class="relative z-10 flex flex-col items-center text-center px-8 pt-12 pb-10"
                            style="min-height: 500px;">

                            <!-- Title: Matches Image 2 Script style -->
                            <h2 class="font-violetbee text-6xl text-white drop-shadow-md mb-6 italic">Save The Date
                            </h2>

                            <!-- Couple photo circle with Gold Border to match Image 2 -->
                            <div
                                class="w-44 h-44 rounded-full overflow-hidden border-[6px] border-[#c2b280] shadow-2xl mb-8">
                                <img src="{{ asset('assets/ARV_9022.JPG-compress.webp') }}"
                                    class="w-full h-full object-cover" 
                                    alt="Couple Portrait"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- Countdown boxes: Updated to Gold Background + White Text -->
                            <div class="flex justify-center gap-2 mb-6">
                                <div
                                    class="flex flex-col items-center bg-[#a39366] border border-white/30 rounded-lg px-2 py-2 min-w-[54px] shadow-lg">
                                    <span id="days" class="text-2xl font-bold text-white leading-none">00</span>
                                    <span class="text-[9px] font-bold text-white mt-1">Hari</span>
                                </div>
                                <div
                                    class="flex flex-col items-center bg-[#a39366] border border-white/30 rounded-lg px-2 py-2 min-w-[54px] shadow-lg">
                                    <span id="hours" class="text-2xl font-bold text-white leading-none">00</span>
                                    <span class="text-[9px] font-bold text-white mt-1">Jam</span>
                                </div>
                                <div
                                    class="flex flex-col items-center bg-[#a39366] border border-white/30 rounded-lg px-2 py-2 min-w-[54px] shadow-lg">
                                    <span id="minutes" class="text-2xl font-bold text-white leading-none">00</span>
                                    <span class="text-[9px] font-bold text-white mt-1">Menit</span>
                                </div>
                                <div
                                    class="flex flex-col items-center bg-[#a39366] border border-white/30 rounded-lg px-2 py-2 min-w-[54px] shadow-lg">
                                    <span id="seconds" class="text-2xl font-bold text-white leading-none">00</span>
                                    <span class="text-[9px] font-bold text-white mt-1">Detik</span>
                                </div>
                            </div>

                            <!-- Date text: White Bold Sans -->
                            <p class="text-white font-bold text-lg tracking-wide mb-5">Selasa, 02 Juni 2026</p>

                            <!-- Save to calendar button: Updated to Pinkish Cream background -->
                            <a href="#" id="btnSaveDate"
                                class="inline-flex items-center gap-2 px-6 py-2 rounded-full text-forest-800 text-xs font-semibold shadow mb-5"
                                style="background: rgba(255,255,255,0.80);">
                                <svg class="w-3.5 h-3.5 text-forest-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Simpan Tanggal
                            </a>
                        </div>
                    </div>

                </div>
            </section>

            <section id="invitation-text" class="py-32 bg-white relative overflow-hidden">
                <div class="container mx-auto px-6 text-center mb-24">
                    <p class="text-gray-600 mb-12 reveal-up">Dengan memohon rahmat dan ridho Allah SWT, kami mengundang
                        Bapak/Ibu/Saudara/i, untuk menghadiri acara pernikahan kami:
                    </p>

                </div>

                <div class="section-footer">
                    <img src="{{ asset('assets/main-footer.webp') }}" 
                        class="w-full h-auto object-cover opacity-80"
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async">
                </div>
            </section>

            <!-- Resepsi info section -->
            <section id="resepsi-info"
                class="min-h-screen flex flex-col items-center justify-center bg-forest-two relative overflow-hidden">

                <!-- Floating Decorations -->
                <img src="{{ asset('assets/butterfly-one.webp') }}"
                    class="absolute top-20 left-4 w-12 animate-pulse opacity-70 z-10" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">

                <!-- Arch Card -->
                <div class="reveal-up relative z-20 w-full flex items-center justify-center px-5 py-10">

                    <!-- SVG border as background layer -->
                    <div class="relative w-full max-w-[320px]">

                        <!-- The arch border SVG -->
                        <img src="{{ asset('assets/foto/border-akad-resepsi-info-compress.webp') }}"
                            class="w-full h-auto object-contain absolute inset-0 z-0 pointer-events-none"
                            alt="Border Info"
                            loading="lazy"
                            decoding="async">

                        <!-- Content layered on top of the SVG -->
                        <div class="relative z-10 flex flex-col items-center text-center px-10 pt-16 pb-16"
                            style="min-height: 520px;">

                            <!-- Flower decoration top -->
                            <div class="mb-3">
                                <img src="{{ asset('assets/foto/flower-white.webp') }}"
                                    class="w-20 h-auto opacity-80 mx-auto" 
                                    alt="Flower Decoration"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- Script title -->
                            <h2 class="font-violetbee text-6xl text-white mb-2 drop-shadow">Akad Nikah</h2>

                            <!-- Day & Date -->
                            <p class="text-white font-bold text-base tracking-widest uppercase mt-1">Selasa</p>
                            <p class="text-white font-bold text-base tracking-widest">02 Juni 2026</p>

                            <!-- Time -->
                            <p class="text-white/80 text-sm mt-1">Pukul 07.00 – Selesai</p>

                            <!-- Divider -->
                            <div class="w-24 h-px bg-white/50 my-4"></div>

                            <!-- Location icon -->
                            <svg class="w-6 h-6 text-white mb-2" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                            <!-- Venue name -->
                            <p class="text-white font-bold text-base leading-snug">Rumah Mempelai Wanita</p>

                            <!-- Venue address -->
                            <p class="text-white/80 text-xs mt-1 leading-relaxed">
                                Dusun Tonggal, Desa Meddelan,<br>Lenteng Sumenep
                            </p>

                            <!-- Maps button -->
                            <a href="https://maps.app.goo.gl/weVDW2Ubi4gurfu36" target="_blank"
                                class="mt-5 inline-flex items-center gap-2 px-5 py-2 rounded-full text-forest-800 text-xs font-semibold shadow"
                                style="background: rgba(255,255,255,0.85);">
                                <svg class="w-3.5 h-3.5 text-forest-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                Buka Maps
                            </a>

                        </div>
                    </div>
                </div>

                <div class="reveal-up relative z-20 w-full flex items-center justify-center px-5 py-10">

                    <!-- SVG border as background layer -->
                    <div class="relative w-full max-w-[320px]">

                        <!-- The arch border SVG -->
                        <img src="{{ asset('assets/foto/border-akad-resepsi-info-compress.webp') }}"
                            class="w-full h-auto object-contain absolute inset-0 z-0 pointer-events-none"
                            alt="Border Info"
                            loading="lazy"
                            decoding="async">

                        <!-- Content layered on top of the SVG -->
                        <div class="relative z-10 flex flex-col items-center text-center px-10 pt-16 pb-16"
                            style="min-height: 520px;">

                            <!-- Flower decoration top -->
                            <div class="mb-3">
                                <img src="{{ asset('assets/foto/flower-white.webp') }}"
                                    class="w-20 h-auto opacity-80 mx-auto" 
                                    alt="Flower Decoration"
                                    loading="lazy"
                                    decoding="async">
                            </div>

                            <!-- Script title -->
                            <h2 class="font-violetbee text-6xl text-white mb-2 drop-shadow">Resepsi</h2>

                            <!-- Day & Date -->
                            <p class="text-white font-bold text-base tracking-widest uppercase mt-1">Selasa</p>
                            <p class="text-white font-bold text-base tracking-widest">02 Juni 2026</p>

                            <!-- Time -->
                            <p class="text-white/80 text-sm mt-1">Pukul 14.00 – Selesai</p>

                            <!-- Divider -->
                            <div class="w-24 h-px bg-white/50 my-4"></div>

                            <!-- Location icon -->
                            <svg class="w-6 h-6 text-white mb-2" fill="none" stroke="currentColor"
                                stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                            <!-- Venue name -->
                            <p class="text-white font-bold text-base leading-snug">Rumah Mempelai Wanita</p>

                            <!-- Venue address -->
                            <p class="text-white/80 text-xs mt-1 leading-relaxed">
                                Dusun Tonggal, Desa Meddelan,<br>Lenteng Sumenep
                            </p>

                            <!-- Maps button -->
                            <a href="https://maps.app.goo.gl/weVDW2Ubi4gurfu36" target="_blank"
                                class="mt-5 inline-flex items-center gap-2 px-5 py-2 rounded-full text-forest-800 text-xs font-semibold shadow"
                                style="background: rgba(255,255,255,0.85);">
                                <svg class="w-3.5 h-3.5 text-forest-600" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                Buka Maps
                            </a>

                        </div>
                    </div>
                </div>

            </section>

            <!-- Story Section -->
            <section id="story" class="py-28 bg-forest-second relative overflow-hidden">
                <!-- Floating Decorative Assets -->
                <img src="{{ asset('assets/butterfly-one.webp') }}"
                    class="absolute top-20 left-10 w-16 animate-pulse opacity-60" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/cloud.webp') }}" 
                    class="absolute top-10 right-20 w-32 opacity-30"
                    alt="Animated Cloud"
                    loading="lazy"
                    decoding="async">

                <div class="container mx-auto px-8 relative z-10 mb-30">
                    <!-- Section Header -->
                    <h2 class="font-violetbee text-5xl text-center text-white mb-10 reveal-up drop-shadow-lg">Love
                        Story
                    </h2>

                    <div class="relative max-w-md mx-auto">
                        <!-- Vertical Timeline Track (The Background Line) -->
                        <div class="absolute left-4 top-2 bottom-0 w-[2px] bg-white/20 rounded-full">
                            <!-- Glowing Progress Line (Animated by JS) -->
                            <div id="progressLine"
                                class="w-full bg-white shadow-[0_0_15px_rgba(255,255,255,0.8)] transition-all duration-300 ease-out rounded-full"
                                style="height: 0%"></div>
                        </div>

                        <!-- Story Items Container -->
                        <div class="space-y-5">

                            <!-- Item 1: The Beginning -->
                            <div class="relative pl-12 reveal-up">
                                <!-- Heart Icon -->
                                <div
                                    class="absolute left-4 -translate-x-1/2 z-20 w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-[0_0_10px_rgba(0,0,0,0.3)] transition-transform duration-500 hover:scale-110">
                                    <svg class="w-5 h-5 text-forest-800" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-violetbee text-3xl text-white mb-3">The Beginning</h3>
                                    <p
                                        class="text-white/90 text-[13px] leading-relaxed text-justify font-light tracking-wide">
                                        Benar kata mereka, takdir selalu menemukan jalannya sendiri. Kami pernah berada
                                        dalam ruang dan waktu yang sama, di lorong sekolah yang serupa, namun tetap
                                        menjadi dua nama yang asing, tanpa cerita. Tak ada sapa, tak ada tanda, hingga
                                        semesta perlahan menulis caranya.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 2: Growing Together -->
                            <div class="relative pl-12 reveal-up">
                                <div
                                    class="absolute left-4 -translate-x-1/2 z-20 w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-[0_0_10px_rgba(0,0,0,0.3)] transition-transform duration-500 hover:scale-110">
                                    <svg class="w-5 h-5 text-forest-800" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-violetbee text-3xl text-white mb-3">Growing Together</h3>
                                    <p
                                        class="text-white/90 text-[13px] leading-relaxed text-justify font-light tracking-wide">
                                        Seperti pecahan kaca, kami saling merangkai, menyatukan bagian-bagian yang
                                        rapuh, menembus sekat hingga akhirnya dekat. Dalam proses yang tak selalu mudah,
                                        kami belajar menerima, memahami, dan saling menguatkan. Setiap perbedaan menjadi
                                        warna, setiap luka menjadi pelajaran. Jatuh cinta kali ini bukan sekadar rasa,
                                        melainkan perjalanan yang membuat kami merasa utuh dan terus tumbuh, bersama.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 3: The Sacred Promise -->
                            <div class="relative pl-12 reveal-up">
                                <div
                                    class="absolute left-4 -translate-x-1/2 z-20 w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-[0_0_10px_rgba(0,0,0,0.3)] transition-transform duration-500 hover:scale-110">
                                    <svg class="w-5 h-5 text-forest-800" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-violetbee text-3xl text-white mb-3">The Sacred Promise</h3>
                                    <p
                                        class="text-white/90 text-[13px] leading-relaxed text-justify font-light tracking-wide">
                                        Dalam doa dan keyakinan, kami memilih satu sama lain. Sebuah janji kami ikat
                                        untuk saling menetap, hari ini 5 April 2025 dan selamanya. Ragu pernah menjadi
                                        bayang, namun keteduhan dan sandaran selalu hadir dalam genggaman.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 4: Forever From Now -->
                            <div class="relative pl-12 reveal-up">
                                <div
                                    class="absolute left-4 -translate-x-1/2 z-20 w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-[0_0_10px_rgba(0,0,0,0.3)] transition-transform duration-500 hover:scale-110">
                                    <svg class="w-5 h-5 text-forest-800" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-violetbee text-3xl text-white mb-3">Forever From Now</h3>
                                    <p
                                        class="text-white/90 text-[13px] leading-relaxed text-justify font-light tracking-wide">
                                        Kini kami adalah tuan dan puan, dengan segala ego dan kekosongan yang perlahan
                                        kami sempurnakan dalam satu perjalanan. Di hadapan-Nya, kami mengikrarkan ikatan
                                        suci sebagai awal dari kisah panjang yang tak hanya tentang kebahagiaan, tetapi
                                        juga tentang kesetiaan. Bersama, kami berlayar.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer Birds -->
                <div class="section-footer w-full">

                    <!-- Bird -->
                    <img src="{{ asset('assets/footer-bird-compress.webp') }}"
                        class="w-56 mx-auto relative translate-y-60" 
                        alt="Footer Bird"
                        loading="lazy"
                        decoding="async" />

                    <!-- Flowers -->
                    <img src="{{ asset('assets/main-footer.webp') }}"
                        class="w-full h-auto object-cover opacity-90 -mt-20
               animate-fade-up [animation-delay:0.4s] opacity-0" 
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async" />

                </div>
            </section>

            <!-- Gallery Section -->
            <section id="gallery" class="pt-24 pb-60 bg-forest-pattern relative overflow-hidden">
                <img src="{{ asset('assets/cloud.webp') }}" 
                    class="absolute top-20 w-32 animate-cloud-slow"
                    alt="Animated Cloud"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/header-main-bg.webp') }}" 
                    class="absolute top-0 left-0" 
                    alt="Header Background"
                    loading="lazy"
                    decoding="async">

                <!-- Title -->
                <div class="container mx-auto px-4 pt-5 mb-10 relative z-10 text-center">
                    <h2 class="font-violetbee text-6xl text-white drop-shadow-md">Our Galery</h2>
                </div>

                <!-- Main Grid: 50/50 Split with Unified Gap 2 -->
                <div class="container mx-auto px-4  grid grid-cols-1 gap-2 relative z-10 max-w-[420px]">

                    <!-- Row 1: Top Wide Image -->
                    <div class="reveal-zoom">
                        <img src="{{ asset('assets/foto/collage-1-top.webp') }}" 
                            class="w-full h-auto block"
                            alt="Gallery Collage 1"
                            loading="lazy"
                            decoding="async">
                    </div>

                    <!-- Row 2: Cluster (Left) + Large Portrait (Right) -->
                    <div class="grid grid-cols-2 gap-2 items-stretch">
                        <div class="grid grid-cols-2 gap-2">
                            <img src="{{ asset('assets/foto/collage-1.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 2"
                                loading="lazy"
                                decoding="async">
                            <img src="{{ asset('assets/foto/collage-2.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 3"
                                loading="lazy"
                                decoding="async">
                            <img src="{{ asset('assets/foto/collage-3.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 4"
                                loading="lazy"
                                decoding="async">
                            <img src="{{ asset('assets/foto/collage-4.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 5"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="reveal-zoom">
                            <img src="{{ asset('assets/foto/collage-5.webp') }}"
                                class="w-full h-full object-cover block"
                                alt="Gallery Collage 6"
                                loading="lazy"
                                decoding="async">
                        </div>
                    </div>

                    <!-- Row 3: Large Portrait (Left) + Cluster (Right) -->
                    <div class="grid grid-cols-2 gap-2 items-stretch">
                        <div class="reveal-zoom">
                            <img src="{{ asset('assets/foto/collage-6.webp') }}"
                                class="w-full h-full object-cover block"
                                alt="Gallery Collage 7"
                                loading="lazy"
                                decoding="async">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <img src="{{ asset('assets/foto/collage-7.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 8"
                                loading="lazy"
                                decoding="async">
                            <img src="{{ asset('assets/foto/collage-8.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 9"
                                loading="lazy"
                                decoding="async">
                            <img src="{{ asset('assets/foto/collage-9.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 10"
                                loading="lazy"
                                decoding="async">
                            <img src="{{ asset('assets/foto/collage-10.webp') }}"
                                class="w-full h-full object-cover reveal-zoom block"
                                alt="Gallery Collage 11"
                                loading="lazy"
                                decoding="async">
                        </div>
                    </div>
                </div>

                <!-- Footer Decoration: Positioned closer to grid -->
                <div class="section-footer w-full">

                    <!-- Bird -->
                    <img src="{{ asset('assets/footer-bird-compress.webp') }}"
                        class="w-56 mx-auto relative translate-y-60" 
                        alt="Footer Bird"
                        loading="lazy"
                        decoding="async" />

                    <!-- Flowers -->
                    <img src="{{ asset('assets/main-footer.webp') }}"
                        class="w-full h-auto object-cover opacity-90 -mt-20 animate-fade-up [animation-delay:0.4s] opacity-0" 
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async" />

                </div>
            </section>

            <!-- Gift Section -->
            <section id="gift" class="py-32 bg-white relative overflow-hidden">
                <div class="container mx-auto px-6 text-center mb-24">
                    <h2 class="font-sans text-4xl text-forest-800 mb-6 reveal-up uppercase tracking-widest">Kado
                        Digital
                    </h2>
                    <p class="text-gray-600 mb-12 reveal-up">Doa restu Anda merupakan karunia yang sangat berarti bagi
                        kami.
                        Namun jika Anda ingin memberi kado, kami sediakan fitur berikut:</p>

                    <button id="btnShowGift"
                        class="px-8 py-3 bg-forest-700 text-white rounded-full shadow-lg hover:bg-forest-800 transition-all reveal-up transform hover:scale-105 active:scale-95">
                        Kirim Hadiah
                    </button>
                </div>

                <div class="section-footer">
                    <img src="{{ asset('assets/main-footer.webp') }}" 
                        class="w-full h-auto object-cover opacity-80"
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async">
                </div>
            </section>

            <!-- RSVP / Wishes Section -->
            <section id="wishes"
                class="py-20 bg-forest-pattern relative overflow-hidden min-h-screen flex items-center justify-center">

                <!-- Floating Assets -->
                <img src="{{ asset('assets/cloud.webp') }}" 
                    class="absolute top-17 w-32 animate-cloud-slow"
                    alt="Animated Cloud"
                    loading="lazy"
                    decoding="async">
                <img src="{{ asset('assets/header-main-bg.webp') }}" 
                    class="absolute top-0 left-0" 
                    alt="Header Background"
                    loading="lazy"
                    decoding="async">


                <!-- Stone Arch Frame -->
                <div class="absolute inset-0 z-0 flex justify-center items-center pointer-events-none">
                    <img src="{{ asset('assets/wishes-stone-arch.webp') }}" 
                        class="h-auto w-auto object-contain"
                        alt="Stone Arch"
                        loading="lazy"
                        decoding="async">
                </div>

                <!-- Cream Arch + Content -->
                <div class="relative z-10 flex justify-center items-center w-full">

                    <div class="relative w-[85vw] max-w-[360px]" style="aspect-ratio: 3/5.0;">

                        <img src="{{ asset('assets/wishes-cream-arch.svg') }}"
                            class="absolute inset-0 w-full h-full object-fill pointer-events-none"
                            alt="Cream Arch Insert"
                            loading="lazy"
                            decoding="async">

                        <div
                            class="absolute inset-0 flex flex-col items-center text-center
            pt-[14%] px-[12%] overflow-y-auto">

                            <h2 class="font-sans font-black text-2xl text-[#1a2b1a] tracking-tight uppercase mb-0">
                                Wishes
                            </h2>
                            <p class="text-[#1a2b1a] text-[9px] font-bold mb-3 tracking-tight">
                                Ucapan Selamat & Konfirmasi Kehadiran
                            </p>

                            @if ($rsvp)
                                <form id="rsvpForm" class="space-y-2 mb-3 w-full">
                                    @csrf
                                    <input type="hidden" name="unique_id" value="{{ $rsvp->unique_id }}">

                                    <input type="text" value="{{ $rsvp->name }}" readonly
                                        class="w-full h-9 rounded-lg bg-[#1a2b1a] text-white/90
                               px-4 text-[11px] font-light focus:outline-none">

                                    <textarea name="comment" placeholder="Ucapan...." rows="3"
                                        class="w-full rounded-lg bg-[#1a2b1a] text-white/90 placeholder:text-white/60
                               p-3 text-[11px] font-light focus:outline-none resize-none"></textarea>

                                    <div class="grid grid-cols-2 gap-2">
                                        <button type="button" id="btnTidakHadir"
                                            class="w-full h-8 flex items-center justify-center gap-1 rounded-md transition-colors
                                   {{ $rsvp->attendance === 'tidak hadir' ? 'bg-red-900' : 'bg-[#1a2b1a]' }} text-white">
                                            <span class="text-[10px]">❌</span>
                                            <span class="text-[9px] font-bold uppercase tracking-tighter">Tidak
                                                Hadir</span>
                                        </button>
                                        <button type="button" id="btnHadir"
                                            class="w-full h-8 flex items-center justify-center gap-1 rounded-md transition-colors
                                   {{ $rsvp->attendance === 'hadir' ? 'bg-green-900' : 'bg-[#1a2b1a]' }} text-white">
                                            <span class="text-[10px]">✅</span>
                                            <span class="text-[9px] font-bold uppercase tracking-tighter">Hadir</span>
                                        </button>
                                    </div>
                                    <input type="hidden" name="attendance" id="attendanceInput"
                                        value="{{ $rsvp->attendance }}">

                                    <button type="submit"
                                        class="w-full h-8 rounded-md bg-[#1a2b1a] text-white text-[10px] font-bold
                               uppercase tracking-widest hover:bg-forest-900 transition-all">
                                        Kirim
                                    </button>
                                </form>
                            @else
                                {{-- No RSVP: polished card matching the dark green theme --}}
                                <div class="mb-4 w-full">
                                    <div
                                        class="flex flex-col items-center gap-3 py-8 px-4 rounded-2xl
                                bg-[#1a2b1a]/70 border border-white/10 text-center">
                                        <div
                                            class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor"
                                                stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0
                                       01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25
                                       2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07
                                       1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25
                                       2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-white/80 text-[12px] font-semibold mb-1">Undangan Pribadi
                                            </p>
                                            <p class="text-white/50 text-[10px] leading-relaxed">
                                                Gunakan link undangan pribadi<br>untuk mengisi ucapan & konfirmasi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- No comments: polished empty state --}}
                            @if ($comments->isEmpty())
                                <div class="w-full mt-2">
                                    <div
                                        class="flex flex-col items-center gap-2 py-6 px-4 rounded-2xl
                                bg-[#1a2b1a]/40 border border-white/10 text-center">
                                        <svg class="w-6 h-6 text-white/25" fill="none" stroke="currentColor"
                                            stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0
                                   010 .75m0 0H8.25m.375 0h.375m-1.125
                                   3.75h.375m-.375 0a.375.375 0 11-.75 0 .375.375
                                   0 010 .75m0 0H8.25m6-3.75h.375m-.375
                                   0a.375.375 0 11-.75 0 .375.375 0 010
                                   .75m0 0h-.375m.375 3.75h.375m-.375
                                   0a.375.375 0 11-.75 0 .375.375 0 010
                                   .75m0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-white/30 text-[9px] leading-relaxed italic">
                                            Belum ada ucapan.<br>Jadilah yang pertama!
                                        </p>
                                    </div>
                                </div>
                            @else
                                <div class="w-full flex items-center gap-2 mb-2">
                                    <div class="flex-1 h-px bg-[#1a2b1a]/20"></div>
                                    <p
                                        class="text-[#1a2b1a] text-[7px] font-bold uppercase tracking-widest opacity-60">
                                        Ucapan Tamu</p>
                                    <div class="flex-1 h-px bg-[#1a2b1a]/20"></div>
                                </div>

                                <div id="wishesList"
                                    class="bg-[#1a2b1a] rounded-xl p-3 space-y-2 shadow-xl w-full
           max-h-[40%] overflow-y-auto scroll-smooth shrink-0">
                                    @foreach ($comments as $comment)
                                        <div
                                            class="comment-item w-full p-2.5 rounded-lg bg-white/5 text-left border border-white/5">
                                            <div class="flex items-start gap-2">
                                                <div
                                                    class="flex-shrink-0 w-6 h-6 rounded-full bg-forest-700 flex items-center
                                            justify-center text-[9px] font-bold text-white uppercase">
                                                    {{ substr($comment->name, 0, 1) }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between gap-1 mb-0.5">
                                                        <p class="text-[10px] font-bold text-white truncate">
                                                            {{ $comment->name }}</p>
                                                        @if ($comment->rsvp?->attendance)
                                                            <span
                                                                class="shrink-0 px-1.5 py-0.5 rounded text-[7px] font-bold uppercase
                                                {{ $comment->rsvp->attendance === 'hadir' ? 'bg-green-900/50 text-green-200' : 'bg-red-900/50 text-red-200' }}">
                                                                {{ $comment->rsvp->attendance }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <p class="text-[9px] text-white/70 leading-relaxed break-words">
                                                        {{ $comment->comment }}</p>
                                                    <p class="comment-date text-[7px] text-white/30 mt-1">
                                                        {{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div id="commentsSentinel" class="h-2 w-full"></div>
                                    <div id="commentsLoading" class="hidden py-2 text-center">
                                        <div
                                            class="inline-block w-4 h-4 border-2 border-white/20 border-t-white/80 rounded-full animate-spin">
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="section-footer w-full">
                    <img src="{{ asset('assets/footer-bird-compress.webp') }}"
                        class="w-56 mx-auto relative translate-y-60" 
                        alt="Footer Bird"
                        loading="lazy"
                        decoding="async" />
                    <img src="{{ asset('assets/main-footer.webp') }}"
                        class="w-full h-auto object-cover opacity-90 -mt-20 animate-fade-up [animation-delay:0.4s] opacity-0" 
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async" />
                </div>
            </section>

            <!-- Final Footer Section -->
            <footer id="footer"
                class="min-h-screen flex flex-col items-center justify-start pt-10 bg-forest-three relative overflow-hidden">

                <!-- Floating Decorations -->
                <img src="{{ asset('assets/butterfly-one.webp') }}"
                    class="absolute top-20 left-14 w-12 animate-pulse opacity-70 z-40" 
                    alt="Butterfly Decoration"
                    loading="lazy"
                    decoding="async">
                {{-- <img src="{{ asset('assets/cloud.webp') }}" class="absolute top-6 right-6 w-28 opacity-40 z-10"
                    alt=""> --}}

                <!-- Main Content Container (Removed justify-center to move content up) -->
                <div class="relative z-20 w-full flex flex-col items-center px-6 ">

                    <!-- Arched Photo Container -->
                    <div class="relative w-full max-w-[230px] md:max-w-[300px] sm:max-w-[200px] mb-8 reveal-zoom">
                        <!-- The arch border / photo asset -->
                        <img src="{{ asset('assets/foto/closing-photo-compress.webp') }}"
                            class="w-full h-auto object-contain relative z-10" 
                            alt="Closing Photo"
                            loading="lazy"
                            decoding="async">
                    </div>

                    <!-- Closing Message Section -->
                    <div class="text-center text-white max-w-xs reveal-up">
                        <p class="text-[13px] leading-relaxed mb-4 font-medium">
                            Suatu kebahagiaan & kehormatan bagi kami, apabila Bapak/Ibu/Saudara/i, berkenan hadir dan
                            memberikan do'a restu kepada kami
                        </p>

                        <p class="text-[14px] font-semibold" dir="rtl">
                            والسَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ
                        </p>

                        <p class="text-[13px] font-medium pt-3">
                            Kami yang berbahagia
                        </p>

                        <!-- Script names matching the reference -->
                        <h2 class="font-violetbee text-5xl mt-2 drop-shadow-lg">Mila & Rizal</h2>
                    </div>

                </div>

                <!-- Integrated Footer Layers -->
                <div class="section-footer w-full">
                    <!-- Bird -->
                    <img src="{{ asset('assets/footer-bird-compress.webp') }}"
                        class="w-56 mx-auto relative translate-y-60" 
                        alt="Footer Bird"
                        loading="lazy"
                        decoding="async" />

                    <!-- Flowers -->
                    <img src="{{ asset('assets/main-footer.webp') }}"
                        class="w-full h-auto object-cover opacity-90 -mt-20
   animate-fade-up [animation-delay:0.4s] opacity-0" 
                        alt="Footer Flowers"
                        loading="lazy"
                        decoding="async" />
                </div>
            </footer>

        </main>

        <!-- Bottom Navigation -->
        <nav id="bottomNav"
            class="fixed bottom-6 left-1/2 -translate-x-1/2 md:left-1/8 md:-translate-x-1/8 z-50 w-[95%] max-w-lg transition-transform duration-700 ease-out transform translate-y-[200%]">

            <div class="backdrop-blur-xl border border-forest-300/40 shadow-2xl rounded-full px-5 py-3"
                style="background: rgba(77, 117, 77, 0.55);">
                <div class="flex justify-around items-center">

                    <a href="#home"
                        class="flex flex-col items-center gap-1 text-white/90 hover:text-white transition-all">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all active:scale-95"
                            style="background: rgba(61, 92, 61, 0.5); border: 1px solid rgba(154, 186, 154, 0.4);">
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider">Home</span>
                    </a>

                    <a href="#couple"
                        class="flex flex-col items-center gap-1 text-white/90 hover:text-white transition-all">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all active:scale-95"
                            style="background: rgba(61, 92, 61, 0.5); border: 1px solid rgba(154, 186, 154, 0.4);">
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider">Couple</span>
                    </a>

                    <a href="#event"
                        class="flex flex-col items-center gap-1 text-white/90 hover:text-white transition-all">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all active:scale-95"
                            style="background: rgba(61, 92, 61, 0.5); border: 1px solid rgba(154, 186, 154, 0.4);">
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider">Event</span>
                    </a>

                    <a href="#gallery"
                        class="flex flex-col items-center gap-1 text-white/90 hover:text-white transition-all">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all active:scale-95"
                            style="background: rgba(61, 92, 61, 0.5); border: 1px solid rgba(154, 186, 154, 0.4);">
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider">Gallery</span>
                    </a>

                    <a href="#wishes"
                        class="flex flex-col items-center gap-1 text-white/90 hover:text-white transition-all">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all active:scale-95"
                            style="background: rgba(61, 92, 61, 0.5); border: 1px solid rgba(154, 186, 154, 0.4);">
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider">Wishes</span>
                    </a>

                    <a href="#gift"
                        class="flex flex-col items-center gap-1 text-white/90 hover:text-white transition-all">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all active:scale-95"
                            style="background: rgba(61, 92, 61, 0.5); border: 1px solid rgba(154, 186, 154, 0.4);">
                            <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                        </div>
                        <span class="text-[9px] font-bold uppercase tracking-wider">Gift</span>
                    </a>

                </div>
            </div>
        </nav>

        <!-- Audio Control Button -->
        <button id="btnAudio"
            class="fixed bottom-28 md:bottom-24 right-7 z-50 w-12 h-12 bg-white/80 backdrop-blur-md rounded-full shadow-lg flex items-center justify-center text-forest-700 opacity-0 transition-opacity duration-500">
            <svg id="iconPlay" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                </path>
                <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <svg id="iconPause" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>
    </div>

    <!-- Gift Modal -->
    <div id="giftModal"
        class="fixed inset-0 z-[110] flex items-center justify-center bg-black/70 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">

        <div
            class="bg-[#faf9f6] rounded-3xl w-full max-w-[440px] mx-5 shadow-2xl overflow-hidden max-h-[90vh] flex flex-col transform scale-90 transition-transform duration-300">

            {{-- Header --}}
            <div class="relative px-7 pt-7 pb-6 bg-gradient-to-br from-forest-700 to-forest-900 shrink-0">
                <div
                    class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent">
                </div>

                <div class="flex justify-between items-start">
                    <button id="btnCloseGift"
                        class="w-9 h-9 rounded-xl bg-white/10 border border-white/15 flex items-center justify-center text-white/60 hover:bg-white/20 hover:text-white transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <h3 class="font-sans text-[28px] font-semibold text-white mt-4 leading-tight">Rekening Kami</h3>
                <p class="text-sm text-white/50 mt-1 font-light tracking-wide">Pilih metode transfer yang Anda
                    inginkan</p>
            </div>

            {{-- Scrollable Body --}}
            <div
                class="px-6 py-5 overflow-y-auto flex-1 scrollbar-thin scrollbar-thumb-forest-200 scrollbar-track-transparent">

                <p class="text-[10px] font-medium tracking-[1.5px] uppercase text-forest-400 mb-3">E-Wallet</p>

                {{-- ShopeePay/Dana/GoPay --}}
                <div
                    class="relative bg-white border border-forest-100 rounded-2xl p-[18px] mb-3 overflow-hidden group hover:-translate-y-px hover:border-forest-300 hover:shadow-lg hover:shadow-forest-900/10 transition-all duration-200">
                    <div
                        class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-forest-500 to-forest-700 rounded-r">
                    </div>
                    <div class="flex justify-between items-center mb-2.5">
                        <span
                            class="text-[10px] font-medium tracking-widest uppercase text-forest-600 bg-forest-50 border border-forest-200 px-2 py-0.5 rounded-full">ShopeePay
                            · Dana · GoPay</span>
                        <span
                            class="w-7 h-7 rounded-lg bg-gradient-to-br from-forest-600 to-forest-800 flex items-center justify-center text-white text-[10px] font-semibold">💚</span>
                    </div>
                    <p class="font-sans text-2xl font-semibold text-forest-950 tracking-wide leading-none mb-1">
                        0823 0168 4881</p>
                    <p class="text-xs text-forest-500 mb-3.5">a.n Jamilatul Aisyiah</p>
                    <button onclick="copyToClipboard('082301684881', this)"
                        class="copy-btn w-full py-2.5 flex items-center justify-center gap-1.5 bg-forest-50 border-[1.5px] border-forest-200 rounded-xl text-forest-700 text-[13px] font-medium hover:bg-forest-700 hover:border-forest-700 hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Salin Nomor
                    </button>
                </div>

                <div class="h-px bg-gradient-to-r from-transparent via-forest-200 to-transparent my-4"></div>
                <p class="text-[10px] font-medium tracking-[1.5px] uppercase text-forest-400 mb-3">Rekening Bank
                </p>

                {{-- Seabank --}}
                <div
                    class="relative bg-white border border-forest-100 rounded-2xl p-[18px] mb-3 overflow-hidden group hover:-translate-y-px hover:border-forest-300 hover:shadow-lg hover:shadow-forest-900/10 transition-all duration-200">
                    <div
                        class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-forest-500 to-forest-700 rounded-r">
                    </div>
                    <div class="flex justify-between items-center mb-2.5">
                        <span
                            class="text-[10px] font-medium tracking-widest uppercase text-forest-600 bg-forest-50 border border-forest-200 px-2 py-0.5 rounded-full">SeaBank</span>
                        <span
                            class="w-7 h-7 rounded-lg bg-gradient-to-br from-forest-600 to-forest-800 flex items-center justify-center text-white text-[10px] font-semibold">SB</span>
                    </div>
                    <p class="font-sans text-2xl font-semibold text-forest-950 tracking-wide leading-none mb-1">
                        9012 6653 4460</p>
                    <p class="text-xs text-forest-500 mb-3.5">a.n Jamilatul Aisyiah</p>
                    <button onclick="copyToClipboard('901266534460', this)"
                        class="copy-btn w-full py-2.5 flex items-center justify-center gap-1.5 bg-forest-50 border-[1.5px] border-forest-200 rounded-xl text-forest-700 text-[13px] font-medium hover:bg-forest-700 hover:border-forest-700 hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Salin No. Rekening
                    </button>
                </div>

                {{-- BCA --}}
                <div
                    class="relative bg-white border border-forest-100 rounded-2xl p-[18px] mb-3 overflow-hidden group hover:-translate-y-px hover:border-forest-300 hover:shadow-lg hover:shadow-forest-900/10 transition-all duration-200">
                    <div
                        class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-forest-500 to-forest-700 rounded-r">
                    </div>
                    <div class="flex justify-between items-center mb-2.5">
                        <span
                            class="text-[10px] font-medium tracking-widest uppercase text-forest-600 bg-forest-50 border border-forest-200 px-2 py-0.5 rounded-full">Bank
                            BCA</span>
                        <span
                            class="w-7 h-7 rounded-lg bg-gradient-to-br from-forest-600 to-forest-800 flex items-center justify-center text-white text-[10px] font-semibold">BCA</span>
                    </div>
                    <p class="font-sans text-2xl font-semibold text-forest-950 tracking-wide leading-none mb-1">
                        1931 4043 30</p>
                    <p class="text-xs text-forest-500 mb-3.5">a.n Rizal Abul Fata</p>
                    <button onclick="copyToClipboard('1931404330', this)"
                        class="copy-btn w-full py-2.5 flex items-center justify-center gap-1.5 bg-forest-50 border-[1.5px] border-forest-200 rounded-xl text-forest-700 text-[13px] font-medium hover:bg-forest-700 hover:border-forest-700 hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Salin No. Rekening
                    </button>
                </div>

                {{-- Mandiri --}}
                <div
                    class="relative bg-white border border-forest-100 rounded-2xl p-[18px] mb-3 overflow-hidden group hover:-translate-y-px hover:border-forest-300 hover:shadow-lg hover:shadow-forest-900/10 transition-all duration-200">
                    <div
                        class="absolute left-0 top-0 bottom-0 w-[3px] bg-gradient-to-b from-forest-500 to-forest-700 rounded-r">
                    </div>
                    <div class="flex justify-between items-center mb-2.5">
                        <span
                            class="text-[10px] font-medium tracking-widest uppercase text-forest-600 bg-forest-50 border border-forest-200 px-2 py-0.5 rounded-full">Bank
                            Mandiri</span>
                        <span
                            class="w-7 h-7 rounded-lg bg-gradient-to-br from-forest-600 to-forest-800 flex items-center justify-center text-white text-[10px] font-semibold">MDR</span>
                    </div>
                    <p class="font-sans text-2xl font-semibold text-forest-950 tracking-wide leading-none mb-1">
                        1400 0213 89102</p>
                    <p class="text-xs text-forest-500 mb-3.5">a.n Rizal Abul Fata</p>
                    <button onclick="copyToClipboard('1400021389102', this)"
                        class="copy-btn w-full py-2.5 flex items-center justify-center gap-1.5 bg-forest-50 border-[1.5px] border-forest-200 rounded-xl text-forest-700 text-[13px] font-medium hover:bg-forest-700 hover:border-forest-700 hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Salin No. Rekening
                    </button>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
