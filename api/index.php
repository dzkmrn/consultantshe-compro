<?php
/**
 * Vercel entry point.
 *
 * vercel.json routes every request that is not a real file to this function.
 * The site itself lives at the repository root, so this is only a shim: the
 * front controller there works out the page from the request path.
 */
require __DIR__ . '/../index.php';
