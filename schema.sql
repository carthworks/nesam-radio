-- Nesam Radio – MySQL Schema
-- Run once to set up all tables

CREATE DATABASE IF NOT EXISTS nesam_radio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE nesam_radio;

-- Song Requests
CREATE TABLE IF NOT EXISTS song_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    requester_name VARCHAR(100) NOT NULL,
    song_name VARCHAR(200) NOT NULL,
    phone VARCHAR(20),
    station VARCHAR(100) DEFAULT 'Nesam FM',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Schedule
CREATE TABLE IF NOT EXISTS schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day_of_week ENUM('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
    time_start TIME NOT NULL,
    time_end TIME NOT NULL,
    program_name VARCHAR(200) NOT NULL,
    channel VARCHAR(100) NOT NULL,
    host VARCHAR(100),
    description TEXT
);

-- Podcasts / Episodes
CREATE TABLE IF NOT EXISTS podcasts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    host VARCHAR(100),
    category VARCHAR(100),
    description TEXT,
    duration VARCHAR(20),
    thumbnail VARCHAR(255),
    audio_url VARCHAR(255),
    downloads INT DEFAULT 0,
    published_at DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog Posts
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(300) NOT NULL,
    slug VARCHAR(300) UNIQUE NOT NULL,
    excerpt TEXT,
    content LONGTEXT,
    thumbnail VARCHAR(255),
    author VARCHAR(100) DEFAULT 'Nesam Team',
    published_at DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contact Messages
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(200),
    message TEXT NOT NULL,
    is_read TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Schedule Data
INSERT INTO schedule (day_of_week, time_start, time_end, program_name, channel, host, description) VALUES
('Monday','07:00:00','09:00:00','Morning Nesam','Nesam FM','RJ Kavya','Start your day with uplifting Tamil hits and motivational words.'),
('Monday','09:00:00','10:00:00','Tamil Devotional Hour','Nesam Devotional','RJ Suresh','Begin the day with peace – bhajans, Thirukkural, and slokas.'),
('Monday','10:00:00','12:00:00','Kollywood Hits Parade','Nesam FM','RJ Priya','Back-to-back chart-toppers from Tamil cinema.'),
('Monday','12:00:00','13:00:00','Lunch Time Retro','Nesam Retro','RJ Mani','80s & 90s golden Tamil classics over lunch.'),
('Monday','13:00:00','14:00:00','Tamil News Hour','Nesam News','News Team','Comprehensive Tamil Nadu & India news update.'),
('Monday','14:00:00','16:00:00','Afternoon Hits','Nesam Hits','RJ Divya','Non-stop latest Tamil & Kollywood tracks.'),
('Monday','16:00:00','17:00:00','Kids Corner','Nesam Kids','RJ Anbu','Fun stories, rhymes and educational content for children.'),
('Monday','17:00:00','19:00:00','Evening Drive','Nesam FM','RJ Karthik','Your commute soundtrack – trending hits & listener requests.'),
('Monday','19:00:00','20:00:00','Tamil Cultural Hour','Nesam FM','RJ Meena','Celebrating Tamil art, literature, and traditions.'),
('Monday','20:00:00','22:00:00','Night Melodies','Nesam FM','RJ Raj','Soothing Tamil melodies to unwind after a long day.'),
('Monday','22:00:00','23:59:00','Midnight Classics','Nesam Retro','Auto DJ','Timeless classics through the night.'),
('Tuesday','07:00:00','09:00:00','Morning Nesam','Nesam FM','RJ Kavya','Start your day with uplifting Tamil hits.'),
('Tuesday','09:00:00','10:00:00','Tamil Devotional Hour','Nesam Devotional','RJ Suresh','Begin the day with peace and devotion.'),
('Wednesday','07:00:00','09:00:00','Morning Nesam','Nesam FM','RJ Priya','Wednesday energy with the best Tamil hits.'),
('Thursday','07:00:00','09:00:00','Morning Nesam','Nesam FM','RJ Kavya','Thursday vibes with Tamil music.'),
('Friday','07:00:00','09:00:00','Friday Fever','Nesam FM','RJ Karthik','Start the weekend with the hottest tracks.'),
('Saturday','08:00:00','10:00:00','Weekend Fiesta','Nesam Hits','RJ Divya','Weekend party mix – non-stop Tamil hits.'),
('Saturday','10:00:00','12:00:00','Request Hour','Nesam FM','RJ Priya','Your requests, our playlist – call or WhatsApp now!'),
('Sunday','08:00:00','10:00:00','Sunday Devotional','Nesam Devotional','RJ Suresh','Peaceful Sunday morning with bhajans & prayers.'),
('Sunday','10:00:00','12:00:00','Retro Sunday','Nesam Retro','RJ Mani','Relive the golden era of Tamil music.');

