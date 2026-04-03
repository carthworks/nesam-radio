# Nesam Radio – Complete PHP Website

> Tamil online radio website for Nesam Media Works. Built with pure PHP 8.2+, MySQL, HTML5 + Tailwind CSS 3.

---

## 🚀 Quick Setup

### 1. Copy Files to Server
Upload the entire `web/` folder contents to your **public_html** (cPanel) or web root.

### 2. Set Up Assets
Copy the logo file to the images folder:
```
cp nesam_media_logo.png assets/images/logo.png
cp nesam_media_logo.png assets/images/favicon.png
```
Or do it via cPanel File Manager.

### 3. Set Up Database
1. Create a MySQL database in cPanel → MySQL Databases
2. Import `schema.sql`:
   ```bash
   mysql -u username -p database_name < schema.sql
   ```
   Or use phpMyAdmin → Import

### 4. Configure `config.php`
Edit `config.php` and update:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_db_username');
define('DB_PASS', 'your_db_password');
define('DB_NAME', 'your_db_name');
define('SITE_URL', 'https://nesammedia.com');
```

### 5. Update Stream URLs
In `config.php`, replace the placeholder stream URLs with your real Icecast/Shoutcast URLs:
```php
define('STREAMS', json_encode([
    'nesam-fm' => ['name' => 'Nesam FM', 'url' => 'YOUR_REAL_STREAM_URL', ...],
    ...
]));
```

### 6. Enable HTTPS (Production)
Uncomment the HTTPS redirect lines in `.htaccess`.

---

## 📁 File Structure

```
web/
├── index.php           # Homepage
├── live.php            # Live Radio Player
├── stations.php        # All Channels
├── schedule.php        # Program Schedule
├── podcasts.php        # Podcasts & On-Demand
├── about.php           # About Us
├── blog.php            # Blog & News (with single post view)
├── contact.php         # Contact + Song Request
├── privacy.php         # Privacy Policy
├── terms.php           # Terms of Service
├── config.php          # 🔧 Database & Site Config (EDIT THIS)
├── schema.sql          # MySQL Schema + Sample Data
├── .htaccess           # Apache config (clean URLs, security)
├── partials/
│   ├── header.php      # Navbar + <head>
│   └── footer.php      # Footer + WhatsApp FAB + Now-Playing bar
├── api/
│   ├── now_playing.php # AJAX: Returns current song info
│   ├── request_song.php# AJAX: Saves song requests
│   └── contact.php     # AJAX: Saves contact messages
└── assets/
    ├── css/style.css   # Custom CSS (Tailwind extended)
    ├── js/main.js      # Global JavaScript
    ├── images/         # logo.png, favicon.png, hero-bg.jpg
    └── audio/          # (for podcast files)
```

---

## 🎨 Color Theme (from Logo)
| Color      | Hex       | Usage                     |
|------------|-----------|---------------------------|
| Brand Red  | `#DC2626` | Primary CTA, live dots     |
| Brand Blue | `#1E6FBB` | Secondary, links          |
| Dark BG    | `#0D0D1A` | Page background           |
| Dark Card  | `#141428` | Cards, sections           |
| White      | `#F1F5F9` | Text                      |

---

## 📻 Stations & Stream URLs

Update these in `config.php`:

| Station           | Current (Demo) URL                           |
|-------------------|----------------------------------------------|
| Nesam FM          | `https://stream.zeno.fm/y0q2tyy2g4zuv`       |
| Nesam Devotional  | Replace with your devotional stream URL       |
| Nesam News        | Replace with your news stream URL             |
| Nesam Hits        | Replace with your hits stream URL             |
| Nesam Retro       | Replace with your retro stream URL            |
| Nesam Kids        | Replace with your kids stream URL             |

---

## 🔧 PHP Requirements
- PHP 8.2+
- MySQL / MariaDB
- Apache with mod_rewrite (standard on cPanel hosting)
- PDO PHP extension (usually enabled by default)

---

## 📱 Features Built
- ✅ 8 pages (Home, Live, Stations, Schedule, Podcasts, About, Blog, Contact)
- ✅ Sticky Now-Playing player (bottom bar)
- ✅ HTML5 Audio player with station switcher
- ✅ Song request form → saves to MySQL
- ✅ Contact form → saves to MySQL
- ✅ Dark/Light mode toggle
- ✅ AJAX now-playing updates every 30 seconds
- ✅ WhatsApp floating button
- ✅ Mobile-first responsive design
- ✅ SEO meta tags + Open Graph
- ✅ Program schedule with day/channel filter
- ✅ Podcast grid with category filter
- ✅ Blog with listing + single post view
- ✅ Google Maps embed (Contact page)
- ✅ Social media links
- ✅ Security headers via .htaccess
- ✅ Static content fallback (works without DB)

---

## 🌐 Google Analytics
Uncomment and add your GA4 ID in `partials/header.php`.

---

## 📞 Contact
- Phone: +91 86681 03301
- Email: nesammedia@gmail.com
- Address: 11, Govt. Hospital Street, Nedungadu, Karaikal, Puducherry – 609602

Made with ❤️ in Tamil Nadu & Puducherry | © 2026 Nesam Media Works
