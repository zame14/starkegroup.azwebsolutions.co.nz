<?php
/**
 * Mail Library
 * 
 * @author			Peter Chapman
 * @version			1.0.16.11.28
 *
 * The functions of this library send and receive email
 *
 * Requirements:
 *  - class.phpmailer.php	PHPMailer
 *
 * Functions: (bracketed parameters are optional)
 *  - isEmailAddressValid(EmailAddress) - Checks if an email address is valid
 *  - sendMail(From, From Name, To, To Name, Subject, Body, (BodyAlt), (BCC), (Attacments)) - Sends an email
 *  - checkSpamScore(Subject, Body, (Text Body)) - Returns a SPAM score calculated from SPAM Assassin
 *  - formatMailClassStyle(HTML) - Double checks all CSS styles in the attribute and removes any duplicates 
 *  - class mailQueue() - Returns status of mail queue on the server
 */

/**
 * Checks an email address to see if it is valid
 *
 * @return boolean
 * @author				Peter Chapman
 * @version				1.0.09.02.16
 * @param $email		- Email address to check, E.g. example@example.com
 */
function isEmailAddressValid($email) {
	// This is a fairly simplistic implementation. Feel free to improve.
	return strpos($email, '@') && strpos($email, '.', strpos($email, '@')) && strpos($email, ':') == false && strpos($email, ' ') == false;
}

/**
 * Sends an email
 *
 * @return boolean
 * @author				Peter Chapman
 * @version				1.0.16.10.31
 * @param $sFrom		- From address, E.g. example@example.com
 * @param $sFromName	- From name, E.g. Example Name
 * @param $sTo			- Email address recipient, E.g. recipient@recipient.com
 * @param $sToName		- To name, E.g. Recipient Name
 * @param $sSubject		- Email subject
 * @param $sBody		- Body of email in HTML format
 * @param $sBodyAlt		- Plain text version of email - not required
 * @param $sBcc			- Bcc emails received as an array
 * @param $sAttachments	- Email attachments received as an array
 * @param $sReplyTo 	- The reply to address or addresses as an array
 */
function sendMail($sFrom, $sFromName, $sTo, $sToName, $sSubject, $sBody, $sBodyAlt = '', $sBcc = '', $sAttachments = '', $sReplyTo = '') {

    require_once('includes/class.phpmailer.php');

	$mail = new PHPMailer();

	$mail->Mailer	= 'mail';	// 'mail', 'sendmail', or 'smtp'
	$mail->SMTPAuth	= false;
	$mail->Sender	= $sFrom;	// Return Path address
	$mail->CharSet	= 'UTF-8';

	$mail->From = $sFrom;
	$mail->FromName = $sFromName;
	if (is_array($sTo)) {
		foreach ($sTo as $index => $address) {
			if ($address) {
				if (isset($sToName[$index])) {
					$mail->AddAddress($address, $sToName[$index]);
				} else {
					$mail->AddAddress($address);
				}
			}
		}
	} else {
		if ($sToName) {
			$mail->AddAddress($sTo, $sToName);
		} else {
			$mail->AddAddress($sTo);
		}
	}

	if ($sBcc) {
		if (is_array($sBcc)) {
			foreach ($sBcc as $address) if ($address) $mail->AddBCC($address, $address);
		} else {
			$mail->AddBCC($sBcc, $sBcc);
		}
	}

	if ($sReplyTo) {
		if (is_array($sReplyTo)) {
			foreach ($sReplyTo as $address) if ($address) $mail->AddReplyTo($address);
		} else {
			$mail->AddReplyTo($sReplyTo);
		}
	}

	$mail->WordWrap = 150;	// set word wrap
	$mail->IsHTML(true);	// send as HTML

	// Attachment
	if ($sAttachments) {
		if (is_array($sAttachments)) {
			foreach ($sAttachments as $attachment) if ($attachment) $mail->AddAttachment($attachment);
		} else {
			$mail->AddAttachment($sAttachments);
		}
	}

	$mail->Subject = $sSubject;
	$mail->Body = $sBody; // $sBody should already be properly encoded HTML. If it ain't you'll get problems.
	// Use an plain text version if supplied or create our own one
	if ($sBodyAlt) {
		$mail->AltBody	= $sBodyAlt;
	} else {
		$sBodyAlt = $sBody;
		// Force an alternative body if this is an HTML message otherwise we are marked down because of it
		if(strpos($sBodyAlt, '<html') !== false) {
			// Start from the body tag if it exists so that we can strip out any extra text in the <head> tag
			if(strpos(strtolower($sBodyAlt), '<body') !== false) $sBodyAlt = trim(strip_tags(substr($sBodyAlt, strpos(strtolower($sBodyAlt), '<body'))));
		}
		$mail->AltBody	= $sBodyAlt;
	}
	if (!$mail->Send())	{
		echo "Message was not sent <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
		exit;	
	} else {
		return true;
	}
	
}



