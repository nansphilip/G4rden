<!-- User class -->
<!-- Admin class that extends User class -->

<?php
/**
 * User class
 * An User has an ID, a username, a password and a userType.
 * It also has methods to add, get, update and delete users.
 */
class User
{
    public $id;
    public $lastname;
    public $firstname;
    public $username;
    public $password;
    public $userType;

    public function __construct($id, $lastname, $firstname, $username, $password, $userType)
    {
        $this->id = $id;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->username = $username;
        $this->password = $password;
        $this->userType = $userType;
    }

    /**
     * Adds a new user to the database.
     * @param string $username
     * @param string $password
     * @param string $userType
     * @return associated_array of the user
     */
    public function addUser($hashedPassword)
    {
        $sql = "INSERT INTO User (lastname, firstname, username, password, userType) VALUES (:lastname, :firstname, :username, :hashedPassword, :userType)";
        $query = Database::queryAssocBool($sql, [
            ':lastname' => $this->lastname,
            ':firstname' => $this->firstname,
            ':username' => $this->username,
            ':hashedPassword' => $hashedPassword,
            ':userType' => $this->userType,
        ]);
        return $query;
    }

    /**
     * Gets a user by his id.
     * @param int $id
     * @return associated_array of the user
     */
    public function getUserById($id)
    {
        $sql = "SELECT * FROM User WHERE id = :id";
        $query = Database::queryAssoc($sql, [
            ':id' => $id
        ]);
        if(!$query) {
            return false;
        } else {
            return $query[0];
        }
    }

    /**
     * Gets an id user by his email.
     * @param string $mail
     * @return int
     */
    public function getUserIdByMail($mail)
    {
        $sql = "SELECT id FROM User WHERE mail = :mail";
        $query = Database::queryAssoc($sql, [
            ':mail' => $mail
        ]);
        if(!$query) {
            return false;
        } else {
            return $query[0]['id'];
        }
    }

    /**
     * Gets an id user by his username.
     * @param string $username
     * @return int
     */
    public function getUserIdByUsername($username)
    {
        $sql = "SELECT id FROM User WHERE username = :username";
        $query = Database::queryAssoc($sql, [
            ':username' => $username
        ]);
        if(!$query) {
            return false;
        } else {
            return $query[0]['id'];
        }
    }

    /**
     * Updates an user username by his id.
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string $userType
     * @return associated_array of the user
     */
    public function updateUserUsernameById($id, $username, $password, $userType)
    {
        $sql = "UPDATE User SET username = :username, password = :password, userType = :userType WHERE id = :id";
        $query = Database::queryAssocBool($sql, [
            ':id' => $id,
            ':username' => $username,
            ':password' => $password,
            ':userType' => $userType
        ]);
        return $query;
    }

    /**
     * Updates an user password by his id.
     * @param int $id
     * @param string $password
     * @return associated_array of the user
     */
    public function updateUserPasswordById($id, $password)
    {
        $sql = "UPDATE User SET password = :password WHERE id = :id";
        $query = Database::queryAssocBool($sql, [
            ':id' => $id,
            ':password' => $password
        ]);
        return $query;
    }

    /**
     * Deletes an user by his id.
     * @param int $id
     * @return boolean if the user has been deleted
     */
    public function deleteUser($id)
    {
        $sql = "DELETE FROM User WHERE id = :id";
        $query = Database::queryAssocBool($sql, [
            ':id' => $id
        ]);
        return $query;
    }

    /**
     * Checks if an user exists by his username.
     * @param string $username
     * @return true if the username if available, false otherwise
     */
    public function isUsernameAvailable($username)
    {
        $sql = "SELECT * FROM User WHERE username = :username";
        $query = Database::queryAssoc($sql, [
            ':username' => $username
        ]);

        // If user exists, return false
        if (isset($query)) {
            return false;
        }

        // If username is available, return true
        return true;
    }


    /**
     * Checks if an user exists by his mail.
     * @param string $mail
     * @return true if the mail if available, false otherwise           
     */
    // public function isMailAvailable($mail)
    // {
    //     $sql = "SELECT * FROM User WHERE mail = :mail";
    //     $query = Database::queryAssoc($sql, [
    //         ':mail' => $mail
    //     ]);
    //     if (is_null($query)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}

class Admin extends User
{
    /**
     * Gets an user by his username.
     * @param string $username
     * @return associated_array of the user
     */
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM User WHERE username = :username";
        $query = Database::queryAssoc($sql, [
            ':username' => $username
        ]);
        if (!$query) {
            return false;
        } else {
            return $query[0];
        }
    }

    /**
     * Gets all users by their userType.
     * @return array of associated_arrays of users
     */
    public function getUsersByUserType($userType)
    {
        $sql = "SELECT * FROM User WHERE userType = :userType";
        $query = Database::queryAssoc($sql, [
            ':userType' => $userType
        ]);
        return $query[0];
    }

    // public function getUserMail($mail)
    // {
    //     $sql = "SELECT * FROM User WHERE mail = :mail";
    //     $query = Database::queryAssoc($sql, [
    //         ':mail' => $mail
    //     ]);
    //     if (!$query) {
    //         return false;
    //     } else {
    //         return $query[0];
    //     }
    // }

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

    /**
     * Get the user password by his mail
     * @param string $mail
     * @return string   
     */ 
    public function getUserPasswordByMail($mail)
    {
        $sql = "SELECT password FROM User WHERE mail = :mail";
        $query = Database::queryAssoc($sql, [
            ':mail' => $mail
        ]);
        if(!$query) {
            return false;
        } else {
            return $query[0]['password'];
        }
    }

    /**
     * Get the user password by his username
     * @param string $username
     * @return string   
     */ 
    public function getUserPasswordByUsername($username)
    {
        $sql = "SELECT password FROM User WHERE username = :username";
        $query = Database::queryAssoc($sql, [
            ':username' => $username
        ]);
        if(!$query) {
            return false;
        } else {
            return $query[0]['password'];
        }
    }
}
?>