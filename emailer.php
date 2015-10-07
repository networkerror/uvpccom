<?php
/**
 * A simple class for validating and sending emails.
 **/
class Emailer {

  /*
   * User-supplied data...
   */
  protected $toEmail;
  protected $fromEmail;
  protected $subject;
  protected $message;

  /*
   * Internal variables
   */
  protected $errors = array();
  protected $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  /*
   * Chain these to configure your instance.
   */
  public function toEmail($email)   { $this->toEmail = sanitize($email); return $this;   }
  public function fromEmail($email) { $this->fromEmail = sanitize($email); return $this; }
  public function subject($subject) { $this->subject = sanitize($subject); return $this; }
  public function message($message) { $this->message = sanitize($message); return $this; }

  /**
   * Validate current from/to email and message.
   * If there are messages, use the appropriate method to fetch them.
   *
   * @return bool     true - all good, false - explode!
   **/
  public function validate() {
    $this->errors = array();
    if (!$this->toEmail || preg_match($this->email_exp, $this->toEmail)) {
      $this->errors[] = 'Please specify a destination email address.';
    }
    if (!$this->fromEmail || !preg_match($this->email_exp, $this->fromEmail)) {
      $this->errors[] = 'Please enter a valid email address.';
    }
    if (!$this->subject || strlen($this->subject) === 0) {
          $this->errors[] = 'Please enter a valid subject.';
    }
    if (!$this->message || strlen($this->message) < 2) {
      $this->errors[] = 'Please enter a valid message.';
    }

    $goodToGo = count($this->errors) === 0;
    return $goodToGo;
  }

  public function getErrors() { return $this->errors; }

  /**
   * Send the email as configured.
   * Runs $this->validate() prior to sending.
   *
   * @return bool   true - all good, false - explode!
   **/
  public function send() {
    $goodToGo = $this->validate();
    if ($goodToGo) {
      $headers = 'From: '.$this->fromEmail."\r\n".
      'Reply-To: '.$this->fromEmail."\r\n" .
      'X-Mailer: PHP/' . phpversion();
      @mail($this->toEmail, $this->subject, $this->message, $headers);
    }
    return $goodToGo;
  }

  /**
   * Sanitize a string for use in an email.
   * Stolen from Pear Mail.
   * @param $str    String to sanitize
   * @return        Sanitized string
   **/
  protected function sanitize($str) {
    return preg_replace('=((<CR>|<LF>|0x0A/%0A|0x0D/%0D|\\n|\\r)\S).*=i', null, $str);
  }

}
