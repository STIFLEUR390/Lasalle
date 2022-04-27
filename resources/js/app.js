require('./bootstrap');

import $ from 'jquery';
import 'admin-lte/plugins/jquery/jquery.min';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min';
import 'admin-lte/dist/js/adminlte';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.$ = window.jQuery = $;
window.$ = window.jQuery = require('jquery');

Alpine.start();
