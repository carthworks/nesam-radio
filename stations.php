<?php
require_once 'config.php';
$pageTitle = 'All Stations – Nesam Radio | Tamil Music Channels';
$pageDesc  = 'Explore all Nesam Radio channels – Tamil FM, Devotional, News, Hits, Retro, and Kids. One click away from your favourite Tamil music.';
$canonUrl  = SITE_URL . '/stations.php';
$streams = json_decode(STREAMS, true);
include 'partials/header.php';
?>

<section id="stations-page" class="py-24 px-4">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-14">
      <span class="section-badge mb-4">📻 All Channels</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-3">All Channels – One Click Away ❤️</h1>
      <p class="text-gray-400 max-w-xl mx-auto">Six lovingly curated Tamil channels for every moment of your day.</p>
    </div>

    <!-- Stations Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php
      $stationDetails = [
        'nesam-fm' => [
          'icon'   => '🎬',
          'desc'   => 'The flagship station of Nesam Radio. Non-stop Tamil film hits, chart-toppers, and classic cinema melodies. From Ilaiyaraaja to AR Rahman to the latest Kollywood blockbusters.',
          'hours'  => '2,184',
          'color'  => 'from-red-900/50 to-dark-card',
          'border' => 'border-brand-red/40',
          'accent' => 'text-brand-red',
          'badge'  => 'bg-brand-red/20 text-brand-red border-brand-red/30',
        ],
        'nesam-devotional' => [
          'icon'   => '🕉️',
          'desc'   => 'Start your day with divine melodies. Tamil devotional songs, Thiruppugazh, Ashtakam, Thiruvasagam, Suprabhatham, and powerful bhajans 24/7.',
          'hours'  => '1,560',
          'color'  => 'from-yellow-900/40 to-dark-card',
          'border' => 'border-yellow-500/40',
          'accent' => 'text-yellow-400',
          'badge'  => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
        ],
        'nesam-news' => [
          'icon'   => '📰',
          'desc'   => 'Stay updated with Tamil Nadu, India, and world news in your language. Hourly bulletins, in-depth analysis, and live commentary on major events.',
          'hours'  => '1,560',
          'color'  => 'from-blue-900/40 to-dark-card',
          'border' => 'border-blue-500/40',
          'accent' => 'text-blue-400',
          'badge'  => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
        ],
        'nesam-hits' => [
          'icon'   => '🔥',
          'desc'   => 'The hottest Tamil tracks straight from Kollywood. Latest releases, music videos, trending songs, and exclusive premiere tracks.',
          'hours'  => '1,200',
          'color'  => 'from-orange-900/40 to-dark-card',
          'border' => 'border-orange-500/40',
          'accent' => 'text-orange-400',
          'badge'  => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
        ],
        'nesam-retro' => [
          'icon'   => '💿',
          'desc'   => 'Travel back in time with iconic Tamil tracks from the 1980s, 90s, and 2000s. Ilaiyaraaja masterpieces, MGR classics, SPB golden hits.',
          'hours'  => '1,800',
          'color'  => 'from-purple-900/40 to-dark-card',
          'border' => 'border-purple-500/40',
          'accent' => 'text-purple-400',
          'badge'  => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
        ],
        'nesam-kids' => [
          'icon'   => '🌟',
          'desc'   => 'A safe, fun Tamil audio world for children. Tamil nursery rhymes, Aathichudi songs, Panchatantra stories, and educational content.',
          'hours'  => '720',
          'color'  => 'from-green-900/40 to-dark-card',
          'border' => 'border-green-500/40',
          'accent' => 'text-green-400',
          'badge'  => 'bg-green-500/20 text-green-400 border-green-500/30',
        ],
      ];
      foreach ($streams as $id => $s):
        $d = $stationDetails[$id] ?? ['icon'=>'📻','desc'=>'','hours'=>'0','color'=>'from-dark-card','border'=>'border-dark-border','accent'=>'text-white','badge'=>'bg-white/10 text-white border-white/20'];
      ?>
      <div class="group bg-gradient-to-br <?= $d['color'] ?> border <?= $d['border'] ?> rounded-3xl overflow-hidden card-hover animate-on-scroll">
        <!-- Top bar -->
        <div class="p-6 pb-4">
          <div class="flex items-start justify-between mb-4">
            <div class="text-5xl"><?= $d['icon'] ?></div>
            <div class="flex items-center gap-1.5 px-3 py-1 <?= $d['badge'] ?> border rounded-full text-xs font-bold">
              <span class="live-dot w-1.5 h-1.5 rounded-full <?= $d['accent'] === 'text-brand-red' ? 'bg-brand-red' : str_replace('text-','bg-',$d['accent']) ?>"></span>
              LIVE
            </div>
          </div>
          <h2 class="text-xl font-black text-white mb-1"><?= h($s['name']) ?></h2>
          <div class="text-xs uppercase tracking-widest <?= $d['accent'] ?> font-semibold mb-3"><?= h($s['genre']) ?></div>
          <p class="text-gray-400 text-sm leading-relaxed"><?= h($d['desc']) ?></p>
        </div>

        <!-- Stats -->
        <div class="px-6 py-3 border-t border-white/5 flex items-center justify-between">
          <div class="text-xs text-gray-500">
            <span class="font-bold text-gray-300"><?= $d['hours'] ?>h</span> streamed this month
          </div>
          <div class="flex items-center gap-1 text-xs text-gray-500">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
            Listeners: Live
          </div>
        </div>

        <!-- Play button -->
        <div class="px-6 pb-6 pt-3">
          <a href="/live.php?station=<?= urlencode($id) ?>"
             onclick="playStation('<?= $id ?>');return false;"
             id="play-<?= $id ?>"
             class="w-full btn-primary justify-center py-3 rounded-xl group-hover:shadow-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            Play Live
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php include 'partials/footer.php'; ?>
