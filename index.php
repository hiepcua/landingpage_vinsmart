<?php
ob_start();
session_start();
ini_set('display_errors',1);
define('incl_path','global/libs/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinit.php');
require_once(incl_path.'gffunc.php');
require_once(libs_path.'cls.mysql.php');
define('ISHOME',true);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Vinhomes Smart City Tây Mỗ - Đại Mỗ - Website bán hàng CĐT</title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <meta name="keywords" content="vinhome smart city, căn hộ vinhome " />
    <meta name="description" content="Vinhomes Smart City Tây Mỗ - Đại Mỗ - Website bán hàng CĐT" />
    <script id="script_viewport" type="text/javascript">
        window.ladi_viewport = function () {
            var width = window.outerWidth > 0 ? window.outerWidth : window.screen.width;
            var widthDevice = width;
            var is_desktop = width >= 768;
            var content = "";
            if (typeof window.ladi_is_desktop == "undefined" || window.ladi_is_desktop == undefined) {
                window.ladi_is_desktop = is_desktop;
            }
            if (!is_desktop) {
                widthDevice = 420;
            } else {
                widthDevice = 1200;
            }
            content = "width=" + widthDevice + ", user-scalable=no";
            var scale = 1;
            if (!is_desktop && widthDevice != window.screen.width && window.screen.width > 0) {
                scale = window.screen.width / widthDevice;
            }
            if (scale != 1) {
                content += ", initial-scale=" + scale + ", minimum-scale=" + scale + ", maximum-scale=" + scale;
            }
            var docViewport = document.getElementById("viewport");
            if (!docViewport) {
                docViewport = document.createElement("meta");
                docViewport.setAttribute("id", "viewport");
                docViewport.setAttribute("name", "viewport");
                document.head.appendChild(docViewport);
            }
            docViewport.setAttribute("content", content);
        };
        window.ladi_viewport();
    </script>
    <meta property="og:url" content="https://vinhomesmartcity.net.vn/ladi01/" />
    <meta property="og:title" content="Vinhomes Smart City Tây Mỗ - Đại Mỗ - Website bán hàng CĐT" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="images/chung-cu-vinhomes-smart-city-1-20210311053929.jpg" />
    <meta property="og:description" content="Vinhomes Smart City Tây Mỗ - Đại Mỗ - Website bán hàng CĐT" />
    <meta name="format-detection" content="telephone=no" />
    <link rel="shortcut icon" type="image/png" href="images/67636786-676489972778636-1602658572531924992-n-20210312142327.png" />
    <link rel="dns-prefetch" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin />
    <link
    rel="preload"
    href="https://fonts.googleapis.com/css?family=Roboto Slab:bold,regular|Quicksand:bold,regular|Oswald:bold,regular|Open Sans:bold,regular|Roboto:bold,regular|Itim:bold,regular&display=swap"
    as="style"
    onload="this.onload = null;this.rel = 'stylesheet';"
    />
    <link rel="preload" href="js/ladipage.vi.min.js" as="script" />
    <style id="style_ladi" type="text/css">
        a,
        abbr,
        acronym,
        address,
        applet,
        article,
        aside,
        audio,
        b,
        big,
        blockquote,
        body,
        button,
        canvas,
        caption,
        center,
        cite,
        code,
        dd,
        del,
        details,
        dfn,
        div,
        dl,
        dt,
        em,
        embed,
        fieldset,
        figcaption,
        figure,
        footer,
        form,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        header,
        hgroup,
        html,
        i,
        iframe,
        img,
        input,
        ins,
        kbd,
        label,
        legend,
        li,
        mark,
        menu,
        nav,
        object,
        ol,
        output,
        p,
        pre,
        q,
        ruby,
        s,
        samp,
        section,
        select,
        small,
        span,
        strike,
        strong,
        sub,
        summary,
        sup,
        table,
        tbody,
        td,
        textarea,
        tfoot,
        th,
        thead,
        time,
        tr,
        tt,
        u,
        ul,
        var,
        video {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }
        body {
            line-height: 1;
        }
        a {
            text-decoration: none;
        }
        ol,
        ul {
            list-style: none;
        }
        blockquote,
        q {
            quotes: none;
        }
        blockquote:after,
        blockquote:before,
        q:after,
        q:before {
            content: "";
            content: none;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
        body {
            font-size: 12px;
            -ms-text-size-adjust: none;
            -moz-text-size-adjust: none;
            -o-text-size-adjust: none;
            -webkit-text-size-adjust: none;
            background: #fff;
        }
        .ladi-loading {
            width: 80px;
            height: 80px;
            z-index: 900000000000;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            margin: auto;
            overflow: hidden;
        }
        .ladi-loading div {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #fff;
            border-radius: 50%;
            animation: ladi-loading 1.2s linear infinite;
        }
        .ladi-loading div:nth-child(1) {
            animation-delay: 0s;
            top: 37px;
            left: 66px;
        }

        .ladi-loading div:nth-child(2) {
            animation-delay: -0.1s;
            top: 22px;
            left: 62px;
        }
        .ladi-loading div:nth-child(3) {
            animation-delay: -0.2s;
            top: 11px;
            left: 52px;
        }
        .ladi-loading div:nth-child(4) {
            animation-delay: -0.3s;
            top: 7px;
            left: 37px;
        }
        .ladi-loading div:nth-child(5) {
            animation-delay: -0.4s;
            top: 11px;
            left: 22px;
        }
        .ladi-loading div:nth-child(6) {
            animation-delay: -0.5s;
            top: 22px;
            left: 11px;
        }
        .ladi-loading div:nth-child(7) {
            animation-delay: -0.6s;
            top: 37px;
            left: 7px;
        }
        .ladi-loading div:nth-child(8) {
            animation-delay: -0.7s;
            top: 52px;
            left: 11px;
        }
        .ladi-loading div:nth-child(9) {
            animation-delay: -0.8s;
            top: 62px;
            left: 22px;
        }
        .ladi-loading div:nth-child(10) {
            animation-delay: -0.9s;
            top: 66px;
            left: 37px;
        }
        .ladi-loading div:nth-child(11) {
            animation-delay: -1s;
            top: 62px;
            left: 52px;
        }
        .ladi-loading div:nth-child(12) {
            animation-delay: -1.1s;
            top: 52px;
            left: 62px;
        }
        @keyframes ladi-loading {
            0%,
            100%,
            20%,
            80% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.5);
            }
        }
        .overflow-hidden {
            overflow: hidden;
        }
        .ladi-transition {
            transition: all 150ms linear 0s;
        }
        .opacity-0 {
            opacity: 0;
        }
        .pointer-events-none {
            pointer-events: none;
        }
        .ladipage-message {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1000000000;
            background: rgba(0, 0, 0, 0.3);
        }
        .ladipage-message .ladipage-message-box {
            width: 400px;
            max-width: calc(100% - 50px);
            height: 160px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            background-color: #fff;
            position: fixed;
            top: calc(50% - 155px);
            left: 0;
            right: 0;
            margin: auto;
            border-radius: 10px;
        }
        .ladipage-message .ladipage-message-box h1 {
            background-color: rgba(6, 21, 40, 0.05);
            color: #000;
            padding: 12px 15px;
            font-weight: 600;
            font-size: 16px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .ladipage-message .ladipage-message-box .ladipage-message-text {
            font-size: 14px;
            padding: 0 20px;
            margin-top: 10px;
            line-height: 18px;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
        }
        .ladipage-message .ladipage-message-box .ladipage-message-close {
            display: block;
            position: absolute;
            right: 15px;
            bottom: 10px;
            margin: 0 auto;
            padding: 10px 0;
            border: none;
            width: 80px;
            text-transform: uppercase;
            text-align: center;
            color: #000;
            background-color: #e6e6e6;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .ladi-wraper {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #fff;
        }
        .ladi-section {
            margin: 0 auto;
            position: relative;
        }
        .ladi-section .ladi-section-arrow-down {
            position: absolute;
            width: 36px;
            height: 30px;
            bottom: 0;
            right: 0;
            left: 0;
            margin: auto;
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            background-position: 4px;
            cursor: pointer;
            z-index: 90000040;
        }
        .ladi-section.ladi-section-readmore {
            transition: height 350ms linear 0s;
        }
        .ladi-section .ladi-section-background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .ladi-container {
            position: relative;
            margin: 0 auto;
            height: 100%;
        }
        .ladi-element {
            position: absolute;
        }
        .ladi-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            pointer-events: none;
        }
        .ladi-carousel {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .ladi-carousel .ladi-carousel-content {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            transition: left 350ms ease-in-out;
        }
        .ladi-carousel .ladi-carousel-arrow {
            position: absolute;
            width: 30px;
            height: 36px;
            top: calc(50% - 18px);
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            cursor: pointer;
            z-index: 90000040;
        }
        .ladi-carousel .ladi-carousel-arrow-left {
            left: 5px;
            background-position: -28px;
        }
        .ladi-carousel .ladi-carousel-arrow-right {
            right: 5px;
            background-position: -52px;
        }
        .ladi-gallery {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-gallery .ladi-gallery-view {
            position: absolute;
            overflow: hidden;
        }
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            width: 100%;
            height: 100%;
            position: relative;
            display: none;
            transition: transform 0.5s ease-in-out;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-perspective: 1000px;
            perspective: 1000px;
        }
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.play-video {
            cursor: pointer;
        }
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.play-video:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 60px;
            height: 60px;
            background: url(images/ladipage-play.svg) no-repeat center center;
            background-size: contain;
            pointer-events: none;
            cursor: pointer;
        }
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.next,
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.selected.right {
            left: 0;
            transform: translate3d(100%, 0, 0);
        }
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.prev,
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.selected.left {
            left: 0;
            transform: translate3d(-100%, 0, 0);
        }
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.next.left,
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.prev.right,
        .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item.selected {
            left: 0;
            transform: translate3d(0, 0, 0);
        }
        .ladi-gallery .ladi-gallery-view > .next,
        .ladi-gallery .ladi-gallery-view > .prev,
        .ladi-gallery .ladi-gallery-view > .selected {
            display: block;
        }
        .ladi-gallery .ladi-gallery-view > .selected {
            left: 0;
        }
        .ladi-gallery .ladi-gallery-view > .next,
        .ladi-gallery .ladi-gallery-view > .prev {
            position: absolute;
            top: 0;
            width: 100%;
        }
        .ladi-gallery .ladi-gallery-view > .next {
            left: 100%;
        }
        .ladi-gallery .ladi-gallery-view > .prev {
            left: -100%;
        }
        .ladi-gallery .ladi-gallery-view > .next.left,
        .ladi-gallery .ladi-gallery-view > .prev.right {
            left: 0;
        }
        .ladi-gallery .ladi-gallery-view > .selected.left {
            left: -100%;
        }
        .ladi-gallery .ladi-gallery-view > .selected.right {
            left: 100%;
        }
        .ladi-gallery .ladi-gallery-control {
            position: absolute;
            overflow: hidden;
        }
        .ladi-gallery.ladi-gallery-top .ladi-gallery-view {
            width: 100%;
        }
        .ladi-gallery.ladi-gallery-top .ladi-gallery-control {
            top: 0;
            width: 100%;
        }
        .ladi-gallery.ladi-gallery-bottom .ladi-gallery-view {
            top: 0;
            width: 100%;
        }
        .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control {
            width: 100%;
            bottom: 0;
        }
        .ladi-gallery.ladi-gallery-left .ladi-gallery-view {
            height: 100%;
        }
        .ladi-gallery.ladi-gallery-left .ladi-gallery-control {
            height: 100%;
        }
        .ladi-gallery.ladi-gallery-right .ladi-gallery-view {
            height: 100%;
        }
        .ladi-gallery.ladi-gallery-right .ladi-gallery-control {
            height: 100%;
            right: 0;
        }
        .ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow {
            position: absolute;
            width: 30px;
            height: 36px;
            top: calc(50% - 18px);
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            cursor: pointer;
            z-index: 90000040;
        }
        .ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow-left {
            left: 5px;
            background-position: -28px;
        }
        .ladi-gallery .ladi-gallery-view .ladi-gallery-view-arrow-right {
            right: 5px;
            background-position: -52px;
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-arrow {
            position: absolute;
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            cursor: pointer;
            z-index: 90000040;
        }
        .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow,
        .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow {
            top: calc(50% - 18px);
            width: 30px;
            height: 36px;
        }
        .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow-left {
            left: 0;
            background-position: -28px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-arrow-right {
            right: 0;
            background-position: -52px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow-left {
            left: 0;
            background-position: -28px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-arrow-right {
            right: 0;
            background-position: -52px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow,
        .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow {
            left: calc(50% - 18px);
            width: 36px;
            height: 30px;
        }
        .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow-left {
            top: 0;
            background-position: -77px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-arrow-right {
            bottom: 0;
            background-position: 3px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow-left {
            top: 0;
            background-position: -77px;
            transform: scale(0.6);
        }
        .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-arrow-right {
            bottom: 0;
            background-position: 3px;
            transform: scale(0.6);
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box {
            position: relative;
        }
        .ladi-gallery.ladi-gallery-top .ladi-gallery-control .ladi-gallery-control-box {
            display: inline-flex;
            left: 0;
            transition: left 150ms ease-in-out;
        }
        .ladi-gallery.ladi-gallery-bottom .ladi-gallery-control .ladi-gallery-control-box {
            display: inline-flex;
            left: 0;
            transition: left 150ms ease-in-out;
        }
        .ladi-gallery.ladi-gallery-left .ladi-gallery-control .ladi-gallery-control-box {
            display: inline-grid;
            top: 0;
            transition: top 150ms ease-in-out;
        }
        .ladi-gallery.ladi-gallery-right .ladi-gallery-control .ladi-gallery-control-box {
            display: inline-grid;
            top: 0;
            transition: top 150ms ease-in-out;
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            float: left;
            position: relative;
            cursor: pointer;
            filter: invert(15%);
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item.play-video:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 30px;
            height: 30px;
            background: url(images/ladipage-play.svg) no-repeat center center;
            background-size: contain;
            pointer-events: none;
            cursor: pointer;
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item:hover {
            filter: none;
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item.selected {
            filter: none;
        }
        .ladi-gallery .ladi-gallery-control .ladi-gallery-control-box .ladi-gallery-control-item:last-child {
            margin-right: 0 !important;
            margin-bottom: 0 !important;
        }
        .ladi-table {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: auto;
        }
        .ladi-table table {
            width: 100%;
        }
        .ladi-table table td {
            vertical-align: middle;
        }
        .ladi-table tbody td {
            word-break: break-word;
        }
        .ladi-table table td img {
            cursor: pointer;
            width: 100%;
        }
        .ladi-box {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .ladi-frame {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .ladi-frame .ladi-frame-background {
            height: 100%;
            width: 100%;
            pointer-events: none;
        }
        .ladi-banner {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .ladi-banner .ladi-banner-background {
            height: 100%;
            width: 100%;
            pointer-events: none;
        }
        #SECTION_POPUP .ladi-container {
            z-index: 90000070;
        }
        #SECTION_POPUP .ladi-container > .ladi-element {
            z-index: 90000070;
            position: fixed;
            display: none;
        }
        #SECTION_POPUP .ladi-container > .ladi-element.hide-visibility {
            display: block !important;
            visibility: hidden !important;
        }
        #SECTION_POPUP .popup-close {
            width: 30px;
            height: 30px;
            position: absolute;
            right: 0;
            top: 0;
            transform: scale(0.8);
            -webkit-transform: scale(0.8);
            z-index: 9000000080;
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            background-position: -108px;
            cursor: pointer;
            display: none;
        }
        .ladi-popup {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-popup .ladi-popup-background {
            height: 100%;
            width: 100%;
            pointer-events: none;
        }
        .ladi-countdown {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-countdown .ladi-countdown-background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
            display: table;
            pointer-events: none;
        }
        .ladi-countdown .ladi-countdown-text {
            position: absolute;
            width: 100%;
            height: 100%;
            text-decoration: inherit;
            display: table;
            pointer-events: none;
        }
        .ladi-countdown .ladi-countdown-text span {
            display: table-cell;
            vertical-align: middle;
        }
        .ladi-countdown > .ladi-element {
            text-decoration: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
            position: relative;
            display: inline-block;
        }
        .ladi-countdown > .ladi-element:last-child {
            margin-right: 0 !important;
        }
        .ladi-button {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .ladi-button:active {
            transform: translateY(2px);
            transition: transform 0.2s linear;
        }
        .ladi-button .ladi-button-background {
            height: 100%;
            width: 100%;
            pointer-events: none;
        }
        .ladi-button > .ladi-element {
            width: 100% !important;
            height: 100% !important;
            top: 0 !important;
            left: 0 !important;
            display: table;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .ladi-button > .ladi-element .ladi-headline {
            display: table-cell;
            vertical-align: middle;
        }
        .ladi-collection {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-collection.carousel {
            overflow: hidden;
        }
        .ladi-collection .ladi-collection-content {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            transition: left 350ms ease-in-out;
        }
        .ladi-collection .ladi-collection-content .ladi-collection-item {
            display: block;
            position: relative;
            float: left;
            box-shadow: 0 0 0 1px #fff;
        }
        .ladi-collection .ladi-collection-content .ladi-collection-page {
            float: left;
        }
        .ladi-collection .ladi-collection-arrow {
            position: absolute;
            width: 30px;
            height: 36px;
            top: calc(50% - 18px);
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            cursor: pointer;
            z-index: 90000040;
        }
        .ladi-collection .ladi-collection-arrow-left {
            left: 5px;
            background-position: -28px;
        }
        .ladi-collection .ladi-collection-arrow-right {
            right: 5px;
            background-position: -52px;
        }
        .ladi-collection .ladi-collection-button-next {
            position: absolute;
            width: 36px;
            height: 30px;
            bottom: -40px;
            right: 0;
            left: 0;
            margin: auto;
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            background-position: 4px;
            cursor: pointer;
            z-index: 90000040;
        }
        .ladi-form {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-form > .ladi-element {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form .ladi-button > .ladi-element {
            color: initial;
            font-size: initial;
            font-weight: initial;
            text-transform: initial;
            text-decoration: initial;
            font-style: initial;
            text-align: initial;
            letter-spacing: initial;
            line-height: initial;
        }
        .ladi-form > .ladi-element .ladi-form-item-container {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item-background {
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-size: 9px 6px !important;
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select-3 {
            width: calc(100% / 3 - 5px);
            max-width: calc(100% / 3 - 5px);
            min-width: calc(100% / 3 - 5px);
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select-3:nth-child(3) {
            margin-left: 7.5px;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select-3:nth-child(4) {
            margin-left: 7.5px;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select option {
            color: initial;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control:not(.ladi-form-control-select) {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select:not([data-selected=""]) {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-control-select[data-selected=""] {
            text-transform: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
            vertical-align: middle;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item span {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item span[data-checked="true"] {
            text-transform: inherit;
            text-decoration: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form > .ladi-element .ladi-form-item-container .ladi-form-item .ladi-form-checkbox-item span[data-checked="false"] {
            text-transform: inherit;
            text-align: inherit;
            letter-spacing: inherit;
            color: inherit;
            background-size: inherit;
            background-attachment: inherit;
            background-origin: inherit;
        }
        .ladi-form .ladi-form-item-container {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-form .ladi-form-item {
            width: 100%;
            height: 100%;
            position: absolute;
        }
        .ladi-form .ladi-form-item-background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox {
            height: auto;
        }
        .ladi-form .ladi-form-item .ladi-form-control {
            background-color: transparent;
            min-width: 100%;
            min-height: 100%;
            max-width: 100%;
            max-height: 100%;
            width: 100%;
            height: 100%;
            padding: 0 5px;
            color: inherit;
            font-size: inherit;
            border: none;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox {
            padding: 10px 5px;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-vertical .ladi-form-checkbox-item {
            margin-top: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            display: table;
            border: none;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-horizontal .ladi-form-checkbox-item {
            margin-top: 0 !important;
            margin-left: 0 !important;
            margin-right: 10px !important;
            display: inline-block;
            border: none;
            position: relative;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item input {
            vertical-align: middle;
            width: 13px;
            height: 13px;
            display: table-cell;
            margin-right: 5px;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span {
            display: table-cell;
            cursor: default;
            vertical-align: middle;
            word-break: break-word;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-horizontal .ladi-form-checkbox-item input {
            position: absolute;
            top: 4px;
        }
        .ladi-form .ladi-form-item.ladi-form-checkbox.ladi-form-checkbox-horizontal .ladi-form-checkbox-item span {
            padding-left: 18px;
        }
        .ladi-form .ladi-form-item textarea.ladi-form-control {
            resize: none;
            padding: 5px;
        }
        .ladi-form .ladi-button {
            cursor: pointer;
        }
        .ladi-form .ladi-button .ladi-headline {
            cursor: pointer;
            user-select: none;
        }
        .ladi-cart {
            position: absolute;
            width: 100%;
            font-size: 12px;
        }
        .ladi-cart .ladi-cart-row {
            position: relative;
            display: inline-table;
            width: 100%;
        }
        .ladi-cart .ladi-cart-row:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 1px;
            width: 100%;
            background: #dcdcdc;
        }
        .ladi-cart .ladi-cart-no-product {
            text-align: center;
            font-size: 16px;
            vertical-align: middle;
        }
        .ladi-cart .ladi-cart-image {
            width: 16%;
            vertical-align: middle;
            position: relative;
            text-align: center;
        }
        .ladi-cart .ladi-cart-image img {
            max-width: 100%;
        }
        .ladi-cart .ladi-cart-title {
            vertical-align: middle;
            padding: 0 5px;
            word-break: break-all;
        }
        .ladi-cart .ladi-cart-title .ladi-cart-title-name {
            display: block;
            margin-bottom: 5px;
        }
        .ladi-cart .ladi-cart-title .ladi-cart-title-variant {
            font-weight: 700;
            display: block;
        }
        .ladi-cart .ladi-cart-image .ladi-cart-image-quantity {
            position: absolute;
            top: -3px;
            right: -5px;
            background: rgba(150, 149, 149, 0.9);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            text-align: center;
            color: #fff;
            line-height: 20px;
        }
        .ladi-cart .ladi-cart-quantity {
            width: 70px;
            vertical-align: middle;
            text-align: center;
        }
        .ladi-cart .ladi-cart-quantity-content {
            display: inline-flex;
        }
        .ladi-cart .ladi-cart-quantity input {
            width: 24px;
            text-align: center;
            height: 22px;
            -moz-appearance: textfield;
            border-top: 1px solid #dcdcdc;
            border-bottom: 1px solid #dcdcdc;
        }
        .ladi-cart .ladi-cart-quantity input::-webkit-inner-spin-button,
        .ladi-cart .ladi-cart-quantity input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .ladi-cart .ladi-cart-quantity button {
            border: 1px solid #dcdcdc;
            cursor: pointer;
            text-align: center;
            width: 21px;
            height: 22px;
            position: relative;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .ladi-cart .ladi-cart-quantity button:active {
            transform: translateY(2px);
            transition: transform 0.2s linear;
        }
        .ladi-cart .ladi-cart-quantity button span {
            font-size: 18px;
            position: relative;
            left: 0.5px;
        }
        .ladi-cart .ladi-cart-quantity button:first-child span {
            top: -1.2px;
        }
        .ladi-cart .ladi-cart-price {
            width: 100px;
            vertical-align: middle;
            text-align: right;
            padding: 0 5px;
        }
        .ladi-cart .ladi-cart-action {
            width: 28px;
            vertical-align: middle;
            text-align: center;
        }
        .ladi-cart .ladi-cart-action button {
            border: 1px solid #dcdcdc;
            cursor: pointer;
            text-align: center;
            width: 25px;
            height: 22px;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        .ladi-cart .ladi-cart-action button:active {
            transform: translateY(2px);
            transition: transform 0.2s linear;
        }
        .ladi-cart .ladi-cart-action button span {
            font-size: 13px;
            position: relative;
            top: 0.5px;
        }
        .ladi-video {
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
            overflow: hidden;
        }
        .ladi-video .ladi-video-background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        .ladi-group {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-button-group {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-checkout {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-shape {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        .ladi-html-code {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .ladi-image {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        .ladi-image .ladi-image-background {
            background-repeat: no-repeat;
            background-position: left top;
            background-size: cover;
            background-attachment: scroll;
            background-origin: content-box;
            position: absolute;
            margin: 0 auto;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        .ladi-headline {
            width: 100%;
            display: inline-block;
            background-size: cover;
            background-position: center center;
        }
        .ladi-headline a {
            text-decoration: underline;
        }
        .ladi-paragraph {
            width: 100%;
            display: inline-block;
        }
        .ladi-paragraph a {
            text-decoration: underline;
        }
        .ladi-list-paragraph {
            width: 100%;
            display: inline-block;
        }
        .ladi-list-paragraph a {
            text-decoration: underline;
        }
        .ladi-list-paragraph ul li {
            position: relative;
            counter-increment: linum;
        }
        .ladi-list-paragraph ul li:before {
            position: absolute;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            left: 0;
        }
        .ladi-list-paragraph ul li:last-child {
            padding-bottom: 0 !important;
        }
        .ladi-line {
            position: relative;
        }
        .ladi-line .ladi-line-container {
            border-bottom: 0 !important;
            border-right: 0 !important;
            width: 100%;
            height: 100%;
        }
        a[data-action] {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            cursor: pointer;
        }
        a:visited {
            color: inherit;
        }
        a:link {
            color: inherit;
        }
        [data-opacity="0"] {
            opacity: 0;
        }
        [data-hidden="true"] {
            display: none;
        }
        [data-action="true"] {
            cursor: pointer;
        }
        .ladi-hidden {
            display: none;
        }
        .backdrop-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 90000060;
        }
        .lightbox-screen {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            margin: auto;
            z-index: 9000000080;
            background: rgba(0, 0, 0, 0.5);
        }
        .lightbox-screen .lightbox-close {
            width: 30px;
            height: 30px;
            position: absolute;
            z-index: 9000000090;
            background: url(images/ladi-icons.svg) rgba(255, 255, 255, 0.2) no-repeat;
            background-position: -108px;
            transform: scale(0.7);
            -webkit-transform: scale(0.7);
            cursor: pointer;
        }
        .lightbox-screen .lightbox-hidden {
            display: none;
        }
        .ladi-animation-hidden {
            visibility: hidden !important;
        }
        .ladi-lazyload {
            background-image: none !important;
        }
        .ladi-list-paragraph ul li.ladi-lazyload:before {
            background-image: none !important;
        }
        @media (min-width: 768px) {
            .ladi-fullwidth {
                width: 100vw !important;
                left: calc(-50vw + 50%) !important;
                box-sizing: border-box !important;
                transform: none !important;
            }
            .ladi-fullwidth .ladi-gallery-view-item {
                transition-duration: 1.5s;
            }
        }
        @media (max-width: 767px) {
            .ladi-element.ladi-auto-scroll {
                overflow-x: scroll;
                overflow-y: hidden;
                width: 100% !important;
                left: 0 !important;
                -webkit-overflow-scrolling: touch;
            }
            .ladi-section.ladi-auto-scroll {
                overflow-x: scroll;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
            }
            .ladi-carousel .ladi-carousel-content {
                transition: left 0.3s ease-in-out;
            }
            .ladi-gallery .ladi-gallery-view > .ladi-gallery-view-item {
                transition: transform 0.3s ease-in-out;
            }
        }
        .ladi-notify-transition {
            transition: top 0.5s ease-in-out, bottom 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }
        .ladi-notify {
            padding: 5px;
            box-shadow: 0 0 1px rgba(64, 64, 64, 0.3), 0 8px 50px rgba(64, 64, 64, 0.05);
            border-radius: 40px;
            color: rgba(64, 64, 64, 1);
            background: rgba(250, 250, 250, 0.9);
            line-height: 1.6;
            width: 100%;
            height: 100%;
            font-size: 13px;
        }
        .ladi-notify .ladi-notify-image img {
            float: left;
            margin-right: 13px;
            border-radius: 50%;
            width: 53px;
            height: 53px;
            pointer-events: none;
        }
        .ladi-notify .ladi-notify-title {
            font-size: 100%;
            height: 17px;
            overflow: hidden;
            font-weight: 700;
            overflow-wrap: break-word;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1;
        }
        .ladi-notify .ladi-notify-content {
            font-size: 92.308%;
            height: 17px;
            overflow: hidden;
            overflow-wrap: break-word;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1;
            padding-top: 2px;
        }
        .ladi-notify .ladi-notify-time {
            line-height: 1.6;
            font-size: 84.615%;
            display: inline-block;
            overflow-wrap: break-word;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: calc(100% - 155px);
            overflow: hidden;
        }
        .ladi-notify .ladi-notify-copyright {
            font-size: 76.9231%;
            margin-left: 2px;
            position: relative;
            padding: 0 5px;
            cursor: pointer;
            opacity: 0.6;
            display: inline-block;
            top: -4px;
        }
        .ladi-notify .ladi-notify-copyright svg {
            vertical-align: middle;
        }
        .ladi-notify .ladi-notify-copyright svg:not(:root) {
            overflow: hidden;
        }
        .ladi-notify .ladi-notify-copyright div {
            text-decoration: none;
            color: rgba(64, 64, 64, 1);
            display: inline;
        }
        .ladi-notify .ladi-notify-copyright strong {
            font-weight: 700;
        }
        .builder-container .ladi-notify {
            transition: unset;
        }
        .ladi-spin-lucky {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            box-shadow: 0 0 7px 0 rgba(64, 64, 64, 0.6), 0 8px 50px rgba(64, 64, 64, 0.3);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .ladi-spin-lucky .ladi-spin-lucky-start {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 20%;
            height: 20%;
            cursor: pointer;
            background-size: contain;
            background-position: center center;
            background-repeat: no-repeat;
            transition: transform 0.3s ease-in-out;
            -webkit-transition: transform 0.3s ease-in-out;
        }
        .ladi-spin-lucky .ladi-spin-lucky-start:hover {
            transform: scale(1.1);
        }
        .ladi-spin-lucky .ladi-spin-lucky-screen {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            transition: transform 7s cubic-bezier(0.25, 0.1, 0, 1);
            -webkit-transition: transform 7s cubic-bezier(0.25, 0.1, 0, 1);
            text-decoration-line: inherit;
            text-transform: inherit;
            -webkit-text-decoration-line: inherit;
        }
        .ladi-spin-lucky .ladi-spin-lucky-screen:before {
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }
        .ladi-spin-lucky .ladi-spin-lucky-label {
            position: absolute;
            top: 50%;
            left: 50%;
            overflow: hidden;
            width: 42%;
            padding-left: 12%;
            transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
            text-decoration-line: inherit;
            text-transform: inherit;
            -webkit-text-decoration-line: inherit;
            line-height: 1.6;
            text-shadow: rgba(0, 0, 0, 0.5) 1px 0 2px;
        }
    </style>
    <style id="style_page" type="text/css">
        @media (min-width: 768px) {
            .ladi-section .ladi-container {
                width: 1200px;
            }
        }
        @media (max-width: 767px) {
            .ladi-section .ladi-container {
                width: 420px;
            }
        }
        body {
            font-family: "Roboto Slab", serif;
        }
    </style>
    <style id="style_element" type="text/css">
        @media (min-width: 768px) {
            #SECTION_POPUP {
                height: 0px;
            }
            #SECTION1 {
                height: 81px;
                top: 1px;
                left: 0px;
                width: 100%;
                position: fixed;
                z-index: 90000050;
            }
            #SECTION1 > .ladi-section-background {
                background: rgba(79, 159, 202, 1);
                background: -webkit-linear-gradient(180deg, rgba(79, 159, 202, 1), rgba(45, 144, 49, 1));
                background: linear-gradient(180deg, rgba(79, 159, 202, 1), rgba(45, 144, 49, 1));
                opacity: 0.95;
            }
            #SECTION3 {
                height: 708.3px;
            }
            #SECTION3 > .ladi-section-background {
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #HEADLINE28 {
                width: 96px;
                top: 27px;
                left: 57.985px;
            }
            #HEADLINE28 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: left;
                line-height: 1.2;
            }
            #HEADLINE30 {
                width: 83px;
                top: 27px;
                left: 208.645px;
            }
            #HEADLINE30 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #HEADLINE31 {
                width: 75px;
                top: 27px;
                left: 739.038px;
            }
            #HEADLINE31 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: center;
                line-height: 1.2;
            }
            #BUTTON_TEXT33 {
                width: 168px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT33 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 19px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON33 {
                width: 170.373px;
                height: 40px;
                top: 0px;
                left: 0px;
            }
            #BUTTON33 > .ladi-button > .ladi-button-background {
                background-color: rgba(255, 255, 255, 0);
            }
            #BUTTON33 > .ladi-button {
                border-style: solid;
                border-color: rgb(244, 221, 156);
                border-width: 1px;
                border-radius: 10px;
            }
            #SHAPE35 {
                width: 25.5705px;
                height: 28.5px;
                top: 8.25px;
                left: 10.58px;
            }
            #SHAPE35 svg:last-child {
                fill: rgba(239, 241, 4, 1);
            }
            #HEADLINE36 {
                width: 531px;
                top: 34.666px;
                left: 49px;
            }
            #HEADLINE36 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(203, 1, 1);
                font-size: 26px;
                text-align: center;
                line-height: 1.2;
            }
            #SECTION50 {
                height: 777.6px;
            }
            #SECTION50 > .ladi-section-background {
                background-size: cover;
                background-attachment: fixed;
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #SECTION84 {
                height: 646.3px;
            }
            #IMAGE115 {
                width: 827px;
                height: 522.104px;
                top: 62.098px;
                left: 0px;
            }
            #IMAGE115 > .ladi-image > .ladi-image-background {
                width: 868.704px;
                height: 630.715px;
                top: -97.9997px;
                left: -37.7036px;
                background-image: url("images/artboard-8-1-20210311081032.png");
            }
            #IMAGE115 > .ladi-image {
                border-style: dashed;
                border-color: rgb(29, 48, 67);
                border-width: 1px;
            }
            #IMAGE115.ladi-animation > .ladi-image {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #HEADLINE116 {
                width: 338px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE116 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #PARAGRAPH117 {
                width: 348px;
                top: 84.552px;
                left: 0px;
            }
            #PARAGRAPH117 > .ladi-paragraph {
                color: rgb(0, 0, 0);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #SECTION159 {
                height: 507.966px;
            }
            #SECTION159 > .ladi-section-background {
                background-size: cover;
                background-attachment: fixed;
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #SECTION161 {
                height: 411.3px;
            }
            #SECTION161 > .ladi-overlay {
                background-color: rgb(10, 54, 67);
                opacity: 0.96;
            }
            #SECTION161 > .ladi-section-background {
                background-color: rgb(29, 48, 67);
            }
            #HEADLINE266 {
                width: 584px;
                top: 52px;
                left: 0px;
            }
            #HEADLINE266 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #HEADLINE267 {
                width: 584px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE267 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(204, 1, 1);
                font-size: 44px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #HEADLINE280 {
                width: 681px;
                top: 32.49px;
                left: 259.5px;
            }
            #HEADLINE280 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
                padding: 10px;
            }
            #HEADLINE284 {
                width: 510px;
                top: 112.4px;
                left: 345px;
            }
            #HEADLINE284 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                line-height: 1.2;
                padding: 10px;
            }
            #SECTION294 {
                height: 911.3px;
            }
            #SECTION294 > .ladi-section-background {
                background-size: cover;
                background-attachment: fixed;
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #LINE298 {
                height: 231px;
                top: 137px;
                left: 0px;
            }
            #LINE298 > .ladi-line > .ladi-line-container {
                border-top: 0px !important;
                border-right: 3px solid rgb(46, 150, 112);
                border-bottom: 3px solid rgb(46, 150, 112);
                border-left: 3px solid rgb(46, 150, 112);
            }
            #LINE298 > .ladi-line {
                height: 100%;
                padding: 0px 8px;
            }
            #BOX336 {
                width: 19.4px;
                height: 863.3px;
                top: 0px;
                left: 0px;
            }
            #BOX336 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE338 {
                width: 383px;
                top: 37px;
                left: 408.983px;
            }
            #HEADLINE338 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #IMAGE339 {
                width: 349.905px;
                height: 214.666px;
                top: 214.304px;
                left: 60px;
            }
            #IMAGE339 > .ladi-image > .ladi-image-background {
                width: 349.905px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_10-20200622074408-20210311141609.jpg");
            }
            #IMAGE339 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE339:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE354 {
                width: 349.905px;
                height: 214.666px;
                top: 214.304px;
                left: 425.048px;
            }
            #IMAGE354 > .ladi-image > .ladi-image-background {
                width: 349.905px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_3-20200622074408-20210311141609.jpg");
            }
            #IMAGE354 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE354:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE359 {
                width: 349.905px;
                height: 214.666px;
                top: 214.304px;
                left: 791.095px;
            }
            #IMAGE359 > .ladi-image > .ladi-image-background {
                width: 380.31px;
                height: 239.216px;
                top: 0px;
                left: -30.4053px;
                background-image: url("images/center_park_12-20200622074407-20210311141609.jpg");
            }
            #IMAGE359 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE359:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE364 {
                width: 349.905px;
                height: 214.666px;
                top: 443.304px;
                left: 60px;
            }
            #IMAGE364 > .ladi-image > .ladi-image-background {
                width: 349.905px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_36-20200622074413-20210311141609.jpg");
            }
            #IMAGE364 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE364:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE369 {
                width: 349.905px;
                height: 214.666px;
                top: 443.304px;
                left: 425.548px;
            }
            #IMAGE369 > .ladi-image > .ladi-image-background {
                width: 349.905px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_17-20200622074408-20210311141609.jpg");
            }
            #IMAGE369 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE369:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE374 {
                width: 349.905px;
                height: 214.666px;
                top: 443.304px;
                left: 791.095px;
            }
            #IMAGE374 > .ladi-image > .ladi-image-background {
                width: 349.905px;
                height: 226.909px;
                top: -12.2426px;
                left: 0px;
                background-image: url("images/center_park_15-20200622074408-20210311141610.jpg");
            }
            #IMAGE374 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE374:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #HEADLINE426 {
                width: 307px;
                top: 252.518px;
                left: 47.328px;
            }
            #HEADLINE426 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 14px;
                line-height: 1.6;
            }
            #HEADLINE429 {
                width: 421px;
                top: 510.037px;
                left: 68px;
            }
            #HEADLINE429 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 14px;
                text-align: center;
                line-height: 1.6;
            }
            #BOX430 {
                width: 557px;
                height: 609px;
                top: 0px;
                left: 0px;
            }
            #BOX430 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
            }
            #HEADLINE433 {
                width: 412px;
                top: 34.666px;
                left: 72.5px;
            }
            #HEADLINE433 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #POPUP437 {
                width: 504.386px;
                height: 432px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP437 > .ladi-popup > .ladi-popup-background {
                background-color: rgb(255, 255, 255);
            }
            #BOX454 {
                width: 504.914px;
                height: 456px;
                top: 0px;
                left: 0px;
            }
            #BOX454 > .ladi-box {
                background: rgba(237, 85, 0, 1);
                background: -webkit-linear-gradient(203deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                background: linear-gradient(203deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                border-style: dashed;
                border-color: rgb(0, 0, 0);
                border-width: 1px;
                border-radius: 5px;
            }
            #HEADLINE455 {
                width: 458px;
                top: 27.5137px;
                left: 26.6644px;
            }
            #HEADLINE455 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #FORM_ITEM462 {
                width: 434.997px;
                height: 46.7171px;
                top: 0px;
                left: 0px;
            }
            #BUTTON_TEXT463 {
                width: 435px;
                top: 11.8364px;
                left: 0px;
            }
            #BUTTON_TEXT463 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 18px;
                text-align: center;
                line-height: 2;
            }
            #BUTTON463 {
                width: 435.472px;
                height: 59.6384px;
                top: 288.507px;
                left: 0px;
            }
            #BUTTON463 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 6);
            }
            #BUTTON463 > .ladi-button {
                border-radius: 7px;
            }
            #FORM_ITEM465 {
                width: 435px;
                height: 117px;
                top: 160.258px;
                left: 0px;
            }
            #FORM_ITEM465 .ladi-form-checkbox-item {
                margin: 5px;
            }
            #FORM461 {
                width: 435.472px;
                height: 348.145px;
                top: 99.9909px;
                left: 38.5967px;
            }
            #FORM461 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM461 .ladi-form-item .ladi-form-control::placeholder,
            #FORM461 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM461 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM461 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM461 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM461 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #HEADLINE466 {
                width: 333px;
                top: 221.321px;
                left: 37.2602px;
            }
            #HEADLINE466 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 14px;
                line-height: 1.6;
            }
            #GROUP453 {
                width: 504.914px;
                height: 456px;
                top: -24px;
                left: -0.264px;
            }
            #FORM_ITEM489 {
                width: 343.863px;
                height: 43.6638px;
                top: 0px;
                left: 2.66063px;
            }
            #FORM_ITEM490 {
                width: 343.863px;
                height: 43.6638px;
                top: 51.6113px;
                left: 1.31369px;
            }
            #FORM_ITEM491 {
                width: 343.863px;
                height: 43.6638px;
                top: 103.223px;
                left: 0px;
            }
            #BUTTON_TEXT492 {
                width: 346px;
                top: 7.89104px;
                left: 0px;
            }
            #BUTTON_TEXT492 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #BUTTON492 {
                width: 345.891px;
                height: 52.607px;
                top: 164.379px;
                left: 0px;
            }
            #BUTTON492 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 7);
            }
            #BUTTON492 > .ladi-button {
                border-radius: 5px;
            }
            #FORM488 {
                width: 346.523px;
                height: 216.987px;
                top: 189.707px;
                left: 36.739px;
            }
            #FORM488 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM488 .ladi-form-item .ladi-form-control::placeholder,
            #FORM488 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM488 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM488 .ladi-form-item {
                padding-left: 8px;
                padding-right: 8px;
            }
            #FORM488 .ladi-form-item.ladi-form-checkbox {
                padding-left: 13px;
                padding-right: 13px;
            }
            #FORM488 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM488 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM488 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #HEADLINE499 {
                width: 301px;
                top: 113.5px;
                left: 59.5005px;
            }
            #HEADLINE499 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 23px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #POPUP487 {
                width: 420px;
                height: 442px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP487 > .ladi-popup > .ladi-overlay {
                border-radius: 4px;
            }
            #POPUP487 > .ladi-popup > .ladi-popup-background {
                background: rgba(237, 85, 0, 1);
                background: -webkit-linear-gradient(180deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                background: linear-gradient(180deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                border-radius: 4px;
            }
            #POPUP487 > .ladi-popup {
                border-style: dashed;
                border-color: rgb(0, 0, 0);
                border-width: 1px;
                border-radius: 5px;
            }
            #IMAGE579 {
                width: 238.933px;
                height: 49.0231px;
                top: 11.9884px;
                left: 454px;
                filter: drop-shadow(rgb(0, 0, 0) 0px 15px 20px);
            }
            #IMAGE579 > .ladi-image > .ladi-image-background {
                width: 238.933px;
                height: 49.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.png");
            }
            #IMAGE579 > .ladi-image {
                border-style: double;
                border-color: rgb(255, 222, 137);
                border-width: 0px;
                border-radius: 13px;
            }
            #SECTION581 {
                height: 655.16px;
            }
            #SECTION581 > .ladi-section-background {
                background-image: url("images/chung-cu-vinhomes-smart-city-1-20210311053929.jpg");
                background-position: center top;
                background-repeat: no-repeat;
            }
            #LIST_PARAGRAPH585 {
                width: 550px;
                top: 101.706px;
                left: 49px;
            }
            #LIST_PARAGRAPH585 > .ladi-list-paragraph {
                color: rgb(0, 0, 0);
                font-size: 18px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH585 ul li {
                padding-left: 35px;
            }
            #LIST_PARAGRAPH585 ul li:before {
                content: "";
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22100%25%22%20height%3D%22100%25%22%20%20viewBox%3D%220%200%202048.0005%201896.0833%22%20class%3D%22%22%20fill%3D%22rgba(203%2C%201%2C%201%2C%201)%22%3E%20%3Cpath%20d%3D%22M212%20768l623%20665-300-665H212zm812%20772l349-772H675zM538%20640l204-384H480L192%20640h346zm675%20793l623-665h-323zM683%20640h682l-204-384H887zm827%200h346l-288-384h-262zm141-486l384%20512q14%2018%2013%2041.5t-17%2040.5l-960%201024q-18%2020-47%2020t-47-20L17%20748Q1%20731%200%20707.5T13%20666l384-512q18-26%2051-26h1152q33%200%2051%2026z%22%3E%3C%2Fpath%3E%20%3C%2Fsvg%3E");
                width: 20px;
                height: 20px;
                top: 0px;
            }
            #PARAGRAPH586 {
                width: 531px;
                top: 539.706px;
                left: 49.5px;
            }
            #PARAGRAPH586 > .ladi-paragraph {
                color: rgb(0, 0, 0);
                font-size: 18px;
                font-weight: bold;
                font-style: italic;
                text-align: center;
                line-height: 1.6;
            }
            #LINE588 {
                width: 350px;
                top: 522.706px;
                left: 140px;
            }
            #LINE588 > .ladi-line > .ladi-line-container {
                border-top: 1px solid rgb(0, 0, 0);
                border-right: 1px solid rgb(0, 0, 0);
                border-bottom: 1px solid rgb(0, 0, 0);
                border-left: 0px !important;
            }
            #LINE588 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE589 {
                width: 350px;
                top: 74.166px;
                left: 156px;
            }
            #LINE589 > .ladi-line > .ladi-line-container {
                border-top: 1px solid rgb(0, 0, 0);
                border-right: 1px solid rgb(0, 0, 0);
                border-bottom: 1px solid rgb(0, 0, 0);
                border-left: 0px !important;
            }
            #LINE589 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #BOX592 {
                width: 643px;
                height: 609px;
                top: 0px;
                left: 0px;
            }
            #BOX592 > .ladi-box {
                background-color: rgb(255, 255, 255);
                border-style: double;
                border-color: rgb(255, 222, 137);
                border-width: 1px;
                filter: contrast(95%);
            }
            #FORM_ITEM591 {
                width: 462.101px;
                height: 48px;
                top: 56.191px;
                left: 0px;
            }
            #FORM418 {
                width: 462.344px;
                height: 363.565px;
                top: 128.303px;
                left: 47.328px;
            }
            #FORM418 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM418 .ladi-form-item .ladi-form-control::placeholder,
            #FORM418 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM418 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM418 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM418 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM418 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #FORM_ITEM422 {
                width: 462px;
                height: 122px;
                top: 165.191px;
                left: 0.294px;
            }
            #FORM_ITEM422 .ladi-form-checkbox-item {
                margin: 5px;
            }
            #BUTTON420 {
                width: 385.975px;
                height: 52.0482px;
                top: 311.517px;
                left: 38.3065px;
            }
            #BUTTON420 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON420 > .ladi-button {
                border-radius: 7px;
            }
            #BUTTON_TEXT420 {
                width: 291px;
                top: 10.33px;
                left: 0px;
            }
            #BUTTON_TEXT420 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #FORM_ITEM419 {
                width: 462.101px;
                height: 48px;
                top: 0px;
                left: 0.2435px;
            }
            #SHAPE594 {
                width: 29px;
                height: 44.078px;
                top: 442.71px;
                left: 144px;
            }
            #SHAPE594 > .ladi-shape {
                opacity: 0.7;
            }
            #SHAPE594 svg:last-child {
                fill: rgba(11, 92, 22, 1);
            }
            #HEADLINE319 {
                width: 432px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE319 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #LIST_PARAGRAPH114 {
                width: 525px;
                top: 151px;
                left: 0px;
            }
            #LIST_PARAGRAPH114 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH114 ul li {
                padding-bottom: 4px;
                padding-left: 28px;
            }
            #LIST_PARAGRAPH114 ul li:before {
                content: "";
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.1%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%20100%20100%22%20enable-background%3D%22new%200%200%20100%20100%22%20xml%3Aspace%3D%22preserve%22%20%20width%3D%22100%25%22%20height%3D%22100%25%22%20class%3D%22%22%20fill%3D%22rgba(239%2C%20241%2C%204%2C%201)%22%3E%3Cpolygon%20points%3D%2248.305%2C35.232%2048.298%2C13%2029.07%2C13%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2248.318%2C82.991%2048.306%2C39%2030.102%2C39%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2227.853%2C39%205.015%2C39%2048.2%2C88.137%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2227%2C37%2027%2C14.125%205.327%2C37%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2246.667%2C37%2029%2C16.261%2029%2C37%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2250.349%2C35.232%2050.354%2C13%2069.583%2C13%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2250.335%2C82.991%2050.348%2C39%2068.551%2C39%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2270.801%2C39%2093.638%2C39%2050.453%2C88.137%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2271%2C37%2071%2C14.125%2093.326%2C37%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2251.986%2C37%2069%2C16.261%2069%2C37%20%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
                width: 20px;
                height: 20px;
                top: 4px;
            }
            #IMAGE109 {
                width: 469.043px;
                height: 475.941px;
                top: 108.592px;
                left: -52px;
            }
            #IMAGE109 > .ladi-image > .ladi-image-background {
                width: 469.043px;
                height: 475.941px;
                top: 0px;
                left: 0px;
                background-image: url("images/a90-1562656441-20200814022442.png");
            }
            #IMAGE109 > .ladi-image {
                opacity: 0.35;
            }
            #SECTION48 {
                height: 654.3px;
            }
            #SECTION48 > .ladi-section-background {
                background-color: rgb(29, 48, 67);
            }
            #GROUP595 {
                width: 643px;
                height: 609px;
                top: 46.16px;
                left: 0px;
            }
            #GROUP595.ladi-animation > .ladi-group {
                animation-name: bounceIn;
                -webkit-animation-name: bounceIn;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP596 {
                width: 557px;
                height: 609px;
                top: 46.16px;
                left: 643px;
            }
            #GROUP596.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #PARAGRAPH597 {
                width: 525px;
                top: 0px;
                left: 0px;
            }
            #PARAGRAPH597 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LINE598 {
                width: 350px;
                top: 55.172px;
                left: 32px;
            }
            #LINE598 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE598 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #GALLERY599 {
                width: 594.5px;
                height: 450px;
                top: 153.533px;
                left: 605.5px;
            }
            #GALLERY599 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #GALLERY599 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #GALLERY599 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/vhsmc5_tong-the-hien-gs-20210311075248.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/vhsmc5_tong-the-hien-gs-20210311075248.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/phoi_canh_tien_ich_s3_11-20210311075749.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/phoi_canh_tien_ich_s3_11-20210311075749.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/pc1-20210311075749.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/pc1-20210311075749.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
                background-image: url("images/3-khai-truong-cong-vien-trung-tam-1024x576-20210311080048.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
                background-image: url("images/3-khai-truong-cong-vien-trung-tam-1024x576-20210311080048.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
                background-image: url("images/phoi_canh_tien_ich_s3_9-20210311080344.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
                background-image: url("images/phoi_canh_tien_ich_s3_9-20210311080344.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
                background-image: url("images/phoi_canh_tien_ich_s3_5-20210311080344.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
                background-image: url("images/phoi_canh_tien_ich_s3_5-20210311080344.s400x400.jpg");
            }
            #LINE600 {
                width: 193px;
                top: 44.552px;
                left: 0px;
            }
            #LINE600 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE600 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #HEADLINE602 {
                width: 359px;
                top: 42.798px;
                left: 431px;
            }
            #HEADLINE602 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #HEADLINE602.ladi-animation > .ladi-headline {
                animation-name: fadeInDown;
                -webkit-animation-name: fadeInDown;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #SECTION601 {
                height: 1000.6px;
            }
            #SECTION601 > .ladi-section-background {
                background: #2c902f;
                background: -webkit-linear-gradient(270deg, #2c902f, #4f9fc9);
                background: linear-gradient(270deg, #2c902f, #4f9fc9);
            }
            #PARAGRAPH613 {
                width: 435px;
                top: 81px;
                left: 24px;
            }
            #PARAGRAPH613 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #BOX614 {
                width: 200px;
                height: 200px;
                top: 119.6px;
                left: 510.5px;
            }
            #BOX614 > .ladi-box {
                opacity: 0.5;
                background-color: rgb(29, 48, 67);
            }
            #HEADLINE615 {
                width: 347px;
                top: 0px;
                left: 24px;
            }
            #HEADLINE615 > .ladi-headline {
                color: rgb(239, 241, 4);
                font-size: 20px;
                font-weight: bold;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH616 {
                width: 213px;
                top: 204px;
                left: 24px;
            }
            #LIST_PARAGRAPH616 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH616 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH616 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #LIST_PARAGRAPH617 {
                width: 201px;
                top: 204px;
                left: 260px;
            }
            #LIST_PARAGRAPH617 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH617 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH617 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #PARAGRAPH618 {
                width: 469px;
                top: 604.6px;
                left: 0px;
            }
            #PARAGRAPH618 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #HEADLINE619 {
                width: 346px;
                top: 553.6px;
                left: 0px;
            }
            #HEADLINE619 > .ladi-headline {
                color: rgb(239, 241, 4);
                font-size: 20px;
                font-weight: bold;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH620 {
                width: 330px;
                top: 746.1px;
                left: 0px;
            }
            #LIST_PARAGRAPH620 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH620 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH620 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #LIST_PARAGRAPH621 {
                width: 314px;
                top: 698.1px;
                left: 0px;
            }
            #LIST_PARAGRAPH621 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH621 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH621 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #GALLERY623 {
                width: 695px;
                height: 377px;
                top: 132.6px;
                left: 0px;
            }
            #GALLERY623 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 0px);
            }
            #GALLERY623 > .ladi-gallery > .ladi-gallery-control {
                height: 0px;
                display: none;
            }
            #GALLERY623 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 0px;
                height: 0px;
                margin-right: 0px;
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/190104_panorama_san-patin-1-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/190104_panorama_san-patin-1-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/190104_panorama-san-the-thao-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/190104_panorama-san-the-thao-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/190104_panorama_vuon-choi-co-1-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/190104_panorama_vuon-choi-co-1-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
                background-image: url("images/190104_panorama_bbq-1-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
                background-image: url("images/190104_panorama_bbq-1-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
                background-image: url("images/181229_zone01_bbq-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
                background-image: url("images/181229_zone01_bbq-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
                background-image: url("images/181229_panorama_xe-dap-dia-hinh-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
                background-image: url("images/181229_panorama_xe-dap-dia-hinh-20210311085453.s400x400.jpg");
            }
            #GALLERY624 {
                width: 695px;
                height: 377px;
                top: 585.6px;
                left: 505px;
            }
            #GALLERY624 > .ladi-gallery > .ladi-gallery-view {
                left: 0px;
                width: calc(100% - 0px);
            }
            #GALLERY624 > .ladi-gallery > .ladi-gallery-control {
                width: 0px;
                display: none;
            }
            #GALLERY624 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 0px;
                height: 0px;
                margin-bottom: 0px;
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/pc4-20210311092835.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/pc4-20210311092835.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/vuon-nhat-2-20210311085453.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/vuon-nhat-2-20210311085453.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/vuon-nhat-3-20210311085453.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/vuon-nhat-3-20210311085453.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
                background-image: url("images/4-20210311094623.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
                background-image: url("images/4-20210311094623.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
                background-image: url("images/9-20210311094623.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
                background-image: url("images/9-20210311094623.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
                background-image: url("images/5-20210311094622.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
                background-image: url("images/5-20210311094622.s400x400.jpg");
            }
            #BOX625 {
                width: 200px;
                height: 200px;
                top: 569.6px;
                left: 487.5px;
            }
            #BOX625 > .ladi-box {
                opacity: 0.5;
                background-color: rgb(29, 48, 67);
            }
            #SECTION626 {
                height: 1018.9px;
            }
            #HEADLINE627 {
                width: 564px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE627 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
                padding: 10px;
            }
            #IMAGE629 {
                width: 1194px;
                height: 861.788px;
                top: 121.908px;
                left: 6px;
            }
            #IMAGE629 > .ladi-image > .ladi-image-background {
                width: 1194px;
                height: 861.788px;
                top: 0px;
                left: 0px;
                background-image: url("images/mat-bang-tong-the-vinhomes-smart-city-20210311101411.jpg");
            }
            #IMAGE629.ladi-animation > .ladi-image {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #HEADLINE656 {
                width: 620px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE656 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
                padding: 10px;
            }
            #BUTTON150 {
                width: 198px;
                height: 51px;
                top: 125.6px;
                left: 628.93px;
            }
            #BUTTON150 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON150 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON_TEXT150 {
                width: 198px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT150 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON154 {
                width: 198px;
                height: 51px;
                top: 125.6px;
                left: 380.5px;
            }
            #BUTTON154 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON154 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON_TEXT154 {
                width: 198px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT154 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON_TEXT134 {
                width: 198px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT134 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON134 {
                width: 198px;
                height: 51px;
                top: 125.6px;
                left: 131.5px;
            }
            #BUTTON134 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON134 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON_TEXT659 {
                width: 198px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT659 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON659 {
                width: 198px;
                height: 51px;
                top: 125.6px;
                left: 876.5px;
            }
            #BUTTON659 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON659 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON224 {
                width: 301.574px;
                height: 44.207px;
                top: 402.908px;
                left: 73px;
            }
            #BUTTON224 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON224 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON224.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #BUTTON_TEXT224 {
                width: 311px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT224 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE220 {
                width: 255px;
                top: 47.104px;
                left: 73px;
            }
            #HEADLINE220 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BOX217 {
                width: 560.699px;
                height: 520.997px;
                top: 0px;
                left: 0px;
            }
            #BOX217 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #LIST_PARAGRAPH663 {
                width: 383px;
                top: 87.65px;
                left: 68px;
            }
            #LIST_PARAGRAPH663 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH663 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH663 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #BOX669 {
                width: 560.699px;
                height: 520.997px;
                top: 0px;
                left: 0px;
            }
            #BOX669 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE671 {
                width: 263px;
                top: 47.104px;
                left: 73px;
            }
            #HEADLINE671 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BUTTON_TEXT672 {
                width: 311px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT672 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON672 {
                width: 301.574px;
                height: 44.207px;
                top: 399.908px;
                left: 73px;
            }
            #BUTTON672 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON672 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON672.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #LIST_PARAGRAPH675 {
                width: 428px;
                top: 87.65px;
                left: 68px;
            }
            #LIST_PARAGRAPH675 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH675 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH675 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #BOX678 {
                width: 560.699px;
                height: 520.997px;
                top: 0px;
                left: 0px;
            }
            #BOX678 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE680 {
                width: 270px;
                top: 47.104px;
                left: 73px;
            }
            #HEADLINE680 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BUTTON_TEXT681 {
                width: 311px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT681 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON681 {
                width: 301.574px;
                height: 44.207px;
                top: 428.758px;
                left: 59.699px;
            }
            #BUTTON681 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON681 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON681.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #LIST_PARAGRAPH684 {
                width: 485px;
                top: 87.65px;
                left: 68px;
            }
            #LIST_PARAGRAPH684 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH684 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH684 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #BOX687 {
                width: 560.699px;
                height: 520.997px;
                top: 0px;
                left: 0px;
            }
            #BOX687 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE689 {
                width: 262px;
                top: 47.104px;
                left: 73px;
            }
            #HEADLINE689 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BUTTON_TEXT690 {
                width: 311px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT690 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON690 {
                width: 301.574px;
                height: 44.207px;
                top: 301.908px;
                left: 73px;
            }
            #BUTTON690 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON690 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON690.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #LIST_PARAGRAPH693 {
                width: 438px;
                top: 87.65px;
                left: 68px;
            }
            #LIST_PARAGRAPH693 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH693 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH693 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #SECTION694 {
                height: 251.9px;
            }
            #SECTION694 > .ladi-section-background {
                background-color: rgb(29, 48, 67);
            }
            #HEADLINE695 {
                width: 547px;
                top: 28.2px;
                left: 316.999px;
            }
            #HEADLINE695 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(239, 241, 4);
                font-size: 28px;
                text-align: center;
                line-height: 1.4;
            }
            #FORM696 {
                width: 886.699px;
                height: 42.8722px;
                top: 21.014px;
                left: 27.15px;
            }
            #FORM696 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 15px;
                line-height: 1.6;
            }
            #FORM696 .ladi-form-item .ladi-form-control::placeholder,
            #FORM696 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM696 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: #000;
            }
            #FORM696 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM696 .ladi-form-item-container {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 1px;
            }
            #FORM696 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #BUTTON697 {
                width: 126.712px;
                height: 42.7447px;
                top: 0.1275px;
                left: 759.987px;
            }
            #BUTTON697 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON_TEXT697 {
                width: 59px;
                top: 10.9915px;
                left: 0px;
            }
            #BUTTON_TEXT697 > .ladi-headline {
                color: rgb(29, 49, 67);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #FORM_ITEM699 {
                width: 341.148px;
                height: 42.7447px;
                top: 0px;
                left: 0px;
            }
            #FORM_ITEM700 {
                width: 341.148px;
                height: 42.7447px;
                top: 0px;
                left: 379.061px;
            }
            #HEADLINE702 {
                width: 358px;
                top: 74.2px;
                left: 430px;
            }
            #HEADLINE702 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 25px;
                text-align: left;
                line-height: 1.4;
            }
            #BOX716 {
                width: 944px;
                height: 84.9px;
                top: 0px;
                left: 0px;
            }
            #BOX716 > .ladi-box {
                background: #fdfbfb;
                background: -webkit-linear-gradient(180deg, #fdfbfb, #eaedee);
                background: linear-gradient(180deg, #fdfbfb, #eaedee);
            }
            #SECTION717 {
                height: 1042px;
            }
            #HEADLINE760 {
                width: 326px;
                top: 166px;
                left: 213.483px;
            }
            #HEADLINE760 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #PARAGRAPH761 {
                width: 318px;
                top: 30px;
                left: 149px;
            }
            #PARAGRAPH761 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #GROUP762 {
                width: 119px;
                height: 116px;
                top: 0px;
                left: 0px;
            }
            #BOX763 {
                width: 119px;
                height: 116px;
                top: 0px;
                left: 0px;
            }
            #BOX763 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE764 {
                width: 37px;
                height: 37px;
                top: 13px;
                left: 41px;
            }
            #SHAPE764 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE765 {
                width: 84px;
                top: 51px;
                left: 16px;
            }
            #HEADLINE765 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #HEADLINE767 {
                width: 326px;
                top: 166px;
                left: 732.483px;
            }
            #HEADLINE767 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #BOX770 {
                width: 119px;
                height: 116px;
                top: 166px;
                left: 583.483px;
            }
            #BOX770 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE771 {
                width: 37px;
                height: 37px;
                top: 179px;
                left: 624.483px;
            }
            #SHAPE771 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE772 {
                width: 84px;
                top: 217px;
                left: 599.483px;
            }
            #HEADLINE772 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH802 {
                width: 318px;
                top: 101px;
                left: 149px;
            }
            #PARAGRAPH802 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH768 {
                width: 404px;
                top: 196px;
                left: 732.483px;
            }
            #PARAGRAPH768 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #PARAGRAPH803 {
                width: 404px;
                top: 267px;
                left: 732.483px;
            }
            #PARAGRAPH803 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #HEADLINE821 {
                width: 326px;
                top: 375px;
                left: 732.483px;
            }
            #HEADLINE821 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #PARAGRAPH822 {
                width: 404px;
                top: 405px;
                left: 732.483px;
            }
            #PARAGRAPH822 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX824 {
                width: 119px;
                height: 116px;
                top: 375px;
                left: 583.483px;
            }
            #BOX824 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE825 {
                width: 37px;
                height: 37px;
                top: 388px;
                left: 624.483px;
            }
            #SHAPE825 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE826 {
                width: 84px;
                top: 426px;
                left: 599.483px;
            }
            #HEADLINE826 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #HEADLINE827 {
                width: 326px;
                top: 375px;
                left: 213.483px;
            }
            #HEADLINE827 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #PARAGRAPH828 {
                width: 318px;
                top: 30px;
                left: 149px;
            }
            #PARAGRAPH828 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX830 {
                width: 119px;
                height: 116px;
                top: 0px;
                left: 0px;
            }
            #BOX830 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE831 {
                width: 37px;
                height: 37px;
                top: 13px;
                left: 41px;
            }
            #SHAPE831 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE832 {
                width: 84px;
                top: 51px;
                left: 16px;
            }
            #HEADLINE832 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH833 {
                width: 318px;
                top: 101px;
                left: 149px;
            }
            #PARAGRAPH833 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH834 {
                width: 404px;
                top: 476px;
                left: 732.483px;
            }
            #PARAGRAPH834 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH837 {
                width: 404px;
                top: 626px;
                left: 732.483px;
            }
            #PARAGRAPH837 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX839 {
                width: 119px;
                height: 116px;
                top: 596px;
                left: 583.483px;
            }
            #BOX839 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE840 {
                width: 37px;
                height: 37px;
                top: 609px;
                left: 624.483px;
            }
            #SHAPE840 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE841 {
                width: 84px;
                top: 647px;
                left: 599.483px;
            }
            #HEADLINE841 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH843 {
                width: 318px;
                top: 626px;
                left: 213.483px;
            }
            #PARAGRAPH843 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX845 {
                width: 119px;
                height: 116px;
                top: 596px;
                left: 64.483px;
            }
            #BOX845 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE846 {
                width: 37px;
                height: 37px;
                top: 609px;
                left: 105.483px;
            }
            #SHAPE846 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE847 {
                width: 84px;
                top: 647px;
                left: 80.483px;
            }
            #HEADLINE847 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH848 {
                width: 318px;
                top: 697px;
                left: 213.483px;
            }
            #PARAGRAPH848 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH849 {
                width: 404px;
                top: 697px;
                left: 732.483px;
            }
            #PARAGRAPH849 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH852 {
                width: 404px;
                top: 859px;
                left: 732px;
            }
            #PARAGRAPH852 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX854 {
                width: 119px;
                height: 116px;
                top: 829px;
                left: 583px;
            }
            #BOX854 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE855 {
                width: 37px;
                height: 37px;
                top: 842px;
                left: 624px;
            }
            #SHAPE855 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE856 {
                width: 84px;
                top: 880px;
                left: 599px;
            }
            #HEADLINE856 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH858 {
                width: 318px;
                top: 859px;
                left: 213px;
            }
            #PARAGRAPH858 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX860 {
                width: 119px;
                height: 116px;
                top: 829px;
                left: 64px;
            }
            #BOX860 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE861 {
                width: 37px;
                height: 37px;
                top: 842px;
                left: 105px;
            }
            #SHAPE861 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE862 {
                width: 84px;
                top: 880px;
                left: 80px;
            }
            #HEADLINE862 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH863 {
                width: 318px;
                top: 901px;
                left: 213px;
            }
            #PARAGRAPH863 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH864 {
                width: 404px;
                top: 901px;
                left: 732px;
            }
            #PARAGRAPH864 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #LINE868 {
                height: 231px;
                top: 731.6px;
                left: 478px;
            }
            #LINE868 > .ladi-line > .ladi-line-container {
                border-top: 0px !important;
                border-right: 3px solid rgba(255, 222, 137, 0.8);
                border-bottom: 3px solid rgba(255, 222, 137, 0.8);
                border-left: 3px solid rgba(255, 222, 137, 0.8);
            }
            #LINE868 > .ladi-line {
                height: 100%;
                padding: 0px 8px;
            }
            #HEADLINE869 {
                width: 263px;
                top: 851.996px;
                left: 339.346px;
            }
            #HEADLINE869 > .ladi-headline {
                transform: rotate(90deg);
                -webkit-transform: rotate(90deg);
                color: rgb(10, 54, 67);
                font-size: 17px;
                text-align: left;
                line-height: 1.4;
            }
            #IMAGE875 {
                width: 349.906px;
                height: 214.666px;
                top: 671.634px;
                left: 425.047px;
            }
            #IMAGE875 > .ladi-image > .ladi-image-background {
                width: 349.906px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/73c394507fd68088d9c7-20200923035507-20210311145359.jpg");
            }
            #IMAGE875 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE875:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE879 {
                width: 349.906px;
                height: 214.666px;
                top: 671.634px;
                left: 792.094px;
            }
            #IMAGE879 > .ladi-image > .ladi-image-background {
                width: 349.906px;
                height: 226.909px;
                top: -12.2426px;
                left: 0px;
                background-image: url("images/00e3e6770df1f2afabe0-20200923035507-20210311145359.jpg");
            }
            #IMAGE879 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE879:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE883 {
                width: 349.906px;
                height: 214.666px;
                top: 671.634px;
                left: 60px;
            }
            #IMAGE883 > .ladi-image > .ladi-image-background {
                width: 349.906px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/a36dc5fb2e7dd123886c-20200923035507-20210311145359.jpg");
            }
            #IMAGE883 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE883:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #GROUP894 {
                width: 944px;
                height: 84.9px;
                top: 122.2px;
                left: 120px;
            }
            #BOX896 {
                width: 944px;
                height: 84.9px;
                top: 0px;
                left: 0px;
            }
            #BOX896 > .ladi-box {
                background: #fdfbfb;
                background: -webkit-linear-gradient(180deg, #fdfbfb, #eaedee);
                background: linear-gradient(180deg, #fdfbfb, #eaedee);
                border-style: dashed;
                border-color: rgb(0, 0, 0);
                border-width: 1px;
                border-radius: 5px;
            }
            #BUTTON_TEXT898 {
                width: 127px;
                top: 10.9915px;
                left: 0px;
            }
            #BUTTON_TEXT898 > .ladi-headline {
                color: rgb(29, 49, 67);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON898 {
                width: 126.712px;
                height: 42.7447px;
                top: 0.1275px;
                left: 759.987px;
            }
            #BUTTON898 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #FORM_ITEM900 {
                width: 341.148px;
                height: 42.7447px;
                top: 0px;
                left: 0px;
            }
            #FORM_ITEM901 {
                width: 341.148px;
                height: 42.7447px;
                top: 0px;
                left: 379.061px;
            }
            #FORM897 {
                width: 886.699px;
                height: 42.8722px;
                top: 21.014px;
                left: 27.15px;
            }
            #FORM897 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 15px;
                line-height: 1.6;
            }
            #FORM897 .ladi-form-item .ladi-form-control::placeholder,
            #FORM897 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM897 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: #000;
            }
            #FORM897 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM897 .ladi-form-item-container {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 1px;
            }
            #FORM897 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #GROUP895 {
                width: 944px;
                height: 84.9px;
                top: 174.4px;
                left: 128px;
            }
            #SECTION902 {
                height: 781.9px;
            }
            #HEADLINE903 {
                width: 584px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE903 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #IMAGE910 {
                width: 1046.46px;
                height: 557.583px;
                top: 116.317px;
                left: 77.253px;
            }
            #IMAGE910 > .ladi-image > .ladi-image-background {
                width: 1046.46px;
                height: 557.583px;
                top: 0px;
                left: 0px;
                background-image: url("images/bang-gia1-vinhomes-smart-city-ngoquocdungcom_-20200729075632-20210311154418.png");
            }
            #IMAGE910.ladi-animation > .ladi-image {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #BUTTON_TEXT917 {
                width: 274px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT917 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON917 {
                width: 437.258px;
                height: 57.207px;
                top: 692.61px;
                left: 390.854px;
            }
            #BUTTON917 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON917 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON917.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #PARAGRAPH919 {
                width: 469px;
                top: 834.6px;
                left: 0px;
            }
            #PARAGRAPH919 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #PARAGRAPH920 {
                width: 747px;
                top: 109px;
                left: 226.5px;
            }
            #PARAGRAPH920 > .ladi-paragraph {
                color: rgb(0, 0, 0);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
                padding: 10px;
            }
            #IMAGE927 {
                width: 349.906px;
                height: 214.666px;
                top: 272.334px;
                left: 425.047px;
            }
            #IMAGE927 > .ladi-image > .ladi-image-background {
                width: 349.906px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/8648873e14b8ebe6b2a9-20200923035127-20210311161028.jpg");
            }
            #IMAGE927 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE927:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE931 {
                width: 349.906px;
                height: 214.666px;
                top: 272.334px;
                left: 796.094px;
            }
            #IMAGE931 > .ladi-image > .ladi-image-background {
                width: 349.906px;
                height: 226.909px;
                top: -12.2426px;
                left: 0px;
                background-image: url("images/60146667f5e10abf53f0-20200923035128-20210311161028.jpg");
            }
            #IMAGE931 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE931:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE935 {
                width: 349.906px;
                height: 214.666px;
                top: 272.334px;
                left: 53px;
            }
            #IMAGE935 > .ladi-image > .ladi-image-background {
                width: 349.906px;
                height: 214.666px;
                top: 0px;
                left: 0px;
                background-image: url("images/01332040b3c64c9815d7-20200923035126-20210311161028.jpg");
            }
            #IMAGE935 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE935:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #GROUP936 {
                width: 432px;
                height: 75.172px;
                top: 42.42px;
                left: 393px;
            }
            #GROUP936.ladi-animation > .ladi-group {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP937 {
                width: 525px;
                height: 453px;
                top: 153.533px;
                left: 59px;
            }
            #GROUP937.ladi-animation > .ladi-group {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP938 {
                width: 348px;
                height: 429.552px;
                top: 71.098px;
                left: 852.046px;
            }
            #GROUP938.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP939 {
                width: 461px;
                height: 368px;
                top: 0px;
                left: 136.654px;
            }
            #GROUP939.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #LINE941 {
                height: 231px;
                top: 0px;
                left: 99.654px;
            }
            #LINE941 > .ladi-line > .ladi-line-container {
                border-top: 0px !important;
                border-right: 3px solid rgba(255, 222, 137, 0.7);
                border-bottom: 3px solid rgba(255, 222, 137, 0.7);
                border-left: 3px solid rgba(255, 222, 137, 0.7);
            }
            #LINE941 > .ladi-line {
                height: 100%;
                padding: 0px 8px;
            }
            #HEADLINE942 {
                width: 263px;
                top: 139.396px;
                left: 0px;
            }
            #HEADLINE942 > .ladi-headline {
                transform: rotate(90deg);
                -webkit-transform: rotate(90deg);
                color: rgb(10, 54, 67);
                font-size: 17px;
                text-align: left;
                line-height: 1.4;
            }
            #GROUP943 {
                width: 597.654px;
                height: 368px;
                top: 141.6px;
                left: 602.346px;
            }
            #GROUP943.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #LINE945 {
                width: 271px;
                top: 88.35px;
                left: 458.046px;
            }
            #LINE945 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE945 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE946 {
                width: 283px;
                top: 49.55px;
                left: 148.311px;
            }
            #LINE946 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE946 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE947 {
                width: 281px;
                top: 51.65px;
                left: 143.077px;
            }
            #LINE947 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE947 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE948 {
                width: 271px;
                top: 44.66px;
                left: 185px;
            }
            #LINE948 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE948 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE949 {
                width: 271px;
                top: 91.66px;
                left: 156.017px;
            }
            #LINE949 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE949 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE950 {
                width: 271px;
                top: 85.45px;
                left: 464.983px;
            }
            #LINE950 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE950 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE951 {
                width: 271px;
                top: 85.15px;
                left: 464.5px;
            }
            #LINE951 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE951 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #GROUP952 {
                width: 564px;
                height: 69.55px;
                top: 44.2px;
                left: 333px;
            }
            #GROUP952.ladi-animation > .ladi-group {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP954 {
                width: 620px;
                height: 71.65px;
                top: 40.3px;
                left: 329.5px;
            }
            #GROUP954.ladi-animation > .ladi-group {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP955 {
                width: 584px;
                height: 64.66px;
                top: 31.69px;
                left: 308px;
            }
            #GROUP955.ladi-animation > .ladi-group {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP956 {
                width: 584px;
                height: 111.66px;
                top: 26.79px;
                left: 308.483px;
            }
            #GROUP956.ladi-animation > .ladi-group {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #FORM_ITEM961 {
                width: 435.472px;
                height: 46.7171px;
                top: 61.0573px;
                left: 0px;
            }
            #IMAGE962 {
                width: 200px;
                height: 49.0231px;
                top: 49.9885px;
                left: 110px;
            }
            #IMAGE962 > .ladi-image > .ladi-image-background {
                width: 200px;
                height: 49.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x350.png");
            }
            #BOX963 {
                width: 339px;
                height: 49px;
                top: 39.434px;
                left: 430.5px;
            }
            #BOX963 > .ladi-box {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 2px;
            }
            #BOX964 {
                width: 339px;
                height: 49px;
                top: 39.434px;
                left: 41.5px;
            }
            #BOX964 > .ladi-box {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 2px;
            }
            #BOX965 {
                width: 339px;
                height: 49px;
                top: 39.434px;
                left: 830.5px;
            }
            #BOX965 > .ladi-box {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 2px;
            }
            #FORM286 {
                width: 300.973px;
                height: 165.375px;
                top: 61.023px;
                left: 19.514px;
            }
            #FORM286 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM286 .ladi-form-item .ladi-form-control::placeholder,
            #FORM286 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM286 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM286 .ladi-form-item {
                padding-left: 8px;
                padding-right: 8px;
            }
            #FORM286 .ladi-form-item.ladi-form-checkbox {
                padding-left: 13px;
                padding-right: 13px;
            }
            #FORM286 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM286 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM286 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #BUTTON290 {
                width: 300.973px;
                height: 52.607px;
                top: 112.768px;
                left: 0px;
            }
            #BUTTON290 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON290 > .ladi-button {
                border-radius: 5px;
            }
            #BUTTON_TEXT290 {
                width: 301px;
                top: 7.89104px;
                left: 0px;
            }
            #BUTTON_TEXT290 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #FORM_ITEM289 {
                width: 299.208px;
                height: 43.6638px;
                top: 51.6117px;
                left: 0px;
            }
            #FORM_ITEM288 {
                width: 299.208px;
                height: 43.6638px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE966 {
                width: 286px;
                top: 51.434px;
                left: 461.957px;
            }
            #HEADLINE966 > .ladi-headline {
                color: rgb(250, 239, 210);
                font-size: 16px;
                font-weight: bold;
                line-height: 1.6;
            }
            #HEADLINE967 {
                width: 286px;
                top: 51.434px;
                left: 68px;
            }
            #HEADLINE967 > .ladi-headline {
                color: rgb(250, 239, 210);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE968 {
                width: 286px;
                top: 51.434px;
                left: 857px;
            }
            #HEADLINE968 > .ladi-headline {
                color: rgb(250, 239, 210);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #IMAGE969 {
                width: 248.957px;
                height: 61.0231px;
                top: 113.922px;
                left: 86.5215px;
            }
            #IMAGE969 > .ladi-image > .ladi-image-background {
                width: 248.957px;
                height: 61.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x400.png");
            }
            #HEADLINE970 {
                width: 305px;
                top: 188.434px;
                left: 58.5px;
            }
            #HEADLINE970 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #PARAGRAPH971 {
                width: 469px;
                top: 252.434px;
                left: -23.5px;
            }
            #PARAGRAPH971 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 19px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #PARAGRAPH972 {
                width: 253px;
                top: 288.434px;
                left: 84.5px;
            }
            #PARAGRAPH972 > .ladi-paragraph {
                color: rgb(239, 241, 4);
                font-size: 28px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH973 {
                width: 339px;
                top: 113.922px;
                left: 830.5px;
            }
            #LIST_PARAGRAPH973 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH973 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH973 ul li:before {
                content: counter(linum, disc);
                color: rgba(239, 241, 4, 1);
                font-size: 30px;
                top: -10px;
            }
            #HEADLINE974 {
                width: 597px;
                top: 196.471px;
                left: 301.5px;
            }
            #HEADLINE974 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
                text-shadow: rgb(0, 0, 0) 1px 2px 3px;
            }
            #HEADLINE976 {
                width: 496px;
                top: 354.481px;
                left: 352px;
            }
            #HEADLINE976 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 235, 62);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
                text-shadow: rgb(0, 0, 0) 1px 2px 3px;
            }
            #HEADLINE976.ladi-animation > .ladi-headline {
                animation-name: bounceInLeft;
                -webkit-animation-name: bounceInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #BOX977 {
                width: 665.393px;
                height: 178px;
                top: 173.471px;
                left: 267.303px;
            }
            #BOX977 > .ladi-box {
                opacity: 0.7;
                background-color: rgb(189, 189, 189);
                border-style: solid;
                border-color: rgb(255, 235, 63);
                border-width: 3px;
                border-radius: 30px;
            }
            #PARAGRAPH978 {
                width: 339px;
                top: 0px;
                left: 0px;
            }
            #PARAGRAPH978 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                text-align: center;
                line-height: 1.6;
            }
            #GROUP979 {
                width: 339px;
                height: 226.398px;
                top: 113.922px;
                left: 430px;
            }
            #HEADLINE980 {
                width: 597px;
                top: 234.471px;
                left: 301.5px;
            }
            #HEADLINE980 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 235, 62);
                font-size: 60px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
                text-shadow: rgb(0, 0, 0) 1px 2px 3px;
            }
            #BUTTON_TEXT991 {
                width: 300px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT991 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 20px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON991 {
                width: 301.574px;
                height: 44.207px;
                top: 437.481px;
                left: 422.679px;
            }
            #BUTTON991 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON991 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON991.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #HEADLINE580 {
                width: 83px;
                top: 27px;
                left: 318.645px;
            }
            #HEADLINE580 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #HEADLINE27 {
                width: 99px;
                top: 27px;
                left: 858.038px;
            }
            #HEADLINE27 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #SHAPE994 {
                width: 31.787px;
                height: 31.787px;
                top: 0px;
                left: 0px;
            }
            #SHAPE994 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #BOX995 {
                width: 117px;
                height: 50px;
                top: 0px;
                left: 0px;
            }
            #BOX995 > .ladi-box {
                border-style: double;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
            }
            #HEADLINE996 {
                width: 59px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE996 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #GROUP998 {
                width: 117px;
                height: 50px;
                top: 0px;
                left: 0px;
                display: none !important;
            }
            #GROUP940 {
                width: 263px;
                height: 231px;
                top: 137px;
                left: 0px;
            }
            #FORM_ITEM1021 {
                width: 299.208px;
                height: 43.6638px;
                top: 0px;
                left: 0px;
            }
            #FORM_ITEM1022 {
                width: 299.208px;
                height: 43.6638px;
                top: 51.6117px;
                left: 0px;
            }
            #BUTTON_TEXT1023 {
                width: 354px;
                top: 7.89104px;
                left: 0px;
            }
            #BUTTON_TEXT1023 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #BUTTON1023 {
                width: 300.973px;
                height: 52.607px;
                top: 112.768px;
                left: 0px;
            }
            #BUTTON1023 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON1023 > .ladi-button {
                border-radius: 5px;
            }
            #FORM1020 {
                width: 300.973px;
                height: 165.375px;
                top: 61.023px;
                left: 19.514px;
                display: none !important;
            }
            #FORM1020 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM1020 .ladi-form-item .ladi-form-control::placeholder,
            #FORM1020 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM1020 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM1020 .ladi-form-item {
                padding-left: 8px;
                padding-right: 8px;
            }
            #FORM1020 .ladi-form-item.ladi-form-checkbox {
                padding-left: 13px;
                padding-right: 13px;
            }
            #FORM1020 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM1020 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM1020 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #GROUP1033 {
                width: 467px;
                height: 189px;
                top: 166px;
                left: 64.483px;
            }
            #GROUP1035 {
                width: 467px;
                height: 211px;
                top: 375px;
                left: 64.483px;
            }
            #SECTION1050 {
                height: 0.717px;
            }
            #GROUP1052 {
                width: 170.373px;
                height: 40px;
                top: 16.5px;
                left: 1004.63px;
            }
            #BUTTON_TEXT1054 {
                width: 168px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT1054 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 19px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON1054 {
                width: 170.373px;
                height: 40px;
                top: 0px;
                left: 0px;
            }
            #BUTTON1054 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 7);
            }
            #BUTTON1054 > .ladi-button {
                border-style: solid;
                border-color: rgb(244, 221, 156);
                border-width: 1px;
                border-radius: 10px 0px 0px 10px;
            }
            #SHAPE1056 {
                width: 25.5705px;
                height: 28.5px;
                top: 8.25px;
                left: 10.58px;
            }
            #SHAPE1056 svg:last-child {
                fill: rgba(239, 241, 4, 1);
            }
            #BUTTON_TEXT1059 {
                width: 168px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT1059 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 19px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON1059 {
                width: 170.373px;
                height: 40px;
                top: 0px;
                left: 170.37px;
            }
            #BUTTON1059 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 7);
            }
            #BUTTON1059 > .ladi-button {
                border-style: solid;
                border-color: rgb(244, 221, 156);
                border-width: 1px;
                border-radius: 0px 10px 10px 0px;
            }
            #GROUP1061 {
                width: 340.743px;
                height: 40px;
                top: auto;
                left: auto;
                bottom: 30px;
                right: 30px;
                position: fixed;
                z-index: 90000050;
            }
            #POPUP1071 {
                width: 479px;
                height: 259px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP1071 > .ladi-popup > .ladi-overlay {
                background-size: cover;
                background-attachment: scroll;
                background-origin: content-box;
                background-image: url("images/57b167c9ca57d39c18a1c57c/bg-2.png");
                background-position: center top;
                background-repeat: no-repeat;
            }
            #POPUP1071 > .ladi-popup > .ladi-popup-background {
                background-color: rgb(255, 255, 255);
            }
            #BOX1073 {
                width: 48px;
                height: 48px;
                top: 0px;
                left: 0px;
            }
            #BOX1073 > .ladi-box {
                border-style: solid;
                border-color: rgb(246, 81, 31);
                border-width: 2px;
                border-radius: 50px;
            }
            #SHAPE1074 {
                width: 26px;
                height: 26px;
                top: 14px;
                left: 13px;
            }
            #SHAPE1074 svg:last-child {
                fill: #f6511f;
            }
            #PARAGRAPH1075 {
                width: 271px;
                top: 147px;
                left: 105px;
            }
            #PARAGRAPH1075 > .ladi-paragraph {
                font-family: "Itim", cursive;
                color: rgb(74, 74, 74);
                font-size: 18px;
                text-align: center;
                line-height: 1.2;
            }
            #LINE1076 {
                width: 64px;
                top: 117px;
                left: 208.5px;
            }
            #LINE1076 > .ladi-line > .ladi-line-container {
                border-top: 3px dotted rgb(74, 74, 74);
                border-right: 3px dotted rgb(74, 74, 74);
                border-bottom: 3px dotted rgb(74, 74, 74);
                border-left: 0px !important;
            }
            #LINE1076 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #GROUP1077 {
                width: 305px;
                height: 30px;
                top: 72px;
                left: 78.5px;
            }
            #HEADLINE1078 {
                width: 164px;
                top: 0px;
                left: 141px;
            }
            #HEADLINE1078 > .ladi-headline {
                font-family: "Itim", cursive;
                color: rgb(246, 81, 31);
                font-size: 30px;
                text-align: left;
                line-height: 1;
            }
            #HEADLINE1079 {
                width: 132px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE1079 > .ladi-headline {
                font-family: "Itim", cursive;
                color: rgb(74, 74, 74);
                font-size: 30px;
                text-align: right;
                line-height: 1;
            }
            #GROUP1080 {
                width: 48px;
                height: 48px;
                top: 19px;
                left: 222.5px;
            }
            #HEADLINE1004 {
                width: 312px;
                top: 94.5px;
                left: 54px;
            }
            #HEADLINE1004 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #IMAGE1005 {
                width: 200px;
                height: 49.0231px;
                top: 40.9885px;
                left: 110px;
            }
            #IMAGE1005 > .ladi-image > .ladi-image-background {
                width: 200px;
                height: 49.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x350.png");
            }
            #POPUP1003 {
                width: 420px;
                height: 491px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP1003 > .ladi-popup > .ladi-popup-background {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE1006 {
                width: 420px;
                top: 179.5px;
                left: 0px;
            }
            #HEADLINE1006 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE1007 {
                width: 420px;
                top: 276.5px;
                left: 0px;
            }
            #HEADLINE1007 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE1008 {
                width: 420px;
                top: 228px;
                left: 0px;
            }
            #HEADLINE1008 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE1009 {
                width: 420px;
                top: 324.5px;
                left: 0px;
            }
            #HEADLINE1009 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #S1 {
                width: 560.699px;
                height: 520.997px;
                top: 204.45px;
                left: 0px;
            }
            #S2 {
                width: 560.699px;
                height: 520.997px;
                top: 204.45px;
                left: 0px;
            }
            #S3 {
                width: 560.699px;
                height: 520.997px;
                top: 204.45px;
                left: 0px;
            }
            #S4 {
                width: 560.699px;
                height: 520.997px;
                top: 204.45px;
                left: 0px;
            }
            #AS4 {
                width: 639.301px;
                height: 520.997px;
                top: 204.45px;
                left: 560.699px;
            }
            #AS4 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS4 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS4 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS4 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/823b330a56d7ad89f4c6-1536x862-20210311115938.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/823b330a56d7ad89f4c6-1536x862-20210311115938.s400x400.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/s402-1536x1009-20210311115937.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {

                background-image: url("images/s402-1536x1009-20210311115937.s400x400.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/mat-bang-tang-3-35-toa-s403-vinhomes-smart-city-20210311120108.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/mat-bang-tang-3-35-toa-s403-vinhomes-smart-city-20210311120108.s400x400.jpg");
            }
            #AS3 {
                width: 639.301px;
                height: 520.997px;
                top: 204.45px;
                left: 560.699px;
            }
            #AS3 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS3 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS3 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS3 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/s301-20210311121940.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/s301-20210311121940.s400x400.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/s302-20210311121940.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/s302-20210311121940.s400x400.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/mat-bang-toa-s303-vinhomes-smart-city-20210311121939.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/mat-bang-toa-s303-vinhomes-smart-city-20210311121939.s400x400.jpg");
            }
            #AS1 {
                width: 639.301px;
                height: 520.997px;
                top: 204.45px;
                left: 560.699px;
            }
            #AS1 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS1 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS1 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS1 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/s102-20210311113823.jpg");
            }
            #AS1 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/s102-20210311113823.s400x400.jpg");
            }
            #AS1 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/mb-s106-h06-20210311113823.jpg");
            }
            #AS1 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/mb-s106-h06-20210311113823.s400x400.jpg");
            }
            #AS2 {
                width: 639.301px;
                height: 520.997px;
                top: 205.3px;
                left: 560.699px;
            }
            #AS2 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS2 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS2 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS2 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/mb-s201-h07-20210311123042.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/mb-s201-h07-20210311123042.s400x400.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/mat-bang-tang-2-35-toa-s202-vinhomes-smart-city-20210311123041.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/mat-bang-tang-2-35-toa-s202-vinhomes-smart-city-20210311123041.s400x400.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/s203-20210311123041.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/s203-20210311123041.s400x400.jpg");
            }
            #GROUP1084 {
                width: 560.699px;
                height: 520.997px;
                top: 0px;
                left: 0px;
            }
        }
        @media (max-width: 767px) {
            #SECTION_POPUP {
                height: 0px;
            }
            #SECTION1 {
                height: 88.843px;
            }
            #SECTION1 > .ladi-section-background {
                background: rgba(79, 159, 202, 1);
                background: -webkit-linear-gradient(180deg, rgba(79, 159, 202, 1), rgba(45, 144, 49, 1));
                background: linear-gradient(180deg, rgba(79, 159, 202, 1), rgba(45, 144, 49, 1));
                opacity: 0.95;
            }
            #SECTION3 {
                height: 1427.21px;
            }
            #SECTION3 > .ladi-section-background {
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.s768x1427.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #HEADLINE28 {
                width: 96px;
                top: 10.023px;
                left: 32.814px;
                display: none !important;
            }
            #HEADLINE28 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: left;
                line-height: 1.2;
            }
            #HEADLINE30 {
                width: 83px;
                top: 18.0231px;
                left: 17.5px;
                display: none !important;
            }
            #HEADLINE30 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #HEADLINE31 {
                width: 63px;
                top: 0.523px;
                left: 5.5px;
                display: none !important;
            }
            #HEADLINE31 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: center;
                line-height: 1.2;
            }
            #BUTTON_TEXT33 {
                width: 168px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT33 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 19px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON33 {
                width: 170.373px;
                height: 40px;
                top: 0px;
                left: 0px;
            }
            #BUTTON33 > .ladi-button > .ladi-button-background {
                background-color: rgba(255, 255, 255, 0);
            }
            #BUTTON33 > .ladi-button {
                border-style: solid;
                border-color: rgb(244, 221, 156);
                border-width: 1px;
                border-radius: 10px;
            }
            #SHAPE35 {
                width: 25.5705px;
                height: 28.5px;
                top: 8.25px;
                left: 10.58px;
            }
            #SHAPE35 svg:last-child {
                fill: rgba(239, 241, 4, 1);
            }
            #HEADLINE36 {
                width: 347px;
                top: 42.8009px;
                left: 26.0062px;
            }
            #HEADLINE36 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(203, 1, 1);
                font-size: 26px;
                text-align: center;
                line-height: 1.2;
            }
            #SECTION50 {
                height: 3340.68px;
            }
            #SECTION50 > .ladi-section-background {
                background-size: cover;
                background-attachment: fixed;
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.s768x3340.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #SECTION84 {
                height: 705.73px;
            }
            #IMAGE115 {
                width: 420px;
                height: 270.704px;
                top: 19px;
                left: 0px;
            }
            #IMAGE115 > .ladi-image > .ladi-image-background {
                width: 591.746px;
                height: 429.632px;
                top: -89.2498px;
                left: -9.13878px;
                background-image: url("images/artboard-8-1-20210311081032.s900x750.png");
            }
            #IMAGE115 > .ladi-image {
                border-style: dashed;
                border-color: rgb(29, 48, 67);
                border-width: 1px;
            }
            #IMAGE115.ladi-animation > .ladi-image {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #HEADLINE116 {
                width: 407px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE116 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #PARAGRAPH117 {
                width: 421px;
                top: 75.552px;
                left: 0px;
            }
            #PARAGRAPH117 > .ladi-paragraph {
                color: rgb(0, 0, 0);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #SECTION159 {
                height: 1017.77px;
            }
            #SECTION159 > .ladi-section-background {
                background-size: cover;
                background-attachment: fixed;
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.s768x1017.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #SECTION161 {
                height: 981.42px;
            }
            #SECTION161 > .ladi-overlay {
                background-color: rgb(10, 54, 67);
                opacity: 0.96;
            }
            #SECTION161 > .ladi-section-background {
                background-color: rgb(29, 48, 67);
            }
            #HEADLINE266 {
                width: 421px;
                top: 52px;
                left: 0px;
            }
            #HEADLINE266 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #HEADLINE267 {
                width: 421px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE267 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(204, 1, 1);
                font-size: 44px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #HEADLINE280 {
                width: 421px;
                top: 17.66px;
                left: -0.5px;
            }
            #HEADLINE280 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
                padding: 10px;
            }
            #HEADLINE284 {
                width: 420px;
                top: 130.91px;
                left: 0px;
            }
            #HEADLINE284 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                line-height: 1.2;
                padding: 10px;
            }
            #SECTION294 {
                height: 2709.77px;
            }
            #SECTION294 > .ladi-section-background {
                background-size: cover;
                background-attachment: fixed;
                background-image: url("images/f3-f4_cam222-1562656802-20200814095935.s768x2709.png");
                background-position: center top;
                background-repeat: repeat;
            }
            #LINE298 {
                height: 203px;
                top: 120.306px;
                left: 0.25px;
                display: none !important;
            }
            #LINE298 > .ladi-line > .ladi-line-container {
                border-top: 0px !important;
                border-right: 3px solid rgb(46, 150, 112);
                border-bottom: 3px solid rgb(46, 150, 112);
                border-left: 3px solid rgb(46, 150, 112);
            }
            #LINE298 > .ladi-line {
                height: 100%;
                padding: 0px 8px;
            }
            #BOX336 {
                width: 40.4px;
                height: 72px;
                top: 0px;
                left: 10.0865px;
                display: none !important;
            }
            #BOX336 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE338 {
                width: 420px;
                top: 21px;
                left: 0px;
            }
            #HEADLINE338 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #IMAGE339 {
                width: 420px;
                height: 257.669px;
                top: 543.628px;
                left: 0px;
            }
            #IMAGE339 > .ladi-image > .ladi-image-background {
                width: 420px;
                height: 257.669px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_10-20200622074408-20210311141609.s750x600.jpg");
            }
            #IMAGE339 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE339:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE354 {
                width: 420px;
                height: 250.149px;
                top: 283px;
                left: 0px;
            }
            #IMAGE354 > .ladi-image > .ladi-image-background {
                width: 420px;
                height: 250.149px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_3-20200622074408-20210311141609.s750x600.jpg");
            }
            #IMAGE354 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE354:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE359 {
                width: 420px;
                height: 257.67px;
                top: 811.349px;
                left: 0px;
            }
            #IMAGE359 > .ladi-image > .ladi-image-background {
                width: 458.613px;
                height: 287.137px;
                top: 0px;
                left: -36.4963px;
                background-image: url("images/center_park_12-20200622074407-20210311141609.s800x600.jpg");
            }
            #IMAGE359 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE359:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE364 {
                width: 420.238px;
                height: 257.814px;
                top: 1617.61px;
                left: 0.2465px;
            }
            #IMAGE364 > .ladi-image > .ladi-image-background {
                width: 420.238px;
                height: 257.814px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_36-20200622074413-20210311141609.s750x600.jpg");
            }
            #IMAGE364 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE364:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE369 {
                width: 419.746px;
                height: 258.814px;
                top: 1347.98px;
                left: 0.2465px;
            }
            #IMAGE369 > .ladi-image > .ladi-image-background {
                width: 421.871px;
                height: 258.814px;
                top: 0px;
                left: 0px;
                background-image: url("images/center_park_17-20200622074408-20210311141609.s750x600.jpg");
            }
            #IMAGE369 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE369:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE374 {
                width: 420.238px;
                height: 257.814px;
                top: 1080.16px;
                left: 0.0005px;
            }
            #IMAGE374 > .ladi-image > .ladi-image-background {
                width: 420.238px;
                height: 272.517px;
                top: -14.7034px;
                left: 0px;
                background-image: url("images/center_park_15-20200622074408-20210311141610.s750x600.jpg");
            }
            #IMAGE374 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE374:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #HEADLINE426 {
                width: 316px;
                top: 238.921px;
                left: 35.6872px;
            }
            #HEADLINE426 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 14px;
                line-height: 1.6;
            }
            #HEADLINE429 {
                width: 317px;
                top: 499.19px;
                left: 51.2746px;
            }
            #HEADLINE429 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 14px;
                text-align: center;
                line-height: 1.6;
            }
            #BOX430 {
                width: 420px;
                height: 576.21px;
                top: 0px;
                left: 0px;
            }
            #BOX430 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
            }
            #HEADLINE433 {
                width: 310px;
                top: 32.7996px;
                left: 54.6678px;
            }
            #HEADLINE433 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #POPUP437 {
                width: 363.643px;
                height: 444px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP437 > .ladi-popup > .ladi-popup-background {
                background-color: rgb(255, 255, 255);
            }
            #BOX454 {
                width: 363.202px;
                height: 444.443px;
                top: 0px;
                left: 0px;
            }
            #BOX454 > .ladi-box {
                background: rgba(237, 85, 0, 1);
                background: -webkit-linear-gradient(203deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                background: linear-gradient(203deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                border-style: dashed;
                border-color: rgb(0, 0, 0);
                border-width: 1px;
                border-radius: 5px;
            }
            #HEADLINE455 {
                width: 332px;
                top: 26.1811px;
                left: 15.5809px;
            }
            #HEADLINE455 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #FORM_ITEM462 {
                width: 310.727px;
                height: 56.7456px;
                top: 0px;
                left: 0px;
            }
            #BUTTON_TEXT463 {
                width: 311px;
                top: 12.2201px;
                left: 0px;
            }
            #BUTTON_TEXT463 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 18px;
                text-align: center;
                line-height: 2;
            }
            #BUTTON463 {
                width: 311.067px;
                height: 46.5717px;
                top: 283.441px;
                left: 0.392624px;
            }
            #BUTTON463 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 6);
            }
            #BUTTON463 > .ladi-button {
                border-radius: 7px;
            }
            #FORM_ITEM465 {
                width: 310px;
                height: 117px;
                top: 145.306px;
                left: 0px;
            }
            #FORM_ITEM465 .ladi-form-checkbox-item {
                margin: 5px;
            }
            #FORM461 {
                width: 311.616px;
                height: 330.013px;
                top: 96.9876px;
                left: 25.9633px;
            }
            #FORM461 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM461 .ladi-form-item .ladi-form-control::placeholder,
            #FORM461 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM461 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM461 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM461 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM461 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #HEADLINE466 {
                width: 238px;
                top: 127.592px;
                left: 55.6524px;
            }
            #HEADLINE466 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 14px;
                line-height: 1.6;
            }
            #GROUP453 {
                width: 363.202px;
                height: 444.443px;
                top: 0px;
                left: -0.5115px;
            }
            #FORM_ITEM489 {
                width: 343.863px;
                height: 43.6638px;
                top: 0px;
                left: 2.66063px;
            }
            #FORM_ITEM490 {
                width: 343.863px;
                height: 43.6638px;
                top: 51.6113px;
                left: 1.31369px;
            }
            #FORM_ITEM491 {
                width: 343.863px;
                height: 43.6638px;
                top: 103.223px;
                left: 0px;
            }
            #BUTTON_TEXT492 {
                width: 346px;
                top: 7.89104px;
                left: 0px;
            }
            #BUTTON_TEXT492 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #BUTTON492 {
                width: 345.891px;
                height: 52.607px;
                top: 164.379px;
                left: 0px;
            }
            #BUTTON492 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 7);
            }
            #BUTTON492 > .ladi-button {
                border-radius: 5px;
            }
            #FORM488 {
                width: 346.523px;
                height: 216.987px;
                top: 153.5px;
                left: 36.739px;
            }
            #FORM488 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM488 .ladi-form-item .ladi-form-control::placeholder,
            #FORM488 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM488 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM488 .ladi-form-item {
                padding-left: 8px;
                padding-right: 8px;
            }
            #FORM488 .ladi-form-item.ladi-form-checkbox {
                padding-left: 13px;
                padding-right: 13px;
            }
            #FORM488 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM488 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM488 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #HEADLINE499 {
                width: 301px;
                top: 89.5px;
                left: 59.5005px;
            }
            #HEADLINE499 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 23px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #POPUP487 {
                width: 420px;
                height: 414px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP487 > .ladi-popup > .ladi-overlay {
                border-radius: 4px;
            }
            #POPUP487 > .ladi-popup > .ladi-popup-background {
                background: rgba(237, 85, 0, 1);
                background: -webkit-linear-gradient(180deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                background: linear-gradient(180deg, rgba(237, 85, 0, 1), rgba(255, 222, 137, 1));
                border-radius: 4px;
            }
            #POPUP487 > .ladi-popup {
                border-style: dashed;
                border-color: rgb(0, 0, 0);
                border-width: 1px;
                border-radius: 5px;
            }
            #IMAGE579 {
                width: 238.933px;
                height: 49.0231px;
                top: 19.0231px;
                left: 36.314px;
                filter: drop-shadow(rgb(0, 0, 0) 0px 15px 20px);
            }
            #IMAGE579 > .ladi-image > .ladi-image-background {
                width: 238.933px;
                height: 49.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x350.png");
            }
            #IMAGE579 > .ladi-image {
                border-style: double;
                border-color: rgb(255, 222, 137);
                border-width: 0px;
                border-radius: 13px;
            }
            #SECTION581 {
                height: 667.207px;
            }
            #SECTION581 > .ladi-section-background {
                background-image: url("images/chung-cu-vinhomes-smart-city-1-20210311053929.s768x667.jpg");
                background-position: center top;
                background-repeat: no-repeat;
            }
            #LIST_PARAGRAPH585 {
                width: 421px;
                top: 138.565px;
                left: 0px;
            }
            #LIST_PARAGRAPH585 > .ladi-list-paragraph {
                color: rgb(0, 0, 0);
                font-size: 18px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH585 ul li {
                padding-left: 35px;
            }
            #LIST_PARAGRAPH585 ul li:before {
                content: "";
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22100%25%22%20height%3D%22100%25%22%20%20viewBox%3D%220%200%202048.0005%201896.0833%22%20class%3D%22%22%20fill%3D%22rgba(203%2C%201%2C%201%2C%201)%22%3E%20%3Cpath%20d%3D%22M212%20768l623%20665-300-665H212zm812%20772l349-772H675zM538%20640l204-384H480L192%20640h346zm675%20793l623-665h-323zM683%20640h682l-204-384H887zm827%200h346l-288-384h-262zm141-486l384%20512q14%2018%2013%2041.5t-17%2040.5l-960%201024q-18%2020-47%2020t-47-20L17%20748Q1%20731%200%20707.5T13%20666l384-512q18-26%2051-26h1152q33%200%2051%2026z%22%3E%3C%2Fpath%3E%20%3C%2Fsvg%3E");
                width: 20px;
                height: 20px;
                top: 0px;
            }
            #PARAGRAPH586 {
                width: 347px;
                top: 746.645px;
                left: 46.006px;
            }
            #PARAGRAPH586 > .ladi-paragraph {
                color: rgb(0, 0, 0);
                font-size: 18px;
                font-weight: bold;
                font-style: italic;
                text-align: center;
                line-height: 1.6;
            }
            #LINE588 {
                width: 228px;
                top: 718.565px;
                left: 105.506px;
            }
            #LINE588 > .ladi-line > .ladi-line-container {
                border-top: 1px solid rgb(0, 0, 0);
                border-right: 1px solid rgb(0, 0, 0);
                border-bottom: 1px solid rgb(0, 0, 0);
                border-left: 0px !important;
            }
            #LINE588 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE589 {
                width: 228px;
                top: 113.479px;
                left: 91.5062px;
            }
            #LINE589 > .ladi-line > .ladi-line-container {
                border-top: 1px solid rgb(0, 0, 0);
                border-right: 1px solid rgb(0, 0, 0);
                border-bottom: 1px solid rgb(0, 0, 0);
                border-left: 0px !important;
            }
            #LINE589 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #BOX592 {
                width: 420px;
                height: 705.645px;
                top: 0px;
                left: 0px;
            }
            #BOX592 > .ladi-box {
                background-color: rgb(255, 255, 255);
                border-style: double;
                border-color: rgb(255, 222, 137);
                border-width: 1px;
                filter: contrast(95%);
            }
            #FORM_ITEM591 {
                width: 348.442px;
                height: 45.4157px;
                top: 53.1656px;
                left: 0px;
            }
            #FORM418 {
                width: 348.626px;
                height: 363.929px;
                top: 121.395px;
                left: 35.6872px;
            }
            #FORM418 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM418 .ladi-form-item .ladi-form-control::placeholder,
            #FORM418 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM418 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM418 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM418 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM418 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #FORM_ITEM422 {
                width: 348px;
                height: 122px;
                top: 159.62px;
                left: 0.221688px;
            }
            #FORM_ITEM422 .ladi-form-checkbox-item {
                margin: 5px;
            }
            #BUTTON420 {
                width: 291.04px;
                height: 49.2459px;
                top: 314.683px;
                left: 28.8846px;
            }
            #BUTTON420 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON420 > .ladi-button {
                border-radius: 7px;
            }
            #BUTTON_TEXT420 {
                width: 386px;
                top: 9.77382px;
                left: 0px;
            }
            #BUTTON_TEXT420 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #FORM_ITEM419 {
                width: 348.442px;
                height: 45.4157px;
                top: 0px;
                left: 0.183608px;
            }
            #SHAPE594 {
                width: 21.8672px;
                height: 41.7048px;
                top: 438.873px;
                left: 98.582px;
            }
            #SHAPE594 > .ladi-shape {
                opacity: 0.7;
            }
            #SHAPE594 svg:last-child {
                fill: rgba(11, 92, 22, 1);
            }
            #HEADLINE319 {
                width: 420px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE319 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 28px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #LIST_PARAGRAPH114 {
                width: 420px;
                top: 188.9px;
                left: 0px;
            }
            #LIST_PARAGRAPH114 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH114 ul li {
                padding-bottom: 4px;
                padding-left: 28px;
            }
            #LIST_PARAGRAPH114 ul li:before {
                content: "";
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20version%3D%221.1%22%20x%3D%220px%22%20y%3D%220px%22%20viewBox%3D%220%200%20100%20100%22%20enable-background%3D%22new%200%200%20100%20100%22%20xml%3Aspace%3D%22preserve%22%20%20width%3D%22100%25%22%20height%3D%22100%25%22%20class%3D%22%22%20fill%3D%22rgba(239%2C%20241%2C%204%2C%201)%22%3E%3Cpolygon%20points%3D%2248.305%2C35.232%2048.298%2C13%2029.07%2C13%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2248.318%2C82.991%2048.306%2C39%2030.102%2C39%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2227.853%2C39%205.015%2C39%2048.2%2C88.137%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2227%2C37%2027%2C14.125%205.327%2C37%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2246.667%2C37%2029%2C16.261%2029%2C37%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2250.349%2C35.232%2050.354%2C13%2069.583%2C13%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2250.335%2C82.991%2050.348%2C39%2068.551%2C39%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2270.801%2C39%2093.638%2C39%2050.453%2C88.137%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2271%2C37%2071%2C14.125%2093.326%2C37%20%22%3E%3C%2Fpolygon%3E%3Cpolygon%20points%3D%2251.986%2C37%2069%2C16.261%2069%2C37%20%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
                width: 20px;
                height: 20px;
                top: 4px;
            }
            #IMAGE109 {
                width: 400px;
                height: 405.883px;
                top: 505.172px;
                left: -128px;
            }
            #IMAGE109 > .ladi-image > .ladi-image-background {
                width: 400px;
                height: 405.883px;
                top: 0px;
                left: 0px;
                background-image: url("images/a90-1562656441-20200814022442.png");
            }
            #IMAGE109 > .ladi-image {
                opacity: 0.35;
            }
            #SECTION48 {
                height: 942.73px;
            }
            #SECTION48 > .ladi-section-background {
                background-color: rgb(29, 48, 67);
            }
            #GROUP595 {
                width: 421px;
                height: 830.645px;
                top: 0px;
                left: 0px;
            }
            #GROUP595.ladi-animation > .ladi-group {
                animation-name: bounceIn;
                -webkit-animation-name: bounceIn;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP596 {
                width: 420px;
                height: 576.21px;
                top: 851px;
                left: 0px;
            }
            #GROUP596.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #PARAGRAPH597 {
                width: 420px;
                top: 0px;
                left: 0px;
            }
            #PARAGRAPH597 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LINE598 {
                width: 340px;
                top: 47.4918px;
                left: 40px;
            }
            #LINE598 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE598 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #GALLERY599 {
                width: 420px;
                height: 302.775px;
                top: 136.726px;
                left: 0px;
            }
            #GALLERY599 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #GALLERY599 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #GALLERY599 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/vhsmc5_tong-the-hien-gs-20210311075248.s750x650.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/vhsmc5_tong-the-hien-gs-20210311075248.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/phoi_canh_tien_ich_s3_11-20210311075749.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/phoi_canh_tien_ich_s3_11-20210311075749.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/pc1-20210311075749.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/pc1-20210311075749.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
                background-image: url("images/3-khai-truong-cong-vien-trung-tam-1024x576-20210311080048.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
                background-image: url("images/3-khai-truong-cong-vien-trung-tam-1024x576-20210311080048.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
                background-image: url("images/phoi_canh_tien_ich_s3_9-20210311080344.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
                background-image: url("images/phoi_canh_tien_ich_s3_9-20210311080344.s400x400.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
                background-image: url("images/phoi_canh_tien_ich_s3_5-20210311080344.jpg");
            }
            #GALLERY599 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
                background-image: url("images/phoi_canh_tien_ich_s3_5-20210311080344.s400x400.jpg");
            }
            #LINE600 {
                width: 201px;
                top: 45.552px;
                left: 103px;
            }
            #LINE600 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE600 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #HEADLINE602 {
                width: 359px;
                top: 24px;
                left: 30.75px;
            }
            #HEADLINE602 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #HEADLINE602.ladi-animation > .ladi-headline {
                animation-name: fadeInDown;
                -webkit-animation-name: fadeInDown;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #SECTION601 {
                height: 1452.96px;
            }
            #SECTION601 > .ladi-section-background {
                background: #2c902f;
                background: -webkit-linear-gradient(270deg, #2c902f, #4f9fc9);
                background: linear-gradient(270deg, #2c902f, #4f9fc9);
            }
            #PARAGRAPH613 {
                width: 420px;
                top: 71.1297px;
                left: 0px;
            }
            #PARAGRAPH613 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #BOX614 {
                width: 200px;
                height: 200px;
                top: 148px;
                left: 220px;
            }
            #BOX614 > .ladi-box {
                opacity: 0.5;
                background-color: rgb(29, 48, 67);
            }
            #HEADLINE615 {
                width: 316px;
                top: 0px;
                left: 22.1146px;
            }
            #HEADLINE615 > .ladi-headline {
                color: rgb(239, 241, 4);
                font-size: 20px;
                font-weight: bold;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH616 {
                width: 194px;
                top: 203.141px;
                left: 22.1146px;
            }
            #LIST_PARAGRAPH616 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH616 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH616 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #LIST_PARAGRAPH617 {
                width: 184px;
                top: 203.141px;
                left: 228.116px;
            }
            #LIST_PARAGRAPH617 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH617 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH617 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #PARAGRAPH618 {
                width: 420px;
                top: 1038.96px;
                left: 0px;
            }
            #PARAGRAPH618 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #HEADLINE619 {
                width: 408px;
                top: 735.978px;
                left: 0.25px;
            }
            #HEADLINE619 > .ladi-headline {
                color: rgb(239, 241, 4);
                font-size: 20px;
                font-weight: bold;
                text-align: right;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH620 {
                width: 330px;
                top: 1205.96px;
                left: 21px;
            }
            #LIST_PARAGRAPH620 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH620 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH620 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #LIST_PARAGRAPH621 {
                width: 314px;
                top: 1157.96px;
                left: 21px;
            }
            #LIST_PARAGRAPH621 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH621 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH621 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #GALLERY623 {
                width: 420px;
                height: 227.827px;
                top: 104px;
                left: 0.25px;
            }
            #GALLERY623 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 0px);
            }
            #GALLERY623 > .ladi-gallery > .ladi-gallery-control {
                height: 0px;
                display: none;
            }
            #GALLERY623 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 0px;
                height: 0px;
                margin-right: 0px;
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/190104_panorama_san-patin-1-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/190104_panorama_san-patin-1-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/190104_panorama-san-the-thao-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/190104_panorama-san-the-thao-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/190104_panorama_vuon-choi-co-1-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/190104_panorama_vuon-choi-co-1-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
                background-image: url("images/190104_panorama_bbq-1-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
                background-image: url("images/190104_panorama_bbq-1-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
                background-image: url("images/181229_zone01_bbq-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
                background-image: url("images/181229_zone01_bbq-20210311085453.s400x400.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
                background-image: url("images/181229_panorama_xe-dap-dia-hinh-20210311085453.jpg");
            }
            #GALLERY623 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
                background-image: url("images/181229_panorama_xe-dap-dia-hinh-20210311085453.s400x400.jpg");
            }
            #GALLERY624 {
                width: 420px;
                height: 227.827px;
                top: 791.98px;
                left: 0px;
            }
            #GALLERY624 > .ladi-gallery > .ladi-gallery-view {
                left: 0px;
                width: calc(100% - 0px);
            }
            #GALLERY624 > .ladi-gallery > .ladi-gallery-control {
                width: 0px;
                display: none;
            }
            #GALLERY624 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 0px;
                height: 0px;
                margin-bottom: 0px;
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/pc4-20210311092835.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/pc4-20210311092835.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/vuon-nhat-2-20210311085453.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/vuon-nhat-2-20210311085453.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/vuon-nhat-3-20210311085453.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/vuon-nhat-3-20210311085453.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="3"] {
                background-image: url("images/4-20210311094623.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="3"] {
                background-image: url("images/4-20210311094623.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="4"] {
                background-image: url("images/9-20210311094623.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="4"] {
                background-image: url("images/9-20210311094623.s400x400.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-view-item[data-index="5"] {
                background-image: url("images/5-20210311094622.jpg");
            }
            #GALLERY624 .ladi-gallery .ladi-gallery-control-item[data-index="5"] {
                background-image: url("images/5-20210311094622.s400x400.jpg");
            }
            #BOX625 {
                width: 200px;
                height: 200px;
                top: 776.978px;
                left: 0px;
            }
            #BOX625 > .ladi-box {
                opacity: 0.5;
                background-color: rgb(29, 48, 67);
            }
            #SECTION626 {
                height: 481.96px;
            }
            #HEADLINE627 {
                width: 420px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE627 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
                padding: 10px;
            }
            #IMAGE629 {
                width: 420px;
                height: 303.142px;
                top: 147.55px;
                left: 0px;
            }
            #IMAGE629 > .ladi-image > .ladi-image-background {
                width: 420px;
                height: 303.142px;
                top: 0px;
                left: 0px;
                background-image: url("images/mat-bang-tong-the-vinhomes-smart-city-20210311101411.jpg");
            }
            #IMAGE629.ladi-animation > .ladi-image {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #HEADLINE656 {
                width: 420px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE656 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
                padding: 10px;
            }
            #BUTTON150 {
                width: 198px;
                height: 50.5402px;
                top: 2458.92px;
                left: 111px;
                display: none !important;
            }
            #BUTTON150 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON150 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON_TEXT150 {
                width: 198px;
                top: 8.91886px;
                left: 0px;
            }
            #BUTTON_TEXT150 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON154 {
                width: 198px;
                height: 51px;
                top: 152.856px;
                left: 222px;
                display: none !important;
            }
            #BUTTON154 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON154 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON_TEXT154 {
                width: 198px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT154 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON_TEXT134 {
                width: 198px;
                top: 8.91886px;
                left: 0px;
            }
            #BUTTON_TEXT134 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON134 {
                width: 198px;
                height: 50.5402px;
                top: 2421.38px;
                left: 110.73px;
                display: none !important;
            }
            #BUTTON134 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON134 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON_TEXT659 {
                width: 198px;
                top: 8.91886px;
                left: 0px;
            }
            #BUTTON_TEXT659 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON659 {
                width: 198px;
                height: 50.5402px;
                top: 2337.84px;
                left: 111px;
                display: none !important;
            }
            #BUTTON659 > .ladi-button > .ladi-button-background {
                background: #2687c8;
                background: -webkit-linear-gradient(90deg, #2687c8, #35b563);
                background: linear-gradient(90deg, #2687c8, #35b563);
            }
            #BUTTON659 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(255, 222, 136, 1);
                border-radius: 98px;
            }
            #BUTTON224 {
                width: 313px;
                height: 43.3457px;
                top: 381.393px;
                left: 13.9364px;
            }
            #BUTTON224 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON224 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON224.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #BUTTON_TEXT224 {
                width: 300px;
                top: 9.1303px;
                left: 0px;
            }
            #BUTTON_TEXT224 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE220 {
                width: 252px;
                top: 16.8189px;
                left: 13.9364px;
            }
            #HEADLINE220 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BOX217 {
                width: 420px;
                height: 460.997px;
                top: 0px;
                left: 0px;
            }
            #BOX217 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #LIST_PARAGRAPH663 {
                width: 420px;
                top: 67.9523px;
                left: 0px;
            }
            #LIST_PARAGRAPH663 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH663 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH663 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #BOX669 {
                width: 421.87px;
                height: 472.997px;
                top: 0px;
                left: 0px;
            }
            #BOX669 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE671 {
                width: 269px;
                top: 25.104px;
                left: 13.9252px;
            }
            #HEADLINE671 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BUTTON_TEXT672 {
                width: 300px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT672 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON672 {
                width: 313px;
                height: 44.0804px;
                top: 388.908px;
                left: 13.9252px;
            }
            #BUTTON672 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON672 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON672.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #LIST_PARAGRAPH675 {
                width: 420px;
                top: 79.65px;
                left: 0px;
            }
            #LIST_PARAGRAPH675 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH675 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH675 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #BOX678 {
                width: 419.053px;
                height: 491.997px;
                top: 0px;
                left: 0.44768px;
            }
            #BOX678 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE680 {
                width: 262px;
                top: 20.104px;
                left: 14.0062px;
            }
            #HEADLINE680 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BUTTON_TEXT681 {
                width: 300px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT681 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON681 {
                width: 313px;
                height: 44.0804px;
                top: 409.758px;
                left: 14.0653px;
            }
            #BUTTON681 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON681 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON681.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #LIST_PARAGRAPH684 {
                width: 419px;
                top: 72.104px;
                left: 0px;
            }
            #LIST_PARAGRAPH684 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH684 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH684 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #BOX687 {
                width: 420px;
                height: 354.26px;
                top: 0px;
                left: 0px;
            }
            #BOX687 > .ladi-box {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE689 {
                width: 256px;
                top: 23.2839px;
                left: 10.6818px;
            }
            #HEADLINE689 > .ladi-headline {
                color: rgb(255, 222, 136);
                font-size: 20px;
                text-align: left;
                line-height: 1.6;
                padding: 10px;
            }
            #BUTTON_TEXT690 {
                width: 300px;
                top: 6.95511px;
                left: 0px;
            }
            #BUTTON_TEXT690 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON690 {
                width: 313px;
                height: 44.0804px;
                top: 274.04px;
                left: 15.9365px;
            }
            #BUTTON690 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON690 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON690.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #LIST_PARAGRAPH693 {
                width: 420px;
                top: 65.6555px;
                left: 0px;
            }
            #LIST_PARAGRAPH693 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                line-height: 1.6;
                padding: 10px;
            }
            #LIST_PARAGRAPH693 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH693 ul li:before {
                content: counter(linum, disc);
                font-size: 40px;
                top: -20px;
            }
            #SECTION694 {
                height: 359.065px;
            }
            #SECTION694 > .ladi-section-background {
                background-color: rgb(29, 48, 67);
            }
            #HEADLINE695 {
                width: 420px;
                top: 25px;
                left: 0px;
            }
            #HEADLINE695 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(239, 241, 4);
                font-size: 28px;
                text-align: center;
                line-height: 1.4;
            }
            #FORM696 {
                width: 412.609px;
                height: 19.9498px;
                top: 9.77851px;
                left: 12.6337px;
            }
            #FORM696 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 12px;
                line-height: 1.6;
            }
            #FORM696 .ladi-form-item .ladi-form-control::placeholder,
            #FORM696 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM696 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: #000;
            }
            #FORM696 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM696 .ladi-form-item-container {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 1px;
            }
            #FORM696 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #BUTTON697 {
                width: 58.9631px;
                height: 19.8905px;
                top: 0.05933px;
                left: 353.646px;
            }
            #BUTTON697 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON_TEXT697 {
                width: 127px;
                top: 5.1147px;
                left: 0px;
            }
            #BUTTON_TEXT697 > .ladi-headline {
                color: rgb(29, 49, 67);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #FORM_ITEM699 {
                width: 158.747px;
                height: 19.8905px;
                top: 0px;
                left: 0px;
            }
            #FORM_ITEM700 {
                width: 158.747px;
                height: 19.8905px;
                top: 0px;
                left: 176.389px;
            }
            #HEADLINE702 {
                width: 420px;
                top: 117.405px;
                left: 0px;
            }
            #HEADLINE702 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 25px;
                text-align: center;
                line-height: 1.4;
            }
            #BOX716 {
                width: 439.273px;
                height: 39.5067px;
                top: 0px;
                left: 0px;
            }
            #BOX716 > .ladi-box {
                background: #fdfbfb;
                background: -webkit-linear-gradient(180deg, #fdfbfb, #eaedee);
                background: linear-gradient(180deg, #fdfbfb, #eaedee);
            }
            #SECTION717 {
                height: 1855.66px;
            }
            #HEADLINE760 {
                width: 326px;
                top: 131.66px;
                left: -177px;
            }
            #HEADLINE760 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #PARAGRAPH761 {
                width: 313px;
                top: 27.0079px;
                left: 107.629px;
            }
            #PARAGRAPH761 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #GROUP762 {
                width: 85.5017px;
                height: 84.6436px;
                top: 0px;
                left: 0px;
            }
            #BOX763 {
                width: 85.5017px;
                height: 83.3462px;
                top: 0px;
                left: 0px;
            }
            #BOX763 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE764 {
                width: 26.5844px;
                height: 26.5847px;
                top: 9.34054px;
                left: 29.4585px;
            }
            #SHAPE764 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE765 {
                width: 61px;
                top: 36.6436px;
                left: 11.496px;
            }
            #HEADLINE765 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #HEADLINE767 {
                width: 326px;
                top: 131.66px;
                left: 342px;
            }
            #HEADLINE767 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #BOX770 {
                width: 86px;
                height: 83px;
                top: 346px;
                left: 0px;
            }
            #BOX770 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE771 {
                width: 28.0789px;
                height: 27.9698px;
                top: 355.827px;
                left: 31.1144px;
            }
            #SHAPE771 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE772 {
                width: 63px;
                top: 381px;
                left: 11.5px;
            }
            #HEADLINE772 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH802 {
                width: 302px;
                top: 90.9267px;
                left: 107.629px;
            }
            #PARAGRAPH802 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH768 {
                width: 311px;
                top: 368.678px;
                left: 107.629px;
            }
            #PARAGRAPH768 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #PARAGRAPH803 {
                width: 302px;
                top: 422.35px;
                left: 107.629px;
            }
            #PARAGRAPH803 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #HEADLINE821 {
                width: 326px;
                top: 330.66px;
                left: 342px;
            }
            #HEADLINE821 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #PARAGRAPH822 {
                width: 307px;
                top: 772.835px;
                left: 107.629px;
            }
            #PARAGRAPH822 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX824 {
                width: 86px;
                height: 83px;
                top: 752.66px;
                left: 0px;
            }
            #BOX824 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE825 {
                width: 28.1394px;
                height: 28.5829px;
                top: 762.703px;
                left: 31.1815px;
            }
            #SHAPE825 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE826 {
                width: 64px;
                top: 787.66px;
                left: 11px;
            }
            #HEADLINE826 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #HEADLINE827 {
                width: 326px;
                top: 330.66px;
                left: -177px;
            }
            #HEADLINE827 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                letter-spacing: 0px;
                line-height: 1.2;
            }
            #PARAGRAPH828 {
                width: 314px;
                top: 23.1754px;
                left: 107.123px;
            }
            #PARAGRAPH828 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX830 {
                width: 86px;
                height: 83px;
                top: 0px;
                left: 0px;
            }
            #BOX830 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE831 {
                width: 33.3072px;
                height: 28.5829px;
                top: 10.8152px;
                left: 26.3464px;
            }
            #SHAPE831 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE832 {
                width: 76px;
                top: 35px;
                left: 5px;
            }
            #HEADLINE832 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH833 {
                width: 302px;
                top: 78.0237px;
                left: 107.123px;
            }
            #PARAGRAPH833 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH834 {
                width: 299px;
                top: 831.684px;
                left: 107.629px;
            }
            #PARAGRAPH834 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH837 {
                width: 306px;
                top: 1229.16px;
                left: 107.629px;
            }
            #PARAGRAPH837 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX839 {
                width: 86px;
                height: 83px;
                top: 1212.66px;
                left: -0.0005px;
            }
            #BOX839 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE840 {
                width: 28.0321px;
                height: 28.032px;
                top: 1223.63px;
                left: 30.2947px;
            }
            #SHAPE840 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE841 {
                width: 63px;
                top: 1247.66px;
                left: 12.8107px;
            }
            #HEADLINE841 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH843 {
                width: 307px;
                top: 1024.64px;
                left: 107.629px;
            }
            #PARAGRAPH843 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX845 {
                width: 86px;
                height: 83px;
                top: 996.66px;
                left: 0.7735px;
            }
            #BOX845 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE846 {
                width: 33.2762px;
                height: 33.2762px;
                top: 1003.35px;
                left: 27.5064px;
            }
            #SHAPE846 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE847 {
                width: 75px;
                top: 1031.66px;
                left: 6.2735px;
            }
            #HEADLINE847 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH848 {
                width: 302px;
                top: 1087.49px;
                left: 107.629px;
            }
            #PARAGRAPH848 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH849 {
                width: 302px;
                top: 1290.18px;
                left: 107.629px;
            }
            #PARAGRAPH849 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH852 {
                width: 308px;
                top: 1677.74px;
                left: 107.629px;
            }
            #PARAGRAPH852 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX854 {
                width: 84.9888px;
                height: 83px;
                top: 1655.66px;
                left: 0px;
            }
            #BOX854 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE855 {
                width: 28.1338px;
                height: 28.4686px;
                top: 1666.43px;
                left: 29.7229px;
            }
            #SHAPE855 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE856 {
                width: 63px;
                top: 1690.66px;
                left: 12.166px;
            }
            #HEADLINE856 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH858 {
                width: 308px;
                top: 1491.66px;
                left: 107.629px;
            }
            #PARAGRAPH858 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: left;
                line-height: 1.4;
            }
            #BOX860 {
                width: 86px;
                height: 83px;
                top: 1462.66px;
                left: 0.0005px;
            }
            #BOX860 > .ladi-box {
                background: #29a9e0;
                background: -webkit-linear-gradient(90deg, #29a9e0, #00a44f);
                background: linear-gradient(90deg, #29a9e0, #00a44f);
                border-radius: 5px;
            }
            #SHAPE861 {
                width: 33.3441px;
                height: 32.7602px;
                top: 1470.17px;
                left: 27.6391px;
            }
            #SHAPE861 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #HEADLINE862 {
                width: 76px;
                top: 1497.66px;
                left: 6.3112px;
            }
            #HEADLINE862 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1;
            }
            #PARAGRAPH863 {
                width: 303px;
                top: 1528.41px;
                left: 107.629px;
            }
            #PARAGRAPH863 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #PARAGRAPH864 {
                width: 302px;
                top: 1711.06px;
                left: 107.629px;
            }
            #PARAGRAPH864 > .ladi-paragraph {
                font-family: "Roboto", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 16px;
                text-align: justify;
                line-height: 1.4;
            }
            #LINE868 {
                height: 231px;
                top: 1106.96px;
                left: 235.154px;
                display: none !important;
            }
            #LINE868 > .ladi-line > .ladi-line-container {
                border-top: 0px !important;
                border-right: 3px solid rgba(255, 222, 137, 0.8);
                border-bottom: 3px solid rgba(255, 222, 137, 0.8);
                border-left: 3px solid rgba(255, 222, 137, 0.8);
            }
            #LINE868 > .ladi-line {
                height: 100%;
                padding: 0px 8px;
            }
            #HEADLINE869 {
                width: 263px;
                top: 1236.35px;
                left: 168.5px;
                display: none !important;
            }
            #HEADLINE869 > .ladi-headline {
                transform: rotate(90deg);
                -webkit-transform: rotate(90deg);
                color: rgb(10, 54, 67);
                font-size: 17px;
                text-align: left;
                line-height: 1.4;
            }
            #IMAGE875 {
                width: 419.992px;
                height: 258.813px;
                top: 2154.33px;
                left: 0.2465px;
            }
            #IMAGE875 > .ladi-image > .ladi-image-background {
                width: 421.871px;
                height: 258.813px;
                top: 0px;
                left: 0px;
                background-image: url("images/73c394507fd68088d9c7-20200923035507-20210311145359.jpg");
            }
            #IMAGE875 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE875:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE879 {
                width: 420.238px;
                height: 257.815px;
                top: 2425.33px;
                left: 0px;
            }
            #IMAGE879 > .ladi-image > .ladi-image-background {
                width: 420.238px;
                height: 272.518px;
                top: -14.7034px;
                left: 0px;
                background-image: url("images/00e3e6770df1f2afabe0-20200923035507-20210311145359.jpg");
            }
            #IMAGE879 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE879:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE883 {
                width: 420.238px;
                height: 257.814px;
                top: 1885.61px;
                left: 0.2465px;
            }
            #IMAGE883 > .ladi-image > .ladi-image-background {
                width: 420.238px;
                height: 257.814px;
                top: 0px;
                left: 0px;
                background-image: url("images/a36dc5fb2e7dd123886c-20200923035507-20210311145359.jpg");
            }
            #IMAGE883 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE883:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #GROUP894 {
                width: 439.273px;
                height: 39.5067px;
                top: 68.7413px;
                left: -13.2728px;
                display: none !important;
            }
            #BOX896 {
                width: 944px;
                height: 84.9px;
                top: 0px;
                left: 0px;
            }
            #BOX896 > .ladi-box {
                background: #fdfbfb;
                background: -webkit-linear-gradient(180deg, #fdfbfb, #eaedee);
                background: linear-gradient(180deg, #fdfbfb, #eaedee);
                border-style: dashed;
                border-color: rgb(0, 0, 0);
                border-width: 1px;
                border-radius: 5px;
            }
            #BUTTON_TEXT898 {
                width: 127px;
                top: 10.9915px;
                left: 0px;
            }
            #BUTTON_TEXT898 > .ladi-headline {
                color: rgb(29, 49, 67);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON898 {
                width: 126.712px;
                height: 42.7447px;
                top: 0.1275px;
                left: 759.987px;
            }
            #BUTTON898 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #FORM_ITEM900 {
                width: 341.148px;
                height: 42.7447px;
                top: 0px;
                left: 0px;
            }
            #FORM_ITEM901 {
                width: 341.148px;
                height: 42.7447px;
                top: 0px;
                left: 379.061px;
            }
            #FORM897 {
                width: 886.699px;
                height: 42.8722px;
                top: 21.014px;
                left: 27.15px;
            }
            #FORM897 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 12px;
                line-height: 1.6;
            }
            #FORM897 .ladi-form-item .ladi-form-control::placeholder,
            #FORM897 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM897 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: #000;
            }
            #FORM897 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20%23000%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM897 .ladi-form-item-container {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 1px;
            }
            #FORM897 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #GROUP895 {
                width: 944px;
                height: 84.9px;
                top: 181.91px;
                left: -270px;
                display: none !important;
            }
            #SECTION902 {
                height: 478.998px;
            }
            #HEADLINE903 {
                width: 420px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE903 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(57, 130, 102);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.4;
            }
            #IMAGE910 {
                width: 419.258px;
                height: 224.131px;
                top: 148.933px;
                left: 0px;
            }
            #IMAGE910 > .ladi-image > .ladi-image-background {
                width: 419.258px;
                height: 224.131px;
                top: 0px;
                left: 0px;
                background-image: url("images/bang-gia1-vinhomes-smart-city-ngoquocdungcom_-20200729075632-20210311154418.png");
            }
            #IMAGE910.ladi-animation > .ladi-image {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #BUTTON_TEXT917 {
                width: 435px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT917 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON917 {
                width: 275.887px;
                height: 51px;
                top: 392.791px;
                left: 72.0565px;
            }
            #BUTTON917 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON917 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON917.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: infinite;
                -webkit-animation-iteration-count: infinite;
            }
            #PARAGRAPH919 {
                width: 420px;
                top: 1278.96px;
                left: 0px;
            }
            #PARAGRAPH919 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #PARAGRAPH920 {
                width: 420px;
                top: 103px;
                left: 0px;
            }
            #PARAGRAPH920 > .ladi-paragraph {
                color: rgb(0, 0, 0);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
                padding: 10px;
            }
            #IMAGE927 {
                width: 420px;
                height: 256.567px;
                top: 491.531px;
                left: 0px;
            }
            #IMAGE927 > .ladi-image > .ladi-image-background {
                width: 420px;
                height: 256.567px;
                top: 0px;
                left: 0px;
                background-image: url("images/8648873e14b8ebe6b2a9-20200923035127-20210311161028.jpg");
            }
            #IMAGE927 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE927:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE931 {
                width: 420px;
                height: 257.669px;
                top: 760.098px;
                left: 0px;
            }
            #IMAGE931 > .ladi-image > .ladi-image-background {
                width: 420px;
                height: 272.364px;
                top: -14.6951px;
                left: 0px;
                background-image: url("images/60146667f5e10abf53f0-20200923035128-20210311161028.jpg");
            }
            #IMAGE931 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE931:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #IMAGE935 {
                width: 420px;
                height: 252.21px;
                top: 228.81px;
                left: 0px;
            }
            #IMAGE935 > .ladi-image > .ladi-image-background {
                width: 420px;
                height: 252.21px;
                top: 0px;
                left: 0px;
                background-image: url("images/01332040b3c64c9815d7-20200923035126-20210311161028.jpg");
            }
            #IMAGE935 > .ladi-image {
                border-radius: 6px;
            }
            #IMAGE935:hover > .ladi-image {
                transform: scale(0.9);
                -webkit-transform: scale(0.9);
            }
            #GROUP936 {
                width: 420px;
                height: 67.4918px;
                top: 36px;
                left: 0px;
            }
            #GROUP936 > .ladi-group {
                padding: 10px;
            }
            #GROUP936.ladi-animation > .ladi-group {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP937 {
                width: 420px;
                height: 490.9px;
                top: 450.83px;
                left: 0px;
            }
            #GROUP937.ladi-animation > .ladi-group {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP938 {
                width: 421px;
                height: 370.552px;
                top: 317.814px;
                left: 0px;
            }
            #GROUP938.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP939 {
                width: 420px;
                height: 347.141px;
                top: 0px;
                left: 0px;
            }
            #GROUP939.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #LINE941 {
                height: 203px;
                top: 0px;
                left: 90.7871px;
            }
            #LINE941 > .ladi-line > .ladi-line-container {
                border-top: 0px !important;
                border-right: 3px solid rgba(255, 222, 137, 0.7);
                border-bottom: 3px solid rgba(255, 222, 137, 0.7);
                border-left: 3px solid rgba(255, 222, 137, 0.7);
            }
            #LINE941 > .ladi-line {
                height: 100%;
                padding: 0px 8px;
            }
            #HEADLINE942 {
                width: 240px;
                top: 122.41px;
                left: 0px;
            }
            #HEADLINE942 > .ladi-headline {
                transform: rotate(90deg);
                -webkit-transform: rotate(90deg);
                color: rgb(10, 54, 67);
                font-size: 17px;
                text-align: left;
                line-height: 1.4;
            }
            #GROUP943 {
                width: 420px;
                height: 347.141px;
                top: 352px;
                left: 0px;
            }
            #GROUP943 > .ladi-group {
                padding: 10px;
            }
            #GROUP943.ladi-animation > .ladi-group {
                animation-name: fadeInRight;
                -webkit-animation-name: fadeInRight;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #LINE945 {
                width: 271px;
                top: 70px;
                left: 74.75px;
            }
            #LINE945 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE945 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE946 {
                width: 211px;
                top: 93.55px;
                left: 0px;
            }
            #LINE946 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE946 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE947 {
                width: 218px;
                top: 91.8559px;
                left: 0px;
            }
            #LINE947 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE947 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE948 {
                width: 195px;
                top: 84px;
                left: 112.5px;
            }
            #LINE948 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE948 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE949 {
                width: 195px;
                top: 91.66px;
                left: 112.471px;
            }
            #LINE949 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE949 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE950 {
                width: 153px;
                top: 72px;
                left: 133.5px;
            }
            #LINE950 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE950 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #LINE951 {
                width: 271px;
                top: 116.66px;
                left: 66.5px;
            }
            #LINE951 > .ladi-line > .ladi-line-container {
                border-top: 4px solid rgb(239, 241, 4);
                border-right: 4px solid rgb(239, 241, 4);
                border-bottom: 4px solid rgb(239, 241, 4);
                border-left: 0px !important;
            }
            #LINE951 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #GROUP952 {
                width: 420px;
                height: 113.55px;
                top: 21px;
                left: 0px;
            }
            #GROUP952.ladi-animation > .ladi-group {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP954 {
                width: 420px;
                height: 111.856px;
                top: 31px;
                left: 0px;
            }
            #GROUP954.ladi-animation > .ladi-group {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP955 {
                width: 420px;
                height: 104px;
                top: 26px;
                left: 0.371px;
            }
            #GROUP955.ladi-animation > .ladi-group {
                animation-name: fadeInLeft;
                -webkit-animation-name: fadeInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #GROUP956 {
                width: 421px;
                height: 111.66px;
                top: 10px;
                left: 0px;
            }
            #GROUP956.ladi-animation > .ladi-group {
                animation-name: fadeInUp;
                -webkit-animation-name: fadeInUp;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #FORM_ITEM961 {
                width: 311.616px;
                height: 55.2652px;
                top: 72.2294px;
                left: 0px;
            }
            #IMAGE962 {
                width: 200px;
                height: 49.0231px;
                top: 49.9885px;
                left: 110px;
            }
            #IMAGE962 > .ladi-image > .ladi-image-background {
                width: 200px;
                height: 49.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x350.png");
            }
            #BOX963 {
                width: 339px;
                height: 49px;
                top: 28.3325px;
                left: 40.5px;
            }
            #BOX963 > .ladi-box {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 2px;
            }
            #BOX964 {
                width: 339px;
                height: 49px;
                top: 638.421px;
                left: 40.5px;
            }
            #BOX964 > .ladi-box {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 2px;
            }
            #BOX965 {
                width: 339px;
                height: 49px;
                top: 325.421px;
                left: 40.5px;
            }
            #BOX965 > .ladi-box {
                border-style: double;
                border-color: rgb(239, 241, 4);
                border-width: 2px;
            }
            #FORM286 {
                width: 300.973px;
                height: 165.375px;
                top: 61.023px;
                left: 19.514px;
            }
            #FORM286 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM286 .ladi-form-item .ladi-form-control::placeholder,
            #FORM286 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM286 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM286 .ladi-form-item {
                padding-left: 8px;
                padding-right: 8px;
            }
            #FORM286 .ladi-form-item.ladi-form-checkbox {
                padding-left: 13px;
                padding-right: 13px;
            }
            #FORM286 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM286 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM286 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #BUTTON290 {
                width: 300.973px;
                height: 52.607px;
                top: 112.768px;
                left: 0px;
            }
            #BUTTON290 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON290 > .ladi-button {
                border-radius: 5px;
            }
            #BUTTON_TEXT290 {
                width: 301px;
                top: 7.89104px;
                left: 0px;
            }
            #BUTTON_TEXT290 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 14px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #FORM_ITEM289 {
                width: 299.208px;
                height: 43.6638px;
                top: 51.6117px;
                left: 0px;
            }
            #FORM_ITEM288 {
                width: 299.208px;
                height: 43.6638px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE966 {
                width: 340px;
                top: 337.421px;
                left: 40px;
            }
            #HEADLINE966 > .ladi-headline {
                color: rgb(250, 239, 210);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE967 {
                width: 286px;
                top: 39.7533px;
                left: 67px;
            }
            #HEADLINE967 > .ladi-headline {
                color: rgb(250, 239, 210);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE968 {
                width: 339px;
                top: 650.421px;
                left: 40.5px;
            }
            #HEADLINE968 > .ladi-headline {
                color: rgb(250, 239, 210);
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #IMAGE969 {
                width: 248.957px;
                height: 61.0231px;
                top: 94.3325px;
                left: 85.5215px;
            }
            #IMAGE969 > .ladi-image > .ladi-image-background {
                width: 248.957px;
                height: 61.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x400.png");
            }
            #HEADLINE970 {
                width: 305px;
                top: 164.754px;
                left: 57.5px;
            }
            #HEADLINE970 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #PARAGRAPH971 {
                width: 400px;
                top: 224.754px;
                left: 10px;
            }
            #PARAGRAPH971 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 19px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #PARAGRAPH972 {
                width: 253px;
                top: 264.754px;
                left: 83.5px;
            }
            #PARAGRAPH972 > .ladi-paragraph {
                color: rgb(239, 241, 4);
                font-size: 28px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH973 {
                width: 340px;
                top: 705.421px;
                left: 40.5px;
            }
            #LIST_PARAGRAPH973 > .ladi-list-paragraph {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: justify;
                line-height: 1.6;
            }
            #LIST_PARAGRAPH973 ul li {
                padding-left: 20px;
            }
            #LIST_PARAGRAPH973 ul li:before {
                content: counter(linum, disc);
                color: rgba(239, 241, 4, 1);
                font-size: 30px;
                top: -10px;
            }
            #HEADLINE974 {
                width: 359px;
                top: 155.79px;
                left: 31.0573px;
            }
            #HEADLINE974 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 30px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
                text-shadow: rgb(0, 0, 0) 1px 2px 3px;
            }
            #HEADLINE976 {
                width: 400px;
                top: 353px;
                left: 10.5px;
            }
            #HEADLINE976 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 235, 62);
                font-size: 48px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
                text-shadow: rgb(0, 0, 0) 1px 2px 3px;
            }
            #HEADLINE976.ladi-animation > .ladi-headline {
                animation-name: bounceInLeft;
                -webkit-animation-name: bounceInLeft;
                animation-delay: 1s;
                -webkit-animation-delay: 1s;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #BOX977 {
                width: 400px;
                height: 207px;
                top: 138px;
                left: 10.5px;
            }
            #BOX977 > .ladi-box {
                opacity: 0.7;
                background-color: rgb(189, 189, 189);
                border-style: solid;
                border-color: rgb(255, 235, 63);
                border-width: 3px;
                border-radius: 30px;
            }
            #PARAGRAPH978 {
                width: 339px;
                top: 0px;
                left: 0px;
            }
            #PARAGRAPH978 > .ladi-paragraph {
                color: rgb(255, 255, 255);
                font-size: 15px;
                text-align: center;
                line-height: 1.6;
            }
            #GROUP979 {
                width: 339px;
                height: 226.398px;
                top: 394.023px;
                left: 40px;
            }
            #HEADLINE980 {
                width: 359px;
                top: 195px;
                left: 31.814px;
            }
            #HEADLINE980 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(255, 235, 62);
                font-size: 47px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
                text-shadow: rgb(0, 0, 0) 1px 2px 3px;
            }
            #BUTTON_TEXT991 {
                width: 300px;
                top: 9.28506px;
                left: 0px;
            }
            #BUTTON_TEXT991 > .ladi-headline {
                color: rgb(10, 54, 67);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON991 {
                width: 301.574px;
                height: 44.207px;
                top: 505px;
                left: 59.713px;
            }
            #BUTTON991 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON991 > .ladi-button {
                box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                -webkit-box-shadow: 0px 0px 5px 0px rgba(250, 239, 210, 1);
                border-style: solid;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
                border-radius: 8px;
            }
            #BUTTON991.ladi-animation > .ladi-button {
                animation-name: pulse;
                -webkit-animation-name: pulse;
                animation-delay: 0.2s;
                -webkit-animation-delay: 0.2s;
                animation-duration: 2s;
                -webkit-animation-duration: 2s;
                animation-iteration-count: 1;
                -webkit-animation-iteration-count: 1;
            }
            #HEADLINE580 {
                width: 83px;
                top: 10.023px;
                left: 17.5px;
                display: none !important;
            }
            #HEADLINE580 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #HEADLINE27 {
                width: 99px;
                top: 18.0231px;
                left: 31.314px;
                display: none !important;
            }
            #HEADLINE27 > .ladi-headline {
                font-family: "Quicksand", sans-serif;
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #SHAPE994 {
                width: 25.9314px;
                height: 25.388px;
                top: 7.37512px;
                left: 6.70511px;
            }
            #SHAPE994 svg:last-child {
                fill: rgba(255, 255, 255, 1);
            }
            #BOX995 {
                width: 95.447px;
                height: 39.9346px;
                top: 0px;
                left: 0px;
            }
            #BOX995 > .ladi-box {
                border-style: double;
                border-color: rgb(255, 255, 255);
                border-width: 1px;
            }
            #HEADLINE996 {
                width: 48px;
                top: 7.0851px;
                left: 37.9455px;
            }
            #HEADLINE996 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 16px;
                text-align: center;
                line-height: 1.6;
            }

            #GROUP998 {
                width: 95.447px;
                height: 39.9346px;
                top: 23.5673px;
                left: 310.553px;
            }
            #GROUP940 {
                width: 240px;
                height: 203px;
                top: 142.306px;
                left: 90.6971px;
                display: none !important;
            }
            #FORM_ITEM1021 {
                width: 351.897px;
                height: 43.6639px;
                top: 0px;
                left: 0px;
            }
            #FORM_ITEM1022 {
                width: 351.897px;
                height: 43.6639px;
                top: 51.6118px;
                left: 0px;
            }
            #BUTTON_TEXT1023 {
                width: 301px;
                top: 7.89105px;
                left: 0px;
            }
            #BUTTON_TEXT1023 > .ladi-headline {
                font-family: "Open Sans", sans-serif;
                color: rgb(36, 36, 36);
                font-size: 18px;
                font-weight: bold;
                text-align: center;
                line-height: 2;
            }
            #BUTTON1023 {
                width: 353.973px;
                height: 44px;
                top: 112.768px;
                left: 0px;
            }
            #BUTTON1023 > .ladi-button > .ladi-button-background {
                background: #ffe259;
                background: -webkit-linear-gradient(180deg, #ffe259, #ffa751);
                background: linear-gradient(180deg, #ffe259, #ffa751);
            }
            #BUTTON1023 > .ladi-button {
                border-radius: 5px;
            }
            #FORM1020 {
                width: 353.973px;
                height: 156.768px;
                top: 171.517px;
                left: 33.0135px;
            }
            #FORM1020 > .ladi-form {
                color: rgb(0, 0, 0);
                font-size: 14px;
                line-height: 1;
            }
            #FORM1020 .ladi-form-item .ladi-form-control::placeholder,
            #FORM1020 .ladi-form .ladi-form-item .ladi-form-control-select[data-selected=""],
            #FORM1020 .ladi-form .ladi-form-item.ladi-form-checkbox .ladi-form-checkbox-item span[data-checked="false"] {
                color: rgba(0, 0, 0, 1);
            }
            #FORM1020 .ladi-form-item {
                padding-left: 8px;
                padding-right: 8px;
            }
            #FORM1020 .ladi-form-item.ladi-form-checkbox {
                padding-left: 13px;
                padding-right: 13px;
            }
            #FORM1020 .ladi-form-item-container .ladi-form-item .ladi-form-control-select {
                background-image: url("data:image/svg+xml;utf8, %3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20version%3D%221.1%22%20width%3D%2232%22%20height%3D%2224%22%20viewBox%3D%220%200%2032%2024%22%3E%3Cpolygon%20points%3D%220%2C0%2032%2C0%2016%2C24%22%20style%3D%22fill%3A%20rgba(0%2C0%2C0%2C1)%22%3E%3C%2Fpolygon%3E%3C%2Fsvg%3E");
            }
            #FORM1020 .ladi-form-item-container {
                border-style: solid;
                border-color: rgb(47, 161, 120);
                border-width: 2px;
            }
            #FORM1020 .ladi-form-item-background {
                background-color: rgb(255, 255, 255);
            }
            #GROUP1033 {
                width: 420.629px;
                height: 200.927px;
                top: 148.66px;
                left: 0.371px;
            }
            #GROUP1035 {
                width: 421.123px;
                height: 188.024px;
                top: 547.66px;
                left: 0.371px;
            }
            #SECTION1050 {
                height: 0.965px;
            }
            #GROUP1052 {
                width: 170.373px;
                height: 40px;
                top: 10.023px;
                left: -219.186px;
                display: none !important;
            }
            #BUTTON_TEXT1054 {
                width: 168px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT1054 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 19px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON1054 {
                width: 170.373px;
                height: 40px;
                top: 0px;
                left: 0px;
            }
            #BUTTON1054 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 7);
            }
            #BUTTON1054 > .ladi-button {
                border-style: solid;
                border-color: rgb(244, 221, 156);
                border-width: 1px;
                border-radius: 10px 0px 0px 10px;
            }
            #SHAPE1056 {
                width: 25.5705px;
                height: 28.5px;
                top: 8.25px;
                left: 10.58px;
            }
            #SHAPE1056 svg:last-child {
                fill: rgba(239, 241, 4, 1);
            }
            #BUTTON_TEXT1059 {
                width: 168px;
                top: 9px;
                left: 0px;
            }
            #BUTTON_TEXT1059 > .ladi-headline {
                color: rgb(255, 255, 255);
                font-size: 19px;
                text-align: center;
                line-height: 1.6;
            }
            #BUTTON1059 {
                width: 170.373px;
                height: 40px;
                top: 0px;
                left: 170.37px;
            }
            #BUTTON1059 > .ladi-button > .ladi-button-background {
                background-color: rgb(246, 19, 7);
            }
            #BUTTON1059 > .ladi-button {
                border-style: solid;
                border-color: rgb(244, 221, 156);
                border-width: 1px;
                border-radius: 0px 10px 10px 0px;
            }
            #GROUP1061 {
                width: 340.743px;
                height: 40px;
                top: auto;
                left: auto;
                bottom: 20px;
                right: 10px;
                position: fixed;
                z-index: 90000050;
                margin-right: calc((100% - 420px) / 2);
            }
            #POPUP1071 {
                width: 375px;
                height: 251px;
                top: 0px;
                left: 0px;
                bottom: 0px;
                right: 0px;
                margin: auto;
            }
            #POPUP1071 > .ladi-popup > .ladi-overlay {
                background-size: cover;
                background-attachment: scroll;
                background-origin: content-box;
                background-image: url("images/bg-2.png");
                background-position: center top;
                background-repeat: no-repeat;
            }
            #POPUP1071 > .ladi-popup > .ladi-popup-background {
                background-color: rgb(255, 255, 255);
            }
            #BOX1073 {
                width: 48px;
                height: 48px;
                top: 0px;
                left: 0px;
            }
            #BOX1073 > .ladi-box {
                border-style: solid;
                border-color: rgb(246, 81, 31);
                border-width: 2px;
                border-radius: 50px;
            }
            #SHAPE1074 {
                width: 26px;
                height: 26px;
                top: 14px;
                left: 13px;
            }
            #SHAPE1074 svg:last-child {
                fill: #f6511f;
            }
            #PARAGRAPH1075 {
                width: 271px;
                top: 164px;
                left: 53px;
            }
            #PARAGRAPH1075 > .ladi-paragraph {
                font-family: "Itim", cursive;
                color: rgb(74, 74, 74);
                font-size: 16px;
                text-align: left;
                line-height: 1.2;
            }
            #LINE1076 {
                width: 64px;
                top: 131px;
                left: 155.5px;
            }
            #LINE1076 > .ladi-line > .ladi-line-container {
                border-top: 3px dotted rgb(74, 74, 74);
                border-right: 3px dotted rgb(74, 74, 74);
                border-bottom: 3px dotted rgb(74, 74, 74);
                border-left: 0px !important;
            }
            #LINE1076 > .ladi-line {
                width: 100%;
                padding: 8px 0px;
            }
            #GROUP1077 {
                width: 305px;
                height: 30px;
                top: 78px;
                left: 36px;
            }
            #HEADLINE1078 {
                width: 164px;
                top: 0px;
                left: 141px;
            }
            #HEADLINE1078 > .ladi-headline {
                font-family: "Itim", cursive;
                color: rgb(246, 81, 31);
                font-size: 30px;
                text-align: left;
                line-height: 1;
            }
            #HEADLINE1079 {
                width: 132px;
                top: 0px;
                left: 0px;
            }
            #HEADLINE1079 > .ladi-headline {
                font-family: "Itim", cursive;
                color: rgb(74, 74, 74);
                font-size: 30px;
                text-align: right;
                line-height: 1;
            }
            #GROUP1080 {
                width: 48px;
                height: 48px;
                top: 20px;
                left: 163.5px;
            }
            #HEADLINE1004 {
                width: 420px;
                top: 128.5px;
                left: 0px;
            }
            #HEADLINE1004 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #IMAGE1005 {
                width: 200px;
                height: 49.0231px;
                top: 40.9885px;
                left: 110px;
            }
            #IMAGE1005 > .ladi-image > .ladi-image-background {
                width: 200px;
                height: 49.0231px;
                top: 0px;
                left: 0px;
                background-image: url("images/logo-20210311032311.s550x350.png");
            }
            #POPUP1003 {
                width: 420px;
                height: 390px;
                top: 0px;
                left: 0px;
                bottom: 0px;

                right: 0px;
                margin: auto;
            }
            #POPUP1003 > .ladi-popup > .ladi-popup-background {
                background: rgba(57, 130, 102, 1);
                background: -webkit-linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
                background: linear-gradient(180deg, rgba(57, 130, 102, 1), rgba(10, 54, 67, 1));
            }
            #HEADLINE1006 {
                width: 420px;
                top: 179.5px;
                left: 0px;
            }
            #HEADLINE1006 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE1007 {
                width: 420px;
                top: 276.5px;
                left: 0px;
            }
            #HEADLINE1007 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE1008 {
                width: 420px;
                top: 228px;
                left: 0px;
            }
            #HEADLINE1008 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #HEADLINE1009 {
                width: 420px;
                top: 324.5px;
                left: 0px;
            }
            #HEADLINE1009 > .ladi-headline {
                font-family: "Oswald", sans-serif;
                color: rgb(250, 239, 210);
                font-size: 22px;
                font-weight: bold;
                text-align: center;
                line-height: 1.6;
            }
            #S1 {
                width: 420px;
                height: 460.997px;
                top: 160.856px;
                left: 0px;
            }
            #S2 {
                width: 421.87px;
                height: 472.997px;
                top: 963.85px;
                left: 0px;
            }
            #S3 {
                width: 419.501px;
                height: 491.997px;
                top: 1789.53px;
                left: 0.5px;
            }
            #S4 {
                width: 420px;
                height: 354.26px;
                top: 2630.25px;
                left: 0.27px;
            }
            #AS4 {
                width: 419.585px;
                height: 341.94px;
                top: 2984.51px;
                left: 0px;
            }
            #AS4 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS4 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS4 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS4 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/823b330a56d7ad89f4c6-1536x862-20210311115938.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/823b330a56d7ad89f4c6-1536x862-20210311115938.s400x400.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/s402-1536x1009-20210311115937.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/s402-1536x1009-20210311115937.s400x400.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/mat-bang-tang-3-35-toa-s403-vinhomes-smart-city-20210311120108.jpg");
            }
            #AS4 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/mat-bang-tang-3-35-toa-s403-vinhomes-smart-city-20210311120108.s400x400.jpg");
            }
            #AS3 {
                width: 420.54px;
                height: 342.718px;
                top: 2287.53px;
                left: 0px;
            }
            #AS3 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS3 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS3 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS3 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/s301-20210311121940.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/s301-20210311121940.s400x400.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/s302-20210311121940.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/s302-20210311121940.s400x400.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/mat-bang-toa-s303-vinhomes-smart-city-20210311121939.jpg");
            }
            #AS3 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/mat-bang-toa-s303-vinhomes-smart-city-20210311121939.s400x400.jpg");
            }
            #AS1 {
                width: 418.983px;
                height: 342.69px;
                top: 621.16px;
                left: 0.5215px;
            }
            #AS1 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS1 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS1 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS1 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/604978159064d900205b344f/s102-20210311113823.jpg");
            }
            #AS1 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/s102-20210311113823.s400x400.jpg");
            }
            #AS1 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/mb-s106-h06-20210311113823.jpg");
            }
            #AS1 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/mb-s106-h06-20210311113823.s400x400.jpg");
            }
            #AS2 {
                width: 419.053px;
                height: 341.506px;
                top: 1442.02px;
                left: 0.94768px;
            }
            #AS2 > .ladi-gallery > .ladi-gallery-view {
                height: calc(100% - 85px);
            }
            #AS2 > .ladi-gallery > .ladi-gallery-control {
                height: 80px;
            }
            #AS2 > .ladi-gallery > .ladi-gallery-control > .ladi-gallery-control-box > .ladi-gallery-control-item {
                width: 80px;
                height: 80px;
                margin-right: 5px;
            }
            #AS2 .ladi-gallery .ladi-gallery-view-item[data-index="0"] {
                background-image: url("images/mb-s201-h07-20210311123042.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-control-item[data-index="0"] {
                background-image: url("images/mb-s201-h07-20210311123042.s400x400.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-view-item[data-index="1"] {
                background-image: url("images/mat-bang-tang-2-35-toa-s202-vinhomes-smart-city-20210311123041.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-control-item[data-index="1"] {
                background-image: url("images/mat-bang-tang-2-35-toa-s202-vinhomes-smart-city-20210311123041.s400x400.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-view-item[data-index="2"] {
                background-image: url("images/s203-20210311123041.jpg");
            }
            #AS2 .ladi-gallery .ladi-gallery-control-item[data-index="2"] {
                background-image: url("images/s203-20210311123041.s400x400.jpg");
            }
            #GROUP1084 {
                width: 419.501px;
                height: 491.997px;
                top: 0px;
                left: 0px;
            }
        }
    </style>
    <style id="style_lazyload" type="text/css">
        .ladi-section-background,
        .ladi-image-background,
        .ladi-button-background,
        .ladi-headline,
        .ladi-video-background,
        .ladi-countdown-background,
        .ladi-box,
        .ladi-frame-background,
        .ladi-banner,
        .ladi-form-item-background,
        .ladi-gallery-view-item,
        .ladi-gallery-control-item,
        .ladi-spin-lucky-screen,
        .ladi-spin-lucky-start,
        .ladi-list-paragraph ul li:before {
            background-image: none !important;
        }
    </style>

