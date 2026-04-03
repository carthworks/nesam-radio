<?php
require_once 'config.php';
$pageTitle = 'Nesam Radio – Tamil Online Radio | Live Tamil Music, Devotional & Podcasts';
$pageDesc  = 'Nesam Radio – Radio with Love ❤️. Live Tamil music, devotional songs, news, retro, kids channels & podcasts. Listen 24/7 from anywhere in the world.';
$pageKw    = 'Nesam Radio, Tamil online radio, Tamil FM, live Tamil music, Tamil devotional, Kollywood hits, Tamil podcast, Nesam Media';
$canonUrl  = SITE_URL . '/';

$streams = json_decode(STREAMS, true);

include 'partials/header.php';
?>

<!-- ===== HERO ===== -->
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden">
  <!-- Animated background -->
  <div class="absolute inset-0 bg-gradient-to-br from-dark-nav via-dark-bg to-[#0A1628]"></div>
  <div class="absolute inset-0 hero-glow opacity-60"></div>

  <!-- Floating radio waves circles -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 sm:w-72 sm:h-72 rounded-full border border-brand-red/10 animate-ping" style="animation-duration:4s"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 sm:w-96 sm:h-96 rounded-full border border-brand-blue/10 animate-ping" style="animation-duration:5s;animation-delay:1s"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 sm:w-[500px] sm:h-[500px] rounded-full border border-brand-red/5 animate-ping" style="animation-duration:6s;animation-delay:2s"></div>
  </div>

  <!-- Grid dots pattern -->
  <div class="absolute inset-0 opacity-5" style="background-image:radial-gradient(rgba(255,255,255,0.4) 1px, transparent 1px);background-size:32px 32px;"></div>

  <!-- Hero content -->
  <div class="relative z-10 text-center px-4 max-w-4xl mx-auto py-24">
    <!-- Live badge -->
    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-brand-red/20 border border-brand-red/40 rounded-full text-brand-red text-sm font-bold mb-6 animate-fadeInUp">
      <span class="live-dot w-2 h-2 rounded-full bg-brand-red"></span>
      24/7 LIVE NOW ON AIR
    </div>

    <!-- Headline -->
    <h1 class="hero-title text-5xl sm:text-6xl lg:text-7xl font-black leading-tight mb-4 animate-fadeInUp delay-100">
      <span class="text-white">Nesam Radio</span><br>
      <span class="gradient-text">Radio with Love ❤️</span>
    </h1>

    <!-- Sub-headline -->
    <p class="text-lg sm:text-xl text-gray-300 max-w-2xl mx-auto mb-8 animate-fadeInUp delay-200">
      Live Tamil music, devotional songs, latest hits, news &amp; podcasts<br class="hidden sm:block">
      – straight from the heart of Tamil Nadu. Listen anytime, anywhere.
    </p>

    <!-- CTA buttons -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fadeInUp delay-300">
      <button onclick="playStation('nesam-fm')" id="hero-listen-btn"
              class="btn-primary text-base px-8 py-4 rounded-xl shadow-lg shadow-brand-red/30 group">
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
        Listen Live Now
      </button>
      <a href="/stations.php" id="hero-stations-btn"
         class="btn-outline text-base px-8 py-4 rounded-xl">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2zm12-3c0 1.105-.895 2-2 2s-2-.895-2-2 .895-2 2-2 2 .895 2 2z"/>
        </svg>
        Explore Stations
      </a>
    </div>

    <!-- Now playing preview -->
    <div class="mt-10 inline-flex items-center gap-3 px-5 py-3 glass-card rounded-2xl animate-fadeInUp delay-400">
      <div class="eq-wrapper">
        <div class="eq-bar h-3 bg-brand-red"></div>
        <div class="eq-bar h-5 bg-brand-red"></div>
        <div class="eq-bar h-2 bg-brand-blue"></div>
        <div class="eq-bar h-4 bg-brand-blue"></div>
      </div>
      <div class="text-left">
        <div class="text-xs text-gray-400 uppercase tracking-wide">Now Playing</div>
        <div id="hero-now-playing" class="text-sm font-semibold text-white">Vellai Pookal – AR Rahman</div>
      </div>
      <div class="text-xs px-2 py-1 bg-brand-red/20 text-brand-red rounded-full font-bold">Nesam FM</div>
    </div>
  </div>

  <!-- Scroll indicator -->
  <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce-sm">
    <div class="w-6 h-10 border-2 border-white/20 rounded-full flex justify-center pt-2">
      <div class="w-1 h-3 bg-white/40 rounded-full"></div>
    </div>
  </div>
