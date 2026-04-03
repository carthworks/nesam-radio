<?php
require_once 'config.php';
$pageTitle = 'Podcasts & Shows – Nesam Radio | Tamil Audio Podcasts On-Demand';
$pageDesc  = 'Listen to Tamil podcasts on-demand – cinema talk, culture, health, business, and spirituality. Download episodes from Nesam Radio.';
$canonUrl  = SITE_URL . '/podcasts.php';

$categories = ['All','Cinema Talk','Culture','Health','Business','Spiritual'];
$activeCategory = $_GET['cat'] ?? 'All';
if (!in_array($activeCategory, $categories)) $activeCategory = 'All';

$db = getDB();
$podcasts = [];
if ($db) {
    if ($activeCategory === 'All') {
        $podcasts = $db->query('SELECT * FROM podcasts ORDER BY published_at DESC')->fetchAll();
    } else {
        $stmt = $db->prepare('SELECT * FROM podcasts WHERE category = ? ORDER BY published_at DESC');
        $stmt->execute([$activeCategory]);
        $podcasts = $stmt->fetchAll();
    }
}

if (!$podcasts) {
    $podcasts = [
        ['id'=>1,'title'=>'Top 10 Tamil Songs of 2026','host'=>'RJ Kavya','category'=>'Cinema Talk','duration'=>'42 mins','description'=>'A countdown of the biggest Tamil chartbusters of 2026, with behind-the-scenes insights.','published_at'=>'2026-03-15'],
        ['id'=>2,'title'=>'Tamil Diaspora Stories – Episode 12','host'=>'RJ Karthik','category'=>'Culture','duration'=>'35 mins','description'=>'How Tamilians around the world use Nesam Radio to stay connected to their roots.','published_at'=>'2026-03-10'],
        ['id'=>3,'title'=>'Health & Wellness in Tamil','host'=>'Dr. Priya','category'=>'Health','duration'=>'28 mins','description'=>'Simple health tips in Tamil – diet, yoga, Siddha medicine for modern life.','published_at'=>'2026-03-05'],
        ['id'=>4,'title'=>'Entrepreneurship Tamil Style','host'=>'RJ Suresh','category'=>'Business','duration'=>'50 mins','description'=>'Success stories of Tamil entrepreneurs from TN to Silicon Valley.','published_at'=>'2026-02-28'],
        ['id'=>5,'title'=>'Thirukkural for Modern Life','host'=>'Scholar Annamalai','category'=>'Spiritual','duration'=>'30 mins','description'=>'Ancient Tamil wisdom from Thirukkural applied to 21st century challenges.','published_at'=>'2026-02-20'],
        ['id'=>6,'title'=>'Kollywood Behind the Mic','host'=>'RJ Meena','category'=>'Cinema Talk','duration'=>'45 mins','description'=>'Exclusive chat with Tamil music directors and playback singers.','published_at'=>'2026-02-15'],
    ];
    if ($activeCategory !== 'All') {
        $podcasts = array_filter($podcasts, fn($p) => $p['category'] === $activeCategory);
    }
}

$catIcons = ['Cinema Talk'=>'🎬','Culture'=>'🌏','Health'=>'🌿','Business'=>'💼','Spiritual'=>'🕉️','All'=>'🎙️'];

include 'partials/header.php';
?>

<section id="podcasts-page" class="py-24 px-4">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-10">
      <span class="section-badge mb-4">🎙️ On-Demand</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-2">Listen Again ❤️</h1>
      <p class="text-gray-400">Podcasts, shows, and stories – anytime, anywhere</p>
    </div>

    <!-- Category Filter -->
    <div class="flex flex-wrap justify-center gap-3 mb-10">
      <?php foreach ($categories as $cat): ?>
      <a href="?cat=<?= urlencode($cat) ?>" id="cat-<?= strtolower(str_replace(' ','-',$cat)) ?>"
         class="flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold border transition-all
                <?= $cat === $activeCategory
                    ? 'bg-brand-red border-brand-red text-white shadow-lg shadow-brand-red/30'
                    : 'bg-white/5 border-dark-border text-gray-400 hover:border-brand-blue/40 hover:text-white' ?>">
        <?= $catIcons[$cat] ?? '🎵' ?> <?= h($cat) ?>
      </a>
      <?php endforeach; ?>
    </div>

    <!-- Podcasts Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="podcasts-grid">
      <?php foreach (array_values($podcasts) as $i => $ep): ?>
      <div class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden card-hover animate-on-scroll group"
           style="animation-delay:<?= $i * 0.08 ?>s">

        <!-- Thumbnail -->
        <div class="relative h-48 bg-gradient-to-br from-brand-red/20 to-brand-blue/20 flex items-center justify-center overflow-hidden">
          <div class="text-6xl opacity-70 group-hover:scale-110 transition-transform duration-300">
            <?= $catIcons[$ep['category']] ?? '🎙️' ?>
          </div>
          <!-- Duration badge -->
          <div class="absolute top-3 right-3 flex items-center gap-1 px-2.5 py-1 bg-black/60 rounded-full">
            <svg class="w-3 h-3 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
            <span class="text-xs text-gray-300 font-semibold"><?= h($ep['duration'] ?? '30 mins') ?></span>
          </div>
          <!-- Category badge -->
          <div class="absolute bottom-3 left-3 px-2.5 py-1 bg-brand-red/80 rounded-full text-xs text-white font-bold">
            <?= h($ep['category'] ?? 'Podcast') ?>
          </div>
        </div>

        <!-- Info -->
        <div class="p-5">
          <div class="text-xs text-gray-500 mb-1.5">
            <?= date('d M Y', strtotime($ep['published_at'] ?? 'today')) ?>
            · by <span class="text-brand-blue"><?= h($ep['host'] ?? 'Nesam Team') ?></span>
          </div>
          <h2 class="text-base font-bold text-white mb-2 leading-tight group-hover:text-brand-red transition-colors">
            <?= h($ep['title']) ?>
          </h2>
          <p class="text-gray-400 text-sm leading-relaxed mb-4 line-clamp-2">
            <?= h($ep['description'] ?? '') ?>
          </p>

          <!-- Podcast mini progress bar (decorative) -->
          <div class="podcast-progress mb-4">
            <div class="podcast-progress-fill" style="width:<?= rand(0,100) ?>%"></div>
          </div>

          <!-- Actions -->
          <div class="flex gap-2">
            <button onclick="playStation('nesam-fm')"
                    id="podcast-play-<?= $ep['id'] ?? $i ?>"
                    class="flex-1 btn-primary text-xs py-2 px-3 rounded-lg justify-center">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
              Play
            </button>
            <a href="<?= h($ep['audio_url'] ?? '#') ?>"
               download id="podcast-download-<?= $ep['id'] ?? $i ?>"
               class="flex-shrink-0 flex items-center gap-1.5 px-3 py-2 bg-white/5 border border-dark-border text-gray-400 hover:text-white rounded-lg text-xs font-medium transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
              </svg>
              Download
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if (!$podcasts): ?>
    <div class="text-center py-16 text-gray-400">
      <div class="text-5xl mb-4">🎙️</div>
      <p class="text-lg">No episodes in this category yet.<br>
         <a href="?cat=All" class="text-brand-blue hover:underline">See all podcasts →</a></p>
    </div>
    <?php endif; ?>

  </div>
</section>

<?php include 'partials/footer.php'; ?>
