import 'bootstrap/scss/bootstrap.scss';
import 'animate.css/animate.css';
import 'simple-line-icons/scss/simple-line-icons.scss';
import 'owl.carousel/src/scss/owl.carousel.scss';
import 'owl.carousel/src/scss/owl.theme.default.scss';
import 'magnific-popup/src/css/main.scss';
import '../porto/front/sass/theme.scss';
import '../porto/front/sass/theme-blog.scss';
import '../porto/front/sass/theme-elements.scss';
import '../porto/front/sass/theme-shop.scss';
import '../porto/front/sass/demos/demo-medical.scss';
import '../porto/front/css/skins/skin-medical.css';
import '@icon/linea-arrows/linea-arrows.css';
import '@icon/linea-basic/linea-basic.css';
import '@icon/linea-basic-elaboration/linea-basic-elaboration.css';
import '@icon/linea-ecommerce/linea-ecommerce.css';
import '@icon/linea-music/linea-music.css';
import '@icon/linea-software/linea-software.css';
import '@icon/linea-weather/linea-weather.css';
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';


import $ from 'jquery';

import 'jquery.appear';
import 'jquery.easing';
import 'jquery.cookie';
import 'popper.js';
import 'bootstrap';
import '../porto/front/vendor/common/common';
import 'jquery-validation';
import 'jquery-gmap';
import 'jquery-lazyload';
import 'isotope-layout';
import 'owl.carousel';
import 'magnific-popup';
import 'vide';
import '@fortawesome/fontawesome-free';

import 'owl.carousel';

import '../porto/front/js/theme';
import '../porto/front/js/theme.init';

const imagesPorto = require.context('../porto/front/', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesPorto.keys().forEach(imagesPorto);

const imagesApp = require.context('../img/', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesApp.keys().forEach(imagesApp);

