<?php

/**
 * Class User
 * Represents a user in the system.
 */
class User
{
    public $userId;
    public $lastname;
    public $firstname;
    public $username;
    public $passwordHash;
    public $userType;

    /**
     * User constructor.
     * @param int|null $userId The ID of the user.
     * @param string|null $lastname The user's last name.
     * @param string|null $firstname The user's first name.
     * @param string|null $username The username.
     * @param string|null $passwordHash The hashed password.
     * @param string|null $userType The type of user (default: 'USER').
     */
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
     * Adds a new user to the database and fill the current instance of object.
     * @param string $lastname The user's last name.
     * @param string $firstname The user's first name.
     * @param string $username The username.
     * @param string $passwordHash The hashed password.
     * @param string $userType The type of user (default: 'USER').
     * @return array|null Information about the added user.
     * @throws Error If an error occurs during the addition.
     */
    public function addUser($lastname, $firstname, $username, $passwordHash, $userType = 'USER')
    {
        try {
            // Get environment
            $envFile = parse_ini_file(".env");
            $ENVIRONMENT = $envFile['ENV'];

            // Check if in production
            if ($ENVIRONMENT == "PROD") {
                $getRowCount = Database::queryAssoc("SELECT COUNT(*) as recordsAmount FROM User;");
                $recordsAmount = $getRowCount[0]['recordsAmount'];

                // If records amount is >= 50, throw an error to prevent the database from being overloaded
                if ($recordsAmount >= 50) {
                    throw new Error("Records amount reached the maximum limit of 50 users.");
                }
            }

            // Insert the message in the database
            $sql = "INSERT INTO User (lastname, firstname, username, passwordHash, userType) VALUES (:lastname, :firstname, :username, :passwordHash, :userType)";
            Database::queryAssoc($sql, [
                ':lastname' => $lastname,
                ':firstname' => $firstname,
                ':username' => $username,
                ':passwordHash' => $passwordHash,
                ':userType' => $userType,
            ]);

            // Get the last inserted id
            $lastInsertId = Database::lastInsertId();
            // Get the current inserted message
            $userArray = $this->getUserById($lastInsertId);
            // Fill the current instance of object
            $this->fillUserInstance($userArray);
            // Return the current user
            return $userArray;
        } catch (PDOException $e) {
            throw new Error("addUser -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Fill methods ==== //
    // ======================= //

    /**
     * Fills the instance of the object with user data.
     * @param array $userArray Associative array containing the user's data.
     * @throws Error If an error occurs during the filling of the instance.
     */
    public function fillUserInstance($userArray)
    {
        try {
            // Set properties in instance object
            foreach ($userArray as $key => $value) {
                $this->$key = $value;
            }
        } catch (PDOException $e) {
            throw new Error("fillUserInstance -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Get methods ===== //
    // ======================= //

    /**
     * Retrieves a user by their ID.
     * @param int $userId The user's ID.
     * @return array|null The user's data or null if the user is not found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getUserById($userId)
    {
        try {
            // Get message
            $sql = "SELECT * FROM User WHERE userId = :userId";
            $query = Database::queryAssoc($sql, [
                ':userId' => $userId
            ]);
            // If no result, return null
            if (is_null($query)) {
                throw new Error("Unkown user with id -> " . $id);
            }
            // Return associated array of user
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getUserById -> " . $e->getMessage());
        }
    }

    /**
     * Retrieves a user by their username.
     * @param string $username The username.
     * @return array|null The user's data or null if the user is not found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getUserByUsername($username)
    {
        try {
            $sql = "SELECT * FROM User WHERE username = :username";
            $query = Database::queryAssoc($sql, [
                ':username' => $username
            ]);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Return instance object
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getUserByUsername -> " . $e->getMessage());
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
     * Deletes a user by their ID.
     * @param int $userId The user's ID.
     * @return array|null The data of the deleted user or null if the user is not found.
     * @throws Error If an error occurs during deletion.
     */
    public function deleteUserById($userId)
    {
        try {
            // Check if the user exists
            $userArray = $this->getUserById($userId);
            // Return null if the user doesn't exist
            if (is_null($userArray)) {
                return null;
            }
            // Prepare the SQL query
            $sql = "DELETE FROM User WHERE userId = :userId";
            // Delete the user
            Database::queryAssoc($sql, [
                ':userId' => $userId
            ]);
            // Return the deleted user
            return $userArray;
        } catch (PDOException $e) {
            throw new Error("deleteUserById -> " . $e->getMessage());
        }
    }
}

class Admin extends User
{
    // Methods that require admin privileges
    // Ex: update user privileges
}