</section>

<!-- ===== TRUST BAR ===== -->
<section id="trust-bar" class="bg-dark-card border-y border-dark-border py-5">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-wrap justify-center gap-6 sm:gap-10 text-center">
      <?php foreach ([
        ['10,000+','Daily Listeners','❤️'],
        ['24/7',   'Live Broadcast', '📻'],
        ['6+',     'Channels',       '🎵'],
        ['Made in','Tamil Nadu &amp; Puducherry','🌟'],
      ] as [$num,$lbl,$icon]): ?>
      <div class="animate-on-scroll">
        <div class="text-2xl font-black text-white"><?= $icon ?> <?= $num ?></div>
        <div class="text-xs text-gray-400 mt-0.5"><?= $lbl ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== WELCOME SECTION ===== -->
<section id="welcome" class="py-20 px-4">
  <div class="max-w-7xl mx-auto">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <!-- Text -->
      <div class="animate-on-scroll">
        <span class="section-badge mb-4">❤️ Welcome to Nesam</span>
        <h2 class="section-title text-3xl sm:text-4xl font-black text-white mb-4 leading-tight">
          Your One-Stop Tamil<br>Entertainment Destination
        </h2>
        <p class="text-gray-400 text-lg leading-relaxed mb-4">
          Welcome to <strong class="text-white">Nesam Media Works</strong> – your one-stop digital entertainment destination.
          We bring you the best of Tamil web radio, podcasts, audiobooks, devotional content, film music, and regional hits.
        </p>
        <p class="text-gray-400 leading-relaxed mb-6">
          Whether you're in Chennai, Puducherry, or anywhere in the world, Nesam Radio keeps you connected to your roots and rhythms.
          <strong class="text-brand-blue">Nesam</strong> means <strong class="text-brand-red">Love</strong> in Tamil – and love is what we pour into every broadcast.
        </p>
        <div class="flex gap-3 flex-wrap">
          <a href="/live.php" id="welcome-listen-btn" class="btn-primary">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            Start Listening Free →
          </a>
          <a href="/about.php" class="btn-outline">Learn Our Story</a>
        </div>
      </div>

      <!-- Stats cards -->
      <div class="grid grid-cols-2 gap-4 animate-on-scroll">
        <?php foreach ([
          ['12,450+','Monthly Active Listeners','text-brand-red','from-brand-red/20 to-transparent'],
          ['98%',    'Recommendation Rate',      'text-brand-blue','from-brand-blue/20 to-transparent'],
          ['4.9/5',  'Average Rating ⭐',         'text-yellow-400','from-yellow-500/20 to-transparent'],
          ['20+ yrs','Combined Experience',       'text-green-400', 'from-green-500/20 to-transparent'],
        ] as [$n,$l,$color,$grad]): ?>
        <div class="p-6 rounded-2xl bg-gradient-to-br <?= $grad ?> border border-white/5 card-hover">
          <div class="text-3xl font-black <?= $color ?> mb-1"><?= $n ?></div>
          <div class="text-gray-400 text-sm"><?= $l ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ===== STATIONS SECTION ===== -->
