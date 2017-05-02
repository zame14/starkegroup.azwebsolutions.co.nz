<?php require_once('includes/header.php'); ?>
<!DOCTYPE html>
<head>
    <title>Starke Group | Windows created for life</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="<?=$robots?>" />
    <meta name="viewport" content="width=device-width; initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="stylesheet" href="/includes/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/includes/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="/includes/styles.css?<?=strtotime('now')?>" type="text/css" />
    <link rel="stylesheet" href="/includes/template.css?<?=strtotime('now')?>" type="text/css" />
    <script type="text/javascript" src="/includes/jquery.js"></script>
    <script type="text/javascript" src="/includes/modernizr.custom.js"></script>
</head>
<body>
<div id="pt-main" class="pt-perspective">
    <div class="pt-page pt-page-1">
        <main id="main">
            <section id="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <a href="/"><img src="/images/starke-logo.svg" alt="Stärke Group Ltd" /></a>
                        </div>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <h1>Windows<br />created for life</h1>
                        <div class="intro-wrapper">
                            <h2>It's not an easy task, but we've searched far and wide to find the best solutions, and we'll continue to do that.</h2>
                        </div>
                        <div class="content-wrapper">
                            <p>Brief intro Stärke Group followed by we are currently working on our full website but in the meantime, please drop us a line or download the Stärke brochure below.</p>
                            <p>We're looking forward to showing you the future.</p>
                        </div>
                        <div class="buttons-wrapper">
                            <a href="javascript:;" class="btn btn-primary contact-us" data-animation="1">Talk with us</a>
                            <a href="javascript:;" class="btn btn-primary request-brochure" data-animation="1">Request Brochure</a>
                        </div>
                    </div>
                </div>
            </div>
            <section id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <ul class="footer-menu">
                                <li><a href="/">Stärke Group Ltd</a></li>
                                <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Pl, Wiri, Auckland, NZ</a></li>
                                <li><a href="tel:091234567">+64 9 123 4567</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="pt-page pt-page-2">
        <main id="main">
            <div class="outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 close-button-wrapper-xs">
                            <a href="javascript:;" class="close-me" data-animation="2"><span class="fa fa-times"></span></a>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="intro-wrapper">
                                <h2>We would love to hear about your project or tell you a little more about our product, so send us a message below and we will get in touch.</h2>
                            </div>
                            <div class="contact-details-wrapper">
                                <a href="javascript:;" class="close-me logo" data-animation="2"><img src="/images/logo-white.png" alt="Stärke Group Ltd" /></a>
                                <ul>
                                    <li><b>Stärke Group Ltd</b></li>
                                    <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Pl, Wiri, Auckland, NZ</a></li>
                                    <li><a href="tel:091234567">+64 9 123 4567</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 no-padding-xs">
                            <?=contactUs()?>
                        </div>
                        <div class="contact-details-wrapper visible-xs">
                            <ul>
                                <li><b>Stärke Group Ltd</b></li>
                                <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Pl, Wiri, Auckland, NZ</a></li>
                                <li><a href="tel:091234567">+64 9 123 4567</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 close-button-wrapper">
                            <a href="javascript:;" class="close-me" data-animation="2"><span class="fa fa-angle-up"></span>close</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div class="pt-page pt-page-3">
        <main id="main">
            <div class="outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 close-button-wrapper-xs">
                            <a href="javascript:;" class="close-me" data-animation="2"><span class="fa fa-times"></span></a>
                        </div>
                        <div class="col-xs-12 col-md-12 no-padding-xs">
                            <?=brochureDownload()?>
                            <div class="contact-details-wrapper">
                                <a href="javascript:;" class="close-me logo" data-animation="2"><img src="/images/logo-white.png" alt="Stärke Group Ltd" /></a>
                                <ul>
                                    <li><b>Stärke Group Ltd</b></li>
                                    <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Pl, Wiri, Auckland, NZ</a></li>
                                    <li><a href="tel:091234567">+64 9 123 4567</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 close-button-wrapper">
                            <a href="javascript:;" class="close-me" data-animation="3"><span class="fa fa-angle-up"></span>close</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="/includes/dlmenu.js"></script>
<script src="/includes/template.js?<?=strtotime('now')?>"></script>
</body>
</html>