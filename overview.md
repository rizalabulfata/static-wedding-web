Digital Wedding Invitation Analysis (@webwedding.html)

  This document provides a comprehensive technical breakdown of the provided wedding invitation website for use in agentic AI generation.

  1. Core Architecture
   - Framework: WordPress with Elementor Page Builder (Container-based).
   - Design Pattern: Single-page application (SPA) behavior with smooth scroll navigation.
   - Responsive Strategy: Mobile-first, utilizing Elementor's responsive breakpoints (Mobile: 600px, Tablet: 991px).
   - Primary Layout: Vertical scrolling with distinct thematic sections.

  2. Structural Breakdown (Key Sections)
  The page is organized into the following major containers (data-id and id references):

  ┌────────────┬─────────────────┬────────────────────────────────────────────────────────────────────────┐
  │ Section ID │ Purpose         │ Key Elements                                                           │
  ├────────────┼─────────────────┼────────────────────────────────────────────────────────────────────────┤
  │ #coverx    │ Initial Landing │ "Open Invitation" button, couple names, decorative floating assets.    │
  │ #home      │ Main Intro      │ Opening greeting, main photo, wedding date.                            │
  │ #couple    │ The Couple      │ Bride and Groom profiles, parents' names, and portraits.               │
  │ #event     │ Schedule        │ Date, Time (Akad & Resepsi), Countdown Timer, Google Maps integration. │
  │ #gallery   │ Media           │ YouTube video embed, Justified Image Gallery.                          │
  │ #story     │ Love Story      │ Vertical timeline (foreverr_timeline) with heart icons.                │
  │ #wishes    │ RSVP            │ Interactive form (Name, Message, Attendance) and guestbook feed.       │
  │ #gift      │ Digital Gift    │ "Amplop Digital" button triggering a modal with bank/E-wallet details. │
  └────────────┴─────────────────┴────────────────────────────────────────────────────────────────────────┘

  3. Element Analysis
  Navigation
   - Sticky Bottom Menu: A persistent nav element with 7 icons (SVG) that uses smooth scrolling to jump to sections.
   - Active State: JavaScript dynamically adds nav__link-onpage and hovers classes to the menu item corresponding to the current viewport section.

  Interactive Components
   - Audio Player: Background music (nadhif basalamah - penjaga hati) starts upon clicking "Buka Undangan". Includes a rotating disc icon with play/pause/mute functionality.
   - Countdown Timer: Located in #event, uses elementor-countdown-item for Days, Hours, Minutes, and Seconds.
   - Digital Gift Modal: A specialized modal (#modalRek) containing tabbed or selectable bank details with "Copy to Clipboard" functionality and a "Confirm via WhatsApp" link generator.
   - Lottie Animations: Uses bird.json for lightweight vector-based bird animations across different sections.

  4. Style & Aesthetics
   - Typography: Relies on a centralized CSS file. Uses a mix of elegant serif for names/headings and clean sans-serif for body text.
   - Visual Assets:
       - Extensive use of WebP for performance.
       - Floating decorative assets (leaves, flowers) often using e-transform for rotation and scaling.
   - Color Palette: Dominated by whites, soft neutrals, and nature-themed accents (Forest/Greenery theme).

  5. Animation Logic
  Animations are a critical part of the "premium" feel:

  Scroll-Triggered Animations
  JavaScript monitors the scroll position and adds the active class to elements with the following classes when they enter the viewport:
   - fup: Fade Up
   - fleft / fright: Slide from Left/Right
   - azoom / zoomo: Zoom-in effects
   - flip: 3D flip effects

  Animation Settings (JSON Data)
  Many elements have data-settings attributes containing specific animation parameters:

   1 {"_animation":"zoomIn","_animation_delay":1000}

  Specialized Effects
   - Timeline Logic: animateLine function in new.js calculates the scroll progress of the timeline and fills the vertical line dynamically.
   - Parallax: Applied to background containers (parallax class) for depth.
   - Audio Disc: Rotates using a CSS animation (spinaudio 2s infinite linear) when music is playing.

  6. Implementation Guide for Agentic AI
  To replicate this site, the AI agent should focus on:
   1. State Management: Create a global "Unlocked" state. Content is hidden/locked until the "Buka Undangan" button is clicked.
   2. Scroll Observer: Implement an IntersectionObserver to trigger the CSS transition classes (active) for scroll-based animations.
   3. Component Modularization:
       - Timeline: A vertical flex container with a central line that grows based on scroll height.
       - RSVP Form: A standard POST form that handles attendance logic (Hadir/Tidak Hadir).
       - Modal: A fixed-position overlay for the gift section.
   4. Assets: Use the provided WebP images and JSON Lottie files. Ensure all SVG icons are embedded directly for styling flexibility.
   5. Audio: Initialize an <audio> tag but only trigger .play() after the user's first interaction (the cover button) to comply with browser autoplay policies.
