<?php
/**
 * Inline SVG icon set.
 *
 * Keeping the markup here means a template never carries raw path data and an
 * icon only has to be corrected in one place.
 *
 * Usage: <?= icon('check-circle', 20) ?>
 */

const ICON_PATHS = [
    // --- Service cards -------------------------------------------------
    'monitor' => '<rect x="2.5" y="4" width="19" height="13.5" rx="2.2"/><path d="M8.5 21h7M12 17.5V21"/>',
    'presentation' => '<path d="M3 3h18"/><path d="M4.5 3v10.5a1.5 1.5 0 0 0 1.5 1.5h12a1.5 1.5 0 0 0 1.5-1.5V3"/><path d="M12 15v6M12 21l-3.5 0M12 21l3.5 0"/>',
    'graduation-cap' => '<path d="M12 3.2 2.5 8 12 12.8 21.5 8z"/><path d="M6.4 10.3v4.9c0 1.7 2.5 3 5.6 3s5.6-1.3 5.6-3v-4.9"/><path d="M21.5 8v5.4"/>',

    // --- Generic UI ----------------------------------------------------
    'check-circle' => '<circle cx="12" cy="12" r="9.2"/><path d="M8 12.3l2.9 2.8 5.2-5.6"/>',
    'arrow-up-right' => '<path d="M7 17 17 7"/><path d="M9 7h8v8"/>',
    'arrow-circle' => '<circle cx="12" cy="12" r="9.2"/><path d="M9 15l6-6"/><path d="M9.9 9H15v5.1"/>',
    'chevron-down' => '<path d="m6 9.5 6 6 6-6"/>',
    'chevron-left' => '<path d="m14.5 6-6 6 6 6"/>',
    'chevron-right' => '<path d="m9.5 6 6 6-6 6"/>',
    'briefcase' => '<rect x="2.5" y="7" width="19" height="13" rx="2.2"/><path d="M8.5 7V5.4A1.9 1.9 0 0 1 10.4 3.5h3.2a1.9 1.9 0 0 1 1.9 1.9V7"/>',

    // --- Contact -------------------------------------------------------
    'map-pin' => '<path d="M12 21.5s7-6.3 7-11.4A7 7 0 0 0 5 10.1c0 5.1 7 11.4 7 11.4z"/><circle cx="12" cy="10" r="2.6"/>',
    'mail' => '<rect x="2.5" y="4.8" width="19" height="14.4" rx="2.2"/><path d="m3.4 6.4 8.6 6 8.6-6"/>',
    'instagram' => '<rect x="2.8" y="2.8" width="18.4" height="18.4" rx="5"/><circle cx="12" cy="12" r="4.2"/><circle cx="17.4" cy="6.6" r="1.15" fill="currentColor" stroke="none"/>',
];

/** Solid icons carry their own fill, so they bypass the stroked wrapper. */
const ICON_SOLID = [
    'check-circle-solid' => '<path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm-1.15 14.4-4.2-4.2 1.6-1.6 2.6 2.6 5.35-5.35 1.6 1.6z"/>',
    'map-pin-solid' => '<path d="M12 2a7.6 7.6 0 0 0-7.6 7.6c0 5.7 7.6 12.4 7.6 12.4s7.6-6.7 7.6-12.4A7.6 7.6 0 0 0 12 2zm0 10.4a2.8 2.8 0 1 1 0-5.6 2.8 2.8 0 0 1 0 5.6z"/>',
    'mail-solid' => '<path d="M2.4 6.6 12 13l9.6-6.4A2.2 2.2 0 0 0 19.6 5H4.4a2.2 2.2 0 0 0-2 1.6zM22 8.7l-9.45 6.3a1 1 0 0 1-1.1 0L2 8.7v8.1A2.2 2.2 0 0 0 4.2 19h15.6a2.2 2.2 0 0 0 2.2-2.2z"/>',
    'instagram-solid' => '<path d="M7.4 2h9.2A5.4 5.4 0 0 1 22 7.4v9.2a5.4 5.4 0 0 1-5.4 5.4H7.4A5.4 5.4 0 0 1 2 16.6V7.4A5.4 5.4 0 0 1 7.4 2zm9.9 3.1a1.3 1.3 0 1 0 0 2.6 1.3 1.3 0 0 0 0-2.6zM12 7.1a4.9 4.9 0 1 0 0 9.8 4.9 4.9 0 0 0 0-9.8zm0 2a2.9 2.9 0 1 1 0 5.8 2.9 2.9 0 0 1 0-5.8z"/>',
    'push-pin' => '<path d="M14.4 2.2 21.8 9.6l-1.6 1.6-1.1-.3-3.3 3.3.35 3.6a1 1 0 0 1-1.7.8l-3.5-3.5-4.6 4.6-1.15-1.15 4.6-4.6-3.5-3.5a1 1 0 0 1 .8-1.7l3.6.35 3.3-3.3-.3-1.1z"/>',
    'whatsapp' => '<path d="M12.04 2A9.9 9.9 0 0 0 3.6 17.1L2.2 22l5.03-1.32A9.9 9.9 0 1 0 12.04 2zm0 1.98a7.92 7.92 0 1 1-4.03 14.74l-.29-.17-2.98.78.8-2.9-.19-.3A7.92 7.92 0 0 1 12.04 3.98zm4.5 11.02c-.24-.12-1.43-.7-1.65-.78-.22-.08-.38-.12-.55.12s-.63.78-.77.94c-.14.16-.28.18-.52.06-.24-.12-1.02-.37-1.94-1.2-.72-.64-1.2-1.43-1.34-1.67-.14-.24-.02-.37.1-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.55-1.31-.75-1.8-.2-.47-.4-.4-.55-.41h-.46c-.16 0-.42.06-.64.3-.22.24-.84.83-.84 2.01s.86 2.33.98 2.49c.12.16 1.7 2.6 4.12 3.64.58.25 1.03.4 1.38.51.58.18 1.1.16 1.52.1.46-.07 1.43-.58 1.63-1.15.2-.56.2-1.05.14-1.15-.06-.1-.22-.16-.46-.28z"/>',
];

/**
 * @param string $name Key from ICON_PATHS or ICON_SOLID.
 * @param int    $size Rendered pixel size (icons are drawn on a 24px grid).
 */
function icon(string $name, int $size = 24, string $class = ''): string
{
    $attrs = sprintf(
        'viewBox="0 0 24 24" width="%d" height="%d" aria-hidden="true" focusable="false"%s',
        $size,
        $size,
        $class !== '' ? ' class="' . htmlspecialchars($class) . '"' : ''
    );

    if (isset(ICON_SOLID[$name])) {
        return '<svg ' . $attrs . ' fill="currentColor">' . ICON_SOLID[$name] . '</svg>';
    }

    if (!isset(ICON_PATHS[$name])) {
        return '';
    }

    return '<svg ' . $attrs . ' fill="none" stroke="currentColor" stroke-width="1.7"'
        . ' stroke-linecap="round" stroke-linejoin="round">' . ICON_PATHS[$name] . '</svg>';
}
