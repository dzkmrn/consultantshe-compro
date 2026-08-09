<?php
/**
 * Open vacancies rendered on the Career page.
 * Content transcribed from reference2/Loker.png.
 *
 * To publish a new opening, append an entry. To close one, delete it —
 * the page falls back to an "no openings" notice when the list is empty.
 *
 * 'quals' entries take a heading line plus optional sub-items rendered as chips.
 */
return [
    [
        'title'    => 'Safety Leadership Trainer',
        'urgent'   => true,
        'type'     => 'Contract',
        'location' => 'DKI Jakarta',
        'banner'   => 'images/career-banner.jpg',
        'deadline' => '16 Juni 2028',
        'summary'  => 'Kami mencari Safety Leadership Trainer yang berpengalaman untuk memfasilitasi '
            . 'pelatihan berbasis immersive learning, experiential learning, dan metode interaktif '
            . 'guna meningkatkan budaya keselamatan, kepemimpinan keselamatan, serta perubahan '
            . 'perilaku di Tangguh UCC Project.',
        'quals' => [
            [
                'text'  => 'Pengalaman 5–10 tahun sebagai trainer, fasilitator, atau konsultan pelatihan '
                    . 'di bidang K3, Safety Leadership, Human Performance, atau bidang terkait.',
                'items' => [],
            ],
            [
                'text'  => 'Memiliki pengalaman memfasilitasi pelatihan untuk level:',
                'items' => ['Supervisor', 'Superintendent', 'Manager', 'Senior Leadership'],
            ],
            [
                'text'  => 'Mampu mengajar dan memfasilitasi pelatihan dalam:',
                'items' => [
                    'Bahasa Indonesia',
                    'Bahasa Inggris (minimal level profesional untuk presentasi dan fasilitasi kelas)',
                ],
            ],
            [
                'text'  => 'Berpengalaman menggunakan metode pembelajaran:',
                'items' => [
                    'Immersive Learning',
                    'Experiential Learning',
                    'Scenario-Based Learning',
                    'Gamification',
                    'Interactive Workshop',
                    'Simulation & Role Play',
                ],
            ],
            [
                'text'  => 'Mampu mengoperasikan dan mengembangkan penggunaan:',
                'items' => [
                    'Training Kit Interaktif',
                    'Safety Learning Simulation',
                    'Immersive Learning Tools',
                    'Facilitation Tools dan Learning Media',
                ],
            ],
            [
                'text'  => 'Berdomisili Jakarta dan sekitarnya.',
                'items' => [],
            ],
        ],
    ],
];
