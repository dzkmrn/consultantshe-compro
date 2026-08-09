<?php
/**
 * Pins for the "Local Presence, Wider Support" map.
 *
 * assets/images/indonesia-map.svg is drawn on a plate-carree (equirectangular)
 * grid, so a pin's position is a straight linear mapping of its coordinates.
 * 'frame' below MUST stay in sync with the bounds the SVG was generated with.
 *
 * Per pin:
 *   lat/lng — real coordinates, used to place the marker dot
 *   place   — where the label pill sits relative to the dot:
 *             left|right anchor the pill's near edge, center centres it on the dot
 *   dx/dy   — label offset from the dot, in cqw (1cqw = 1% of the map's width).
 *             Because the map keeps a fixed aspect ratio, an offset in cqw holds
 *             the same position on the artwork at every screen size. Offsets are
 *             purely for collision avoidance; the dot always sits on the true
 *             coordinates. Every pill is kept about 1.1cqw from its own dot so
 *             the pairing stays obvious; on crowded Java they alternate above
 *             and below the island rather than moving further away.
 */
return [
    'frame' => [
        'lng_min' => 94.5,
        'lng_max' => 141.5,
        'lat_min' => -11.3,
        'lat_max' => 6.3,
    ],
    'pins' => [
        ['name' => 'Batam',      'lat' =>  1.0456, 'lng' => 104.0305, 'place' => 'right',  'dx' =>  1.10, 'dy' =>  0.00],
        ['name' => 'Palembang',  'lat' => -2.9761, 'lng' => 104.7754, 'place' => 'left',   'dx' =>  1.10, 'dy' =>  0.00],
        ['name' => 'Cilegon',    'lat' => -6.0175, 'lng' => 106.0538, 'place' => 'left',   'dx' =>  1.10, 'dy' =>  0.00],
        ['name' => 'Jakarta',    'lat' => -6.2088, 'lng' => 106.8456, 'place' => 'center', 'dx' =>  0.00, 'dy' =>  2.16],
        ['name' => 'Balongan',   'lat' => -6.3667, 'lng' => 108.3833, 'place' => 'center', 'dx' => -1.24, 'dy' => -2.16],
        ['name' => 'Cilacap',    'lat' => -7.7269, 'lng' => 109.0100, 'place' => 'center', 'dx' =>  0.00, 'dy' =>  2.16],
        ['name' => 'Bojonegoro', 'lat' => -7.1502, 'lng' => 111.8817, 'place' => 'center', 'dx' =>  0.00, 'dy' => -2.16],
        ['name' => 'Tuban',      'lat' => -6.8976, 'lng' => 112.0648, 'place' => 'center', 'dx' =>  0.00, 'dy' => -3.88],
        ['name' => 'Surabaya',   'lat' => -7.2575, 'lng' => 112.7521, 'place' => 'right',  'dx' =>  1.10, 'dy' =>  0.00],
        ['name' => 'Makassar',   'lat' => -5.1477, 'lng' => 119.4327, 'place' => 'right',  'dx' =>  1.10, 'dy' =>  0.00],
        ['name' => 'Balikpapan', 'lat' => -1.2379, 'lng' => 116.8529, 'place' => 'right',  'dx' =>  1.10, 'dy' =>  0.00],
        ['name' => 'Sorong',     'lat' => -0.8762, 'lng' => 131.2558, 'place' => 'left',   'dx' =>  1.10, 'dy' =>  0.00],
    ],
];
