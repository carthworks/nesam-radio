<?php
// partials/header.php
// Usage: include 'partials/header.php';  ($pageTitle & $pageDesc should be set before including)
$pageTitle = $pageTitle ?? 'Nesam Radio – Tamil Online Radio | Live Tamil Music & Podcasts';
$pageDesc  = $pageDesc  ?? 'Nesam Radio is your 24/7 live Tamil online radio – film hits, devotional, news, retro, kids, and podcasts. Made with love in Tamil Nadu.';
$pageKw    = $pageKw    ?? 'Tamil radio, Tamil online radio, Tamil FM, Tamil music, Nesam Radio, live Tamil streaming, Tamil devotional, Kollywood hits';
$canonUrl  = $canonUrl  ?? SITE_URL . '/' . basename($_SERVER['PHP_SELF']);
$ogImage   = $ogImage   ?? SITE_URL . '/assets/images/og-default.jpg';

// Resolve base path for assets (handles /nesammedia/ subfolders in Laragon)
$bp = BASE_PATH; // e.g. '/nesammedia' or '' at domain root

// Logo: use assets/images/logo.png if it exists, otherwise fall back to root copy
$logoFile  = __DIR__ . '/../assets/images/logo.png';
$logoSrc   = file_exists($logoFile)
    ? $bp . '/assets/images/logo.png'
    : $bp . '/nesam_media_logo.png';

// Auto-copy logo on first request if missing (saves manual step)
if (!file_exists($logoFile)) {
    $srcLogo = __DIR__ . '/../nesam_media_logo.png';
    if (file_exists($srcLogo)) {
        @mkdir(dirname($logoFile), 0755, true);
        @copy($srcLogo, $logoFile);
        @copy($srcLogo, __DIR__ . '/../assets/images/favicon.png');
        $logoSrc = $bp . '/assets/images/logo.png';
    }
}

// Active page detection (works with or without BASE_PATH prefix)
$requestPath = '/' . ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
// Strip subfolder prefix for matching
$strippedPath = $bp ? substr($requestPath, strlen($bp)) : $requestPath;
$strippedPath = '/' . ltrim($strippedPath ?: '/', '/');
?>
<!DOCTYPE html>
<html lang="ta-IN" class="scroll-smooth" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($pageTitle) ?></title>
  <meta name="description" content="<?= h($pageDesc) ?>">
  <meta name="keywords" content="<?= h($pageKw) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= h($canonUrl) ?>">

  <!-- Open Graph -->
  <meta property="og:type"        content="website">
  <meta property="og:title"       content="<?= h($pageTitle) ?>">
  <meta property="og:description" content="<?= h($pageDesc) ?>">
  <meta property="og:url"         content="<?= h($canonUrl) ?>">
  <meta property="og:image"       content="<?= h($ogImage) ?>">
  <meta property="og:locale"      content="ta_IN">

  <!-- Twitter -->
  <meta name="twitter:card"        content="summary_large_image">
  <meta name="twitter:title"       content="<?= h($pageTitle) ?>">
  <meta name="twitter:description" content="<?= h($pageDesc) ?>">
  <meta name="twitter:image"       content="<?= h($ogImage) ?>">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= $logoSrc ?>">
  <link rel="apple-touch-icon"      href="<?= $logoSrc ?>">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+Tamil:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS (CDN with config – fine for shared hosting, no build step needed) -->
  <script>
    // Suppress production CDN warning for self-hosted PHP sites
    const _warn = console.warn;
    console.warn = (...a) => { if (a[0] && String(a[0]).includes('cdn.tailwindcss.com')) return; _warn(...a); };
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            brand: {
              red:   '#DC2626',
              redDk: '#B91C1C',
              blue:  '#1E6FBB',
              blueDk:'#1558A0',
              light: '#EFF6FF',
            },
            dark: {
              bg:    '#0D0D1A',
              card:  '#141428',
              nav:   '#0A0A16',
              border:'#1E2040',
            }
          },
          fontFamily: {
            sans:  ['Inter', 'Noto Sans Tamil', 'system-ui', 'sans-serif'],
            tamil: ['Noto Sans Tamil', 'system-ui', 'sans-serif'],
          },
          animation: {
            'pulse-slow': 'pulse 3s cubic-bezier(0.4,0,0.6,1) infinite',
            'spin-slow':  'spin 8s linear infinite',
            'wave':       'wave 1.5s ease-in-out infinite',
            'bounce-sm':  'bounce 2s infinite',
          },
          keyframes: {
            wave: {
              '0%,100%': {transform:'scaleY(0.5)'},
              '50%':     {transform:'scaleY(1.2)'},
            }
          }
        }
      }
    }
  </script>

  <!-- Main CSS (inlined via PHP – avoids URL path issues on any host) -->
  <style><?php
    $cssFile = __DIR__ . '/../assets/css/style.css';
    if (file_exists($cssFile)) { readfile($cssFile); }
  ?></style>

  <!-- Google Analytics placeholder -->
  <!--
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
  <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','G-XXXXXXXXXX');</script>
  -->
