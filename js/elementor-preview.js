/**
 * Elementor Editor Preview Integration
 *
 * Re-initializes theme animations and layout listeners within the Elementor editor preview.
 *
 * @package The_Optimize_Code
 */

(function ($) {
    'use strict';

    $(window).on('elementor/frontend/init', function () {
        if (typeof elementorFrontend === 'undefined') {
            return;
        }

        // Global hook when any widget is rendered/modified in preview
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
            // Trigger scroll/reveal observer update if present
            if (typeof window.tocInitReveals === 'function') {
                window.tocInitReveals();
            }

            // Ensure images and links inside preview maintain accessible focus
            $scope.find('a[href^="#"]').on('click.tocPreview', function (e) {
                var target = $(this).attr('href');
                if (target && target.length > 1 && $(target).length) {
                    e.preventDefault();
                }
            });
        });

        // Section header specific preview handling
        elementorFrontend.hooks.addAction('frontend/element_ready/toc-section-header.default', function ($scope) {
            $scope.find('.toc-section-header').addClass('is-preview-ready');
        });
    });
})(jQuery);
