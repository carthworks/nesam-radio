<?php
$src1 = "C:\\Users\\tkart\\.gemini\\antigravity\\brain\\975f9100-0ca3-442f-ae34-4b5dc2882b5f\\hero_artist_1775189506819.png";
$src2 = "C:\\Users\\tkart\\.gemini\\antigravity\\brain\\975f9100-0ca3-442f-ae34-4b5dc2882b5f\\hero_event_1775189530922.png";
$src3 = "C:\\Users\\tkart\\.gemini\\antigravity\\brain\\975f9100-0ca3-442f-ae34-4b5dc2882b5f\\hero_studio_1775189547828.png";

copy($src1, __DIR__ . '/assets/images/hero_artist.png');
copy($src2, __DIR__ . '/assets/images/hero_event.png');
copy($src3, __DIR__ . '/assets/images/hero_studio.png');

echo "Copied images successfully.";
