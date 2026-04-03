<?php
require_once 'config.php';
$pageTitle = 'Program Schedule – Nesam Radio | Weekly Tamil Radio Timetable';
$pageDesc  = 'View the full weekly schedule of Nesam Radio programs – Morning Nesam, Devotional Hour, Kollywood Hits, Evening Drive, and more.';
$canonUrl  = SITE_URL . '/schedule.php';

$streams = json_decode(STREAMS, true);
$days    = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
$today   = date('l');

// Filter params
$filterDay     = in_array($_GET['day'] ?? '',     $days)      ? $_GET['day']     : $today;
$filterChannel = $_GET['channel'] ?? 'all';

// Fetch from DB
$db = getDB();
$schedule = [];
if ($db) {
    $sql    = 'SELECT * FROM schedule WHERE day_of_week = ?';
    $params = [$filterDay];
    if ($filterChannel !== 'all') {
        $sql    .= ' AND channel = ?';
        $params[] = $filterChannel;
    }
    $sql .= ' ORDER BY time_start ASC';
    $schedule = $db->prepare($sql);
    $schedule->execute($params);
    $schedule = $schedule->fetchAll();
}

// Fallback static data
if (!$schedule) {
    $schedule = [
        ['time_start'=>'07:00:00','time_end'=>'09:00:00','program_name'=>'Morning Nesam','channel'=>'Nesam FM','host'=>'RJ Kavya','description'=>'Start your day with uplifting Tamil hits.'],
        ['time_start'=>'09:00:00','time_end'=>'10:00:00','program_name'=>'Tamil Devotional Hour','channel'=>'Nesam Devotional','host'=>'RJ Suresh','description'=>'Begin with peace – bhajans and Thirukkural.'],
        ['time_start'=>'10:00:00','time_end'=>'12:00:00','program_name'=>'Kollywood Hits Parade','channel'=>'Nesam FM','host'=>'RJ Priya','description'=>'Back-to-back chart-toppers.'],
        ['time_start'=>'12:00:00','time_end'=>'13:00:00','program_name'=>'Lunch Time Retro','channel'=>'Nesam Retro','host'=>'RJ Mani','description'=>'80s & 90s golden classics.'],
        ['time_start'=>'13:00:00','time_end'=>'14:00:00','program_name'=>'Tamil News Hour','channel'=>'Nesam News','host'=>'News Team','description'=>'Comprehensive Tamil Nadu & India news.'],
        ['time_start'=>'14:00:00','time_end'=>'16:00:00','program_name'=>'Afternoon Hits','channel'=>'Nesam Hits','host'=>'RJ Divya','description'=>'Non-stop latest Tamil & Kollywood.'],
        ['time_start'=>'16:00:00','time_end'=>'17:00:00','program_name'=>'Kids Corner','channel'=>'Nesam Kids','host'=>'RJ Anbu','description'=>'Fun stories and rhymes for children.'],
        ['time_start'=>'17:00:00','time_end'=>'19:00:00','program_name'=>'Evening Drive','channel'=>'Nesam FM','host'=>'RJ Karthik','description'=>'Trending hits & listener requests.'],
        ['time_start'=>'19:00:00','time_end'=>'20:00:00','program_name'=>'Tamil Cultural Hour','channel'=>'Nesam FM','host'=>'RJ Meena','description'=>'Celebrating Tamil art and traditions.'],
        ['time_start'=>'20:00:00','time_end'=>'22:00:00','program_name'=>'Night Melodies','channel'=>'Nesam FM','host'=>'RJ Raj','description'=>'Soothing Tamil melodies to unwind.'],
        ['time_start'=>'22:00:00','time_end'=>'23:59:00','program_name'=>'Midnight Classics','channel'=>'Nesam Retro','host'=>'Auto DJ','description'=>'Timeless classics through the night.'],
    ];
}

// Determine "now" show
$nowTime    = date('H:i:s');
$nowChannel = $filterDay === $today ? $filterChannel : '';

$channelColors = [
    'Nesam FM'         => 'text-brand-red   bg-brand-red/20   border-brand-red/30',
    'Nesam Devotional' => 'text-yellow-400  bg-yellow-400/20  border-yellow-400/30',
    'Nesam News'       => 'text-blue-400    bg-blue-400/20    border-blue-400/30',
    'Nesam Hits'       => 'text-orange-400  bg-orange-400/20  border-orange-400/30',
    'Nesam Retro'      => 'text-purple-400  bg-purple-400/20  border-purple-400/30',
    'Nesam Kids'       => 'text-green-400   bg-green-400/20   border-green-400/30',
];

include 'partials/header.php';
?>

