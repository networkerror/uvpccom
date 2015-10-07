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
    $sendingEmail = (boolean)$_POST['email'];
    $sentEmail = false;
    if($sendingEmail) {
      require_once('emailer.php');

      $emailer = new Emailer();
      $emailer->toEmail('networkerror@gmail.com')
              ->fromEmail($_POST['email'])
              ->subject("uv-pc.com message from '".$_POST['email']."'")
              ->message($_POST['message']);
      $sentEmail = $emailer->send();
      if ($sentEmail) {
        ?>
        <div class="alert alert-success">You message has been sent.  Thank you.</div>
        <?php
      } else {
        $errorOut = "<ul><li>".implode($emailer->getErrors(), "</li><li>")."</li></ul>";
        ?>
        <div class="alert alert-danger">
          We encountered a problem sending your message:<br>
          <?php echo $errorOut; ?>
        </div>
        <?php
      }
    }

    if (!sendingEmail || !$sentEmail) {
    ?>
    <form action="./" method="POST">
      <input type="text" name="email" placeholder="Email Address" value="<?php echo $_POST['email']; ?>">
      <br>
      Message
      <br>
      <textarea name="message"><?php echo $_POST['message']; ?></textarea>
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