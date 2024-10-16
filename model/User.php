<?php
/**
 * User class
 * An User has an userId, a username, a passwordHash and a userType.
 * It also has methods to add, get, update and delete users.
 */
class User
{
    public $userId;
    public $lastname;
    public $firstname;
    public $username;
    public $passwordHash;
    public $userType;

    public function __construct($userId = null, $lastname = null, $firstname = null, $username = null, $passwordHash = null, $userType = null)
    {
        $this->userId = $userId;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->userType = $userType;
    }


    // ======================= //
    // ===== Add methods ===== //
    // ======================= //


    /**
     * Adds a new user to the database.
     */
    public function addUser()
    {
        try {
            // Get environment
            $envFile = parse_ini_file(".env");
            $ENVIRONMENT = $envFile['ENV'];

            // Check if in production
            if ($ENVIRONMENT == "PROD") {
                $getRowCount = Database::queryAssoc("SELECT COUNT(*) FROM User;");
                $recordsAmount = $getRowCount[0]['COUNT(*)'];

                // If records amount is >= 50, throw an error to prevent the database from being overloaded
                if ($recordsAmount >= 50) {
                    throw new Error("Records amount reached the maximum limit of 50 users.");
                }
            }

            $sql = "INSERT INTO User (lastname, firstname, username, passwordHash, userType) VALUES (:lastname, :firstname, :username, :passwordHash, :userType)";
            Database::queryAssoc($sql, [
                ':lastname' => $this->lastname,
                ':firstname' => $this->firstname,
                ':username' => $this->username,
                ':passwordHash' => $this->passwordHash,
                ':userType' => $this->userType,
            ]);
        } catch (PDOException $e) {
            throw new Error("addUser -> " . $e->getMessage());
        }
    }


    // ======================= //
    // ===== Get methods ===== //
    // ======================= //


    /**
     * Fill instance object with data from database
     * @param $userId
     * @return associated_array of the user
     */
    public function getUserById($userId)
    {
        try {
            $sql = "SELECT * FROM User WHERE userId = :userId";
            $query = Database::queryAssoc($sql, [
                ':userId' => $userId
            ]);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Set properties in instance object
            foreach ($query as $key => $value) {
                $this->$key = $value;
            }
            // Return instance object
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getUserById -> " . $e->getMessage());
        }
    }

    /**
     * Fill instance object with data from database
     * @param $username
     * @return associated_array of the user
     */
    public function getUserByUsername($username)
    {
        try {
            $sql = "SELECT * FROM User WHERE username = :username";
            $query = Database::queryAssoc($sql, [
                ':username' => $this->username
            ]);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Set properties in instance object
            foreach ($query as $key => $value) {
                $this->$key = $value;
            }
            // Return instance object
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getUserByUsername -> " . $e->getMessage());
        }
    }

    /**
     * Gets all users by their userType.
     * @return array of associated_arrays of users
     */
    public function getUsersByUserType()
    {
        try {
            $sql = "SELECT * FROM User WHERE userType = :userType";
            $query = Database::queryAssoc($sql, [
                ':userType' => $this->userType
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getUsersByUserType -> " . $e->getMessage());
        }
    }

    /**
     * Gets all users.
     * @return array of associated_arrays of users
     */
    public static function getAll()
    {
        try {
            $sql = "SELECT * FROM User";
            $query = Database::queryAssoc($sql);
            return $query;
        } catch (PDOException $e) {
            throw new Error("getAll -> " . $e->getMessage());
        }
    }


    // ========================== //
    // ===== Update methods ===== //
    // ========================== //


    // ========================== //
    // ===== Delete methods ===== //
    // ========================== //


    /**
     * Deletes a user by its userId.
     */
    public function deleteUser()
    {
        try {
            $sql = "DELETE FROM User WHERE userId = :userId";
            $query = Database::queryAssoc($sql, [
                ':userId' => $this->userId
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("deleteUser -> " . $e->getMessage());
        }
    }
}

class Admin extends User
{
    // Methods that require admin privileges
    // Ex: update user privileges
}
?>