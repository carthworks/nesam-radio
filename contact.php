<?php
require_once 'config.php';
$pageTitle = 'Contact – Nesam Radio | Get in Touch with Us';
$pageDesc  = 'Contact Nesam Radio – call, email, or visit us in Karaikal, Puducherry. Request a song, suggest a channel, or partner with us.';
$canonUrl  = SITE_URL . '/contact.php';
include 'partials/header.php';
?>

<section id="contact-page" class="py-24 px-4">
  <div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-14">
      <span class="section-badge mb-4">📞 Get in Touch</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-2">Talk to Us ❤️</h1>
      <p class="text-gray-400">Questions, requests, ideas, partnerships – we love hearing from you</p>
    </div>

    <div class="grid lg:grid-cols-5 gap-10">

      <!-- Contact Info -->
      <div class="lg:col-span-2 space-y-6">

        <!-- Address card -->
        <div class="glass-card rounded-2xl p-6">
          <div class="text-3xl mb-4">📍</div>
          <h3 class="text-white font-bold mb-2">Our Office</h3>
          <p class="text-gray-400 text-sm leading-relaxed"><?= h(SITE_ADDRESS) ?></p>
          <a href="https://maps.google.com/?q=Karaikal+Puducherry+India" target="_blank" rel="noopener"
             class="inline-block mt-3 text-brand-blue text-sm font-semibold hover:text-white transition-colors">
            View on Google Maps →
          </a>
        </div>

        <!-- Phone -->
        <div class="glass-card rounded-2xl p-6 flex items-start gap-4">
          <div class="text-3xl flex-shrink-0">📞</div>
          <div>
            <h3 class="text-white font-bold mb-1">Phone / WhatsApp</h3>
            <a href="tel:+918668103301" id="contact-phone"
               class="text-brand-blue font-semibold hover:text-white transition-colors block">
              <?= SITE_PHONE ?>
            </a>
            <a href="https://wa.me/<?= WHATSAPP_NUMBER ?>?text=Hi+Nesam+Radio%21"
               target="_blank" class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-green-500/20 border border-green-500/30 text-green-400 rounded-full text-xs font-bold hover:bg-green-500/30 transition-colors">
              💬 Chat on WhatsApp
            </a>
          </div>
        </div>

        <!-- Email -->
        <div class="glass-card rounded-2xl p-6 flex items-start gap-4">
          <div class="text-3xl flex-shrink-0">📧</div>
          <div>
            <h3 class="text-white font-bold mb-1">Email</h3>
            <a href="mailto:<?= SITE_EMAIL ?>" id="contact-email"
               class="text-brand-blue font-semibold hover:text-white transition-colors">
              <?= SITE_EMAIL ?>
            </a>
            <p class="text-gray-500 text-xs mt-1">We reply within 24 hours</p>
          </div>
        </div>

        <!-- Social -->
        <div class="glass-card rounded-2xl p-6">
          <h3 class="text-white font-bold mb-4">Follow Us</h3>
          <div class="grid grid-cols-2 gap-3">
            <?php foreach ([
              ['https://wa.me/'.WHATSAPP_NUMBER,'WhatsApp','💬','bg-green-500/10 border-green-500/20 text-green-400'],
              ['https://facebook.com/nesammedia','Facebook','👍','bg-blue-500/10 border-blue-500/20 text-blue-400'],
              ['https://instagram.com/nesammedia','Instagram','📸','bg-pink-500/10 border-pink-500/20 text-pink-400'],
              ['https://youtube.com/@nesammedia','YouTube','▶️','bg-red-500/10 border-red-500/20 text-red-400'],
            ] as [$href,$name,$ic,$cls]): ?>
            <a href="<?= $href ?>" target="_blank" rel="noopener"
               class="flex items-center gap-2 px-3 py-2 rounded-xl border <?= $cls ?> text-sm font-medium hover:scale-105 transition-all">
              <span><?= $ic ?></span><?= $name ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="lg:col-span-3 space-y-6">

        <!-- General Contact -->
        <div class="glass-card rounded-3xl p-8">
          <h2 class="text-2xl font-bold text-white mb-1">Send a Message</h2>
          <p class="text-gray-400 text-sm mb-6">General enquiries, feedback, partnerships – we read every message ❤️</p>
          <form id="contact-form" class="space-y-4">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label for="contact-name" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Name *</label>
                <input id="contact-name" name="name" type="text" required placeholder="Your full name"
                       class="nesam-input" maxlength="100">
              </div>
              <div>
                <label for="contact-email-field" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Email *</label>
                <input id="contact-email-field" name="email" type="email" required placeholder="you@example.com"
                       class="nesam-input" maxlength="150">
              </div>
            </div>
            <div>
              <label for="contact-subject" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Subject</label>
              <input id="contact-subject" name="subject" type="text" placeholder="How can we help?"
                     class="nesam-input" maxlength="200">
            </div>
            <div>
              <label for="contact-message" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Message *</label>
              <textarea id="contact-message" name="message" required rows="5"
                        placeholder="Tell us what's on your mind…"
                        class="nesam-input resize-none" maxlength="2000"></textarea>
            </div>
            <button type="submit" id="contact-submit-btn" class="btn-primary w-full justify-center py-3 rounded-xl">
              Send Message ❤️
            </button>
            <p id="contact-status" class="text-sm"></p>
          </form>
        </div>

        <!-- Song Request Form -->
        <div id="request-song" class="glass-card rounded-3xl p-8">
          <h2 class="text-xl font-bold text-white mb-1">🎵 Request a Song</h2>
          <p class="text-gray-400 text-sm mb-6">Tell us what to play – we'll do our best to play it for you ❤️</p>
          <form id="song-request-form" class="space-y-4">
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
              <input id="req-song" name="song_name" type="text" required placeholder="e.g. Vellai Pookal – AR Rahman"
                     class="nesam-input" maxlength="200">
            </div>
            <div>
              <label for="req-station-select" class="block text-xs text-gray-400 font-semibold mb-1.5 uppercase tracking-wide">Preferred Channel</label>
              <select id="req-station-select" name="station" class="nesam-input" aria-label="Select channel">
                <option value="Nesam FM">Nesam FM</option>
                <option value="Nesam Devotional">Nesam Devotional</option>
                <option value="Nesam Hits">Nesam Hits</option>
                <option value="Nesam Retro">Nesam Retro</option>
              </select>
            </div>
            <button type="submit" id="req-submit-btn" class="btn-secondary w-full justify-center py-3 rounded-xl">
              Send Request ❤️
            </button>
            <p id="req-status" class="text-sm"></p>
          </form>
        </div>

      </div>
    </div>

    <!-- Google Maps embed -->
    <div class="mt-12 rounded-3xl overflow-hidden border border-dark-border animate-on-scroll">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.097!2d79.9897!3d10.9254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae7c1e6a8f4b25%3A0x0!2sKaraikal%2C+Puducherry!5e0!3m2!1sen!2sin!4v1700000000000"
        width="100%" height="350" style="border:0;filter:brightness(0.7)grayscale(0.2)" allowfullscreen loading="lazy"
        referrerpolicy="no-referrer-when-downgrade" title="Nesam Radio Office Location – Karaikal, Puducherry">
      </iframe>
    </div>

  </div>
</section>

<?php include 'partials/footer.php'; ?>
