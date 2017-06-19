<?php
/**
 * Created by PhpStorm.
 * User: A-Z
 * Date: 4/29/2017
 * Time: 11:24 AM
 */
require_once('includes/lib_mail.php');
require_once('includes/functions.php');

$thisPage = $_SERVER['SCRIPT_NAME'];
$robots = 'follow, index';
$debug = 1;
$pdf_folder_path = '/PDF/';

if($debug == 1) {
    $robots = 'index, nofollow';
}

if(request('ajax') == "contact_us") {
    $spammer = false;
    $honeypotfield = 'additional_email_' . date('md');
    if(request($honeypotfield) || !isset($_POST[$honeypotfield])) {
        $spammer = true;
    }
    if(!$spammer) {
        // send email
        sendContactEmail(request('full_name'), request('email'), request('phone'), request('message'));
    }
    echo "success";
    exit;
}

if(request('ajax') == "download") {
    $spammer = false;
    $honeypotfield = 'additional_email_' . date('md');
    if(request($honeypotfield) || !isset($_POST[$honeypotfield])) {
        $spammer = true;
    }
    if(!$spammer) {
        // send email
        sendBrochureEmail(request('brochure_full_name'), request('brochure_email'));
    }
    echo "success";
    exit;
}
if(request('ajax') == "download_brochure") {
    // downlaod PDF
    $file = $_SERVER['DOCUMENT_ROOT'] . $pdf_folder_path . 'TEST.pdf';
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile($file);
}

if(request('ajax') == "transitionPage") {
    $html2 = '';
    if(request('pageid') == 1) {
        $html2 = '
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="intro-wrapper">
                <h2>We would love to hear about your project or tell you a little more about our product, so send us a message below and we will get in touch.</h2>
            </div>
            <div class="contact-details-wrapper">
                <a href="javascript:;" class="close-me logo" data-animation="2"><img src="/images/starke-logo-white.svg" alt="Stärke Group Ltd" /></a>
                <ul>
                    <li><b>Stärke Group Ltd</b></li>
                    <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Place, Wiri, Auckland 2104, New Zealand</a></li>
                    <li><a href="tel:06421538708">+64 21 538 708</a></li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 no-padding-xs">
            ' . contactUs() . '
        </div>
        <div class="contact-details-wrapper visible-xs">
            <ul>
                <li><b>Stärke Group Ltd</b></li>
                <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Place, Wiri, Auckland 2104, New Zealand</a></li>
                <li><a href="tel:06421538708">+64 21 538 708</a></li>
            </ul>
        </div>';
    } elseif(request('pageid') == 2) {
        $html2 = '      
        <div class="col-xs-12 col-md-12 no-padding-xs">
            ' . brochureDownload() . '
            <div class="contact-details-wrapper">
                <a href="javascript:;" class="close-me logo" data-animation="2"><img src="/images/starke-logo-white.svg" alt="Stärke Group Ltd" /></a>
                <ul>
                    <li><b>Stärke Group Ltd</b></li>
                    <li><a href="https://www.google.co.nz/maps/place/4+Wilco+Pl,+Wiri,+Auckland+2104/@-37.0119681,174.8427,17z/data=!3m1!4b1!4m5!3m4!1s0x6d0d4e1d2f8b9263:0x6a214e43343b101c!8m2!3d-37.0119724!4d174.8448887" target="_blank">4 Wilco Place, Wiri, Auckland 2104, New Zealand</a></li>
                    <li><a href="tel:099518964">+64 9 951 8964</a></li>
                </ul>
            </div>
        </div>';
    }
echo $html2;
    exit;
}