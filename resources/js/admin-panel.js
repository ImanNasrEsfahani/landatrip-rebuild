

import "../scss/admin-panel.scss";
console.log("salam admin panel js");

import "./admin-panel/App";

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
