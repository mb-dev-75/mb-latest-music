jQuery(function ($) {
  // Upload Image
  $('#wpbody').on('click', '.upload_image_button', function (e) {
    e.preventDefault();

    var field_id = $(this).data('field-id');

    if (imageUploader) {
      imageUploader.open();
      return;
    }

    var imageUploader = (wp.media.frames.file_frame = wp.media({
      title: 'Select a cover',
      library: {
        type: 'image',
      },
      button: {
        text: 'Add this cover',
      },
      multiple: false,
    }));

    imageUploader.on('select', function () {
      var attachment = imageUploader.state().get('selection').first().toJSON();

      $('#' + field_id)
        .val(attachment.url)
        .change();

      $('#' + field_id + '_img').html(
        '<img src="' + attachment.url + '" alt="" style="width: 100%" />'
      );
    });

    imageUploader.open();
  });

  // Upload Track
  $('#wpbody').on('click', '.upload_audio_button', function (e) {
    e.preventDefault();

    var f_id = $(this).data('f-id');

    if (audioUploader) {
      audioUploader.open();
      return;
    }

    var audioUploader = (wp.media.frames.file_frame = wp.media({
      title: 'Select a track',
      library: {
        type: 'audio',
      },
      button: {
        text: 'Add this track',
      },
      multiple: false,
    }));

    audioUploader.on('select', function () {
      var attachment = audioUploader.state().get('selection').first().toJSON();

      $('#' + f_id)
        .val(attachment.url)
        .change();

      $('#' + f_id + '_audio').html(
        '<input type="text" value="' + attachment.url + '" />'
      );
    });

    audioUploader.open();
  });
});