</head>
<body>
    <div class="ladi-wraper">
        <div id="SECTION1" class="ladi-section">
            <div class="ladi-section-background"></div>
            <div class="ladi-container">
                <div id="IMAGE579" class="ladi-element">
                    <div class="ladi-image"><div class="ladi-image-background"></div></div>
                </div>
                <div data-action="true" id="HEADLINE27" class="ladi-element">
                    <h2 class="ladi-headline"><span style="font-weight: 700;">BẢNG GIÁ</span></h2>
                </div>
                <div data-action="true" id="HEADLINE30" class="ladi-element">
                    <h2 class="ladi-headline"><span style="font-weight: 700;">VỊ TRÍ</span></h2>
                </div>
                <div data-action="true" id="HEADLINE31" class="ladi-element">
                    <h2 class="ladi-headline"><span style="font-weight: bold;">TIỆN ÍCH</span></h2>
                </div>
                <div data-action="true" id="HEADLINE28" class="ladi-element"><h2 class="ladi-headline">TỔNG QUAN</h2></div>
                <div id="GROUP1052" class="ladi-element">
                    <div class="ladi-group">
                        <a href="tel:0901946222" id="BUTTON33" class="ladi-element">
                            <div class="ladi-button">
                                <div class="ladi-button-background"></div>
                                <div id="BUTTON_TEXT33" class="ladi-element">
                                    <p class="ladi-headline"><span style="font-weight: bold;">&nbsp; &nbsp; &nbsp; 098.743.1551</span></p>
                                </div>
                            </div>
                        </a>
                        <div id="SHAPE35" class="ladi-element">
                            <div class="ladi-shape">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1408 1896.0833" class="" fill="rgba(239, 241, 4, 1.0)">
                                    <path
                                    d="M1408 1240q0 27-10 70.5t-21 68.5q-21 50-122 106-94 51-186 51-27 0-52.5-3.5T959 1520t-47.5-14.5T856 1485t-49-18q-98-35-175-83-128-79-264.5-215.5T152 904q-48-77-83-175-3-9-18-49t-20.5-55.5T16 577 3.5 519.5 0 467q0-92 51-186 56-101 106-122 25-11 68.5-21t70.5-10q14 0 21 3 18 6 53 76 11 19 30 54t35 63.5 31 53.5q3 4 17.5 25t21.5 35.5 7 28.5q0 20-28.5 50t-62 55-62 53-28.5 46q0 9 5 22.5t8.5 20.5 14 24 11.5 19q76 137 174 235t235 174q2 1 19 11.5t24 14 20.5 8.5 22.5 5q18 0 46-28.5t53-62 55-62 50-28.5q14 0 28.5 7t35.5 21.5 25 17.5q25 15 53.5 31t63.5 35 54 30q70 35 76 53 3 7 3 21z"
                                    ></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-action="true" id="HEADLINE580" class="ladi-element">
                    <h2 class="ladi-headline"><span style="font-weight: bold;">MẶT BẰNG</span></h2>
                </div>
                <div data-action="true" id="GROUP998" class="ladi-element">
                    <div class="ladi-group">
                        <div id="BOX995" class="ladi-element"><div class="ladi-box"></div></div>
                        <div id="SHAPE994" class="ladi-element">
                            <div class="ladi-shape">
                                <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1"
                                x="0px"
                                y="0px"
                                viewBox="0 0 100 100"
                                enable-background="new 0 0 100 100"
                                xml:space="preserve"
                                preserveAspectRatio="none"
                                width="100%"
                                height="100%"
                                class=""
                                fill="rgba(255, 255, 255, 1.0)"
                                >
                                <g>
                                    <path d="M20.12,7.942c-6.696,0-12.144,5.447-12.144,12.144s5.448,12.144,12.144,12.144c6.696,0,12.144-5.447,12.144-12.144   S26.816,7.942,20.12,7.942z"></path>
                                    <path d="M79.879,7.942c-6.695,0-12.143,5.447-12.143,12.144s5.447,12.144,12.143,12.144c6.697,0,12.145-5.447,12.145-12.144   S86.576,7.942,79.879,7.942z"></path>
                                    <path d="M50,7.942c-6.696,0-12.143,5.447-12.143,12.144S43.304,32.229,50,32.229s12.145-5.447,12.145-12.144S56.695,7.942,50,7.942   z"></path>
                                    <path d="M20.12,67.771c-6.696,0-12.144,5.447-12.144,12.144s5.448,12.144,12.144,12.144c6.696,0,12.144-5.447,12.144-12.144   S26.816,67.771,20.12,67.771z"></path>
                                    <path d="M79.879,67.771c-6.695,0-12.143,5.447-12.143,12.144s5.447,12.144,12.143,12.144c6.697,0,12.145-5.447,12.145-12.144   S86.576,67.771,79.879,67.771z"></path>
                                    <path d="M50,67.771c-6.696,0-12.143,5.447-12.143,12.144S43.304,92.058,50,92.058s12.145-5.447,12.145-12.144   S56.695,67.771,50,67.771z"></path>
                                    <path d="M20.12,37.942c-6.696,0-12.144,5.447-12.144,12.143c0,6.696,5.448,12.144,12.144,12.144   c6.696,0,12.144-5.447,12.144-12.144C32.264,43.39,26.816,37.942,20.12,37.942z"></path>
                                    <path d="M79.879,37.942c-6.695,0-12.143,5.447-12.143,12.143c0,6.696,5.447,12.144,12.143,12.144   c6.697,0,12.145-5.447,12.145-12.144C92.023,43.39,86.576,37.942,79.879,37.942z"></path>
                                    <path d="M50,37.942c-6.696,0-12.143,5.447-12.143,12.143c0,6.696,5.447,12.144,12.143,12.144s12.145-5.447,12.145-12.144   C62.145,43.39,56.695,37.942,50,37.942z"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div id="HEADLINE996" class="ladi-element"><h3 class="ladi-headline">MENU</h3></div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION1050" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container"></div>
    </div>
    <div id="SECTION581" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="HEADLINE976" class="ladi-element">
                <h3 class="ladi-headline"><span style="color: rgb(255, 255, 255);">CHIẾT KHẤU </span>TỚI 11.5%</h3>
            </div>
            <div data-action="true" id="BUTTON991" class="ladi-element">
                <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT991" class="ladi-element">
                        <p class="ladi-headline"><span style="font-weight: 700;">NHẬN BÁO GIÁ NGAY</span></p>
                    </div>
                </div>
            </div>
            <div id="BOX977" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="HEADLINE974" class="ladi-element"><h3 class="ladi-headline">RA MẮT PHÂN KHU MỚI</h3></div>
            <div id="HEADLINE980" class="ladi-element">
                <h3 class="ladi-headline"><span style="color: rgb(246, 19, 6);">GRAND SAPPHIRE 2,3</span></h3>
            </div>
            <div id="GROUP1061" class="ladi-element">
                <div class="ladi-group">
                    <a href="tel:0901946222" id="BUTTON1054" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT1054" class="ladi-element">
                                <p class="ladi-headline"><span style="font-weight: bold;">&nbsp; &nbsp; &nbsp; 098.743.1551</span></p>
                            </div>
                        </div>
                    </a>
                    <div id="SHAPE1056" class="ladi-element">
                        <div class="ladi-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1408 1896.0833" class="" fill="rgba(239, 241, 4, 1.0)">
                                <path
                                d="M1408 1240q0 27-10 70.5t-21 68.5q-21 50-122 106-94 51-186 51-27 0-52.5-3.5T959 1520t-47.5-14.5T856 1485t-49-18q-98-35-175-83-128-79-264.5-215.5T152 904q-48-77-83-175-3-9-18-49t-20.5-55.5T16 577 3.5 519.5 0 467q0-92 51-186 56-101 106-122 25-11 68.5-21t70.5-10q14 0 21 3 18 6 53 76 11 19 30 54t35 63.5 31 53.5q3 4 17.5 25t21.5 35.5 7 28.5q0 20-28.5 50t-62 55-62 53-28.5 46q0 9 5 22.5t8.5 20.5 14 24 11.5 19q76 137 174 235t235 174q2 1 19 11.5t24 14 20.5 8.5 22.5 5q18 0 46-28.5t53-62 55-62 50-28.5q14 0 28.5 7t35.5 21.5 25 17.5q25 15 53.5 31t63.5 35 54 30q70 35 76 53 3 7 3 21z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                    <div data-action="true" id="BUTTON1059" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT1059" class="ladi-element">
                                <p class="ladi-headline"><span style="font-weight: 700;">TẢI BẢNG GIÁ</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION3" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP595" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX592" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="HEADLINE36" class="ladi-element">
                        <h3 class="ladi-headline">CHÍNH SÁCH ƯU ĐÃI MỚI NHẤT THÁNG 3/2021<br /></h3>
                    </div>
                    <div id="LIST_PARAGRAPH585" class="ladi-element">
                        <div class="ladi-list-paragraph">
                            <ul>
                                <li>Căn hộ <span style="font-weight: bold; color: rgb(203, 1, 1);">dưới 1.7 tỷ</span> tặng voucher <span style="color: rgb(204, 1, 1); font-weight: bold;">70 triệu</span> mua xe Fadil</li>
                                <li>Căn hộ từ <span style="font-weight: bold; color: rgb(203, 1, 1);">1.7 – 2.5 tỷ</span> tặng voucher <span style="font-weight: bold; color: rgb(203, 1, 1);">150 triệu</span> mua xe Lux A</li>
                                <li>Căn hộ <span style="color: rgb(203, 1, 1); font-weight: bold;">trên 2.5 tỷ</span>, tặng voucher <span style="font-weight: bold; color: rgb(203, 1, 1);">200 triệu</span> mua xe Lux SA</li>
                                <li><span style="font-weight: bold; color: rgb(16, 145, 33);">Tặng voucher NỘI THẤT AN CƯỜNG</span></li>
                                <li>Căn hộ Studio tặng voucher&nbsp;<span style="font-weight: bold; color: rgb(203, 1, 1);">40 triệu </span></li>
                                <li>Căn hộ 1PN, 1PN+1 tặng voucher&nbsp;<span style="font-weight: bold; color: rgb(203, 1, 1);">60 triệu </span></li>
                                <li>Căn hộ 2PN, 2PN+1 tặng voucher&nbsp;<span style="font-weight: bold; color: rgb(203, 1, 1);">80 triệu </span></li>
                                <li>Căn hộ 3PN tặng voucher&nbsp;<span style="font-weight: bold; color: rgb(203, 1, 1);">100 triệu</span></li>
                                <li>Chỉ cần 10% ký ngay hợp đồng mua bán</li>
                                <li>Vay lãi suất 0% đến 24 tháng .</li>
                                <li>Khách TTS nhận <span style="font-weight: bold; color: rgb(203, 1, 1);">chiết khấu đến 11,5%</span> GTCH</li>
                                <li>Khách không nhận bảo lãnh <span style="font-weight: bold; color: rgb(203, 1, 1);">chiết khấu 1% </span></li>
                                <li>MIỄN PHÍ trả nợ trước hạn trong thời gian HTLS</li>
                                <li>Vay vốn 70% GTCH đến 35 năm</li>
                            </ul>
                        </div>
                    </div>
                    <div id="PARAGRAPH586" class="ladi-element">
                        <p class="ladi-paragraph">Liên hệ <span style="color: rgb(203, 1, 1);">HOTLINE: 098.743.1551</span> để cập nhật đầy đủ và chính xác chính sách bán hàng mới nhất của dự án.</p>
                    </div>
                    <div id="LINE588" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                    <div id="LINE589" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
            <div id="GROUP596" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX430" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="HEADLINE433" class="ladi-element"><h3 class="ladi-headline">TẢI BẢNG GIÁ VÀ FULL CHÍNH SÁCH CÁC TÒA ĐANG MỞ BÁN (.pdf)</h3></div>
                    <div id="HEADLINE429" class="ladi-element">
                        <h3 class="ladi-headline">*Thông tin của quý khách hàng luôn được bảo mật tuyệt đối.<br /></h3>
                    </div>
                    <div id="FORM418" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                        <form autocomplete="off" method="post" class="ladi-form">
                            <div id="FORM_ITEM419" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="[0-9]{9,12}" value="" /></div>
                                </div>
                            </div>
                            <div id="BUTTON420" class="ladi-element">
                                <div class="ladi-button">
                                    <div class="ladi-button-background"></div>
                                    <div id="BUTTON_TEXT420" class="ladi-element"><p class="ladi-headline">TẢI XUỐNG NGAY</p></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM422" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item ladi-form-checkbox ladi-form-checkbox-vertical">
                                        <div class="ladi-form-checkbox-item">
                                            <input tabindex="2" name="form_item1737" type="checkbox" value="Căn hộ STUDIO: 28-33 m2 giá từ 1,2 - 1,5 tỷ" /><span data-checked="false">Căn hộ STUDIO: 28-33 m2 giá từ 1,2 - 1,5 tỷ</span>
                                        </div>
                                        <div class="ladi-form-checkbox-item">
                                            <input tabindex="2" name="form_item1737" type="checkbox" value="Căn hộ 1PN+1: 43 m2 giá từ 1,6 tỷ - 1,8 tỷ" /><span data-checked="false">Căn hộ 1PN+1: 43 m2 giá từ 1,6 tỷ - 1,8 tỷ</span>
                                        </div>
                                        <div class="ladi-form-checkbox-item">
                                            <input tabindex="2" name="form_item1737" type="checkbox" value="Căn hộ 2PN, 1 WC: 55 m2 giá từ 1,6 tỷ" /><span data-checked="false">Căn hộ 2PN, 1 WC: 55 m2 giá từ 1,6 tỷ</span>
                                        </div>
                                        <div class="ladi-form-checkbox-item">
                                            <input tabindex="2" name="form_item1737" type="checkbox" value="Căn hộ 2PN +1, 2 WC: 64 m2 giá từ 1,6 tỷ" /><span data-checked="false">Căn hộ 2PN +1, 2 WC: 64 m2 giá từ 1,6 tỷ</span>
                                        </div>
                                        <div class="ladi-form-checkbox-item">
                                            <input tabindex="2" name="form_item1737" type="checkbox" value="Căn hộ 3PN, 2 WC : 75-94 m2 giá từ 2,7 tỷ" /><span data-checked="false">Căn hộ 3PN, 2 WC : 75-94 m2 giá từ 2,7 tỷ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="FORM_ITEM591" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="3" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                                </div>
                            </div>
                            <button type="submit" class="ladi-hidden"></button>
                        </form>
                    </div>
                    <div id="HEADLINE426" class="ladi-element">
                        <h3 class="ladi-headline"><span style="font-weight: bold;">Bạn đang quan tâm tới loại hình căn hộ nào:</span></h3>
                    </div>
                    <div id="SHAPE594" class="ladi-element">
                        <div class="ladi-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 1664 1896.0833" class="" fill="rgba(11, 92, 22, 1.0)">
                                <path
                                d="M1280 1344q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28H96q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h465l135 136q58 56 136 56t136-56l136-136h464q40 0 68 28t28 68zm-325-569q17 41-14 70l-448 448q-18 19-45 19t-45-19L339 621q-31-29-14-70 17-39 59-39h256V64q0-26 19-45t45-19h256q26 0 45 19t19 45v448h256q42 0 59 39z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION48" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="IMAGE109" class="ladi-element">
                <div class="ladi-image"><div class="ladi-image-background"></div></div>
            </div>
            <div id="GROUP937" class="ladi-element">
                <div class="ladi-group">
                    <div id="LIST_PARAGRAPH114" class="ladi-element">
                        <div class="ladi-list-paragraph">
                            <ul>
                                <li>&nbsp;- Tên dự án: Vinhomes Smart City</li>
                                <li>- Vị trí: Tây Mỗ – Đại Mỗ, Nam Từ Liêm, Hà Nội</li>
                                <li>- Quy mô dự án: 280 ha</li>
                                <li>- Mật độ xây dựng: 14,7%</li>
                                <li>- 3 dòng sản phẩm: Vinhomes Sapphire, Vinhomes Ruby, Vinhomes Diamond.</li>
                                <li>- Chiều cao trung bình mỗi tòa nhà: 35 – 39 tầng</li>
                                <li>- Diện tích thiết kế mỗi căn hộ: 28 – 94m2</li>
                                <li>- Sản phẩm: 49 tòa chung cư, 98 căn biệt thự</li>
                                <li>- Thời gian xây dựng và hoàn thiện: 2018 – 2021</li>
                            </ul>
                        </div>
                    </div>
                    <div id="PARAGRAPH597" class="ladi-element">
                        <p class="ladi-paragraph">
                            Vinhomes Smart City là Đại đô thị thông minh đẳng cấp quốc tế đầu tiên tại Việt Nam. Một sản phẩm tiên phong của Vinhomes ứng dụng các công nghệ thông minh vào dự án BĐS. Nổi bật với hệ sinh thái thông
                            minh toàn diện trên 4 trục cốt lõi: An ninh – an toàn thông minh, Vận hành thông minh, Cộng đồng thông minh, Căn hộ thông minh.
                        </p>
                    </div>
                </div>
            </div>
            <div id="GROUP936" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE319" class="ladi-element"><h3 class="ladi-headline">TỔNG QUAN VINHOMES SMART CITY</h3></div>
                    <div id="LINE598" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
            <div id="GALLERY599" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                        <div class="ladi-gallery-view-item" data-index="2"></div>
                        <div class="ladi-gallery-view-item" data-index="3"></div>
                        <div class="ladi-gallery-view-item" data-index="4"></div>
                        <div class="ladi-gallery-view-item" data-index="5"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                            <div class="ladi-gallery-control-item" data-index="2"></div>
                            <div class="ladi-gallery-control-item" data-index="3"></div>
                            <div class="ladi-gallery-control-item" data-index="4"></div>
                            <div class="ladi-gallery-control-item" data-index="5"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION84" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="IMAGE115" class="ladi-element">
                <div class="ladi-image"><div class="ladi-image-background"></div></div>
            </div>
            <div id="GROUP938" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE116" class="ladi-element"><h3 class="ladi-headline">VỊ TRÍ VÀNG ĐẮC ĐỊA</h3></div>
                    <div id="PARAGRAPH117" class="ladi-element">
                        <p class="ladi-paragraph">
                            Nằm trên trên Đại lộ Thăng Long – huyết mạch Tây thủ đô, Vinhomes Smart City sở hữu vị trí đắc địa, cách Trung tâm Hội nghị Quốc gia chỉ 7 phút di chuyển.
                            <br />
                            <br />
                            Đây được coi là tọa độ vàng cho cuộc sống hiện đại, năng động. Không chỉ thuận lợi để cư dân di chuyển về mọi phía, Vinhomes Smart City còn là tiềm năng thúc đẩy sự gia tăng giá trị bất động sản. Nơi đây
                            cũng tập trung cộng đồng người nước ngoài đang sống và làm việc tại Việt Nam.<br />
                        </p>
                    </div>
                    <div id="LINE600" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION601" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="BOX625" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="BOX614" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="HEADLINE602" class="ladi-element"><h3 class="ladi-headline">TIỆN ÍCH SỐNG THỜI THƯỢNG</h3></div>
            <div id="GALLERY623" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                        <div class="ladi-gallery-view-item" data-index="2"></div>
                        <div class="ladi-gallery-view-item" data-index="3"></div>
                        <div class="ladi-gallery-view-item" data-index="4"></div>
                        <div class="ladi-gallery-view-item" data-index="5"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                            <div class="ladi-gallery-control-item" data-index="2"></div>
                            <div class="ladi-gallery-control-item" data-index="3"></div>
                            <div class="ladi-gallery-control-item" data-index="4"></div>
                            <div class="ladi-gallery-control-item" data-index="5"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
            <div id="GALLERY624" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-left">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                        <div class="ladi-gallery-view-item" data-index="2"></div>
                        <div class="ladi-gallery-view-item" data-index="3"></div>
                        <div class="ladi-gallery-view-item" data-index="4"></div>
                        <div class="ladi-gallery-view-item" data-index="5"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                            <div class="ladi-gallery-control-item" data-index="2"></div>
                            <div class="ladi-gallery-control-item" data-index="3"></div>
                            <div class="ladi-gallery-control-item" data-index="4"></div>
                            <div class="ladi-gallery-control-item" data-index="5"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
            <div id="GROUP943" class="ladi-element">
                <div class="ladi-group">
                    <div id="GROUP939" class="ladi-element">
                        <div class="ladi-group">
                            <div id="PARAGRAPH613" class="ladi-element">
                                <p class="ladi-paragraph">
                                    Mở lối nhịp sống soi động với các hoạt động độc đáo ngoài trời thông qua hệ thống công viên đa dạng giúp cư dân Vinhomes Smart City tận hưởng cuộc sống lành mạnh, tươi trẻ hơn bao giờ hết.
                                </p>
                            </div>
                            <div id="HEADLINE615" class="ladi-element"><h3 class="ladi-headline">3 CÔNG VIÊN THỂ THAO RỘNG TỚI 10.5HA</h3></div>
                            <div id="LIST_PARAGRAPH616" class="ladi-element">
                                <div class="ladi-list-paragraph">
                                    <ul>
                                        <li>Hồ cảnh quan và chòi nghỉ thư giãn</li>
                                        <li>Khu chèo thuyền Kayak</li>
                                        <li>Công viên dưỡng sinh</li>
                                        <li>Công viên dã ngoại</li>
                                        <li>Công viên Aerobic</li>
                                    </ul>
                                </div>
                            </div>
                            <div id="LIST_PARAGRAPH617" class="ladi-element">
                                <div class="ladi-list-paragraph">
                                    <ul>
                                        <li>Công viên Patin</li>
                                        <li>Công viên khiêu vũ</li>
                                        <li>Công viên BBQ hơn 100 điểm nướng</li>
                                        <li>Công viên gym với 1200 máy tập</li>
                                    </ul>
                                </div>
                            </div>
                            <div id="LINE298" class="ladi-element">
                                <div class="ladi-line"><div class="ladi-line-container"></div></div>
                            </div>
                        </div>
                    </div>
                    <div id="GROUP940" class="ladi-element">
                        <div class="ladi-group">
                            <div id="LINE941" class="ladi-element">
                                <div class="ladi-line"><div class="ladi-line-container"></div></div>
                            </div>
                            <div id="HEADLINE942" class="ladi-element"><h2 class="ladi-headline">Đại đô thị năng động nhất</h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="LINE945" class="ladi-element">
                <div class="ladi-line"><div class="ladi-line-container"></div></div>
            </div>
            <div id="PARAGRAPH618" class="ladi-element">
                <p class="ladi-paragraph">Tận hưởng cuộc sống đáng mơ ước được tích hợp toàn vẹn tiện ích từ hệ sinh thái Vin, nơi mỗi cư dân đều được chăm sóc chu đáo từ sức khỏe, giáo dục toàn diện và giải trí.<br /></p>
            </div>
            <div id="HEADLINE619" class="ladi-element"><h3 class="ladi-headline">MỘT BƯỚC CHÂN - NGÀN TIỆN ÍCH</h3></div>
            <div id="LIST_PARAGRAPH620" class="ladi-element">
                <div class="ladi-list-paragraph">
                    <ul>
                        <li>Vinbus</li>
                        <li>Tòa văn phòng</li>
                        <li>TTTM Vincom Mega Mall</li>
                    </ul>
                </div>
            </div>
            <div id="LIST_PARAGRAPH621" class="ladi-element">
                <div class="ladi-list-paragraph">
                    <ul>
                        <li>Trường học Quốc tế Vinschool</li>
                        <li>Bệnh viện quốc tế Vinmec</li>
                    </ul>
                </div>
            </div>
            <div id="PARAGRAPH919" class="ladi-element">
                <p class="ladi-paragraph">
                    Khu Vườn Nhật – Công viên lễ hội đèn lồng đã được đầu tư xứng tầm với hàng loạt tiện ích như Nhà hàng Nhật, Công viên đèn lồng, Núi giả thác nước, Suối cá chép đỏ, ..mang lại cho cư dân trải nghiệm sống đa dạng
                    mỗi ngày.<br />
                </p>
            </div>
            <div id="LINE868" class="ladi-element">
                <div class="ladi-line"><div class="ladi-line-container"></div></div>
            </div>
            <div id="HEADLINE869" class="ladi-element"><h2 class="ladi-headline">Quản lý vận hành Vinhomes</h2></div>
        </div>
    </div>
    <div id="SECTION626" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="IMAGE629" class="ladi-element">
                <div class="ladi-image"><div class="ladi-image-background"></div></div>
            </div>
            <div id="GROUP952" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE627" class="ladi-element"><h3 class="ladi-headline">MẶT BẰNG TỔNG THỂ VINHOMES SMART CITY</h3></div>
                    <div id="LINE946" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION694" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="HEADLINE695" class="ladi-element"><h3 class="ladi-headline">TẢI FILE MẶT BẰNG TỔNG THỂ BẢN NÉT HD (.pdf)</h3></div>
            <div id="GROUP894" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX716" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="FORM696" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                        <form autocomplete="off" method="post" class="ladi-form">
                            <div id="BUTTON697" class="ladi-element">
                                <div class="ladi-button">
                                    <div class="ladi-button-background"></div>
                                    <div id="BUTTON_TEXT697" class="ladi-element"><p class="ladi-headline">TẢI NGAY</p></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM699" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="2" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM700" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item">
                                        <input autocomplete="off" tabindex="2" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" value="" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="ladi-hidden"></button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="HEADLINE702" class="ladi-element"><h3 class="ladi-headline">Hoặc gọi ngay HOTLINE: 098.743.1551</h3></div>
            <div id="FORM1020" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                <form autocomplete="off" method="post" class="ladi-form">
                    <div id="FORM_ITEM1021" class="ladi-element">
                        <div class="ladi-form-item-container">
                            <div class="ladi-form-item-background"></div>
                            <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                        </div>
                    </div>
                    <div id="FORM_ITEM1022" class="ladi-element">
                        <div class="ladi-form-item-container">
                            <div class="ladi-form-item-background"></div>
                            <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="[0-9]{9,12}" value="" /></div>
                        </div>
                    </div>
                    <div id="BUTTON1023" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT1023" class="ladi-element"><p class="ladi-headline">TẢI NGAY</p></div>
                        </div>
                    </div>
                    <button type="submit" class="ladi-hidden"></button>
                </form>
            </div>
        </div>
    </div>
    <div id="SECTION50" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="S4" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX687" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="HEADLINE689" class="ladi-element">
                        <h3 class="ladi-headline"><span style="font-weight: bold;">PHÂN KHU SAPPHIRE 4</span></h3>
                    </div>
                    <div data-action="true" id="BUTTON690" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT690" class="ladi-element">
                                <p class="ladi-headline"><span style="font-weight: 700;">TẢI FILE MẶT BẰNG BẢN NÉT (.pdf)</span></p>
                            </div>
                        </div>
                    </div>
                    <div id="LIST_PARAGRAPH693" class="ladi-element">
                        <div class="ladi-list-paragraph">
                            <ul>
                                <li>Bao gồm các tòa: <span style="color: rgb(255, 222, 137);">S4.01, S4.02, S4.03</span></li>
                                <li>Vị trí trung tâm nhất dự án</li>
                                <li>Tầm nhìn xanh đắt giá, view trọn công viên trung tâm</li>
                                <li>Kế cận trường Vinschool</li>
                                <li>Bàn giao T8 - T12/2021</li>
                                <li>Diện tích đa dạng từ 25-98m2</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="S2" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX669" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="HEADLINE671" class="ladi-element">
                        <h3 class="ladi-headline"><span style="font-weight: bold;">PHÂN KHU SAPPHIRE 2</span></h3>
                    </div>
                    <div data-action="true" id="BUTTON672" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT672" class="ladi-element">
                                <p class="ladi-headline"><span style="font-weight: 700;">TẢI FILE MẶT BẰNG BẢN NÉT (.pdf)</span></p>
                            </div>
                        </div>
                    </div>
                    <div id="LIST_PARAGRAPH675" class="ladi-element">
                        <div class="ladi-list-paragraph">
                            <ul>
                                <li>Bao gồm 3 tòa: <span style="color: rgb(255, 222, 137);">S2.01, S2.02, S2.03</span></li>
                                <li>Phân khu năng động nhất, sở hữu shop downtown sôi động</li>
                                <li>Trở thành những cư dân đầu tiên của đại đô thị</li>
                                <li>Chính sách bán hàng hấp dẫn nhất dự án&nbsp;</li>
                                <li>LOẠI CĂN HỘ (TT) :</li>
                                <li>Căn Studio: khoảng 28m2 đến 36,4m2</li>
                                <li>Căn 1 PN +1: khoảng 42,8m2 đến 43m2</li>
                                <li>Căn 2 PN: khoảng 53,7m2 đến 54,9m2</li>
                                <li>Căn 2 PN +1: khoảng 61,8m2 đến 64,6m2</li>
                                <li>Căn 3 PN: khoảng 74,1m2 đến 76,2m2</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="S3" class="ladi-element">
                <div class="ladi-group">
                    <div id="GROUP1084" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX678" class="ladi-element"><div class="ladi-box"></div></div>
                            <div id="HEADLINE680" class="ladi-element">
                                <h3 class="ladi-headline"><span style="font-weight: bold;">PHÂN KHU SAPPHIRE 3</span></h3>
                            </div>
                            <div id="LIST_PARAGRAPH684" class="ladi-element">
                                <div class="ladi-list-paragraph">
                                    <ul>
                                        <li>Bao gồm 3 tòa: <span style="color: rgb(255, 222, 137);">S3.01, S3.02, S3.03</span></li>
                                        <li>Kế cận công viên trung tâm</li>
                                        <li>Tâm điểm sống của cộng đồng cư dân đẳng cấp (Diamond &amp; Ruby)</li>
                                        <li>Gần trường học, nhà để xe, cực kỳ thuận tiện.</li>
                                        <li>Bàn giao: Tháng 3/2021</li>
                                        <li>Căn Studio: khoảng 24,5m2 đến 31,7m2</li>
                                        <li>Căn 1 PN: khoảng 33,9m2 đến 34,2m2</li>
                                        <li>Căn 1 PN +1: khoảng 42,8m2 đến 43,1m2</li>
                                        <li>Căn 2 PN: khoảng 53,9m2 đến 54,9m2</li>
                                        <li>Căn 2 PN +1: khoảng 61,9m2 đến 63,6m2</li>
                                        <li>Căn 3 PN: khoảng 75,1m2 đến 94,5m2</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-action="true" id="BUTTON681" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT681" class="ladi-element">
                                <p class="ladi-headline"><span style="font-weight: 700;">TẢI FILE MẶT BẰNG BẢN NÉT (.pdf)</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="S1" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX217" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="HEADLINE220" class="ladi-element">
                        <h3 class="ladi-headline"><span style="font-weight: bold;">PHÂN KHU SAPPHIRE 1</span></h3>
                    </div>
                    <div data-action="true" id="BUTTON224" class="ladi-element">
                        <div class="ladi-button">
                            <div class="ladi-button-background"></div>
                            <div id="BUTTON_TEXT224" class="ladi-element">
                                <p class="ladi-headline"><span style="font-weight: 700;">TẢI FILE MẶT BẰNG BẢN NÉT (.pdf)</span></p>
                            </div>
                        </div>
                    </div>
                    <div id="LIST_PARAGRAPH663" class="ladi-element">
                        <div class="ladi-list-paragraph">
                            <ul>
                                <li>Bao gồm 5 tòa: <span style="color: rgb(255, 222, 137);">S1.01, S1.02, S1.03, S1.05, S1.06</span></li>
                                <li>Công viên nội khu đậm chất resort</li>
                                <li>Là phân khu mở bán đầu tiên, có giá tốt nhất</li>
                                <li>Tầm view các tòa rộng mở</li>
                                <li>Bàn giao: Tháng 10.2020</li>
                                <li>LOẠI CĂN HỘ (TT) :</li>
                                <li>Căn Studio: khoảng 28m2 đến 32,5m2</li>
                                <li>Căn 1 PN +1: khoảng 42m2 đến 48m2</li>
                                <li>Căn 2 PN: khoảng 53,7m2 đến 54,9m2</li>
                                <li>Căn 2 PN +1: khoảng 54m2 đến 65m2</li>
                                <li>Căn 3 PN: khoảng 73m2 đến 76m2</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="AS3" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                        <div class="ladi-gallery-view-item" data-index="2"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                            <div class="ladi-gallery-control-item" data-index="2"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
            <div id="AS4" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                        <div class="ladi-gallery-view-item" data-index="2"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                            <div class="ladi-gallery-control-item" data-index="2"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
            <div id="GROUP954" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE656" class="ladi-element"><h3 class="ladi-headline">MẶT BẰNG PHÂN KHU SAPPHIRE (ĐANG MỞ BÁN)</h3></div>
                    <div id="LINE947" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
            <div data-action="true" id="BUTTON154" class="ladi-element">
                <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT154" class="ladi-element"><p class="ladi-headline">SAPPHIRE 2</p></div>
                </div>
            </div>
            <div id="AS2" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                        <div class="ladi-gallery-view-item" data-index="2"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                            <div class="ladi-gallery-control-item" data-index="2"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
            <div id="AS1" class="ladi-element">
                <div class="ladi-gallery ladi-gallery-bottom">
                    <div class="ladi-gallery-view">
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-left"></div>
                        <div class="ladi-gallery-view-arrow ladi-gallery-view-arrow-right"></div>
                        <div class="ladi-gallery-view-item selected" data-index="0"></div>
                        <div class="ladi-gallery-view-item" data-index="1"></div>
                    </div>
                    <div class="ladi-gallery-control">
                        <div class="ladi-gallery-control-box">
                            <div class="ladi-gallery-control-item selected" data-index="0"></div>
                            <div class="ladi-gallery-control-item" data-index="1"></div>
                        </div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-left"></div>
                        <div class="ladi-gallery-control-arrow ladi-gallery-control-arrow-right"></div>
                    </div>
                </div>
            </div>
            <div data-action="true" id="BUTTON134" class="ladi-element">
                <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT134" class="ladi-element"><p class="ladi-headline">SAPPHIRE 1</p></div>
                </div>
            </div>
            <div data-action="true" id="BUTTON150" class="ladi-element">
                <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT150" class="ladi-element"><p class="ladi-headline">SAPPHIRE 3</p></div>
                </div>
            </div>
            <div data-action="true" id="BUTTON659" class="ladi-element">
                <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT659" class="ladi-element"><p class="ladi-headline">SAPPHIRE 4</p></div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION902" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="IMAGE910" class="ladi-element">
                <div class="ladi-image"><div class="ladi-image-background"></div></div>
            </div>
            <div data-action="true" id="BUTTON917" class="ladi-element">
                <div class="ladi-button">
                    <div class="ladi-button-background"></div>
                    <div id="BUTTON_TEXT917" class="ladi-element">
                        <p class="ladi-headline"><span style="font-weight: 700;">ĐĂNG KÝ NGAY - NHẬN TƯ VẤN CĂN ĐẸP + GIÁ TỐT</span></p>
                    </div>
                </div>
            </div>
            <div id="GROUP955" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE903" class="ladi-element"><h3 class="ladi-headline">NHẬN QUỸ CĂN GIÁ TỐT SAU CHIẾT KHẤU</h3></div>
                    <div id="LINE948" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION717" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="GROUP956" class="ladi-element">
                <div class="ladi-group">
                    <div id="HEADLINE267" class="ladi-element"><h3 class="ladi-headline">8 LÝ DO</h3></div>
                    <div id="HEADLINE266" class="ladi-element"><h3 class="ladi-headline">LỰA CHỌN VINHOMES SMART CITY</h3></div>
                    <div id="LINE949" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                </div>
            </div>
            <div id="HEADLINE767" class="ladi-element"><h5 class="ladi-headline">Lorem ipsum dolor sit amet?</h5></div>
            <div id="HEADLINE760" class="ladi-element"><h5 class="ladi-headline">Lorem ipsum dolor sit amet?</h5></div>
            <div id="GROUP1033" class="ladi-element">
                <div class="ladi-group">
                    <div id="PARAGRAPH761" class="ladi-element">
                        <p class="ladi-paragraph">
                            VỊ TRÍ VÀNG TỪ NƠI HUYẾT MẠCH <br />
                            PHÍA TÂY<br />
                        </p>
                    </div>
                    <div id="GROUP762" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX763" class="ladi-element"><div class="ladi-box"></div></div>
                            <div id="SHAPE764" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div id="HEADLINE765" class="ladi-element"><h1 class="ladi-headline">01</h1></div>
                        </div>
                    </div>
                    <div id="PARAGRAPH802" class="ladi-element">
                        <p class="ladi-paragraph">Vinhomes Smart City sở hữu vị trí đắc địa trên trên Đại lộ Thăng Long – tuyến đường huyết mạch phía Tây thủ đô, cách Trung tâm Hội nghị Quốc gia chỉ 7 phút di chuyển.<br /></p>
                    </div>
                </div>
            </div>
            <div id="HEADLINE821" class="ladi-element"><h5 class="ladi-headline">Lorem ipsum dolor sit amet?</h5></div>
            <div id="HEADLINE827" class="ladi-element"><h5 class="ladi-headline">Lorem ipsum dolor sit amet?</h5></div>
            <div id="GROUP1035" class="ladi-element">
                <div class="ladi-group">
                    <div id="PARAGRAPH828" class="ladi-element"><p class="ladi-paragraph">CÔNG VIÊN THỂ THAO QUY MÔ HÀNG ĐẦU ĐÔNG NAM Á</p></div>
                    <div id="PARAGRAPH833" class="ladi-element">
                        <p class="ladi-paragraph">
                            Với Công viên thể thao quy mô hàng đầu Đông Nam Á rộng 10.5ha cùng 12 công viên chủ đề mới lạ, hấp dẫn để mỗi ngày tại Vinhomes Smart City của cư dân, là một hành trình trải nghiệm vô cùng thú vị.<br />
                        </p>
                    </div>
                    <div id="BOX830" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="SHAPE831" class="ladi-element">
                        <div class="ladi-shape">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                                <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div id="HEADLINE832" class="ladi-element"><h1 class="ladi-headline">03</h1></div>
                </div>
            </div>
            <div id="PARAGRAPH768" class="ladi-element">
                <p class="ladi-paragraph">ĐẠI ĐÔ THỊ THÔNG MINH ĐẲNG CẤP QUỐC TẾ ĐẦU TIÊN TẠI VIỆT NAM<br /></p>
            </div>
            <div id="PARAGRAPH803" class="ladi-element">
                <p class="ladi-paragraph">Vinhomes Smart City được phát triển dựa trên hệ sinh thái thông minh dựa trên 4 trục cốt lõi, gồm An ninh thông minh, Vận hành thông minh, Cộng đồng thông minh, Căn hộ thông minh.<br /></p>
            </div>
            <div id="BOX770" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="SHAPE771" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                    </svg>
                </div>
            </div>
            <div id="HEADLINE772" class="ladi-element"><h1 class="ladi-headline">02</h1></div>
            <div id="PARAGRAPH822" class="ladi-element">
                <p class="ladi-paragraph">VƯỜN NHẬT ĐẲNG CẤP - KHÔNG GIAN NHẬT NGAY GIỮA THỦ ĐÔ<br /></p>
            </div>
            <div id="PARAGRAPH834" class="ladi-element">
                <p class="ladi-paragraph">
                    Nhằm tạo lập một chuẩn sống mới cho cư dân, khu Vườn Nhật – Công viên lễ hội đèn lồng đã được đầu tư xứng tầm với hàng loạt tiện ích như Nhà hàng Nhật, Công viên đèn lồng, Núi giả thác nước, Suối cá chép đỏ, ..
                    mang lại cho cư dân trải nghiệm sống đa dạng mỗi ngày.
                </p>
            </div>
            <div id="BOX824" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="SHAPE825" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                    </svg>
                </div>
            </div>
            <div id="HEADLINE826" class="ladi-element"><h1 class="ladi-headline">04</h1></div>
            <div id="PARAGRAPH843" class="ladi-element">
                <p class="ladi-paragraph">HỘI TỤ ĐẦY ĐỦ CÁC DÒNG SẢN PHẨM BĐS<br /></p>
            </div>
            <div id="PARAGRAPH848" class="ladi-element">
                <p class="ladi-paragraph">Vinhomes Smart City phát triển 3 dòng sản phẩm Vinhomes từ trung cấp đến cao cấp: Sapphire, Ruby, Diamond, đáp ứng đa dạng các nhu cầu cuộc sống của từng phân khúc khách hàng.<br /></p>
            </div>
            <div id="BOX845" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="SHAPE846" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                    </svg>
                </div>
            </div>
            <div id="HEADLINE847" class="ladi-element"><h1 class="ladi-headline">05</h1></div>
            <div id="PARAGRAPH837" class="ladi-element">
                <p class="ladi-paragraph">HỆ THỐNG TIỆN ÍCH HOÀN HẢO VỚI QUY MÔ CHƯA TỪNG CÓ<br /></p>
            </div>
            <div id="PARAGRAPH849" class="ladi-element">
                <p class="ladi-paragraph">
                    Tiện ích nội khu hấp dẫn ngay phía dưới tòa căn hộ: Hơn 60 sân chơi cho trẻ em và sân chơi vận động liên hoàn, hơn 150 sân thể thao đa dạng, 8 bể bơi trong nhà và ngoài trời, Vinmec, Hệ thống Vinschool, Vincom
                    Mega Mall, Tòa hỗn hợp văn phòng...<br />
                </p>
            </div>
            <div id="BOX839" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="SHAPE840" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                    </svg>
                </div>
            </div>
            <div id="HEADLINE841" class="ladi-element"><h1 class="ladi-headline">06</h1></div>
            <div id="PARAGRAPH858" class="ladi-element">
                <p class="ladi-paragraph">VẬN HÀNH QUẢN LÝ BỞI VINHOMES<br /></p>
            </div>
            <div id="PARAGRAPH863" class="ladi-element">
                <p class="ladi-paragraph">Vinhomes Smart City ứng dụng các công nghệ tiên tiến nhất (trí tuệ nhân tạo AI, Internet vạn vật IoT) trong quản lý vận hành để mang lại cuộc sống hiện đại và an toàn cho cư dân.<br /></p>
            </div>
            <div id="BOX860" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="SHAPE861" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                    </svg>
                </div>
            </div>
            <div id="HEADLINE862" class="ladi-element"><h1 class="ladi-headline">07</h1></div>
            <div id="PARAGRAPH852" class="ladi-element"><p class="ladi-paragraph">CỘNG ĐỒNG CƯ DÂN HIỆN ĐẠI</p></div>
            <div id="PARAGRAPH864" class="ladi-element">
                <p class="ladi-paragraph">Vinhomes Smart City hội tụ những công dân toàn cầu, văn minh, cùng nhau chia sẻ, kết nối, kiến tạo nên một chuẩn sống đẳng cấp giữa trung tâm phía Tây của Thủ đô.<br /></p>
            </div>
            <div id="BOX854" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="SHAPE855" class="ladi-element">
                <div class="ladi-shape">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="rgba(255, 255, 255, 1.0)">
                        <path d="M3 6v20h9.563l2.718 2.72.72.686.72-.687L19.437 26H29V6H3zm2 2h22v16h-8.406l-.313.28L16 26.563l-2.28-2.28-.314-.282H5V8zm4 3v2h14v-2H9zm0 4v2h14v-2H9zm0 4v2h10v-2H9z"></path>
                    </svg>
                </div>
            </div>
            <div id="HEADLINE856" class="ladi-element"><h1 class="ladi-headline">08</h1></div>
        </div>
    </div>
    <div id="SECTION294" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="BOX336" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="IMAGE369" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE374" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE364" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="HEADLINE338" class="ladi-element"><h3 class="ladi-headline">HÌNH ẢNH THỰC TẾ DỰ ÁN</h3></div>
            <div id="PARAGRAPH920" class="ladi-element">
                <p class="ladi-paragraph">
                    Sở hữu một căn hộ tại Vinhomes Smart City là sở hữu vị trí tâm điểm giữa trung tâm mới của Thủ đô, sở hữu cả một hệ sinh thái thông minh với những điểm nhấn tiện ích chưa từng có tại bất cứ đâu. Hãy chạm tới ước
                    mơ nâng tầm cuộc sống cùng Vinhomes Smart City ngay bây giờ!<br />
                </p>
            </div>
            <div id="LINE950" class="ladi-element">
                <div class="ladi-line"><div class="ladi-line-container"></div></div>
            </div>
            <div id="IMAGE339" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div data-action="true" id="IMAGE359" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE354" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE875" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE879" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE883" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
        </div>
    </div>
    <div id="SECTION159" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="HEADLINE280" class="ladi-element"><h3 class="ladi-headline">NHẬN VÉ MỜI THAM QUAN CĂN HỘ MẪU</h3></div>
            <div id="HEADLINE284" class="ladi-element"><h1 class="ladi-headline">Đăng ký trải nghiệm thực tế sẽ giúp bạn hình dung 1 cách khách quan nhất căn hộ tương lai của mình !</h1></div>
            <div id="GROUP895" class="ladi-element">
                <div class="ladi-group">
                    <div id="BOX896" class="ladi-element"><div class="ladi-box"></div></div>
                    <div id="FORM897" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                        <form autocomplete="off" method="post" class="ladi-form">
                            <div id="BUTTON898" class="ladi-element">
                                <div class="ladi-button">
                                    <div class="ladi-button-background"></div>
                                    <div id="BUTTON_TEXT898" class="ladi-element"><p class="ladi-headline">ĐĂNG KÝ NGAY</p></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM900" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM901" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item">
                                        <input autocomplete="off" tabindex="2" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="(\+84|0){1}(9|8|7|5|3){1}[0-9]{8}" value="" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="ladi-hidden"></button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="LINE951" class="ladi-element">
                <div class="ladi-line"><div class="ladi-line-container"></div></div>
            </div>
            <div id="IMAGE927" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE931" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
            <div id="IMAGE935" class="ladi-element">
                <div class="ladi-image ladi-transition"><div class="ladi-image-background"></div></div>
            </div>
        </div>
    </div>
    <div id="SECTION161" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-overlay"></div>
        <div class="ladi-container">
            <div id="BOX963" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="BOX964" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="BOX965" class="ladi-element"><div class="ladi-box"></div></div>
            <div id="HEADLINE966" class="ladi-element"><h3 class="ladi-headline">ĐĂNG KÝ NHẬN TƯ VẤN MIỄN PHÍ</h3></div>
            <div id="HEADLINE967" class="ladi-element"><h3 class="ladi-headline">LIÊN HỆ PHÒNG KINH DOANH</h3></div>
            <div id="HEADLINE968" class="ladi-element"><h3 class="ladi-headline">LÝ DO LỰA CHỌN CHÚNG TÔI</h3></div>
            <div id="IMAGE969" class="ladi-element">
                <div class="ladi-image"><div class="ladi-image-background"></div></div>
            </div>
            <div id="HEADLINE970" class="ladi-element"><h3 class="ladi-headline">CĐT VINHOMES SMART CITY - TÂY MỖ - ĐẠI MỖ - NAM TỪ LIÊM - HN</h3></div>
            <div id="PARAGRAPH971" class="ladi-element"><p class="ladi-paragraph">Hotline phòng kinh doanh CĐT</p></div>
            <div id="PARAGRAPH972" class="ladi-element"><p class="ladi-paragraph">098.743.1551</p></div>
            <div id="LIST_PARAGRAPH973" class="ladi-element">
                <div class="ladi-list-paragraph">
                    <ul>
                        <li>Cam kết bảo mật thông tin cá nhân khách hàng</li>
                        <li>Trở thành cầu nối vững chắc, chuyên nghiệp giữa khách hàng và chủ đầu tư</li>
                        <li>Hỗ trợ tư vấn trực tiếp chuyên sâu, chọn căn, tầng đẹp nhất</li>
                        <li>Cung cấp bảng giá gốc, hỗ trợ quý khách làm thủ tục, hợp đồng</li>
                        <li>Khách hàng được xem nhà mẫu trực tiếp</li>
                        <li>Không thu thêm bất cứ khoản phí nào</li>
                    </ul>
                </div>
            </div>
            <div id="GROUP979" class="ladi-element">
                <div class="ladi-group">
                    <div id="FORM286" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                        <form autocomplete="off" method="post" class="ladi-form">
                            <div id="FORM_ITEM288" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM289" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="[0-9]{9,12}" value="" /></div>
                                </div>
                            </div>
                            <div id="BUTTON290" class="ladi-element">
                                <div class="ladi-button">
                                    <div class="ladi-button-background"></div>
                                    <div id="BUTTON_TEXT290" class="ladi-element"><p class="ladi-headline">ĐĂNG KÝ NGAY</p></div>
                                </div>
                            </div>
                            <button type="submit" class="ladi-hidden"></button>
                        </form>
                    </div>
                    <div id="PARAGRAPH978" class="ladi-element"><p class="ladi-paragraph">Đừng ngại ngần, hãy để chúng tôi tư vấn. Hoàn toàn là miễn phí !</p></div>
                </div>
            </div>
        </div>
    </div>
    <div id="SECTION_POPUP" class="ladi-section">
        <div class="ladi-section-background"></div>
        <div class="ladi-container">
            <div id="POPUP437" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div id="GROUP453" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX454" class="ladi-element"><div class="ladi-box"></div></div>
                            <div id="HEADLINE455" class="ladi-element">
                                <h3 class="ladi-headline">
                                    TẢI FULL TÀI LIỆU DỰ ÁN<br />
                                    BẢNG GIÁ &amp; CHÍNH SÁCH BÁN HÀNG MỚI NHẤT<br />
                                </h3>
                            </div>
                            <div id="FORM461" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                                <form autocomplete="off" method="post" class="ladi-form">
                                    <div id="FORM_ITEM462" class="ladi-element">
                                        <div class="ladi-form-item-container">
                                            <div class="ladi-form-item-background"></div>
                                            <div class="ladi-form-item">
                                                <input autocomplete="off" tabindex="1" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="[0-9]{9,12}" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="BUTTON463" class="ladi-element">
                                        <div class="ladi-button">
                                            <div class="ladi-button-background"></div>
                                            <div id="BUTTON_TEXT463" class="ladi-element"><p class="ladi-headline">TẢI XUỐNG NGAY</p></div>
                                        </div>
                                    </div>
                                    <div id="FORM_ITEM465" class="ladi-element">
                                        <div class="ladi-form-item-container">
                                            <div class="ladi-form-item-background"></div>
                                            <div class="ladi-form-item ladi-form-checkbox ladi-form-checkbox-horizontal">
                                                <div class="ladi-form-checkbox-item">
                                                    <input tabindex="2" name="form_item1737" type="checkbox" value="Mat_bang_layout_chi_tiet_Sapphire.pdf" /><span data-checked="false">Mat_bang_layout_chi_tiet_Sapphire.pdf</span>
                                                </div>
                                                <div class="ladi-form-checkbox-item">
                                                    <input tabindex="2" name="form_item1737" type="checkbox" value="Chinh_sach_new_11_3_2021.pdf" /><span data-checked="false">Chinh_sach_new_11_3_2021.pdf</span>
                                                </div>
                                                <div class="ladi-form-checkbox-item">
                                                    <input tabindex="2" name="form_item1737" type="checkbox" value="Bang_gia_full_Vat_update_3_2021.xlsx" /><span data-checked="false">Bang_gia_full_Vat_update_3_2021.xlsx</span>
                                                </div>
                                                <div class="ladi-form-checkbox-item">
                                                    <input tabindex="2" name="form_item1737" type="checkbox" value="Tieu_chuan_ban_giao_Sapphire.pdf" /><span data-checked="false">Tieu_chuan_ban_giao_Sapphire.pdf</span>
                                                </div>
                                                <div class="ladi-form-checkbox-item">
                                                    <input tabindex="2" name="form_item1737" type="checkbox" value="Tai_lieu_ban_hang_tong_hop.pdf" /><span data-checked="false">Tai_lieu_ban_hang_tong_hop.pdf</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="FORM_ITEM961" class="ladi-element">
                                        <div class="ladi-form-item-container">
                                            <div class="ladi-form-item-background"></div>
                                            <div class="ladi-form-item"><input autocomplete="off" tabindex="3" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                                        </div>
                                    </div>
                                    <button type="submit" class="ladi-hidden"></button>
                                </form>
                            </div>
                            <div id="HEADLINE466" class="ladi-element">
                                <h3 class="ladi-headline"><span style="font-weight: bold;">Chọn tài liệu tải xuống:</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="POPUP487" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div class="ladi-overlay"></div>
                    <div id="FORM488" data-config-id="604b72049064d900205c05b7" class="ladi-element">
                        <form autocomplete="off" method="post" class="ladi-form">
                            <div id="FORM_ITEM489" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="name" required class="ladi-form-control" type="text" placeholder="Họ và tên" value="" /></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM490" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="email" required class="ladi-form-control" type="email" placeholder="Email" value="" /></div>
                                </div>
                            </div>
                            <div id="FORM_ITEM491" class="ladi-element">
                                <div class="ladi-form-item-container">
                                    <div class="ladi-form-item-background"></div>
                                    <div class="ladi-form-item"><input autocomplete="off" tabindex="1" name="phone" required class="ladi-form-control" type="tel" placeholder="Số điện thoại" pattern="[0-9]{9,12}" value="" /></div>
                                </div>
                            </div>
                            <div id="BUTTON492" class="ladi-element">
                                <div class="ladi-button">
                                    <div class="ladi-button-background"></div>
                                    <div id="BUTTON_TEXT492" class="ladi-element"><p class="ladi-headline">HOÀN TẤT ĐĂNG KÝ</p></div>
                                </div>
                            </div>
                            <button type="submit" class="ladi-hidden"></button>
                        </form>
                    </div>
                    <div id="HEADLINE499" class="ladi-element"><h3 class="ladi-headline">ĐĂNG KÝ THAM QUAN NHÀ MẪU</h3></div>
                    <div id="IMAGE962" class="ladi-element">
                        <div class="ladi-image"><div class="ladi-image-background"></div></div>
                    </div>
                </div>
            </div>
            <div id="POPUP1003" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div data-action="true" id="HEADLINE1004" class="ladi-element"><h3 class="ladi-headline">TỔNG QUAN</h3></div>
                    <div id="IMAGE1005" class="ladi-element">
                        <div class="ladi-image"><div class="ladi-image-background"></div></div>
                    </div>
                    <div data-action="true" id="HEADLINE1006" class="ladi-element"><h3 class="ladi-headline">VỊ TRÍ</h3></div>
                    <div data-action="true" id="HEADLINE1007" class="ladi-element"><h3 class="ladi-headline">MẶT BẰNG</h3></div>
                    <div data-action="true" id="HEADLINE1008" class="ladi-element"><h3 class="ladi-headline">TIỆN ÍCH</h3></div>
                    <div data-action="true" id="HEADLINE1009" class="ladi-element"><h3 class="ladi-headline">BẢNG GIÁ</h3></div>
                </div>
            </div>
            <div id="POPUP1071" class="ladi-element">
                <div class="ladi-popup">
                    <div class="ladi-popup-background"></div>
                    <div class="ladi-overlay"></div>
                    <div id="GROUP1080" class="ladi-element">
                        <div class="ladi-group">
                            <div id="BOX1073" class="ladi-element"><div class="ladi-box"></div></div>
                            <div id="SHAPE1074" class="ladi-element">
                                <div class="ladi-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 32 32" fill="#F6511F">
                                        <path d="M28.28 6.28L11 23.563l-7.28-7.28-1.44 1.437 8 8 .72.686.72-.687 18-18-1.44-1.44z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="PARAGRAPH1075" class="ladi-element">
                        <p class="ladi-paragraph">Chúng tôi sẽ xác thực thông tin qua số điện thoại của bạn sau 5 phút. Tài liệu sẽ được gửi vào email của bạn.<br style="color: rgb(74, 74, 74);" /></p>
                    </div>
                    <div id="LINE1076" class="ladi-element">
                        <div class="ladi-line"><div class="ladi-line-container"></div></div>
                    </div>
                    <div id="GROUP1077" class="ladi-element">
                        <div class="ladi-group">
                            <div id="HEADLINE1078" class="ladi-element"><h2 class="ladi-headline">thành công!</h2></div>
                            <div id="HEADLINE1079" class="ladi-element"><h2 class="ladi-headline">Đăng ký</h2></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="backdrop-popup" class="backdrop-popup"></div>
