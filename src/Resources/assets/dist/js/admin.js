(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
'use strict';

jQuery(document).ready(function ($) {
  $('.input-img .input-img__button').on('click', function (e) {
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

    frame.on('select', function () {
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

  $('.input-img .input-img__button--remove').on('click', function (e) {
    var wrap = $(this).parents('.input-img');
    var input = wrap.find('.input-img__val');
    var thumb = wrap.find('.input-img__thumb');

    wrap.removeClass('input-img--has-image');
    input.val('');
    thumb.html('');
  });
});

},{}]},{},[1]);