<section id="stations" class="py-20 px-4 bg-dark-card">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-12 animate-on-scroll">
      <span class="section-badge mb-4">📻 Channels</span>
      <h2 class="text-3xl sm:text-4xl font-black text-white mb-3">Discover Your Favourite Channel</h2>
      <p class="text-gray-400 max-w-xl mx-auto">Six handcrafted channels for every mood. Film hits to devotional, retro classics to kids – all in Tamil, all with love.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php
      $stationCards = [
        ['nesam-fm',        'Nesam FM',         'Tamil Film Hits & Classics', 'Non-stop entertainment', '🎬', 'from-red-900/40 to-dark-card',    'border-brand-red/30'],
        ['nesam-devotional','Nesam Devotional',  'Devotional & Bhajans',        'Peace for your soul',    '🕉️', 'from-yellow-900/30 to-dark-card',  'border-yellow-500/30'],
        ['nesam-news',      'Nesam News',         'Tamil Nadu & India News',     'Stay updated in Tamil',  '📰', 'from-blue-900/30 to-dark-card',    'border-blue-500/30'],
        ['nesam-hits',      'Nesam Hits',         'Latest Tamil & Kollywood',    'Trending now',           '🔥', 'from-orange-900/30 to-dark-card',  'border-orange-500/30'],
        ['nesam-retro',     'Nesam Retro',        '80s–2000s Tamil Classics',    'Memories reloaded',      '💿', 'from-purple-900/30 to-dark-card',  'border-purple-500/30'],
        ['nesam-kids',      'Nesam Kids',         'Children Stories & Songs',    'Fun for little ones',    '🌟', 'from-green-900/30 to-dark-card',   'border-green-500/30'],
      ];
      foreach ($stationCards as [$id, $name, $genre, $tagline, $emoji, $grad, $border]):
      ?>
      <div class="relative group bg-gradient-to-br <?= $grad ?> border <?= $border ?> rounded-2xl p-6 card-hover cursor-pointer animate-on-scroll"
           onclick="playStation('<?= $id ?>')" id="station-card-<?= $id ?>">
        <!-- Live indicator -->
        <div class="absolute top-4 right-4 flex items-center gap-1.5 px-2.5 py-1 bg-black/40 rounded-full">
          <span class="live-dot w-1.5 h-1.5 rounded-full bg-brand-red"></span>
          <span class="text-[10px] text-white font-bold tracking-wide">LIVE</span>
        </div>

        <!-- Icon -->
        <div class="text-4xl mb-4"><?= $emoji ?></div>

        <!-- Info -->
        <h3 class="text-lg font-bold text-white mb-1"><?= $name ?></h3>
        <div class="text-xs text-gray-500 uppercase tracking-wide mb-2"><?= $genre ?></div>
        <p class="text-gray-400 text-sm mb-5"><?= $tagline ?></p>

        <!-- Play button -->
        <button class="flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-brand-red text-white text-sm font-semibold rounded-full transition-all duration-200 group-hover:bg-brand-red">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          Play Now
        </button>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-8">
      <a href="/stations.php" id="view-all-stations-btn" class="btn-secondary inline-flex">
        View All Channels →
      </a>
    </div>
  </div>
</section>

<!-- ===== WHY NESAM ===== -->
<section id="why-nesam" class="py-20 px-4">
  <div class="max-w-7xl mx-auto">
    <div class="text-center mb-12 animate-on-scroll">
      <span class="section-badge mb-4">✨ Why Choose Us</span>
      <h2 class="text-3xl sm:text-4xl font-black text-white mb-3">Why Nesam Radio?</h2>
      <p class="text-gray-400 max-w-xl mx-auto">We're not just a radio station – we're a community that celebrates Tamil culture, language, and love.</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ([
        ['🎵','Crystal-Clear Streaming','24/7 HD audio with zero buffering on any device or connection.'],
        ['🇮🇳','Tamil-First Content','Every song, show, and story crafted for Tamilians worldwide.'],
        ['📱','Listen Everywhere','Web, mobile, smart TV – music follows you anywhere.'],
        ['❤️','Community Driven','Your song requests, your playlists, your radio.'],
      ] as [$icon,$h,$p]): ?>
      <div class="glass-card rounded-2xl p-6 card-hover animate-on-scroll text-center">
        <div class="text-4xl mb-4"><?= $icon ?></div>
        <h3 class="text-white font-bold mb-2"><?= $h ?></h3>
        <p class="text-gray-400 text-sm leading-relaxed"><?= $p ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== FEATURED PODCASTS ===== -->
