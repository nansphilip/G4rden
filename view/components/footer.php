<?php // Footer for each page ?>

<button type="button" id="arrow_to_top" class="arrow_to_top">↑</button>

<footer class="mt-2">
    <p class="italic text-sm text-secondary">G4rden - Made by <a class="italic text-sm text-secondary" target="_blank" href="https://github.com/nansphilip/G4rden">G4rden's Team</a></p>
</footer>

</main>

<?php // Scripts  ?>

<script>
    // Gives the index.php timezone configuration to the view
    const timezoneConfig = "<?= date_default_timezone_get(); ?>";
</script>

<script src="static/js/global.js" type="module"></script>

<?php if (is_array(App::$jsFiles)) {
    foreach (App::$jsFiles as $file) {
        echo "<script src='$file' type='module'></script>";
    }
} ?>

</body>

</html>