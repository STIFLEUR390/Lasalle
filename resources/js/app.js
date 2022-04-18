require('./bootstrap');

import $ from 'jquery';
import 'admin-lte/plugins/jquery/jquery.min';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min';
// import bootbox from 'bootbox/bootbox';
// import 'bootbox/bootbox.locales'
import 'admin-lte/dist/js/adminlte';

import Swal from 'sweetalert2/dist/sweetalert2'

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.$ = window.jQuery = $;
window.Swal = Swal;
// window.bootbox = bootbox;
// window.$ = window.jQuery = require('jquery');

Alpine.start();
