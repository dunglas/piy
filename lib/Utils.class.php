<?php
/**
 * Some utilities.
 *
 */
class Utils {
	/**
	 * Generate an unique id.
	 *
	 * @return String unique id.
	 */
	public static function generateHash() {
		return md5(uniqid(rand(), true));
	}

  /**
   * Send an email using Zend Framework
   *
   * @param mixed $to an address or an array of addresses
   * @param string $subject the mail subject
   * @param string $body the mail body
   * @param string $from an address
   */
  public static function sendMail($to, $subject, $body, $from = null) {
    ProjectConfiguration::registerZend();
    
    $mail = new Zend_Mail();
    $mail->setBodyText($body);

    if (is_null($from)) {
      $mail->setFrom(
        sfConfig::get('app_email_address'),
        sfConfig::get('app_email_name')
      );
    } else {
      $mail->setFrom($from['address'], $from['name']);
    }

    if (is_array($to)) {
      foreach ($to as $address) {
        $mail->addTo($address);
      }
    } else {
      $mail->addTo($to);
    }

    $mail->setSubject($subject);
    $mail->send();
  }
}
?>