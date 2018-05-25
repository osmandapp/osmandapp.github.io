<?php
    header("Location: https://www.".$_GET["lang"].".wikivoyage.org/wiki/".$_GET["title"], true, 302);
    exit;
?>
