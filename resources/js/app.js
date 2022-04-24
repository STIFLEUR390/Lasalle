require('./bootstrap');

import $ from 'jquery';
import 'admin-lte/plugins/jquery/jquery.min';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min';
import 'admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min';
import 'admin-lte/dist/js/adminlte';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.$ = window.jQuery = $;
window.$ = window.jQuery = require('jquery');

$(function () {
    bsCustomFileInput.init();
});

Alpine.start();
