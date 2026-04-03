<?php
require_once 'config.php';
$pageTitle = 'Live Radio – Nesam Radio | Listen Live Tamil Music Online';
$pageDesc  = 'Listen to Nesam FM live – Tamil film hits, devotional, news, retro & kids channels. Request a song. 24/7 live Tamil radio streaming.';
$canonUrl  = SITE_URL . '/live.php';

$streams = json_decode(STREAMS, true);
$activeStation = $_GET['station'] ?? 'nesam-fm';
if (!array_key_exists($activeStation, $streams)) $activeStation = 'nesam-fm';

include 'partials/header.php';
?>

<section id="live-radio" class="min-h-screen py-24 px-4 relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-dark-nav via-dark-bg to-[#0A1628]"></div>
  <div class="absolute inset-0 hero-glow opacity-30"></div>

  <div class="relative z-10 max-w-7xl mx-auto">
    <div class="text-center mb-10">
      <span class="section-badge mb-3">📻 On Air</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-2">Live Radio ❤️</h1>
      <p class="text-gray-400">Pick your channel and feel the Tamil vibration</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

      <!-- Station List -->
      <div class="lg:col-span-1 space-y-3" id="station-list">
        <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-4">Choose Channel</h2>
        <?php foreach ($streams as $id => $s):
          $icons = ['nesam-fm'=>'🎬','nesam-devotional'=>'🕉️','nesam-news'=>'📰','nesam-hits'=>'🔥','nesam-retro'=>'💿','nesam-kids'=>'🌟'];
          $icon = $icons[$id] ?? '📻';
        ?>
        <button onclick="switchStation('<?= $id ?>')" id="station-btn-<?= $id ?>"
                data-active="<?= $id === $activeStation ? 'true' : 'false' ?>"
                class="station-list-btn w-full flex items-center gap-4 p-4 rounded-2xl border transition-all duration-200 text-left
                       <?= $id === $activeStation
                           ? 'bg-brand-red/20 border-brand-red/50 text-white'
                           : 'bg-dark-card border-dark-border text-gray-300 hover:border-brand-blue/40 hover:bg-brand-blue/10' ?>">
          <div class="text-2xl flex-shrink-0"><?= $icon ?></div>
          <div class="flex-1 min-w-0">
            <div class="font-bold text-sm"><?= h($s['name']) ?></div>
            <div class="text-xs text-gray-500 truncate"><?= h($s['genre']) ?></div>
          </div>
          <div class="flex items-center gap-1.5 flex-shrink-0">
            <span class="<?= $id === $activeStation ? 'live-dot' : '' ?> w-2 h-2 rounded-full <?= $id === $activeStation ? 'bg-brand-red' : 'bg-gray-600' ?>"></span>
          </div>
        </button>
        <?php endforeach; ?>
      </div>

      <!-- Main Player -->
      <div class="lg:col-span-2 space-y-6">

        <!-- Player card -->
        <div class="glass-card rounded-3xl p-8 text-center relative overflow-hidden">
          <div class="absolute inset-0 hero-glow opacity-20"></div>
          <div class="relative z-10">

            <!-- Station icon large -->
            <div id="player-icon" class="text-7xl mb-4">🎬</div>

            <!-- Station name / now playing -->
            <div class="flex items-center justify-center gap-2 mb-2">
              <span id="main-live-dot" class="live-dot w-2 h-2 rounded-full bg-brand-red flex-shrink-0"></span>
              <div id="player-station-name" class="text-brand-red font-bold text-sm uppercase tracking-widest">Nesam FM</div>
              <div id="main-stream-status" class="px-2 py-0.5 bg-brand-red/20 border border-brand-red/30 text-brand-red rounded-full text-[10px] font-bold uppercase tracking-wide ml-1">Live</div>
            </div>
            <div class="text-[10px] text-gray-500 uppercase tracking-widest font-bold mb-1">Now Playing</div>
            <h2 id="player-song-title" class="text-2xl sm:text-3xl font-black text-white mb-1 leading-tight">Vellai Pookal</h2>
            <div id="player-artist" class="text-gray-400 text-sm font-medium mb-6">AR Rahman · Tamil Film Hits</div>

            <!-- EQ Bars (shows when playing) -->
            <div id="player-eq" class="flex justify-center gap-2 mb-6 opacity-0 transition-opacity duration-300">
              <?php for ($i=0;$i<8;$i++): ?>
              <div class="eq-bar <?= $i%2===0 ? 'bg-brand-red' : 'bg-brand-blue' ?>" style="height:<?= rand(6,22) ?>px"></div>
              <?php endfor; ?>
            </div>

            <!-- Big play button -->
            <button id="main-play-btn" onclick="toggleMainPlayer()"
                    class="w-24 h-24 rounded-full bg-gradient-to-br from-brand-red to-brand-redDk shadow-2xl shadow-brand-red/40
                           flex items-center justify-center mx-auto mb-8 hover:scale-110 active:scale-95 transition-all duration-200">
              <svg id="main-play-icon"  class="w-10 h-10 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
              <svg id="main-pause-icon" class="w-10 h-10 text-white hidden" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
            </button>

            <!-- Volume control -->
            <div class="flex items-center justify-center gap-3 mb-6">
              <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z"/></svg>
              <input id="main-volume" type="range" min="0" max="1" step="0.05" value="0.8" class="w-32 accent-brand-red" aria-label="Volume">
              <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
            </div>

            <!-- Share buttons -->
            <div class="flex justify-center gap-3 flex-wrap">
              <a href="https://wa.me/?text=I%27m+listening+to+Nesam+Radio+%E2%9D%A4%EF%B8%8F+Join+me%21+https%3A%2F%2Fnesammedia.com"
                 target="_blank" id="share-whatsapp"
                 class="flex items-center gap-2 px-4 py-2 bg-green-500/20 border border-green-500/30 text-green-400 rounded-full text-sm font-semibold hover:bg-green-500/30 transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.556 4.116 1.527 5.845L0 24l6.335-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.893 0-3.667-.502-5.197-1.377l-.373-.22-3.76.895.947-3.645-.243-.378A9.942 9.942 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
                WhatsApp
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u=https://nesammedia.com/live.php"
                 target="_blank" id="share-facebook"
                 class="flex items-center gap-2 px-4 py-2 bg-blue-500/20 border border-blue-500/30 text-blue-400 rounded-full text-sm font-semibold hover:bg-blue-500/30 transition-colors">
                Facebook
              </a>
              <button onclick="navigator.clipboard.writeText(location.href).then(()=>alert('Link copied!'))"
                      id="share-copy"
                      class="flex items-center gap-2 px-4 py-2 bg-white/10 border border-white/20 text-gray-300 rounded-full text-sm font-semibold hover:bg-white/20 transition-colors">
                🔗 Copy Link
              </button>
            </div>
          </div>
        </div>

        <!-- Song Request Form -->
        <div id="request-song" class="glass-card rounded-3xl p-8">
          <h3 class="text-xl font-bold text-white mb-1">🎵 Request a Song</h3>
          <p class="text-gray-400 text-sm mb-6">Tell us what you want to hear – we'll play it for you ❤️</p>
          <form id="song-request-form" class="space-y-4">
            <input type="hidden" name="station" id="req-station-hidden" value="<?= h($activeStation) ?>">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label for="req-name" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Your Name *</label>
                <input id="req-name" name="requester_name" type="text" required placeholder="e.g. Karthik"
                       class="nesam-input" maxlength="100">
              </div>
              <div>
                <label for="req-phone" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Phone (optional)</label>
                <input id="req-phone" name="phone" type="tel" placeholder="+91 98765 43210"
                       class="nesam-input" maxlength="20">
              </div>
            </div>
            <div>
              <label for="req-song" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Song Name & Artist *</label>
              <input id="req-song" name="song_name" type="text" required placeholder="e.g. Roja Kaadhali – AR Rahman"
                     class="nesam-input" maxlength="200">
            </div>
            <button type="submit" id="req-submit-btn" class="btn-primary w-full justify-center py-3 rounded-xl">
              Send Request ❤️
            </button>
            <p id="req-status" class="text-sm"></p>
          </form>
        </div>

      </div>
    </div>
  </div>
