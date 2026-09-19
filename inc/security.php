<?php
/** Theme security headers. @package The_Optimize_Code */
if (!defined('ABSPATH')) { exit; }

function toc_send_security_headers(): void
{
    if (!headers_sent()) {
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('X-Frame-Options: SAMEORIGIN');
    }
}
add_action('send_headers', 'toc_send_security_headers');
