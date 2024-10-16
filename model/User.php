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

    public function __construct($id = null, $lastname = null, $firstname = null, $username = null, $passwordHash = null, $userType = null)
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
    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM User WHERE id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $id
            ]);
            if (is_null($query)) {
                throw new Error("Unkown user with id -> " . $id);
            }
            $this->id = $query[0]['id'];
            $this->lastname = $query[0]['lastname'];
            $this->firstname = $query[0]['firstname'];
            $this->username = $query[0]['username'];
            $this->passwordHash = $query[0]['passwordHash'];
            $this->userType = $query[0]['userType'];
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


    /**
     * Updates a user by its id.
     * @param string $username
     */
    public function updateUsername($username)
    {
        try {
            $sql = "UPDATE User SET username = :username where id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id,
                ':username' => $username
            ]);
            $this->username = $username;
        } catch (PDOException $e) {
            throw new Error("updateUsername -> " . $e->getMessage());
        }
    }

    /**
     * Updates a user by its id.
     * @param string $firstname
     */
    public function updateFirstname($firstname)
    {
        try {
            $sql = "UPDATE User SET firstname = :firstname where id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id,
                ':firstname' => $firstname
            ]);
            $this->firstname = $firstname;
        } catch (PDOException $e) {
            throw new Error("updateFirstsname -> " . $e->getMessage());
        }
    }

    /**
     * Updates a user by its id.
     * @param string $lastname
     */
    public function updateLastname($lastname)
    {
        try {
            $sql = "UPDATE User SET lastname = :lastname where id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id,
                ':lastname' => $lastname
            ]);
            $this->lastname = $lastname;
        } catch (PDOException $e) {
            throw new Error("updateLastname -> " . $e->getMessage());
        }
    }

    /**
     * Updates a user by its id.
     * @param string $passwordHash
     */
    public function updatePassword($passwordHash)
    {
        try{
            $sql = "UPDATE User SET passwordHash = :passwordHash where id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id,
                ':passwordHash' => $passwordHash
            ]);
            $this->passwordHash = $passwordHash;
        } catch (PDOException $e) {
            throw new Error("updatePassword -> " . $e->getMessage());
        }
    }


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
}

class Admin extends User
{
    // Methods that require admin privileges
    // Ex: update user privileges
}
