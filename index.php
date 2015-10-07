<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>UV Paint & Coatings</title>
  <meta name="description" content="UV Paint & Coatings">

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="index.css">
</head>

<body>

<header class="page-header">
  <section>
    <h1>UV Paint & Coatings</h1>
    <small>Custom designed coatings cured with the power of UV light</small>
  </section>
</header>

<main>
  <section>
    <h4>We design custom UV coatings for a variety of materials.  Our coatings range from decorative to corrosion resistant to hardening.</h4>

    <figure class="well metal">
      <h2>Metal</h2>
    </figure>
    <figure class="well glass">
      <h2>Glass</h2>
    </figure>
    <figure class="well plastic">
      <h2>Plastic</h2>
    </figure>
  </section>

  <section>
    <h2>Contact</h2>

    <address>
      UV Paint & Coatings<br>
      509 Marin #125<br>
      Thousand Oaks, CA 91360
    </address>

    <address>(805) 390-1866</address>

    <h3>Email</h3>
    <?php
    if(isset($_POST['email'])) {
      function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
      }

      // validation expected data exists
      if(!isset($_POST['email']) ||
         !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
      }

      $email_from = $_POST['email']; // required
      $comments = $_POST['message']; // required


      // EDIT THE 2 LINES BELOW AS REQUIRED
      $email_to = "networkerror@gmail.com";
      $email_subject = "Message from UVPC.COM email form ($email_from)";

      $error_message = "";

      $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
      if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
      }
      if(strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
      }
      if(strlen($error_message) > 0) {
        died($error_message);
      }
      $email_message = "";

      function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
      }

      $email_message .= "Email: ".clean_string($email_from)."\n";
      $email_message .= "Comments: ".clean_string($comments)."\n";

      // create email headers
      $headers = 'From: '.$email_from."\r\n".
      'Reply-To: '.$email_from."\r\n" .
      'X-Mailer: PHP/' . phpversion();
      @mail($email_to, $email_subject, $email_message, $headers);
    ?>

      Thank you for contacting us. We will be in touch with you very soon.

    <?php
    } else {
    ?>
    <form action="./" method="POST">
      <input type="text" name="email" placeholder="Email Address">
      <br>
      Message
      <br>
      <textarea name="message"></textarea>
      <br>
      <input class="btn btn-primary" type="submit" value="SEND">
    </form>
    <?php
    }
    ?>
  </section>
</main>

<footer>
  <section></section>
</footer>

</body>
</html>