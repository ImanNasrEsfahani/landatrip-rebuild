import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import $ from "jquery";

import "../scss/agent-panel.scss";

console.log("salam agent panel js");


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

import './agent-panel/App.jsx'

