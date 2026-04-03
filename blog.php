<?php
require_once 'config.php';
$pageTitle = 'Blog & News – Nesam Radio | Tamil Music & Culture News';
$pageDesc  = 'Read the latest Tamil music news, cinema stories, and Nesam Radio updates. Stay connected with Tamil culture worldwide.';
$canonUrl  = SITE_URL . '/blog.php';

$db = getDB();

// ── Single post view ──────────────────────────────────────────────────────────
$slug = $_GET['slug'] ?? '';
if ($slug) {
    $post = null;

    // Try database first
    if ($db) {
        $stmt = $db->prepare('SELECT * FROM blog_posts WHERE slug = ? LIMIT 1');
        $stmt->execute([$slug]);
        $post = $stmt->fetch();
    }

    // Static fallback when DB is unavailable or post not in DB
    if (!$post) {
        $staticPosts = [
            'top-10-tamil-songs-2026' => [
                'title'        => 'Top 10 Tamil Songs of 2026 So Far',
                'author'       => 'Nesam Team',
                'published_at' => '2026-03-20',
                'content'      => '<p>2026 has been a phenomenal year for Tamil music. The industry continues to evolve, blending traditional Carnatic roots with modern beats, creating something truly magical.</p><p>From chart-toppers in blockbuster films to independent music that captures the Tamil soul, this year has given us some unforgettable songs. Here are our picks that have defined Tamil music in 2026, curated by our RJ team at Nesam Radio.</p><h3>1. Vellai Pookal (AR Rahman)</h3><p>A soul-touching melody that took the internet by storm...</p><h3>2. Aaluma Doluma (Remix 2026)</h3><p>The classic reimagined with modern beats...</p>',
            ],
            'nesam-radio-tamil-diaspora' => [
                'title'        => 'How Nesam Radio is Connecting Tamil Diaspora Worldwide',
                'author'       => 'RJ Karthik',
                'published_at' => '2026-03-10',
                'content'      => '<p>From London to Singapore, from Dubai to Toronto – wherever Tamilians have settled, they carry their music, their language, and their culture. Nesam Radio was born to serve this community.</p><p>We spoke to listeners from 12 countries about what Nesam Radio means to them. The stories left us in tears – and filled with pride.</p>',
            ],
        ];
        $post = $staticPosts[$slug] ?? null;
    }

    if ($post) {
        // Show single post
        $pageTitle = h($post['title']) . ' – Nesam Radio Blog';
        include 'partials/header.php';
?>
<article id="blog-post" class="py-24 px-4">
  <div class="max-w-3xl mx-auto">
    <a href="<?= BASE_PATH ?>/blog.php" class="inline-flex items-center gap-2 text-brand-blue text-sm mb-8 hover:text-white transition-colors">
      ← Back to Blog
    </a>
    <!-- Post header -->
    <div class="h-64 bg-gradient-to-br from-brand-red/20 to-brand-blue/20 rounded-2xl flex items-center justify-center text-7xl mb-8">
      🎵
    </div>
    <div class="text-sm text-gray-500 mb-3">
      <?= date('d F Y', strtotime($post['published_at'] ?? 'today')) ?>
      · by <span class="text-brand-blue"><?= h($post['author'] ?? 'Nesam Team') ?></span>
    </div>
    <h1 class="text-3xl sm:text-4xl font-black text-white mb-8 leading-tight"><?= h($post['title']) ?></h1>
    <!-- Post content -->
    <div class="prose prose-invert prose-lg max-w-none text-gray-300 leading-relaxed space-y-4">
      <?= $post['content'] ?>
    </div>
    <!-- Share -->
    <div class="mt-10 pt-8 border-t border-dark-border flex items-center gap-4">
      <span class="text-gray-400 text-sm">Share:</span>
      <a href="https://wa.me/?text=<?= urlencode($post['title'] . ' - ' . SITE_URL . '/blog.php?slug=' . $slug) ?>"
         target="_blank" class="text-green-400 hover:text-green-300 text-sm font-semibold">WhatsApp</a>
      <a href="https://facebook.com/sharer.php?u=<?= urlencode(SITE_URL . '/blog.php?slug=' . $slug) ?>"
         target="_blank" class="text-blue-400 hover:text-blue-300 text-sm font-semibold">Facebook</a>
    </div>
  </div>
</article>
<?php
        include 'partials/footer.php';
    } else {
        // Post not found – redirect cleanly to listing
        header('Location: ' . BASE_PATH . '/blog.php', true, 302);
    }
    exit;
}

