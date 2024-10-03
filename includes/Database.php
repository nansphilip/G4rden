<?php

/**
 * Database class
 * A singleton class that instantiates a PDO connection to the database.
 * It also handles errors by throwing an exception.
 */
class Database
{
    private static $connection;

    /**
     * Instantiates a singleton PDO connection for the database.
     */
    private static function init()
    {
        // Parse .env file
        $env = parse_ini_file(".env");

        // Get environment variables
        $dsn = "mysql:host=" . $env['MYSQL_HOST'] . ";dbname=" . $env['MYSQL_NAME'];
        $user = $env['MYSQL_USER'];
        $pass = $env['MYSQL_PASS'];

        // error_log("Connection string: $dsn");

        try {
            // Create a new PDO connection
            self::$connection = new PDO($dsn, $user, $pass);

            // Set the error mode to exception
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Catch database connection errors
        } catch (PDOException $e) {
            error_log("database -> " . $e->getMessage());
            throw new Exception("database -> " . $e->getMessage());
        }
    }

    /**
     * Prepares and executes a SQL query, and returns the result in an associative array.
     * @param string $sql
     * @param array $bindList
     * @return array with the result, or null if the result is empty
     */
    public static function queryAssoc($sqlQuery, $bindVariableList = [])
    {
        try {
            // If database connection doesn't exist, create it
            if (!self::$connection) {
                self::init();
            }

            // Prepare the SQL query
            $statement = self::$connection->prepare($sqlQuery);

            // Bind the variables variable to the query
            if ($bindVariableList != null) {
                foreach ($bindVariableList as $key => $variable) {
                    $statement->bindValue($key, $variable);
                }
            }

            // Execute the query
            $statement->execute();

            // Stores the data in an associative array if result is not empty
            if ($statement->rowCount() > 0) {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }

            // Return null if result is empty
            return null;
        } catch (PDOException $e) {
            error_log("queryAssoc -> " . $e->getMessage());
            throw new Exception("queryAssoc -> " . $e->getMessage());
        }
    }
}
