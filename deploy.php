<?php
/**
 * deploy.php – One-click Nesam Radio local deployment script
 * Run this ONCE from C:\laragon\www\nesammedia\deploy.php
 * Delete this file after use!
 */

// Copy logo to assets
$tasks = [];
$base  = __DIR__;

// Dirs to create
$dirs = [
    "$base/assets/images",
    "$base/assets/audio",
    "$base/api",
    "$base/partials",
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        $tasks[] = "✅ Created: $dir";
    } else {
        $tasks[] = "📁 Exists: $dir";
    }
}

// Copy logo.png → assets/images/logo.png and favicon.png
$logoSrc = "$base/nesam_media_logo.png";
if (file_exists($logoSrc)) {
    copy($logoSrc, "$base/assets/images/logo.png");
    copy($logoSrc, "$base/assets/images/favicon.png");
    $tasks[] = "✅ Logo copied to assets/images/";
} else {
    $tasks[] = "⚠️ nesam_media_logo.png not found in root – copy it manually to assets/images/logo.png";
}

// Copy hero-bg if exists
$heroBg = "$base/hero-bg.jpg";
if (file_exists($heroBg)) {
    copy($heroBg, "$base/assets/images/hero-bg.jpg");
    $tasks[] = "✅ Hero background copied";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Nesam Radio – Deploy Check</title>
<style>
body { font-family: monospace; background: #0D0D1A; color: #F1F5F9; padding: 2rem; }
h1   { color: #DC2626; } h2 { color: #1E6FBB; margin-top: 2rem; }
li   { margin: .4rem 0; } a { color: #1E6FBB; }
.ok  { color: #4ade80; } .warn { color: #fbbf24; }
</style>
</head>
<body>
<h1>Nesam Radio ❤️ – Deploy Check</h1>
<h2>File Setup Tasks</h2>
<ul>
<?php foreach ($tasks as $t): ?>
<li><?= htmlspecialchars($t) ?></li>
<?php endforeach; ?>
</ul>

<h2>PHP & Extensions</h2>
<ul>
<li class="<?= version_compare(PHP_VERSION,'8.2','>=') ? 'ok' : 'warn' ?>">PHP <?= PHP_VERSION ?> <?= version_compare(PHP_VERSION,'8.2','>=') ? '✅' : '⚠️ PHP 8.2+ required' ?></li>
<li class="<?= extension_loaded('pdo_mysql') ? 'ok' : 'warn' ?>">PDO MySQL: <?= extension_loaded('pdo_mysql') ? '✅ Loaded' : '⚠️ Not found – enable in php.ini' ?></li>
</ul>

<h2>Database Test</h2>
<?php
// Try DB connection
try {
    require_once __DIR__.'/config.php';
    $db = getDB();
    if ($db) {
        $ver = $db->query('SELECT VERSION()')->fetchColumn();
        echo "<p class='ok'>✅ Database connected! MySQL {$ver}</p>";
        $rows = $db->query('SELECT COUNT(*) FROM schedule')->fetchColumn();
        echo "<p class='ok'>✅ schedule table: {$rows} rows</p>";
        $rows = $db->query('SELECT COUNT(*) FROM podcasts')->fetchColumn();
        echo "<p class='ok'>✅ podcasts table: {$rows} rows</p>";
    } else {
        echo "<p class='warn'>⚠️ DB not connected (config.php DB settings not set up yet – that's OK for now)</p>";
    }
} catch (Exception $e) {
    echo "<p class='warn'>⚠️ DB error: ".htmlspecialchars($e->getMessage())." – update config.php with your DB credentials</p>";
}
?>

<h2>Pages</h2>
<ul>
<li><a href="/">Home (index.php)</a></li>
<li><a href="/live.php">Live Radio</a></li>
<li><a href="/stations.php">Stations</a></li>
<li><a href="/schedule.php">Schedule</a></li>
<li><a href="/podcasts.php">Podcasts</a></li>
<li><a href="/about.php">About</a></li>
<li><a href="/blog.php">Blog</a></li>
<li><a href="/contact.php">Contact</a></li>
</ul>

<p style="margin-top:2rem;color:#666;">⚠️ Delete this file before going live!</p>
</body>
</html>