<section id="schedule-page" class="py-24 px-4">
  <div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="text-center mb-10">
      <span class="section-badge mb-4">🕐 Schedule</span>
      <h1 class="text-4xl sm:text-5xl font-black text-white mb-2">Program Schedule ❤️</h1>
      <p class="text-gray-400"><?= date('l, d F Y') ?> · <?= date('h:i A') ?> IST</p>
    </div>

    <!-- Filters -->
    <div class="glass-card rounded-2xl p-4 mb-8 flex flex-col sm:flex-row gap-4">
      <!-- Day filter -->
      <form method="GET" class="flex flex-wrap gap-2 flex-1" id="schedule-filter-form">
        <?php if ($filterChannel !== 'all'): ?>
        <input type="hidden" name="channel" value="<?= h($filterChannel) ?>">
        <?php endif; ?>
        <?php foreach ($days as $day): ?>
        <button type="submit" name="day" value="<?= $day ?>"
                class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all
                       <?= $day === $filterDay ? 'bg-brand-red text-white' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' ?>">
          <?= substr($day,0,3) ?>
        </button>
        <?php endforeach; ?>
      </form>

      <!-- Channel filter -->
      <form method="GET" class="flex items-center" id="channel-filter-form">
        <input type="hidden" name="day" value="<?= h($filterDay) ?>">
        <select name="channel" onchange="this.form.submit()"
                class="nesam-input text-sm py-1.5 px-3 rounded-lg w-auto min-w-[140px]" aria-label="Filter by channel">
          <option value="all" <?= $filterChannel==='all' ? 'selected' : '' ?>>All Channels</option>
          <?php foreach (array_column(json_decode(STREAMS,true),'name') as $ch): ?>
          <option value="<?= h($ch) ?>" <?= $filterChannel===$ch ? 'selected' : '' ?>><?= h($ch) ?></option>
          <?php endforeach; ?>
        </select>
      </form>
    </div>

    <!-- Schedule Table -->
    <?php if ($schedule): ?>
    <div class="rounded-2xl border border-dark-border overflow-hidden">
      <table class="w-full schedule-table text-sm">
        <thead class="bg-dark-card">
          <tr>
            <th class="px-4 py-3 text-left text-gray-400">Time</th>
            <th class="px-4 py-3 text-left text-gray-400">Program</th>
            <th class="px-4 py-3 text-left text-gray-400 hidden sm:table-cell">Channel</th>
            <th class="px-4 py-3 text-left text-gray-400 hidden md:table-cell">Host</th>
            <th class="px-4 py-3 text-left text-gray-400 hidden lg:table-cell">Description</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-dark-border">
          <?php foreach ($schedule as $row):
            $start  = substr($row['time_start'],0,5);
            $end    = substr($row['time_end'],0,5);
            $isNow  = ($filterDay === $today && $row['time_start'] <= $nowTime && $row['time_end'] >= $nowTime);
            $color  = $channelColors[$row['channel']] ?? 'text-gray-400 bg-white/10 border-white/20';
          ?>
          <tr class="<?= $isNow ? 'now-show bg-brand-red/5' : 'bg-dark-bg hover:bg-dark-card' ?> transition-colors">
            <td class="px-4 py-4 font-mono text-sm whitespace-nowrap">
              <?= $isNow ? '<span class="live-dot inline-block w-2 h-2 rounded-full bg-brand-red mr-2"></span>' : '' ?>
              <span class="text-white font-bold"><?= h($start) ?></span>
              <span class="text-gray-500">–<?= h($end) ?></span>
            </td>
            <td class="px-4 py-4">
              <div class="font-semibold text-white"><?= h($row['program_name']) ?></div>
              <?= $isNow ? '<div class="text-xs text-brand-red font-bold mt-0.5">▶ On Air Now</div>' : '' ?>
            </td>
            <td class="px-4 py-4 hidden sm:table-cell">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs border font-semibold <?= $color ?>">
                <?= h($row['channel']) ?>
              </span>
            </td>
            <td class="px-4 py-4 hidden md:table-cell text-gray-400"><?= h($row['host'] ?? '') ?></td>
            <td class="px-4 py-4 hidden lg:table-cell text-gray-500 max-w-xs text-xs leading-relaxed"><?= h($row['description'] ?? '') ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
    <div class="text-center py-16 text-gray-400">
      <div class="text-4xl mb-3">📻</div>
      <p>No shows scheduled for this day/channel yet.<br>Check back soon!</p>
    </div>
    <?php endif; ?>

    <!-- Note -->
    <p class="text-center text-gray-600 text-xs mt-6">
      All times are in IST (Indian Standard Time · UTC+5:30). Schedule may vary. ❤️
    </p>
  </div>
</section>

<?php include 'partials/footer.php'; ?>
