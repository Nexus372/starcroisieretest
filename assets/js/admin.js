import 'bootstrap/scss/bootstrap.scss';
import 'animate.css/animate.css';
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import 'govicons/scss/govicons.scss';
import 'magnific-popup/src/css/main.scss';
import 'jquery-ui/themes/base/all.css';

import '../porto/admin/vendor/pnotify/pnotify.custom';
import '../porto/admin/vendor/pnotify/pnotify.custom.css'

import '../porto/admin/vendor/bootstrap-fileupload/bootstrap-fileupload.min';
import '../porto/admin/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css';

import '../porto/admin/css/sass/theme.scss';
import '../porto/admin/css/skins/default.css';

import $ from 'jquery';
import 'jquery-ui';
import 'jquery.appear';
import 'jquery.easing';
import 'bootstrap';
import nanoScroller from 'nanoscroller';
import 'jquery.browser';
import '../porto/admin/js/theme';
import '../porto/admin/js/theme.init';

import 'select2/dist/css/select2.css';
import 'select2-bootstrap-theme/dist/select2-bootstrap.css';
import 'select2/dist/js/select2.full';

import 'summernote/dist/summernote-bs4.css';
import summernote from 'summernote/dist/summernote-bs4';
import 'summernote/dist/lang/summernote-fr-FR';

import 'bootstrap-datepicker/dist/css/bootstrap-datepicker3.css';
import 'bootstrap-datepicker';

import '../porto/admin/vendor/fuelux/css/spinner.css';
import '../porto/admin/vendor/fuelux/js/spinner';

import 'magnific-popup';
import 'magnific-popup/src/css/main.scss';

import 'bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css';

import '../css/admin.css';

function loadSummernote() {
    $('.summernote').summernote({
        lang: 'fr-FR',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['table'],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
        height: $('.summernote').data('height')
    });

    $('.summernote').each(function (index, value) {
        if ($(value).summernote("isEmpty")) {
            $(value).summernote("code", "");
        }
    });
}

$(document).ready(function() {
    var notifyType = {
        success: 'Succès',
        notice: 'Infos'
    };
    $('.notify').each(function() {
        new PNotify({
            title: notifyType[$(this).data('type')],
            text: $(this).html(),
            type: $(this).data('type')
        });
    });

    $('.modal-delete-row').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-slide-bottom',
        callbacks: {
            open: function() {
                var href = this.currItem.el.data('href');
                this.currItem.inlineElement.find('.modal-confirm').click(function() {
                    window.location.href = href;
                });
            }
        }
    });

    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

    $('button[type=link]').click(function () {
        if ($(this).attr('href')) {
            window.location.href = $(this).attr('href');
        }
    });

    $('button[type=submit]').click(function() {
        var formElement = 'form[name=' + $(this).data('form-name') + ']';
        $(formElement).submit();
    });

    loadSummernote();
});