/**
 * Converts and style declaration in a HTML template and sets them as inline CSS
 * 
 * @param string $html		HTML template containing <style></style> tags to convert
 * 
 * @return string
 * @author Nigel Wells
 * @version 1.0.14.02.10
 */
function setMailClassInline($html) {
	// Find section where all the styles are set
	if($start = strpos($html, '<style')) {
		$start = $start + 6;
		// Go to the end of the style tag just incase it has some attributes
		$start = strpos($html, '>', $start) + 1;
		if($finish = strpos($html, '</style>', $start)) {
			$styles = Array();
			$styleHTML = substr($html, $start, $finish - $start);
			// Break everything based on the end declaration
			$classes = explode('}', $styleHTML);
			// Loop through each class
			foreach($classes as $details) {
				if(trim($details)) {
					// Break it up a bit further so the class is on its own
					list($names, $css) = explode('{', $details);
					// Build a complete list and add later as some classes might be associated with many elements
					$classNames = explode(',', $names);
					foreach($classNames as $class) {
						$class = trim($class);
						if($class) {
							if(!isset($styles[$class])) $styles[$class] = '';
							$styles[$class] .= trim($css);
						}
					}
				}
			}
			// Loop through any styles found and add them as inline to the HTML
			if(count($styles)) foreach($styles as $class => $css) {
				// Check if this is a class or a generic element
				if(substr($class, 0, 1) == '.') {
					$class = substr($class, 1);
					// Need to be a bit more careful here as need to make sure styles haven't already been applied from a class
					$tag = 'class="' . $class; // This is assuming there is only one class per element for now
					$classStart = strpos($html, $tag);
					while($classStart > 0) {
						// We need to find the start of the element
						$tagStart = rstrpos($html, '<', $classStart) - 1;
						// Find the end of the element
						$tagEnd = strpos($html, '>', $tagStart) + 1;
						$element = substr($html, $tagStart, $tagEnd - $tagStart);
						// Check to see if a style has already been applied
						if(strpos($element, 'style=') === false) {
							// Safe to add in then
							$element = $element = str_replace($tag, 'style="' . $css, $element);
						} else {
							// Put it inside the style tag - watch out inheritence!
							$element = str_replace('style="', 'style="' . $css, $element);
							// Remove class
							$element = str_replace($tag, 'class="', $element);
						}
						// Format the styles in the element so that duplicated styles are removed
						$element = formatMailClassStyle($element);
						// Add the modified element back into the template
						$html = substr($html, 0, $tagStart) . $element . substr($html, $tagEnd);
						// Loop through to the next instance
						$classStart = strpos($html, $tag, $classStart + 1);
					}
				} else {
					// Get the full element
					$tag = '<' . $class;
					$tagStart = strpos($html, $tag);
					while($tagStart > 0) {
						$tagEnd = strpos($html, '>', $tagStart) + 1;
						$element = substr($html, $tagStart, $tagEnd - $tagStart);
						// Check to see if a style has already been applied
						if(strpos($element, 'style=') === false) {
							// Safe to add in then
							$element = $element = str_replace($tag, $tag . ' style="' . $css . '"', $element);
						} else {
							// Put it inside the style tag - watch out inheritence!
							$element = str_replace('style="', 'style="' . $css, $element);
						}
						// Format the styles in the element so that duplicated styles are removed
						$element = formatMailClassStyle($element);
						// Add the modified element back into the template
						$html = substr($html, 0, $tagStart) . $element . substr($html, $tagEnd);
						// Loop through to the next instance
						$tagStart = strpos($html, $tag, $tagStart + 1);
					}
				}
			}
			// Remove any empty classes
			$html = str_replace('class=""', '', $html);
		}
	}
	// Return amended HTML
	return $html;
}