</head>
<body class="dark bg-dark-bg text-white font-sans antialiased">

<!-- ===== NAVBAR ===== -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-dark-nav/95 backdrop-blur-md border-b border-dark-border">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Logo -->
      <a href="<?= $bp ?>/" class="flex items-center gap-3 group" id="nav-logo">
        <img src="<?= $logoSrc ?>" alt="Nesam Media Logo" class="h-10 w-auto">
        <div class="hidden sm:block">
          <div class="text-lg font-bold text-white leading-tight">Nesam Radio</div>
          <div class="text-[10px] text-brand-red font-semibold tracking-widest uppercase">Radio with Love ❤️</div>
        </div>
      </a>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center gap-1" id="desktop-menu">
        <?php
        $navLinks = [
          [$bp . '/',             'Home'],
          [$bp . '/live.php',     'Live Radio'],
          [$bp . '/stations.php', 'Stations'],
          [$bp . '/schedule.php', 'Schedule'],
          [$bp . '/podcasts.php', 'Podcasts'],
          [$bp . '/about.php',    'About'],
          [$bp . '/blog.php',     'Blog'],
          [$bp . '/contact.php',  'Contact'],
        ];
        foreach ($navLinks as [$href, $label]):
          // Match on stripped path (without subfolder prefix)
          $slug   = str_replace($bp, '', $href);
          $active = ($strippedPath === $slug)
                 || ($slug !== '/' && $slug !== ($bp.'/') && strpos($strippedPath, str_replace($bp,'',$slug)) === 0);
        ?>
        <a href="<?= $href ?>" id="nav-<?= strtolower(str_replace([' ', '.php'], ['-', ''], $label)) ?>"
          class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200
                 <?= $active ? 'text-white bg-brand-blue/20 border border-brand-blue/30' : 'text-gray-300 hover:text-white hover:bg-white/5' ?>">
          <?= $label ?>
        </a>
        <?php endforeach; ?>
      </div>

      <!-- Right actions -->
      <div class="flex items-center gap-2">
        <!-- Live badge -->
        <a href="<?= $bp ?>/live.php" id="nav-live-btn"
           class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-brand-red text-white text-xs font-bold rounded-full hover:bg-brand-redDk transition-colors">
          <span class="live-dot w-2 h-2 rounded-full bg-white"></span>
          LIVE
        </a>
        <!-- Dark/Light toggle: shows what you switch TO (sun in dark, moon in light) -->
        <button id="theme-toggle" aria-label="Toggle dark/light mode"
                class="p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
          <!-- Moon: click to go dark (shown in light mode) -->
          <svg id="icon-moon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
          </svg>
          <!-- Sun: click to go light (shown in dark mode) -->
          <svg id="icon-sun" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707M17.657 17.657l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/>
          </svg>
        </button>
        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" aria-label="Open navigation menu"
                class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path id="menu-open-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path id="menu-close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div id="mobile-menu" class="hidden lg:hidden border-t border-dark-border">
    <div class="px-4 py-3 space-y-1">
      <?php foreach ($navLinks as [$href, $label]):
        $slug   = str_replace($bp, '', $href);
        $active = ($strippedPath === $slug)
               || ($slug !== '/' && strpos($strippedPath, str_replace($bp,'',$slug)) === 0);
      ?>
      <a href="<?= $href ?>"
         class="block px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?= $active ? 'text-white bg-brand-blue/20 border border-brand-blue/30' : 'text-gray-300 hover:text-white hover:bg-white/5' ?>">
        <?= $label ?>
      </a>
      <?php endforeach; ?>
      <a href="<?= $bp ?>/live.php" class="flex items-center gap-2 px-4 py-2.5 bg-brand-red rounded-lg text-white text-sm font-bold mt-2">
        <span class="live-dot w-2 h-2 rounded-full bg-white"></span> Listen Live Now
      </a>
    </div>
  </div>
</nav>

<!-- Main content starts here -->
<main id="main-content" class="pt-16">
