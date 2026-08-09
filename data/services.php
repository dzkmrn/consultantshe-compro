<?php
/**
 * Service cards shown on the home page.
 *
 * 'icon'  — key from includes/icons.php
 * 'items' — bullet list; a nested array renders as one bullet with line breaks.
 */
return [
    [
        'title' => 'Procurement',
        'icon'  => 'monitor',
        'items' => [
            'SHE Equipment',
            'Office & Training Equipment',
            'PPE',
            'Uniform & Fire Retardant Coverall',
            'Corporate Gift Set',
            'Milestone Souvenir',
            'Office Stationery, etc.',
        ],
    ],
    [
        'title' => 'Consultancy',
        'icon'  => 'presentation',
        'items' => [
            'SHE Management System',
            'Organizational Development',
            'Technical and NonTechnical Assessment & Coaching',
            'Training Need Analysis',
            'Cultural Assessment',
            'Robust Safety Culture Development',
            'SHE Inspection',
        ],
    ],
    [
        'title' => 'Competency Training & Assessment',
        'icon'  => 'graduation-cap',
        'items' => [
            'Occupational Health & Safety Management System',
            'Technical SHE',
            'Safety Culture',
            'Aviation & Helicopter',
            'Driving & Riding',
            'Offshore & Survival',
            [
                'Marine,',
                'Professional Certification (Migas,',
                'Kemenakertrans RI, ESDM, ISO, BNSP,',
                'Kemenhub, NIOSH, NEBOSH)',
            ],
        ],
    ],
];
