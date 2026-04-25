 Project Stack
   - HTML5: Semantic structure.
   - Tailwind CSS: For layout, spacing, and responsive design.
   - Vanilla JavaScript: For state management (Cover, Audio, Modal) and animations.
   - Intersection Observer API: For scroll-triggered effects.

  ---

  Step 1: Core Layout & State Setup
   1. Initialize Structure: Create a standard HTML5 boilerplate. Configure Tailwind with a custom font config to match the "Serif" and "Sans" mix of the original.
   2. Global State: Implement a "locked" state. The <body> should have overflow: hidden by default.
   3. The Cover (#cover): Build a full-screen fixed overlay. It must contain the "Buka Undangan" button.
   4. Opening Logic: Write a JS function that:
       - Removes the cover (fade out).
       - Re-enables body scrolling.
       - Starts the <audio> element (Autoplay workaround).
       - Triggers the first set of entrance animations.

  Step 2: Scroll Animation System
  The original uses class-based triggers. Re-implement this using a lightweight Intersection Observer:
   1. Define Animation Classes: Create Tailwind-friendly utility classes:
       - .reveal-up: opacity-0 translate-y-10 transition duration-700
       - .reveal-zoom: opacity-0 scale-90 transition duration-700
       - .is-active: opacity-100 translate-y-0 scale-100
   2. Observer Script: Create a script that watches all elements with reveal-* classes and toggles .is-active when they are 10% visible in the viewport.

  Step 3: Interactive Components Implementation
   1. Sticky Navigation: 
       - Build a bottom-fixed <nav>. 
       - Use flex justify-around for icons. 
       - Implement a "scroll spy" logic to highlight icons based on the currently visible section ID.
   2. Countdown Timer:
       - Create a JS class that takes a target date string.
       - Update the innerHTML of days, hours, minutes, and seconds spans every 1000ms.
   3. The Timeline (Love Story):
       - Use a central vertical div with a background color.
       - Create a "progress line" div inside it that grows its height based on the scroll percentage of the Story section.

  Step 4: Section-by-Section Reconstruction
   1. Intro/Couple Section: Use CSS background-image with bg-cover for the main portraits. Use absolute positioning for the floating leaf assets.
   2. Gallery Section: 
       - Use CSS Grid (grid-cols-2 md:grid-cols-3) with aspect-square for the images.
       - Implement a simple Lightbox (or use a tiny library like Luminous) for full-screen image viewing.
   3. RSVP Form: Build the form using Tailwind inputs. Mock the "Send" action to either save to localStorage or generate a WhatsApp API string: https://wa.me/{phone}?text={encoded_message}.

  Step 5: Digital Gift Modal
   1. Modal Logic: Build a hidden fixed overlay. 
   2. Payment Selection: Use a radio-group or dropdown that toggles the visibility of the "Bank Card" UI.
   3. Copy Functionality: Use navigator.clipboard.writeText() for the account number buttons, providing a "Copied!" tooltip feedback.

  Step 6: Assets & Optimization
   1. Image Handling: Convert all provided assets to .webp format. Implement loading="lazy" for all images below the fold.
   2. Lottie Integration: Use the lottie-web CDN to load the bird.json animation into specific container IDs.
   3. CSS Cleanup: Move complex decorative transforms (like the 23-degree tilted leaves) into a style.css file or Tailwind @layer utilities.

  ---

  Instructions for the Next Agent
  > "Using the provided @webwedding.html and the technical analysis, re-create the site from scratch. Do not use any CSS frameworks other than Tailwind. Ensure the 'Open Invitation' flow is perfectly smooth and
  that the background audio only plays after user interaction. Prioritize a mobile-first approach as 90% of wedding invitation traffic is mobile."


