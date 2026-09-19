(function ($) {
  'use strict';

  $(document).on('click', '.toc-select-media', function (event) {
    event.preventDefault();
    const field = $(this).closest('.toc-media-field');
    const frame = wp.media({
      title: tocThemeSettings.title,
      button: { text: tocThemeSettings.button },
      library: { type: 'image' },
      multiple: false
    });

    frame.on('select', function () {
      const attachment = frame.state().get('selection').first().toJSON();
      const thumbnail = attachment.sizes?.thumbnail?.url || attachment.url;
      field.find('.toc-media-id').val(attachment.id);
      field.find('.toc-media-preview').html($('<img>', { src: thumbnail, alt: '' }));
      field.find('.toc-remove-media').prop('hidden', false);
    });
    frame.open();
  });

  $(document).on('click', '.toc-remove-media', function (event) {
    event.preventDefault();
    const field = $(this).closest('.toc-media-field');
    field.find('.toc-media-id').val('0');
    field.find('.toc-media-preview').empty();
    $(this).prop('hidden', true);
  });
})(jQuery);
