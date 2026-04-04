<?php // partials/footer.php ?>
</main><!-- /main-content -->

<!-- ===== STICKY NOW-PLAYING PLAYER ===== -->
<div id="now-playing-bar"
     class="fixed bottom-0 left-0 right-0 z-40 bg-dark-nav/98 backdrop-blur-md border-t border-dark-border
            transform translate-y-full transition-transform duration-500">
  <div class="max-w-7xl mx-auto px-4 py-2 flex items-center gap-3 sm:gap-4">

    <!-- Station icon -->
    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-brand-red/20 border border-brand-red/40
                flex items-center justify-center">
      <svg class="w-5 h-5 sm:w-6 sm:h-6 text-brand-red" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 3v10.55A4 4 0 1014 17V7h4V3h-6z"/>
      </svg>
    </div>

    <!-- Info -->
    <div class="flex-1 min-w-0">
      <div class="flex items-center gap-2 mb-0.5">
        <span class="live-dot w-2 h-2 rounded-full bg-brand-red flex-shrink-0" id="sticky-live-dot"></span>
        <span id="np-station" class="text-[10px] sm:text-xs font-bold text-brand-red uppercase tracking-widest">Nesam FM</span>
        <span id="sticky-stream-status" class="px-1.5 py-0.5 bg-brand-red/20 border border-brand-red/30 text-brand-red rounded-sm text-[9px] font-bold uppercase tracking-wider ml-0.5"><?= $ml->tr('Live') ?></span>
      </div>
      <div class="flex items-baseline gap-1.5">
        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold hidden sm:inline-block flex-shrink-0"><?= $ml->tr('Now Playing:') ?></span>
        <div id="np-song" class="text-xs sm:text-sm font-semibold text-white truncate w-full"><?= $ml->tr('Loading...') ?></div>
      </div>
    </div>

    <!-- Progress (visual only for live) -->
    <div class="hidden sm:flex flex-1 max-w-xs items-center gap-2">
      <div class="flex-1 h-1 bg-white/10 rounded-full overflow-hidden">
        <div id="np-progress" class="h-full bg-gradient-to-r from-brand-red to-brand-blue rounded-full w-0 transition-all duration-1000"></div>
      </div>
    </div>

    <!-- Controls -->
    <div class="flex items-center gap-2">
      <button id="np-play-btn" aria-label="Play/Pause"
              class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-brand-red hover:bg-brand-redDk text-white
                     flex items-center justify-center transition-all duration-200 active:scale-95">
        <svg id="np-play-icon" class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M8 5v14l11-7z"/>
        </svg>
        <svg id="np-pause-icon" class="w-4 h-4 hidden" fill="currentColor" viewBox="0 0 24 24">
          <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
        </svg>
      </button>
      <!-- Volume -->
      <input id="np-volume" type="range" min="0" max="1" step="0.05" value="0.8"
             class="hidden sm:block w-20 accent-brand-red" aria-label="Volume">
      <!-- Expand -->
      <a href="<?= BASE_PATH ?>/live.php" id="np-expand-btn" aria-label="Open full player"
         class="p-2 rounded-lg text-gray-400 hover:text-white transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
        </svg>
      </a>
    </div>
  </div>
  <!-- Hidden audio element -->
  <audio id="np-audio" preload="none"></audio>
</div>

