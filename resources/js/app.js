/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import {dom, library} from '@fortawesome/fontawesome-svg-core'
import {faAddressCard, faChartBar, faClock, faEnvelope} from '@fortawesome/free-regular-svg-icons'
import {
    faBell,
    faCamera,
    faSearch,
    faShoppingBag,
    faSignOutAlt,
    faStoreAlt,
    faUser,
    faUsers,
    faYenSign
} from '@fortawesome/free-solid-svg-icons'

library.add(faSearch, faAddressCard, faStoreAlt, faShoppingBag, faSignOutAlt, faYenSign,
    faClock, faCamera, faBell, faUsers, faEnvelope, faChartBar, faUser);
dom.watch();

document.querySelector('.image-picker input')
    .addEventListener('change', (e) => {
        const input = e.target;
        const reader = new FileReader();
        reader.onload = (e) => {
            input.closest('.image-picker').querySelector('img').src = e.target.result
        };
        reader.readAsDataURL(input.files[0]);
    });