/**
 * Double checks all CSS styles in the attribute and removes any duplicates
 * 
 * @param string $element		Full HTML element including all attributes
 * 
 * @return string
 * @author Nigel Wells
 * @version 1.0.14.02.10
 */
function formatMailClassStyle($element) {
	// Find the style tag and get its contents
	$valid = Array();
	if($tagStart = strpos($element, 'style="')) {
		$tagStart = $tagStart + 7;
		// make sure there is a valid end
		if($tagEnd = strpos($element, '"', $tagStart)) {
			// Get the CSS
			$css = substr($element, $tagStart, $tagEnd - $tagStart);
			$styles = explode(';', $css);
			// Loop through all styles and construct an array of valid ones
			foreach($styles as $code) {
				$code = trim($code);
				if($code) {
					list($style, $format) = explode(':', $code);
					$style = trim($style);
					$format = trim($format);
					// Only add if it doesn't already exist - basic inheritence
					if(!isset($valid[$style])) $valid[$style] = $format;
				}
			}
			// Re-create valid CSS to put back into the element
			$css = '';
			if(count($valid)) foreach($valid as $style => $format) {
				$css .= $style . ':' . $format . ';';
			}
			// Put new CSS back into the element
			$element = substr($element, 0, $tagStart) . $css . substr($element, $tagEnd);
		}
	}
	// Return amended HTML
	return $element;
}

/**
 * Class to check the current status of the mail queue on the server
 *
 * @return object
 * @author				Nigel Wells
 * @version				1.0.10.11.18
 */
class mailQueue {
	var $queue = Array();
	
	/**
	 * The constructor
	 * 
	 * @author			Nigel Wells
	 * @version			1.0.10.11.18
	 */
	function mailQueue() {
		$this->getQueue();
	}
	
	/**
	 * Gets the mail queue from the system and builds it into a meaningful array
	 * 
	 * @return			void
	 * @author			Nigel Wells
	 * @version			1.0.12.10.12
	 */
	function getQueue() {
		$email = Array();
		$id = 0;
		// Get results of mail queue
		exec('mailq', $results);
		// Loop through results - skip out the first and last line
		$start = true;
		for($i = 1; $i < (count($results) - 1); $i++) {
			$line = trim($results[$i]);
			// A blank line means there is no more information to this lot of mail
			if(!$line) {
				$start = true;
			} else {
				if($start) {
					// Add results to the mail queue
					if($email != Array()) $this->queue[] = $email;
					$email = Array();
					$detail = explode('  ', $line);
					$id = count($email);
					$email['id'] = trim($detail[0]);
					$email['size'] = trim(substr($detail[2], 0, strpos($detail[2], ' ')));
					$email['time'] = strtotime(trim(substr($detail[2], strpos($detail[2], ' '))));
					$email['sender'] = (isset($detail[3]) ? trim($detail[3]) : '');
					// Check if the email has been processed yet
					if(substr($email['id'], -1) == '*') {
						$processed = false;
					} else {
						$processed = true;
					}
					$email['processed'] = $processed;
					$start = false;
				} else {
					// If its been processed then something went wrong and its just sitting here
					$error = '';
					if($email['processed']) {
						$email['error'] = $line;
						$i++;
						$line = trim($results[$i]);
					}
					$email['recipient'] = $line;
				}
			}
		}
	}
	
	/**
	 * Refreshes the queue
	 * 
	 * @return			void
	 * @author			Nigel Wells
	 * @version			1.0.10.11.18
	 */
	function refresh() {
		$this->getQueue();
	}
	
	/**
	 * Gets the total amount of emails currently in the mail queue
	 * 
	 * @return			integer
	 * @author			Nigel Wells
	 * @version			1.0.10.11.18
	 */
	function total() {
		return count($this->queue);
	}
	
	/**
	 * Gets the total amount of emails that have been processed - usually these are deferred
	 * 
	 * @return			integer
	 * @author			Nigel Wells
	 * @version			1.0.10.11.18
	 */
	function processed() {
		$count = 0;
		foreach($this->queue as $email) {
			if($email['processed']) $count++;
		}
		return $count;
	}
	
	/**
	 * Gets the total amount of emails that are yet to be processed
	 * 
	 * @return			integer
	 * @author			Nigel Wells
	 * @version			1.0.10.11.18
	 */
	function notProcessed() {
		$count = 0;
		foreach($this->queue as $email) {
			if(!$email['processed']) $count++;
		}
		return $count;
	}
}
?>