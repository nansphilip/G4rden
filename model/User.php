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
     * @param int|null $userId The userId of the user.
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
            if ($ENVIRONMENT !== "DEV") {
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

            // Get the last inserted userId
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
     * Retrieves a user by their userId.
     * @param int $userId The user's userId.
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
                return null;
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
     * Updates a user by its userId.
     * @param string $username The new username.
     * @throws Error If an error occurs during the update.
     */
    public function updateUsername($username)
    {
        try {
            $sql = "UPDATE User SET username = :username where userId = :userId";
            Database::queryAssoc($sql, [
                ':userId' => $this->userId,
                ':username' => $username
            ]);
            // Update the current instance of object
            $this->username = $username;
        } catch (PDOException $e) {
            throw new Error("updateUsername -> " . $e->getMessage());
        }
    }

    /**
     * Updates a user by its userId.
     * @param string $firstname The new first name.
     * @throws Error If an error occurs during the update.
     */
    public function updateFirstname($firstname)
    {
        try {
            $sql = "UPDATE User SET firstname = :firstname where userId = :userId";
            Database::queryAssoc($sql, [
                ':userId' => $this->userId,
                ':firstname' => $firstname
            ]);
            // Update the current instance of object
            $this->firstname = $firstname;
        } catch (PDOException $e) {
            throw new Error("updateFirstname -> " . $e->getMessage());
        }
    }

    /**
     * Updates a user by its userId.
     * @param string $lastname The new last name.
     * @throws Error If an error occurs during the update.
     */
    public function updateLastname($lastname)
    {
        try {
            $sql = "UPDATE User SET lastname = :lastname where userId = :userId";
            Database::queryAssoc($sql, [
                ':userId' => $this->userId,
                ':lastname' => $lastname
            ]);
            // Update the current instance of object
            $this->lastname = $lastname;
        } catch (PDOException $e) {
            throw new Error("updateLastname -> " . $e->getMessage());
        }
    }

    /**
     * Updates a user by its userId.
     * @param string $passwordHash The new hashed password.
     * @throws Error If an error occurs during the update.
     */
    public function updatePassword($passwordHash)
    {
        try {
            $sql = "UPDATE User SET passwordHash = :passwordHash where userId = :userId";
            Database::queryAssoc($sql, [
                ':userId' => $this->userId,
                ':passwordHash' => $passwordHash
            ]);
            // Update the current instance of object
            $this->passwordHash = $passwordHash;
        } catch (PDOException $e) {
            throw new Error("updatePassword -> " . $e->getMessage());
        }
    }
}

/**
 * Class Admin
 * Represents an admin user in the system.
 */
class Admin extends User
{
    // ======================= //
    // ===== Get methods ===== //
    // ======================= //

    /**
     * Gets all users' usernames except for anonymous users, for the admin interface.
     * @return array|null An array of usernames or null if no users are found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getAllUsername()
    {
        try {
            $sql = "SELECT username FROM User WHERE username NOT LIKE 'anonymized-%'";
            $query = Database::queryAssoc($sql);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Extract the username from the associative array
            $usernameList = [];
            foreach ($query as $user) {
                $usernameList[] = $user['username'];
            }
            // Return instance object
            return $usernameList;
        } catch (PDOException $e) {
            throw new Error("getAllUsername -> " . $e->getMessage());
        }
    }

    // ========================== //
    // ===== Update methods ===== //
    // ========================== //

    /**
     * Updates the user type of a user.
     * @param int $userId The ID of the user.
     * @param string $userType The new user type.
     * @throws Exception If an error occurs during the update.
     */
    public function updateUserType($userId, $userType)
    {
        try {
            $sql = "UPDATE User SET userType = :userType WHERE userId = :userId";
            Database::queryAssoc($sql, [
                ':userType' => $userType,
                ':userId' => $userId
            ]);
        } catch (PDOException $e) {
            throw new Exception("updateUserType -> " . $e->getMessage());
        }
    }

    /**
     * Anonymizes a user by their userId.
     * @param int $userId The ID of the user.
     * @param string $anonymizedUsername The anonymized username.
     * @throws Error If an error occurs during the anonymisation.
     */
    public function anonymiseUser($userId, $anonymizedUsername)
    {
        try {
            $sql = "UPDATE User
                SET 
                    username = :username,
                    lastname = 'anonymized',
                    firstname = 'anonymized',
                    passwordHash = 'anonymized',
                    userType = 'USER'
                WHERE userId = :userId";
            Database::queryAssoc($sql, [
                ':username' => $anonymizedUsername,
                ':userId' => $userId
            ]);
        } catch (PDOException $e) {
            throw new Error("anonymiseUser -> " . $e->getMessage());
        }
    }

    // ========================== //
    // ===== Delete methods ===== //
    // ========================== //

    /**
     * Deletes a user by their userId.
     * @param int $userId The user's userId.
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
