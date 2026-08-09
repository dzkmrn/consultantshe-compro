<?php
/**
 * Reads assets/galeri straight off disk so dropping a new photo in the folder
 * publishes it — no list to update anywhere.
 */

/**
 * @param int|null $limit Return at most this many photos.
 * @return array<int, array{url:string, ratio:float, w:int, h:int}>
 */
function gallery_photos(?int $limit = null): array
{
    static $cache = null;

    if ($cache === null) {
        $files = glob(__DIR__ . '/../assets/galeri/*.{png,jpg,jpeg,webp}', GLOB_BRACE) ?: [];

        // "Image.png" first, then Image-1 … Image-16 in numeric order.
        usort($files, function (string $a, string $b): int {
            $rank = static fn(string $p): int =>
                preg_match('/-(\d+)\.[a-z]+$/i', basename($p), $m) ? (int) $m[1] : 0;
            return $rank($a) <=> $rank($b) ?: strcmp($a, $b);
        });

        $cache = [];
        foreach ($files as $file) {
            $size = @getimagesize($file);
            if (!$size || $size[0] <= 0 || $size[1] <= 0) {
                continue;
            }
            $cache[] = [
                'url'   => asset('galeri/' . rawurlencode(basename($file))),
                'ratio' => round($size[0] / $size[1], 4),
                'w'     => $size[0],
                'h'     => $size[1],
            ];
        }
    }

    return $limit === null ? $cache : array_slice($cache, 0, $limit);
}
