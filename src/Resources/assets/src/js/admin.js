jQuery(document).ready(function($) {
  $('.input-img .input-img__button').on('click', function(e) {
    e.preventDefault();

    var frame = wp.media({
      title: 'Select image',
      button: {
          text: 'Select'
      },
      multiple: false
    });

    var wrap = $(this).parents('.input-img');
    var input = wrap.find('.input-img__val');
    var thumb = wrap.find('.input-img__thumb');

    frame.on('select', function() {
      var img = frame.state().get('selection').first().toJSON();

      // show buttons
      wrap.addClass('input-img--has-image');

      // set value
      input.val(img.id);

      // add thumb
      thumb.html('<img class="input-img__thumb-img" src="' + img.url + '" />');
    });

    frame.open();
  });

  $('.input-img .input-img__button--remove').on('click', function(e) {
    var wrap = $(this).parents('.input-img');
    var input = wrap.find('.input-img__val');
    var thumb = wrap.find('.input-img__thumb');

    wrap.removeClass('input-img--has-image');
    input.val('');
    thumb.html('');
  });
});
