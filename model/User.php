<!-- User class -->
<!-- Admin class that extends User class -->

<?php
/**
 * User class
 * An User has an ID, a username, a hashedPassword and a userType.
 * It also has methods to add, get, update and delete users.
 */
class User
{
    public $id;
    public $lastname;
    public $firstname;
    public $username;
    public $hashedPassword;
    public $userType;

    public function __construct($id, $lastname, $firstname, $username, $hashedPassword, $userType)
    {
        $this->id = $id;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->userType = $userType;
    }


    // ===== Add methods ===== //


    /**
     * Adds a new user to the database.
     * @param string $username
     * @param string $hashedPassword
     * @param string $userType
     * @return associated_array of the user
     */
    public function addUser()
    {
        $sql = "INSERT INTO User (lastname, firstname, username, hashedPassword, userType) VALUES (:lastname, :firstname, :username, :hashedPassword, :userType)";
        $query = Database::queryAssocBool($sql, [
            ':lastname' => $this->lastname,
            ':firstname' => $this->firstname,
            ':username' => $this->username,
            ':hashedPassword' => $this->hashedPassword,
            ':userType' => $this->userType,
        ]);
        return $query;
    }


    // ===== Get methods ===== //


    /**
     * Gets a user by his id.
     * @param int $id
     * @return associated_array of the user
     */
    public function getUserById()
    {
        $sql = "SELECT * FROM User WHERE id = :id";
        $query = Database::queryAssoc($sql, [
            ':id' => $this->id
        ]);
        if (!$query) {
            return false;
        } else {
            return $query[0];
        }
    }

    /**
     * Gets an user by his username.
     * @param string $username
     * @return associated_array of the user
     */
    public function getUserByUsername()
    {
        $sql = "SELECT * FROM User WHERE username = :username";
        $query = Database::queryAssoc($sql, [
            ':username' => $this->username
        ]);
        return $query[0];
    }
    
    /**
     * Gets all users by their userType.
     * @return array of associated_arrays of users
     */
    public function getUsersByUserType()
    {
        $sql = "SELECT * FROM User WHERE userType = :userType";
        $query = Database::queryAssoc($sql, [
            ':userType' => $this->userType
        ]);
        return $query[0];
    }

    /**
     * Gets all users.
     * @return array of associated_arrays of users
     */
    public static function getAll()
    {
        $sql = "SELECT * FROM User";
        $query = Database::queryAssoc($sql);
        return $query;
    }


    // ===== Update methods ===== //



    // ===== Delete methods ===== //


    /**
     * Deletes an user by his id.
     * @param int $id
     * @return boolean if the user has been deleted
     */
    public function deleteUser()
    {
        $sql = "DELETE FROM User WHERE id = :id";
        $query = Database::queryAssocBool($sql, [
            ':id' => $this->id
        ]);
        return $query;
    }
}

class Admin extends User
{
    // Update methods that require admin privileges
}
?>