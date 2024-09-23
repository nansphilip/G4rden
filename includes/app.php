<!-- App framework -->

<?php
class App
{
    // Properties
    public static $pageTitle;
    public static $pageDescription;
    public static $pageFavicon;
    public static $cssFiles;
    public static $jsFiles;
    public static $viewFile;

    // Methods
    public static function setPageTitle($title)
    {
        self::$pageTitle = $title;
    }

    public static function setPageDescription($description)
    {
        self::$pageDescription = $description;
    }

    public static function setPageFavicon($favicon)
    {
        self::$pageFavicon = "static/img/$favicon";
    }

    public static function loadCssFiles($files)
    {
        foreach ($files as $file) {
            self::$cssFiles[] = "static/css/$file.css";
        }
    }

    public static function loadJsFiles($files)
    {
        foreach ($files as $file) {
            self::$jsFiles[] = "static/js/$file.js";
        }
    }

    public static function loadViewFile($view)
    {
        require_once("view/$view.php");
    }
}
?>