-- Sample Podcasts
INSERT INTO podcasts (title, host, category, description, duration, audio_url, published_at) VALUES
('Top 10 Tamil Songs of 2026','RJ Kavya','Cinema Talk','A countdown of the biggest Tamil chartbusters of 2026, with behind-the-scenes insights.','42 mins','/assets/audio/sample.mp3','2026-03-15'),
('Tamil Diaspora Stories – Episode 12','RJ Karthik','Culture','How Tamilians around the world use Nesam Radio to stay connected to their roots.','35 mins','/assets/audio/sample.mp3','2026-03-10'),
('Health & Wellness in Tamil','Dr. Priya','Health','Simple health tips in Tamil – diet, yoga, Siddha medicine.','28 mins','/assets/audio/sample.mp3','2026-03-05'),
('Entrepreneurship Tamil Style','RJ Suresh','Business','Success stories of Tamil entrepreneurs from TN to Silicon Valley.','50 mins','/assets/audio/sample.mp3','2026-02-28'),
('Thirukkural for Modern Life','Scholar Annamalai','Spiritual','Ancient Tamil wisdom from Thirukkural applied to 21st century challenges.','30 mins','/assets/audio/sample.mp3','2026-02-20'),
('Kollywood Behind the Mic','RJ Meena','Cinema Talk','Exclusive chat with Tamil music directors and playback singers.','45 mins','/assets/audio/sample.mp3','2026-02-15');

-- Sample Blog Posts
INSERT INTO blog_posts (title, slug, excerpt, content, author, published_at) VALUES
('Top 10 Tamil Songs of 2026 So Far','top-10-tamil-songs-2026','Discover the hottest Tamil tracks that are ruling the charts in 2026. From Kollywood blockbusters to independent hits.','<p>2026 has been a phenomenal year for Tamil music. The industry continues to evolve, blending traditional Carnatic roots with modern beats...</p><p>Here are our top picks that have defined Tamil music this year...</p>','Nesam Team','2026-03-20'),
('How Nesam Radio is Connecting Tamil Diaspora Worldwide','nesam-radio-tamil-diaspora','From London to Singapore, Tamilians tune into Nesam Radio to stay connected with their culture, language, and music.','<p>Music is the thread that binds every Tamil heart, no matter where in the world they may be. Nesam Radio was born from this very understanding...</p>','RJ Karthik','2026-03-10'),
('Interview with AR Rahman\'s Sound Engineer','interview-ar-rahman-sound-engineer','We sat down with one of India\'s top sound engineers who has worked on some of the most iconic Tamil film soundtracks.','<p>Behind every legendary Tamil film score is a team of unsung heroes. We had the privilege of speaking with one such genius...</p>','RJ Kavya','2026-02-25'),
('Why Tamil Radio is Making a Massive Comeback in 2026','tamil-radio-comeback-2026','Digital radio is having a renaissance. Here is why Tamil online radio, especially Nesam Radio, is at the forefront of this revolution.','<p>Remember the days of gathering around the radio to listen to Vividh Bharati? That nostalgia is back, but now it is digital, global, and on-demand...</p>','Nesam Team','2026-02-15');