// ── Blog listing ──────────────────────────────────────────────────────────────
$posts = [];
if ($db) {
    $result = $db->query('SELECT id,title,slug,excerpt,author,published_at FROM blog_posts ORDER BY published_at DESC');
    if ($result) {
        $posts = $result->fetchAll();
    }
}
if (!$posts) {
    $posts = [
        ['id' => 1, 'title' => 'Top 10 Tamil Songs of 2026 So Far',                      'slug' => 'top-10-tamil-songs-2026',            'excerpt' => 'Discover the hottest Tamil tracks that are ruling the charts in 2026. From Kollywood blockbusters to indie hits.',                                           'author' => 'Nesam Team', 'published_at' => '2026-03-20'],
        ['id' => 2, 'title' => 'How Nesam Radio is Connecting Tamil Diaspora Worldwide',  'slug' => 'nesam-radio-tamil-diaspora',          'excerpt' => 'From London to Singapore, Tamilians tune into Nesam Radio to stay connected with their culture and music.',                                              'author' => 'RJ Karthik', 'published_at' => '2026-03-10'],
        ['id' => 3, 'title' => "Interview with AR Rahman's Sound Engineer",              'slug' => 'interview-ar-rahman-sound-engineer',  'excerpt' => "We sat down with one of India's top Tamil film sound engineers who has worked on iconic scores.",                                                    'author' => 'RJ Kavya',   'published_at' => '2026-02-25'],
        ['id' => 4, 'title' => 'Why Tamil Radio is Making a Massive Comeback in 2026',   'slug' => 'tamil-radio-comeback-2026',            'excerpt' => "Digital radio is having a renaissance. Here's why Tamil online radio is at the forefront of this revolution.",                                        'author' => 'Nesam Team', 'published_at' => '2026-02-15'],
    ];
}

$blogEmojis = ['🎵', '📻', '🌍', '🎬', '🕉️', '💿'];
include 'partials/header.php';
?>

<section id="blog-page" class="py-24 px-4">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-14">
      <span class="section-badge mb-4">📰 Blog &amp; News</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-2">Latest from Nesam ❤️</h1>
      <p class="text-gray-400">Tamil music, culture, and radio stories – straight from our hearts</p>
    </div>

    <!-- Featured (first post) -->
    <?php $featured = array_shift($posts); ?>
    <article class="glass-card rounded-3xl overflow-hidden mb-12 animate-on-scroll card-hover group">
      <div class="grid md:grid-cols-5 gap-0">
        <div class="md:col-span-2 h-52 md:h-auto bg-gradient-to-br from-brand-red/30 to-brand-blue/30 flex items-center justify-center text-7xl">
          🎵
        </div>
        <div class="md:col-span-3 p-8 flex flex-col justify-center">
          <div class="section-badge mb-4 w-fit">⭐ Featured</div>
          <div class="text-xs text-gray-500 mb-2">
            <?= date('d F Y', strtotime($featured['published_at'] ?? 'today')) ?>
            · <?= h($featured['author'] ?? 'Nesam Team') ?>
          </div>
          <h2 class="text-2xl sm:text-3xl font-black text-white mb-3 leading-tight group-hover:text-brand-red transition-colors">
            <a href="<?= BASE_PATH ?>/blog.php?slug=<?= h($featured['slug'] ?? $featured['id']) ?>"><?= h($featured['title']) ?></a>
          </h2>
          <p class="text-gray-400 leading-relaxed mb-5"><?= h($featured['excerpt'] ?? '') ?></p>
          <a href="<?= BASE_PATH ?>/blog.php?slug=<?= h($featured['slug'] ?? $featured['id']) ?>"
             class="btn-primary w-fit">Read Article →</a>
        </div>
      </div>
    </article>

    <!-- Other posts grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach (array_values($posts) as $i => $post): ?>
      <article class="bg-dark-card border border-dark-border rounded-2xl overflow-hidden card-hover animate-on-scroll group"
               style="animation-delay:<?= $i * 0.1 ?>s">
        <div class="h-48 bg-gradient-to-br from-brand-blue/20 to-brand-red/20 flex items-center justify-center text-5xl">
          <?= $blogEmojis[$i % count($blogEmojis)] ?>
        </div>
        <div class="p-5">
          <div class="text-xs text-gray-500 mb-2">
            <?= date('d M Y', strtotime($post['published_at'] ?? 'today')) ?> · <?= h($post['author'] ?? 'Nesam Team') ?>
          </div>
          <h2 class="text-base font-bold text-white mb-2 leading-tight group-hover:text-brand-blue transition-colors">
            <a href="<?= BASE_PATH ?>/blog.php?slug=<?= h($post['slug'] ?? $post['id']) ?>"><?= h($post['title']) ?></a>
          </h2>
          <p class="text-gray-400 text-sm leading-relaxed mb-4">
            <?= h(substr($post['excerpt'] ?? '', 0, 110)) ?>…
          </p>
          <a href="<?= BASE_PATH ?>/blog.php?slug=<?= h($post['slug'] ?? $post['id']) ?>"
             class="text-brand-blue text-sm font-semibold hover:text-brand-red transition-colors">
            Read More →
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php include 'partials/footer.php'; ?>
