<!-- Home view -->

<?php
// Includes the header
require_once ("view/components/header.php");
?>

<!-- Body content start -->

<h1><?= App::$pageTitle; ?></h1>
<p class="test"><?= App::$pageDescription; ?></p>

<!-- Body content end -->

<?php
// Includes the footer
require_once ("view/components/footer.php");
?>