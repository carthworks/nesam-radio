<?php
require_once 'config.php';
$pageTitle = 'About Us – Nesam Radio | Tamil Online Radio Born from Love';
$pageDesc  = 'Nesam Media Works was founded with the dream of bringing Tamil culture, music, and stories to every listener. Learn our story, mission, and team.';
$canonUrl  = SITE_URL . '/about.php';
include 'partials/header.php';
?>

<section id="about-hero" class="py-24 px-4 relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-dark-nav via-dark-bg to-[#0A1628]"></div>
  <div class="absolute inset-0 hero-glow opacity-25"></div>

  <div class="relative z-10 max-w-7xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-16">
      <span class="section-badge mb-4">❤️ Our Story</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-3">About Nesam Radio</h1>
      <p class="text-xl text-brand-red font-semibold">Radio Born from Love</p>
    </div>

    <!-- Story -->
    <div class="grid lg:grid-cols-2 gap-14 items-center mb-20">
      <div class="animate-on-scroll space-y-5">
        <p class="text-gray-300 text-lg leading-relaxed">
          <strong class="text-white"><?= $ml->tr('Nesam Media') ?> Works</strong> was founded with a simple dream — to bring the warmth of Tamil culture,
          music, and stories to every listener across the globe.
        </p>
        <p class="text-gray-400 leading-relaxed">
          From our roots in <strong class="text-brand-blue">Karaikal (Puducherry)</strong> to the bustling streets of
          <strong class="text-brand-blue">Chennai</strong>, we have grown into a full-fledged digital radio platform
          loved by Tamilians everywhere — in India, Singapore, Malaysia, UAE, the UK, Canada, and beyond.
        </p>
        <p class="text-gray-400 leading-relaxed">
          We are not just a radio station. We are a community that celebrates Tamil language, traditions,
          film music, devotional songs, and current affairs.
        </p>

        <!-- Mission box -->
        <div class="glass-red rounded-2xl p-6">
          <div class="text-2xl mb-2">❤️</div>
          <h3 class="text-white font-bold text-lg mb-2">Our Mission</h3>
          <p class="text-gray-300 leading-relaxed">
            To spread "Nesam" (Love) through every song, every story, and every heartbeat.
            Tamil culture must be felt, not just heard.
          </p>
        </div>
      </div>

      <!-- Stats visual -->
      <div class="grid grid-cols-2 gap-4 animate-on-scroll">
        <?php foreach ([
          ['Founded','2020','🏛️','text-brand-red'],
          ['Listeners','10,000+','👥','text-brand-blue'],
          ['Channels','6+','📻','text-yellow-400'],
          ['Team Members','15+','❤️','text-green-400'],
        ] as [$lbl,$val,$ic,$col]): ?>
        <div class="glass-card rounded-2xl p-6 text-center card-hover">
          <div class="text-3xl mb-2"><?= $ic ?></div>
          <div class="text-3xl font-black <?= $col ?> mb-1"><?= $val ?></div>
          <div class="text-gray-500 text-sm"><?= $lbl ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Values -->
    <div class="mb-20">
      <div class="text-center mb-10">
        <span class="section-badge mb-3">✨ Our Values</span>
        <h2 class="text-3xl font-black text-white">What Drives Us</h2>
      </div>
      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ([
          ['❤️','Tamil First','Every decision, every song choice, every story is made for our Tamil listeners.'],
          ['🎵','Quality Audio','Crystal-clear HD streaming with no buffering, no ads, no compromise.'],
          ['🌍','Global Reach','Connecting Tamil hearts from Chennai to California, from Karaikal to Kuala Lumpur.'],
          ['🤝','Community','Your song requests, your feedback, your stories – this is YOUR radio.'],
        ] as [$ic,$h,$p]): ?>
        <div class="glass-card rounded-2xl p-6 card-hover animate-on-scroll text-center">
          <div class="text-4xl mb-4"><?= $ic ?></div>
          <h3 class="text-white font-bold mb-2"><?= $h ?></h3>
          <p class="text-gray-400 text-sm leading-relaxed"><?= $p ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Team note -->
    <div class="bg-gradient-to-r from-brand-red/10 to-brand-blue/10 border border-dark-border rounded-3xl p-10 text-center animate-on-scroll">
      <div class="text-5xl mb-4">🎙️</div>
      <h2 class="text-2xl sm:text-3xl font-black text-white mb-4">Meet the Team</h2>
      <p class="text-gray-300 max-w-2xl mx-auto leading-relaxed mb-6">
        A passionate team of <strong class="text-white">broadcasters, sound engineers, and Tamil content creators</strong>
        with 20+ years of combined experience. We eat, sleep, and dream Tamil music.
      </p>
      <div class="flex flex-wrap justify-center gap-6 text-center">
        <?php foreach ([
          ['RJ Kavya','Morning Anchor','🌅'],
          ['RJ Karthik','Evening Drive Host','🌆'],
          ['RJ Priya','Kollywood Specialist','🎬'],
          ['RJ Suresh','Devotional Host','🕉️'],
          ['RJ Mani','Retro Expert','💿'],
          ['RJ Meena','Cultural Correspondent','🌸'],
        ] as [$name,$role,$ic]): ?>
        <div class="flex flex-col items-center gap-2">
          <div class="w-16 h-16 rounded-full bg-gradient-to-br from-brand-red/30 to-brand-blue/30 border border-white/10 flex items-center justify-center text-2xl">
            <?= $ic ?>
          </div>
          <div class="text-white font-semibold text-sm"><?= $name ?></div>
          <div class="text-gray-500 text-xs"><?= $role ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Address -->
    <div class="mt-12 grid sm:grid-cols-3 gap-6 animate-on-scroll">
      <?php foreach ([
        ['📍','Address',SITE_ADDRESS],
        ['📞','Phone',SITE_PHONE],
        ['📧','Email',SITE_EMAIL],
      ] as [$ic,$h,$v]): ?>
      <div class="glass-card rounded-2xl p-6 text-center">
        <div class="text-2xl mb-2"><?= $ic ?></div>
        <div class="text-xs text-gray-500 uppercase tracking-wide mb-1"><?= $h ?></div>
        <div class="text-white font-semibold text-sm"><?= h($v) ?></div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php include 'partials/footer.php'; ?>
