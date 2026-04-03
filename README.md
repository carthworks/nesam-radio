# Nesam Radio – Complete PHP Website

> Tamil online radio website for Nesam Media Works. Built with pure PHP 8.2+, MySQL, HTML5 + Tailwind CSS 3 via CDN.

---

## 🚀 Welcome to Nesam Radio
Nesam Radio is a full-featured, scalable digital radio platform created to serve Tamil listeners globally. The application encompasses live streaming capabilities, real-time "Now Playing" updates, song requests, program schedules, and a beautiful, high-performance UI tailored specifically for modern radio broadcasting.

### ✨ Key Features
- **Live Radio Player**: Global persistent bottom-bar player + main live radio page with station switching.
- **Dynamic Hero Scroller**: An eye-catching auto-playing carousel on the homepage highlighting Artists of the Week, Special Events, and Studio Life.
- **Theme Support**: Completely hand-tuned, visually flawless **Dark & Light Modes** out of the box.
- **Responsive UI**: Built mobile-first. Looks beautiful on phones, tablets, and massive desktop screens. 
- **Database Driven Content**: Easy robust fetching for blogs, podcasts, and upcoming schedules using PDO MySQL.
- **Built-in APIs**: Lightweight PHP AJAX endpoints for Now Playing metadata, Contact forms, and Song Requests.
- **Environment Agnostic**: Works perfectly in root directories or subfolders using dynamic `BASE_PATH` routing. 

---

## 💻 Quick Setup for Local Development (Laragon / XAMPP)

### 1. Database Setup
1. Open your local database tool (e.g., HeidiSQL, phpMyAdmin).
2. Create a new database called `nesam`.
3. Import the `schema.sql` file located in the root directory to set up tables and insert demo data.

### 2. Configure Settings
Open `config.php` and ensure your database settings match your local environment:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Usually empty on Laragon/XAMPP
define('DB_NAME', 'nesam');
```

### 3. Start the Server
If using **Laragon**, just drop the folder into `C:\laragon\www\nesammedia`. The app will automatically be available at `http://nesammedia.test`.

---

## 🚀 Deployment to Production (cPanel)

### 1. Copy Files
Upload the entire repository contents to your **public_html** or web root directory.

### 2. Set Up Database
1. Go to **cPanel → MySQL Databases**.
2. Create a new database and a new database user. Add the user to the database with all privileges.
3. Import `schema.sql` using **cPanel → phpMyAdmin**.

### 3. Update `config.php`
Edit `config.php` with your live credentials:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_cpanel_db_username');
define('DB_PASS', 'your_secure_password');
define('DB_NAME', 'your_cpanel_db_name');
define('SITE_URL', 'https://nesammedia.com');
```

### 4. Enable HTTPS
In `.htaccess`, locate the `Force HTTPS` section and uncomment the rewrite rules to enforce secure connections.

---

## 🎨 Design & Customization

The site uses Tailwind CSS via CDN. Custom overrides, animations, and Light/Dark mode logic are heavily driven by the custom stylesheet. 

**Editing Styles:**
Open `assets/css/style.css` to modify brand colors, glassmorphism intensities, scrolling behaviors, and theme overrides.
`main.js` handles the toggling class on the `<html>` root node for the theme changer.

| Color | Hex | Usage |
|---|---|---|
| **Brand Red** | `#DC2626` | Primary CTAs, Live pulsing dots, Accents |
| **Brand Blue** | `#1E6FBB` | Secondary buttons, Links, Gradients |
| **Dark Theme Bg** | `#0D0D1A` | Dark mode base layout background |
| **Light Theme Bg**| `#F8FAFC` | Light mode base layout background |

---

## 📻 Broadcasting Streams

Stream definitions are globally controlled via JSON in `config.php`. To update where the audio comes from, modify the `STREAMS` constant:
```php
define('STREAMS', json_encode([
    'nesam-fm' => ['name' => 'Nesam FM', 'url' => 'https://YOUR_STREAM_URL', 'genre' => 'Tamil Film Hits'],
    // Add or remove stations here
]));
```
*Note: The metadata API (`api/now_playing.php`) pulls current song information from icecast/zenomedia metadata where available.*

---

## 📁 Project Structure

```text
/
├── index.php           # Landing page with dynamic hero carousel
├── live.php            # Main streaming player interface
├── stations.php        # Channel guide
├── podcasts.php        # Podcast library
├── blog.php            # News & Updates
├── about.php           # Company info & Team
├── contact.php         # Contact forms & Maps
├── config.php          # Global configuration (DB & Site Variables)
├── schema.sql          # Database structure + demo data
├── partials/
│   ├── header.php      # Global Navigation & SEO Meta
│   └── footer.php      # Persistent Audio Player & Footers
├── api/                # AJAX Endpoints
│   ├── contact.php     
│   ├── request_song.php
│   └── now_playing.php 
└── assets/
    ├── css/style.css   # Core CSS file
    ├── js/main.js      # Core Logic (Theming, Player, AJAX)
    └── images/         # Brand assets & Hero images
```

---

## 📞 Support & Information
- **Phone**: +91 86681 03301
- **Email**: nesammedia@gmail.com
- **Address**: 11, Govt. Hospital Street, Nedungadu, Karaikal, Puducherry – 609602

*Made with ❤️ | © Nesam Media Works*
