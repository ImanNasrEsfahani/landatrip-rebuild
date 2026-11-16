

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import "../scss/admin-panel.scss";
console.log("salam admin panel js");

import "./admin-panel/App";


$(document).ready(function () {
    console.log("menu");
    $('#sidebarCollapse').on('click', function () {
        console.log("navbar clicked");
        $('#sidebar').toggleClass('active');
        $('#content').toggleClass('active');
        $('#sidebar-header').toggleClass('active');
    });

    $('.more-button,.body-overlay').on('click', function () {
        console.log("show navbar clicked");
        $('#sidebar,.body-overlay').toggleClass('show-nav');
    });

});