<div id="lightbox-screen" class="lightbox-screen"></div>
<script id="script_lazyload" type="text/javascript">
    (function () {
        var list_element_lazyload = document.querySelectorAll(
            ".ladi-section-background, .ladi-image-background, .ladi-button-background, .ladi-headline, .ladi-video-background, .ladi-countdown-background, .ladi-box, .ladi-frame-background, .ladi-banner, .ladi-form-item-background, .ladi-gallery-view-item, .ladi-gallery-control-item, .ladi-spin-lucky-screen, .ladi-spin-lucky-start, .ladi-list-paragraph ul li"
            );
        var style_lazyload = document.getElementById("style_lazyload");
        for (var i = 0; i < list_element_lazyload.length; i++) {
            var rect = list_element_lazyload[i].getBoundingClientRect();
            if (rect.x == "undefined" || rect.x == undefined || rect.y == "undefined" || rect.y == undefined) {
                rect.x = rect.left;
                rect.y = rect.top;
            }
            var offset_top = rect.y + window.scrollY;
            if (offset_top >= window.scrollY + window.innerHeight || window.scrollY >= offset_top + list_element_lazyload[i].offsetHeight) {
                list_element_lazyload[i].classList.add("ladi-lazyload");
            }
        }
        style_lazyload.parentElement.removeChild(style_lazyload);
        var currentScrollY = window.scrollY;
        var stopLazyload = function (event) {
            if (event.type == "scroll" && window.scrollY == currentScrollY) {
                currentScrollY = -1;
                return;
            }
            window.removeEventListener("scroll", stopLazyload);
            list_element_lazyload = document.getElementsByClassName("ladi-lazyload");
            while (list_element_lazyload.length > 0) {
                list_element_lazyload[0].classList.remove("ladi-lazyload");
            }
        };
        window.addEventListener("scroll", stopLazyload);
    })();
</script>
        <!--[if lt IE 9]>
            <script src="https://w.ladicdn.com/v2/source/html5shiv.min.js?v=1614062170934"></script>
            <script src="https://w.ladicdn.com/v2/source/respond.min.js?v=1614062170934"></script>
        <![endif]-->
        <link href="https://fonts.googleapis.com/css?family=Roboto Slab:bold,regular|Quicksand:bold,regular|Oswald:bold,regular|Open Sans:bold,regular|Roboto:bold,regular|Itim:bold,regular&display=swap" rel="stylesheet" type="text/css" />
        <link href="css/ladipage.min.css" rel="stylesheet" type="text/css" />
        <script src="js/ladipage.vi.min.js" type="text/javascript"></script>

    </body>
    </html>
