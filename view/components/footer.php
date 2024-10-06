<?php
// Footer for each page
?>

<button type="button" id="arrow_to_top" class="arrow_to_top">↑</button>

<footer>
    <p>G4rden - Made with ❤️ by <a target="_blank" href="https://github.com/nansphilip/G4rden">G4rden's Team.</a></p>
</footer>

<?php // Scripts 
?>
<script src="static/js/global.js"></script>
<script src="static/js/arrow_to_top.js"></script>
<?php if (is_array(App::$jsFiles)) {
    foreach (App::$jsFiles as $file) {
        echo "<script src='$file' type='module'></script>";
    }
} ?>

</body>

</html>