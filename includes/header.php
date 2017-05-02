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