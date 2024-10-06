<?php
/**
 * App class
 * A minimalist PHP framework based on MVC pattern.
 * @example
 * // Set page meta data
 * App::setPageTitle("Home");
 * App::setPageDescription("Welcome to G4rden");
 * App::setPageFavicon("world.png");
 *
 * // Load the view
 * App::loadCssFiles(["home", "global"]);
 * App::loadJsFiles(["home", "global"]);
 * App::loadViewFile("home");
 */
class App
{
    // Properties
    public static $pageTitle;
    public static $pageDescription;
    public static $pageFavicon;
    public static $cssFiles;
    public static $jsFiles;
    public static $viewFile;
    public static $profile;

    // Methods

    /**
     * Sets the page title
     * @param string $title
     */
    public static function setPageTitle($title)
    {
        self::$pageTitle = $title;
    }

    /**
     * Sets the page description
     * @param string $description
     */
    public static function setPageDescription($description)
    {
        self::$pageDescription = $description;
    }

    /**
     * Sets the page favicon
     * @param string $favicon
     */
    public static function setPageFavicon($favicon)
    {
        self::$pageFavicon = "static/img/$favicon";
    }

    /**
     * Loads CSS files
     * @param array $files
     */
    public static function loadCssFiles($files)
    {
        foreach ($files as $file) {
            self::$cssFiles[] = "static/css/$file.css";
        }
    }

    /**
     * Loads JS files
     * @param array $files
     */
    public static function loadJsFiles($files)
    {
        foreach ($files as $file) {
            self::$jsFiles[] = "static/js/$file.js";
        }
    }

    /**
     * Loads the view file, and injects the given variables
     * @param string $view file name without the .php extension
     * @param array $variableList to inject in the view
     */
    public static function loadViewFile($view, $variableList = [])
    {
        try {
            foreach ($variableList as $variable => $value) {
                ${$variable} = $value;
            }

            // Start buffering
            ob_start();

            require_once "view/$view.php";

            // End buffering, and return the output
            ob_end_flush();
        } catch (Throwable $e) {
            throw new Error("loadViewFile -> " . $e->getMessage());
        }
    }
}
