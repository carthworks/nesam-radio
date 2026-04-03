<?php
require_once 'config.php';
$pageTitle = 'Privacy Policy – Nesam Radio';
include 'partials/header.php';
?>
<section class="py-24 px-4 max-w-3xl mx-auto">
  <h1 class="text-4xl font-black text-white mb-6">Privacy Policy</h1>
  <p class="text-gray-400 mb-4">Last updated: <?= date('d F Y') ?></p>
  <div class="space-y-5 text-gray-300 leading-relaxed">
    <p>Nesam Media Works ("we", "us") operates the website nesammedia.com. This policy explains how we handle your personal information.</p>
    <h2 class="text-xl font-bold text-white">Information We Collect</h2>
    <p>We collect information you provide directly, such as song request names, contact form submissions, and general usage analytics (via Google Analytics).</p>
    <h2 class="text-xl font-bold text-white">How We Use It</h2>
    <p>To process song requests, respond to enquiries, and improve our radio service. We never sell your data.</p>
    <h2 class="text-xl font-bold text-white">Contact</h2>
    <p>For any privacy concerns: <a href="mailto:<?= SITE_EMAIL ?>" class="text-brand-blue"><?= SITE_EMAIL ?></a></p>
  </div>
</section>
<?php include 'partials/footer.php'; ?>