<section id="featured-podcasts" class="py-20 px-4 bg-dark-card">
  <div class="max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-10 animate-on-scroll">
      <div>
        <span class="section-badge mb-3">🎙️ Podcasts</span>
        <h2 class="text-3xl sm:text-4xl font-black text-white">Listen Again – Podcasts &amp; Shows</h2>
      </div>
      <a href="/podcasts.php" class="btn-outline text-sm shrink-0">All Episodes →</a>
    </div>

    <?php
    $db = getDB();
    $podcasts = [];
    if ($db) {
        $result = $db->query('SELECT * FROM podcasts ORDER BY published_at DESC LIMIT 3');
        if ($result) $podcasts = $result->fetchAll();
    }
    if (!$podcasts) {
        $podcasts = [
            ['id'=>1,'title'=>'Top 10 Tamil Songs of 2026','host'=>'RJ Kavya','category'=>'Cinema Talk','duration'=>'42 mins','description'=>'A countdown of the biggest Tamil chartbusters of 2026.'],
            ['id'=>2,'title'=>'Tamil Diaspora Stories – Ep 12','host'=>'RJ Karthik','category'=>'Culture','duration'=>'35 mins','description'=>'How Tamilians worldwide use Nesam Radio to stay connected.'],
            ['id'=>3,'title'=>'Health & Wellness in Tamil','host'=>'Dr. Priya','category'=>'Health','duration'=>'28 mins','description'=>'Simple health tips in Tamil – diet, yoga, Siddha medicine.'],
        ];
    }
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($podcasts as $i => $ep): ?>
      <div class="bg-dark-bg border border-dark-border rounded-2xl overflow-hidden card-hover animate-on-scroll group" style="animation-delay:<?= $i * 0.1 ?>s">
        <!-- Thumbnail placeholder with gradient -->
        <div class="relative h-44 bg-gradient-to-br from-brand-red/30 to-brand-blue/30 flex items-center justify-center">
          <div class="text-5xl">🎙️</div>
          <div class="absolute top-3 right-3 px-2 py-1 bg-black/50 rounded-full text-xs text-gray-300">
            <?= h($ep['duration'] ?? '30 mins') ?>
          </div>
          <div class="absolute bottom-3 left-3 px-2 py-1 bg-brand-red/80 rounded-full text-xs text-white font-semibold">
            <?= h($ep['category'] ?? 'Podcast') ?>
          </div>
        </div>
        <div class="p-5">
          <h3 class="text-white font-bold mb-1 group-hover:text-brand-red transition-colors"><?= h($ep['title']) ?></h3>
          <div class="text-xs text-gray-500 mb-3">by <?= h($ep['host'] ?? 'Nesam Team') ?></div>
          <p class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-2"><?= h(substr($ep['description'] ?? '',0,100)) ?>…</p>
          <div class="flex gap-2">
            <button onclick="playStation('nesam-fm')"
                    class="flex-1 btn-primary text-xs py-2 px-3 rounded-lg justify-center">
              ▶ Play
            </button>
            <a href="/podcasts.php" class="flex-1 btn-outline text-xs py-2 px-3 rounded-lg justify-center text-center">
              Details
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== BLOG PREVIEW ===== -->
<section id="blog-preview" class="py-20 px-4">
  <div class="max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-10 animate-on-scroll">
      <div>
        <span class="section-badge mb-3">📰 News & Blog</span>
        <h2 class="text-3xl sm:text-4xl font-black text-white">Latest from Nesam</h2>
      </div>
      <a href="/blog.php" class="btn-outline text-sm shrink-0">All Articles →</a>
    </div>

    <?php
    $posts = [];
    if ($db) {
        $result = $db->query('SELECT id,title,slug,excerpt,author,published_at FROM blog_posts ORDER BY published_at DESC LIMIT 3');
        if ($result) $posts = $result->fetchAll();
    }
    if (!$posts) {
        $posts = [
            ['id'=>1,'title'=>'Top 10 Tamil Songs of 2026 So Far','slug'=>'top-10-tamil-songs-2026','excerpt'=>'Discover the hottest Tamil tracks that are ruling the charts in 2026.','author'=>'Nesam Team','published_at'=>'2026-03-20'],
            ['id'=>2,'title'=>'How Nesam Radio is Connecting Tamil Diaspora Worldwide','slug'=>'nesam-radio-tamil-diaspora','excerpt'=>'From London to Singapore, Tamilians tune into Nesam Radio.','author'=>'RJ Karthik','published_at'=>'2026-03-10'],
            ['id'=>3,'title'=>'Why Tamil Radio is Making a Massive Comeback in 2026','slug'=>'tamil-radio-comeback-2026','excerpt'=>'Digital radio is having a renaissance. Here\'s why Tamil online radio is leading.','author'=>'Nesam Team','published_at'=>'2026-02-15'],
        ];
    }
    ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($posts as $i => $post): ?>
      <article class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden card-hover animate-on-scroll group" style="animation-delay:<?= $i * 0.1 ?>s">
        <div class="h-48 bg-gradient-to-br from-brand-blue/20 to-brand-red/20 flex items-center justify-center text-5xl">
          <?= ['🎵','📻','🌍'][$i % 3] ?>
        </div>
        <div class="p-6">
          <div class="text-xs text-gray-500 mb-2">
            <?= date('d M Y', strtotime($post['published_at'] ?? 'today')) ?> · <?= h($post['author'] ?? 'Nesam Team') ?>
          </div>
          <h3 class="text-white font-bold mb-2 leading-tight group-hover:text-brand-blue transition-colors">
            <a href="/blog.php?slug=<?= h($post['slug'] ?? $post['id']) ?>"><?= h($post['title']) ?></a>
          </h3>
          <p class="text-gray-400 text-sm leading-relaxed mb-4"><?= h(substr($post['excerpt'] ?? '',0,110)) ?>…</p>
          <a href="/blog.php?slug=<?= h($post['slug'] ?? $post['id']) ?>"
             class="text-brand-blue text-sm font-semibold hover:text-brand-red transition-colors">
            Read More →
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section id="cta-banner" class="py-20 px-4">
  <div class="max-w-4xl mx-auto animate-on-scroll">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-brand-red via-[#9B1C1C] to-brand-blue p-1">
      <div class="rounded-[22px] bg-dark-bg p-10 sm:p-14 text-center relative overflow-hidden">
        <div class="absolute inset-0 hero-glow opacity-30"></div>
        <div class="relative z-10">
          <div class="text-5xl mb-4">❤️</div>
          <h2 class="text-3xl sm:text-4xl font-black text-white mb-3">
            Ready to Feel the Love?
          </h2>
          <p class="text-gray-300 max-w-xl mx-auto mb-8">
            Join 10,000+ Tamilians who start their day with Nesam Radio. No signup needed – just pure Tamil music and culture.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button onclick="playStation('nesam-fm')" id="cta-play-btn" class="btn-primary text-base px-8 py-4 rounded-xl shadow-lg shadow-brand-red/30">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
              Listen Live for Free
            </button>
            <a href="/contact.php#request-song" id="cta-request-btn" class="btn-outline text-base px-8 py-4 rounded-xl">
              🎵 Request Your Song
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'partials/footer.php'; ?>
