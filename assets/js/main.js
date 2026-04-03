/**
 * main.js – Nesam Radio global JavaScript
 * Handles: dark/light mode, mobile menu, now-playing bar, audio player, AJAX now-playing updates
 */

(function () {
  'use strict';

  /* ─── Stream data (mirrors PHP config) ─── */
  const STREAMS = {
    'nesam-fm':        { name: 'Nesam FM',         url: 'https://stream.zeno.fm/y0q2tyy2g4zuv',  genre: 'Tamil Film Hits' },
    'nesam-devotional':{ name: 'Nesam Devotional',  url: 'https://stream.zeno.fm/y0q2tyy2g4zuv',  genre: 'Devotional & Bhajans' },
    'nesam-news':      { name: 'Nesam News',         url: 'https://stream.zeno.fm/y0q2tyy2g4zuv',  genre: 'News & Current Affairs' },
    'nesam-hits':      { name: 'Nesam Hits',         url: 'https://stream.zeno.fm/y0q2tyy2g4zuv',  genre: 'Latest Kollywood' },
    'nesam-retro':     { name: 'Nesam Retro',        url: 'https://stream.zeno.fm/y0q2tyy2g4zuv',  genre: '80s–2000s Classics' },
    'nesam-kids':      { name: 'Nesam Kids',         url: 'https://stream.zeno.fm/y0q2tyy2g4zuv',  genre: 'Children Songs & Stories' },
  };

  let currentStation = 'nesam-fm';
  let isPlaying = false;

  /* ─── DOM refs ─── */
  const audio       = document.getElementById('np-audio');
  const playBtn     = document.getElementById('np-play-btn');
  const playIcon    = document.getElementById('np-play-icon');
  const pauseIcon   = document.getElementById('np-pause-icon');
  const npStation   = document.getElementById('np-station');
  const npSong      = document.getElementById('np-song');
  const npBar       = document.getElementById('now-playing-bar');
  const npVolume    = document.getElementById('np-volume');
  const npProgress  = document.getElementById('np-progress');

  /* ─── Show / hide now-playing bar ─── */
  function showNPBar() {
    if (npBar) npBar.classList.remove('translate-y-full');
  }

  /* ─── Play a station ─── */
  window.playStation = function (stationId) {
    const s = STREAMS[stationId];
    if (!s) return;
    currentStation = stationId;
    if (audio) {
      audio.src = s.url;
      audio.load();
      audio.play().then(() => {
        isPlaying = true;
        updatePlayUI();
        if (npStation) npStation.textContent = s.name;
        if (npSong)    npSong.textContent    = '♪ Live Stream';
        showNPBar();
      }).catch(() => {
        if (npSong) npSong.textContent = 'Tap play to listen';
      });
    }
    // Sync station UI on live page if exists
    if (typeof syncStationUI === 'function') syncStationUI(stationId);
  };

  function updatePlayUI() {
    if (!playIcon || !pauseIcon) return;
    playIcon.classList.toggle('hidden', isPlaying);
    pauseIcon.classList.toggle('hidden', !isPlaying);
  }

  /* ─── Sticky bar play/pause ─── */
  if (playBtn) {
    playBtn.addEventListener('click', () => {
      if (!audio) return;
      if (audio.paused) {
        // Load stream if not loaded
        if (!audio.src) {
          audio.src = STREAMS[currentStation].url;
          audio.load();
        }
        audio.play().then(() => {
          isPlaying = true;
          updatePlayUI();
          showNPBar();
        }).catch(() => {});
      } else {
        audio.pause();
        isPlaying = false;
        updatePlayUI();
      }
    });
  }

  /* ─── Volume ─── */
  if (npVolume && audio) {
    npVolume.addEventListener('input', () => {
      audio.volume = parseFloat(npVolume.value);
    });
  }

  /* ─── Simulated progress for live (visual) ─── */
  if (npProgress) {
    let prog = 0;
    setInterval(() => {
      if (isPlaying) {
        prog = (prog + 0.3) % 100;
        npProgress.style.width = prog + '%';
      }
    }, 500);
  }

  /* ─── Dark/Light mode ─── */
  const themeToggle = document.getElementById('theme-toggle');
  const iconMoon    = document.getElementById('icon-moon');
  const iconSun     = document.getElementById('icon-sun');
  const html        = document.documentElement;

  function applyTheme(theme) {
    html.classList.toggle('dark',  theme === 'dark');
    html.classList.toggle('light', theme === 'light');
    if (iconMoon && iconSun) {
      // Dark mode  → show SUN  (click to go light)
      // Light mode → show MOON (click to go dark)
      iconMoon.classList.toggle('hidden', theme === 'dark');
      iconSun.classList.toggle('hidden',  theme === 'light');
    }
    localStorage.setItem('nesam-theme', theme);
  }

  // Init theme
  const savedTheme = localStorage.getItem('nesam-theme') || 'dark';
  applyTheme(savedTheme);

  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      const current = html.classList.contains('dark') ? 'dark' : 'light';
      applyTheme(current === 'dark' ? 'light' : 'dark');
    });
  }

  /* ─── Mobile menu ─── */
  const mobileMenuBtn  = document.getElementById('mobile-menu-btn');
  const mobileMenu     = document.getElementById('mobile-menu');
  const menuOpenIcon   = document.getElementById('menu-open-icon');
  const menuCloseIcon  = document.getElementById('menu-close-icon');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      const open = !mobileMenu.classList.contains('hidden');
      mobileMenu.classList.toggle('hidden', open);
      if (menuOpenIcon)  menuOpenIcon.classList.toggle('hidden', !open);
      if (menuCloseIcon) menuCloseIcon.classList.toggle('hidden', open);
    });
    // Close on link click
    mobileMenu.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        menuOpenIcon && menuOpenIcon.classList.remove('hidden');
        menuCloseIcon && menuCloseIcon.classList.add('hidden');
      });
    });
  }

  /* ─── Navbar scroll effect ─── */
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    if (!navbar) return;
    if (window.scrollY > 20) {
      navbar.style.boxShadow = '0 4px 24px rgba(0,0,0,0.4)';
    } else {
      navbar.style.boxShadow = 'none';
    }
  }, { passive: true });

  /* ─── AJAX Now Playing update (every 30s) ─── */
  function updateNowPlaying() {
    fetch('api/now_playing.php?station=' + encodeURIComponent(currentStation))
      .then(r => r.json())
      .then(data => {
        if (npSong && data.song) npSong.textContent = '♪ ' + data.song;
        if (npStation && data.station) npStation.textContent = data.station;
      })
      .catch(() => {}); // Fail silently
  }

  // Initial + interval
  showNPBar();
  if (audio) {
    updateNowPlaying();
    setInterval(updateNowPlaying, 30000);
  }

  /* ─── Intersection Observer for fadeInUp animations ─── */
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.animate-on-scroll').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(24px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
  });

  /* ─── Song request form (live page) ─── */
  const reqForm = document.getElementById('song-request-form');
  if (reqForm) {
    reqForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn    = reqForm.querySelector('[type=submit]');
      const status = document.getElementById('req-status');
      btn.disabled = true;
      btn.textContent = 'Sending…';
      const fd = new FormData(reqForm);
      fd.append('ajax', '1');
      try {
        const r    = await fetch('api/request_song.php', { method: 'POST', body: fd });
        const data = await r.json();
        if (status) {
          status.textContent = data.message;
          status.className = data.ok
            ? 'text-green-400 text-sm mt-2'
            : 'text-red-400 text-sm mt-2';
        }
        if (data.ok) reqForm.reset();
      } catch {
        if (status) status.textContent = 'Error. Please try again.';
      } finally {
        btn.disabled = false;
        btn.textContent = 'Send Request ❤️';
      }
    });
  }

  /* ─── Contact form ─── */
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn    = contactForm.querySelector('[type=submit]');
      const status = document.getElementById('contact-status');
      btn.disabled = true;
      btn.textContent = 'Sending…';
      const fd = new FormData(contactForm);
      fd.append('ajax', '1');
      try {
        const r    = await fetch('api/contact.php', { method: 'POST', body: fd });
        const data = await r.json();
        if (status) {
          status.textContent = data.message;
          status.className = data.ok
            ? 'text-green-400 text-sm mt-2'
            : 'text-red-400 text-sm mt-2';
        }
        if (data.ok) contactForm.reset();
      } catch {
        if (status) status.textContent = 'Error. Please try again.';
      } finally {
        btn.disabled = false;
        btn.textContent = 'Send Message ❤️';
      }
    });
  }

})();
