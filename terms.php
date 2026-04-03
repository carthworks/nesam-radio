<?php
require_once 'config.php';
$pageTitle = 'Terms of Service – Nesam Radio';
include 'partials/header.php';
?>
<section class="py-24 px-4 max-w-3xl mx-auto">
  <h1 class="text-4xl font-black text-white mb-6">Terms of Service</h1>
  <p class="text-gray-400 mb-4">Last updated: <?= date('d F Y') ?></p>
  <div class="space-y-5 text-gray-300 leading-relaxed">
    <p>By using Nesam Radio (nesammedia.com), you agree to these terms.</p>
    <h2 class="text-xl font-bold text-white">Use of Service</h2>
    <p>Nesam Radio is provided for personal, non-commercial listening enjoyment. You may not reproduce, redistribute, or scrape any audio or content without written permission.</p>
    <h2 class="text-xl font-bold text-white">Content</h2>
    <p>All music is broadcast under appropriate licensing. Song request submissions must be respectful and appropriate.</p>
    <h2 class="text-xl font-bold text-white">Limitation of Liability</h2>
    <p>Nesam Media Works is not liable for stream interruptions, licensing changes, or third-party service failures.</p>
    <h2 class="text-xl font-bold text-white">Contact</h2>
    <p><a href="mailto:<?= SITE_EMAIL ?>" class="text-brand-blue"><?= SITE_EMAIL ?></a></p>
  </div>
</section>
<?php include 'partials/footer.php'; ?>