</section>

<script>
const STREAM_DATA = <?= STREAMS ?>;
const stationIcons = {
  'nesam-fm':'🎬','nesam-devotional':'🕉️','nesam-news':'📰',
  'nesam-hits':'🔥','nesam-retro':'💿','nesam-kids':'🌟'
};
let mainIsPlaying = false;
let mainStation = '<?= h($activeStation) ?>';

function switchStation(id) {
  mainStation = id;
  const s = STREAM_DATA[id];
  if (!s) return;
  document.getElementById('player-station-name').textContent = s.name;
  document.getElementById('player-song-title').textContent   = '♪ Live Stream';
  document.getElementById('player-artist').textContent       = s.genre;
  document.getElementById('player-icon').textContent         = stationIcons[id] || '📻';
  document.getElementById('req-station-hidden').value        = id;

  // Update station buttons via data-active (theme-safe)
  document.querySelectorAll('.station-list-btn').forEach(btn => {
    btn.dataset.active = 'false';
    btn.classList.remove('bg-brand-red/20','border-brand-red/50','text-white');
    btn.classList.add('bg-dark-card','border-dark-border','text-gray-300');
  });
  const activeBtn = document.getElementById('station-btn-'+id);
  if (activeBtn) {
    activeBtn.dataset.active = 'true';
    activeBtn.classList.remove('bg-dark-card','border-dark-border','text-gray-300');
    activeBtn.classList.add('bg-brand-red/20','border-brand-red/50','text-white');
  }

  if (mainIsPlaying) {
    // Auto-switch stream
    const audio = document.getElementById('np-audio');
    if (audio) { audio.src = s.url; audio.load(); audio.play().catch(()=>{}); }
    window.playStation && window.playStation(id);
  }
}

function toggleMainPlayer() {
  const audio = document.getElementById('np-audio');
  const playI = document.getElementById('main-play-icon');
  const pauseI = document.getElementById('main-pause-icon');
  const eq    = document.getElementById('player-eq');

  if (!audio) return;
  if (audio.paused || !mainIsPlaying) {
    audio.src = STREAM_DATA[mainStation].url;
    audio.load();
    audio.play().then(() => {
      mainIsPlaying = true;
      playI.classList.add('hidden');
      pauseI.classList.remove('hidden');
      eq.classList.remove('opacity-0'); eq.classList.add('opacity-100');
    }).catch(() => {});
    window.playStation && window.playStation(mainStation);
  } else {
    audio.pause();
    mainIsPlaying = false;
    playI.classList.remove('hidden');
    pauseI.classList.add('hidden');
    eq.classList.remove('opacity-100'); eq.classList.add('opacity-0');
  }
}

// Volume sync
const mainVol = document.getElementById('main-volume');
const audio   = document.getElementById('np-audio');
if (mainVol && audio) {
  mainVol.addEventListener('input', () => { audio.volume = parseFloat(mainVol.value); });
}

// Global syncStationUI hook
window.syncStationUI = function(id) { switchStation(id); };
</script>

<?php include 'partials/footer.php'; ?>
