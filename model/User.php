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


    // ======================= //
    // ===== Add methods ===== //
    // ======================= //


    public function addUser()
    {
        try {
            $sql = "INSERT INTO User (lastname, firstname, username, hashedPassword, userType) VALUES (:lastname, :firstname, :username, :hashedPassword, :userType)";
            $query = Database::queryAssoc($sql, [
                ':lastname' => $this->lastname,
                ':firstname' => $this->firstname,
                ':username' => $this->username,
                ':hashedPassword' => $this->hashedPassword,
                ':userType' => $this->userType,
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            error_log("addUser -> " . $e->getMessage());
            throw new Exception("addUser -> " . $e->getMessage());
        }
    }


    // ======================= //
    // ===== Get methods ===== //
    // ======================= //


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
            error_log("getUserById -> " . $e->getMessage());
            throw new Exception("getUserById -> " . $e->getMessage());
        }
    }

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
            error_log("getUserByUsername -> " . $e->getMessage());
            throw new Exception("getUserByUsername -> " . $e->getMessage());
        }
    }

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
            error_log("getUsersByUserType -> " . $e->getMessage());
            throw new Exception("getUsersByUserType -> " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $sql = "SELECT * FROM User";
            $query = Database::queryAssoc($sql);
            return $query;
        } catch (PDOException $e) {
            error_log("getAll -> " . $e->getMessage());
            throw new Exception("getAll -> " . $e->getMessage());
        }
    }


    // ========================== //
    // ===== Update methods ===== //
    // ========================== //


    // ========================== //
    // ===== Delete methods ===== //
    // ========================== //


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
            error_log("deleteUser -> " . $e->getMessage());
            throw new Exception("deleteUser -> " . $e->getMessage());
        }
    }
}

class Admin extends User
{
    // Methods that require admin privileges
    // Ex: update user privileges
}
?>