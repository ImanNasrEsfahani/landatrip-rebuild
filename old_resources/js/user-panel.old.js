import "bootstrap";
import $ from "jquery";

import "../scss/user-panel.scss";

console.log("salam panel js");

$(function () {$('.accordion-button, .menu-item').tooltip('toggleEnabled');});
$(function () { $('.accordion-button, .menu-item, .nav-link').tooltip('hide');});

$(document).ready(function () {
    console.log("menu");
    $('#sidebarCollapse').on('click', function () {
        console.log("navbar clicked");
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
        $('#sidebar-header').toggleClass('active');
        $('.accordion-button, .menu-item').tooltip('toggleEnabled');
    });

    $('.more-button,.body-overlay').on('click', function () {
        console.log("show navbar clicked");
        $('#sidebar,.body-overlay').toggleClass('show-nav');
    });

});

import './user-panel/App.jsx'