<!-- ===== FOOTER ===== -->
<footer class="bg-dark-card border-t border-dark-border mt-16 pb-24">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">

      <!-- Brand -->
      <div class="sm:col-span-2 lg:col-span-1">
        <a href="<?= BASE_PATH ?>/" class="flex items-center gap-3 mb-4">
          <img src="<?= BASE_PATH ?>/assets/images/logo.png" alt="Nesam Media Logo" class="h-12 w-auto" onerror="this.src='<?= BASE_PATH ?>/nesam_media_logo.png'">
          <div>
            <div class="text-lg font-bold text-white"><?= $ml->tr('Nesam Radio') ?></div>
            <div class="text-xs text-brand-red font-semibold"><?= $ml->tr('Radio with Love ❤️') ?></div>
          </div>
        </a>
        <p class="text-gray-400 text-sm leading-relaxed mb-4">
          <?= $ml->tr('Tamil Nadu & Puducherry\'s favourite online radio. Spreading love through music, culture, and stories since 2020.') ?>
        </p>
        <!-- Social links -->
        <div class="flex gap-3">
          <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>" target="_blank" rel="noopener" id="footer-whatsapp"
             aria-label="WhatsApp"
             class="w-9 h-9 rounded-full bg-green-500/20 border border-green-500/30 flex items-center justify-center text-green-400 hover:bg-green-500/30 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.556 4.116 1.527 5.845L0 24l6.335-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.893 0-3.667-.502-5.197-1.377l-.373-.22-3.76.895.947-3.645-.243-.378A9.942 9.942 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
          </a>
          <a href="https://facebook.com/nesammedia" target="_blank" rel="noopener" id="footer-facebook"
             aria-label="Facebook"
             class="w-9 h-9 rounded-full bg-blue-500/20 border border-blue-500/30 flex items-center justify-center text-blue-400 hover:bg-blue-500/30 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://instagram.com/nesammedia" target="_blank" rel="noopener" id="footer-instagram"
             aria-label="Instagram"
             class="w-9 h-9 rounded-full bg-pink-500/20 border border-pink-500/30 flex items-center justify-center text-pink-400 hover:bg-pink-500/30 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a href="https://youtube.com/@nesammedia" target="_blank" rel="noopener" id="footer-youtube"
             aria-label="YouTube"
             class="w-9 h-9 rounded-full bg-red-500/20 border border-red-500/30 flex items-center justify-center text-red-400 hover:bg-red-500/30 transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wide"><?= $ml->tr('Quick Links') ?></h3>
        <ul class="space-y-2 text-sm">
          <?php foreach ([
            [BASE_PATH.'/live.php','🎵 ' . $ml->tr('Listen Live Now')],
            [BASE_PATH.'/stations.php','📻 ' . $ml->tr('Stations')],
            [BASE_PATH.'/schedule.php','🕐 ' . $ml->tr('Schedule')],
            [BASE_PATH.'/podcasts.php','🎙️ ' . $ml->tr('Podcasts')],
            [BASE_PATH.'/blog.php','📰 ' . $ml->tr('Blog')],
            [BASE_PATH.'/about.php','ℹ️ ' . $ml->tr('About')],
            [BASE_PATH.'/contact.php','📞 ' . $ml->tr('Contact')],
          ] as [$href,$lbl]): ?>
          <li><a href="<?= $href ?>" class="text-gray-400 hover:text-white transition-colors"><?= $lbl ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Stations -->
      <div>
        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wide"><?= $ml->tr('Our Channels') ?></h3>
        <ul class="space-y-2 text-sm">
          <?php foreach ([
            'Nesam FM','Nesam Devotional','Nesam News','Nesam Hits','Nesam Retro','Nesam Kids'
          ] as $station): ?>
          <li>
            <a href="<?= BASE_PATH ?>/live.php?station=<?= urlencode(strtolower(str_replace(' ','-',$station))) ?>"
               class="text-gray-400 hover:text-white transition-colors flex items-center gap-2">
              <span class="w-1.5 h-1.5 rounded-full bg-brand-red"></span>
              <?= $station ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wide"><?= $ml->tr('Contact Us') ?></h3>
        <ul class="space-y-3 text-sm text-gray-400">
          <li class="flex gap-2">
            <svg class="w-4 h-4 text-brand-red flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span><?= SITE_ADDRESS ?></span>
          </li>
          <li class="flex gap-2">
            <svg class="w-4 h-4 text-brand-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <a href="tel:<?= str_replace([' ','+'], '', SITE_PHONE) ?>" class="hover:text-white transition-colors"><?= SITE_PHONE ?></a>
          </li>
          <li class="flex gap-2">
            <svg class="w-4 h-4 text-brand-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <a href="mailto:<?= SITE_EMAIL ?>" class="hover:text-white transition-colors"><?= SITE_EMAIL ?></a>
          </li>
        </ul>

        <!-- Request a song shortcut -->
        <a href="<?= BASE_PATH ?>/contact.php#request-song" id="footer-request-song"
           class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-brand-blue/20 border border-brand-blue/40
                  text-brand-blue text-sm font-medium rounded-lg hover:bg-brand-blue/30 transition-colors">
          <?= $ml->tr('🎵 Request a Song') ?>
        </a>
      </div>

    </div>

    <!-- Divider -->
    <div class="border-t border-dark-border mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
      <p><?= $ml->tr('© 2026 Nesam Media Works. Made with ❤️ in Tamil Nadu & Puducherry.') ?></p>
      <p>
        <a href="<?= BASE_PATH ?>/privacy.php" class="hover:text-gray-300 transition-colors"><?= $ml->tr('Privacy Policy') ?></a> ·
        <a href="<?= BASE_PATH ?>/terms.php"   class="hover:text-gray-300 transition-colors"><?= $ml->tr('Terms') ?></a>
      </p>
    </div>
  </div>
</footer>

<!-- ===== WHATSAPP FLOAT BUTTON ===== -->
<a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Hi+Nesam+Radio%21+I+want+to+request+a+song." id="whatsapp-fab"
   target="_blank" rel="noopener" aria-label="Chat on WhatsApp"
   class="fixed bottom-24 right-4 sm:right-6 z-50 w-14 h-14 bg-green-500 hover:bg-green-600
          rounded-full shadow-lg shadow-green-500/30 flex items-center justify-center
          transition-all duration-300 hover:scale-110 active:scale-95">
  <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.556 4.116 1.527 5.845L0 24l6.335-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.893 0-3.667-.502-5.197-1.377l-.373-.22-3.76.895.947-3.645-.243-.378A9.942 9.942 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
  </svg>
</a>

<!-- Global Scripts (inlined via PHP – avoids URL path issues on any host) -->
<script><?php
  $jsFile = __DIR__ . '/../assets/js/main.js';
  if (file_exists($jsFile)) { readfile($jsFile); }
?></script>
</body>
</html>
