jQuery(document).ready(function($) {
  // img
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

  // imgs
  $('.input-imgs__btn').on('click', function(e) {
    e.preventDefault();

    var btn = $(this);
    var wrap = $(this).parents('.input-imgs');
    var input = wrap.find('.input-imgs__val');
    var thumbs = wrap.find('.input-imgs__thumbs');

    var frame = wp.media({
      title: 'Select image',
      button: {
          text: 'Select'
      },
      multiple: 'add'
    });

    // open
    frame.on('open', function(){
        var selection = frame.state().get('selection');
        var imgIds = input.val(); // the id of the image
        if (imgIds) {
          var imgIds = imgIds.split(',');

          imgIds.forEach(imgId => {
            selection.add(wp.media.attachment(imgId));
          });
        }
    });

    // select
    frame.on('select', function() {
      var selection = frame.state().get('selection');
      var imgIds = [];

      // add thumbs
      thumbs.html('');
      selection.map(function(attachment) {
        attachment = attachment.toJSON();

        // append img
        thumbs.append($('<div data-id="'+attachment.id+'" class="input-imgs__thumb"><img class="input-imgs__thumb-img" src="' + attachment.url + '" /><div class="input-imgs__thumb-remove">X</div></div>'));

        // save id
        imgIds.push(attachment.id);
      });

      // set value
      input.val(imgIds.join(','));
    });

    // remove

    frame.open();
  });

  $('.input-imgs__thumb-remove').on('click', function (e) {
    var wrap = $(this).parents('.input-imgs');
    var input = wrap.find('.input-imgs__val');
    var img = $(this).parents('.input-imgs__thumb');
    var id = img.data('id').toString();

    var ids = input.val().split(',');
    ids.splice(ids.indexOf(id), 1);

    input.val(ids.join(','));
    img.remove();
  });
});
