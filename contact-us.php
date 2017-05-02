<?php require_once('includes/header.php'); ?>
<!DOCTYPE html>
<head>
    <title>Starke Group | Contact Us</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="<?=$robots?>" />
    <meta name="viewport" content="width=device-width; initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
    <link rel="stylesheet" href="/includes/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/includes/font-awesome.css" type="text/css" />
    <link rel="stylesheet" href="/includes/styles.css?<?=strtotime('now')?>" type="text/css" />
    <link rel="stylesheet" href="/includes/template.css?<?=strtotime('now')?>" type="text/css" />
</head>
<body>
<div class="brochure-template">
    <main id="main">
        <div class="outer-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?=brochureDownload()?>
                        <div class="contact-details-wrapper">
                            <a href="/" class="logo"><img src="/images/logo-white.png" alt="Stärke Group Ltd" /></a>
                            <ul>
                                <li><b>Stärke Group Ltd</b></li>
                                <li>4 Wilco Pl, Wiri, Auckland, NZ</li>
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
<script src="/includes/template.js?<?=strtotime('now')?>"></script>
</body>
</html>