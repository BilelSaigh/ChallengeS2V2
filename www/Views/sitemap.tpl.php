<?php
header("Content-Type: application/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
foreach ($slug as $url) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . htmlspecialchars($url->getSlug()) . '</loc>' . PHP_EOL;
    echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL;
    echo '<changefreq>weekly</changefreq>' . PHP_EOL;
    echo '<priority>0.8</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;
