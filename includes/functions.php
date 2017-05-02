<?php
/**
 * Created by PhpStorm.
 * User: A-Z
 * Date: 4/29/2017
 * Time: 11:24 AM
 */
function contactUs() {
    global $thisPage;
    $html = '
	<div class="contact-form">
		<div class="form-wrapper">
			<form method="post" action="' . $thisPage . '" onsubmit="contactUs(this); return false;" id="Contact_Form" >
				<div class="name-field"><input type="text" name="full_name" required="required" placeholder="Name" id="full_name" class="form-control" /></div>
				<div class="email-field"><input type="email" name="email" required="required" placeholder="Email" class="form-control" id="email" /></div>
				<div class="phone-field"><input type="text" name="phone" required="required" placeholder="Phone Number" class="form-control" id="phone" /></div>
				<div class="message-field"><textarea required="required" placeholder="Message" name="message" class="form-control" id="message"></textarea></div>
				<div class="submit-wrapper">
					<input type="submit" class="btn btn-default send-message" value="Send Message" />
				</div>
				<div style="display:none;"><input type="text" value="" name="additional_email_' . date('md') . '" /></div>
			</form>	
		</div>
	</div>
	<div class="cta-form-success">
		<p>Thank you, your message has been sent.</p>
	</div>';

    return $html;
}

function brochureDownload() {
    global $thisPage;
    $html = '
	<div class="contact-form">
		<div class="form-wrapper">
			<form method="post" action="' . $thisPage . '" onsubmit="downloadBrochure(this); return false;" id="Brochure_Form" >
				<div class="name-field"><input type="text" name="brochure_full_name" required="required" placeholder="Name" id="brochure_full_name" class="form-control" /></div>
				<div class="email-field"><input type="email" name="brochure_email" required="required" placeholder="Email" class="form-control" id="brochure_email" /></div>
				<div class="submit-wrapper">
					<input type="submit" class="btn btn-default download-brochure" value="Download Brochure" />
				</div>
				<div style="display:none;"><input type="text" value="" name="additional_email_' . date('md') . '" /></div>
			</form>	
		</div>
	</div>
	<div class="cta-form-success">
		<p>Thank you for downloading our brochure.</p>
	</div>';

    return $html;
}

function request($name) {
    $value = '';
    if(isset($_REQUEST[$name])) {
        $value = $_REQUEST[$name];
        if(is_string($value)) $value = trim($value);
    }
    return $value;
}

function sendContactEmail($full_name, $email, $phone, $message) {
    $sFrom		= 'aaron.zame@gmail.com';
    $sFromName	= 'Stärke Group Ltd';
    $sTo 		= 'aaron.zame@gmail.com';
    $sToName 	= 'aaron.zame@gmail.com';
    $sSubject 	= 'Contact Us - ' . $full_name;
    $emailBody = '
    <html>
    <head>
    <style>
    body, td, p {
        font-family: calibri, Verdana;
        font-size:15px;
        font-weight:normal;
        font-style:normal;
        text-decoration: none;
        font-variant:normal;
        color:#000000;
    }
    a {
        color: #1f6db0;
        text-decoration: none;
    }
    </style>
    </head>
    <body>	
        Hi Admin,<br /><br />
        A new website enquiry:<br /><br />
        <table>
            <tr>
                <td><b>Full Name</b></td>
                <td>' . $full_name . '</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td>' . $email . '</td>
            </tr>
            <tr>
                <td><b>Phone</b></td>
                <td>' . $phone . '</td>
            </tr>												
            <tr>
                <td colspan="2"><b>Message</b></td>	
            </tr>
            <tr>
                <td colspan="2">' . $message . '</td>	
            </tr>
        </table>
    </body></html>';

    sendMail($sFrom, $sFromName, $sTo, $sToName, $sSubject, $emailBody);
}

function sendBrochureEmail($full_name, $email) {
    $sFrom		= 'aaron.zame@gmail.com';
    $sFromName	= 'Stärke Group Ltd';
    $sTo 		= 'aaron.zame@gmail.com';
    $sToName 	= 'aaron.zame@gmail.com';
    $sSubject 	= 'New Brochure Download - ' . $full_name;
    $emailBody = '
    <html>
    <head>
    <style>
    body, td, p {
        font-family: calibri, Verdana;
        font-size:15px;
        font-weight:normal;
        font-style:normal;
        text-decoration: none;
        font-variant:normal;
        color:#000000;
    }
    a {
        color: #1f6db0;
        text-decoration: none;
    }
    </style>
    </head>
    <body>	
        Hi Admin,<br /><br />
        A new brochure download:<br /><br />
        <table>
            <tr>
                <td><b>Full Name</b></td>
                <td>' . $full_name . '</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td>' . $email . '</td>
            </tr>
        </table>
    </body></html>';

    sendMail($sFrom, $sFromName, $sTo, $sToName, $sSubject, $emailBody);
}