<!-- User class -->
<!-- Admin class that extends User class -->

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


    public function addUser()
    {
        try {
            $sql = "INSERT INTO User (lastname, firstname, username, passwordHash, userType) VALUES (:lastname, :firstname, :username, :passwordHash, :userType)";
            Database::queryAssoc($sql, [
                ':lastname' => $this->lastname,
                ':firstname' => $this->firstname,
                ':username' => $this->username,
                ':passwordHash' => $this->passwordHash,
                ':userType' => $this->userType,
            ]);
        } catch (PDOException $e) {
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