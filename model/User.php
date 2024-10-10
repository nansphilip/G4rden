<?php
/**
 * User class
 * An User has an ID, a username, a passwordHash and a userType.
 * It also has methods to add, get, update and delete users.
 */
class User
{
    public $id;
    public $lastname;
    public $firstname;
    public $username;
    public $passwordHash;
    public $userType;

    public function __construct($id, $lastname, $firstname, $username, $passwordHash, $userType)
    {
        $this->id = $id;
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
     * Gets a user by its id.
     * @return associated_array of the user
     */
    public function getUserById()
    {
        try {
            $sql = "SELECT * FROM User WHERE id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getUserById -> " . $e->getMessage());
        }
    }

    /**
     * Gets a user by its username.
     * @return associated_array of the user
     */
    public function getUserByUsername()
    {
        try {
            $sql = "SELECT * FROM User WHERE username = :username";
            $query = Database::queryAssoc($sql, [
                ':username' => $this->username
            ]);
            if (is_null($query)) {
                return null;
            }
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
     * Gets all users matching a username.
     * @return array of associated_arrays of users
     */
    public static function getAllUsernamesByUsername($username){
        try {
            $sql = "SELECT username FROM User WHERE username LIKE :username";
            $query = Database::queryAssoc($sql, [
                ':username' => "%".$username."%"
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Error("getAllUsersByUsername -> " . $e->getMessage());
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
     * Deletes a user by its id.
     */
    public function deleteUser()
    {
        try {
            $sql = "DELETE FROM User WHERE id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("deleteUser -> " . $e->getMessage());
        }
    }

    /**
     * Deletes a user by its username.
     */
    public function deleteUserByUsername($username){
        try {
            $sql = "DELETE FROM User WHERE username = :username";
            $query = Database::queryBool($sql, [
                ':username' => $username
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("deleteUserByUsername -> " . $e->getMessage());
        }
    }
}

class Admin extends User
{
    // Methods that require admin privileges
    // Ex: update user privileges

    /**
     * Updates the user type of a user
     * @param string $userId
     * @param string $userType
     */
    public function updateUserType($userId, $userType)
    {
        try {
            $sql = "UPDATE User SET userType = :userType WHERE id = :userId";
            $query = Database::queryBool($sql, [
                ':userType' => $userType,
                ':userId' => $userId
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("updateUserType -> " . $e->getMessage());
        }
    }
}
?>