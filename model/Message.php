<?php
class Message
{
    public $id;
    public $content;
    public $date;
    public $userId;

    public function __construct($id, $content, $date, $userId)
    {
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->userId = $userId;
    }


    // ======================= //
    // ===== Add methods ===== //
    // ======================= //


    public function addMessage()
    {
        try {
            $sql = "INSERT INTO Message (content, date, userId) VALUES (:content, :date, :userId)";
            Database::queryAssoc($sql, [
                ':content' => $this->content,
                ':date' => $this->date,
                ':userId' => $this->userId
            ]);
        } catch (PDOException $e) {
            throw new Exception("addMessage -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Get methods ===== //
    // ======================= //


    public function getMessageById()
    {
        try {
            $sql = "SELECT * FROM Message WHERE id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Exception("getMessageById -> " . $e->getMessage());
        }
    }

    public function getMessagesByUserId()
    {
        try {
            $sql = "SELECT * FROM Message WHERE userId = :userId";
            $query = Database::queryAssoc($sql, [
                ':userId' => $this->userId
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("getMessagesByUserId -> " . $e->getMessage());
        }
    }

    public function getMessagesByDateBetween($startDate, $endDate)
    {
        try {
            $sql = "SELECT * FROM Message WHERE date BETWEEN :startDate AND :endDate";
            $query = Database::queryAssoc($sql, [
                ':startDate' => $startDate,
                ':endDate' => $endDate
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("getMessagesByDateBetween -> " . $e->getMessage());
        }
    }

    public static function getMessagesByPeaceOfContent($stringOfContent)
    {
        try {
            $sql = "SELECT * FROM Message WHERE content LIKE :content";
            $query = Database::queryAssoc($sql, [
                ':content' => $stringOfContent
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("getMessagesByPeaceOfContent -> " . $e->getMessage());
        }
    }

    public static function getAllMessageJoinedToUser()
    {
        try {
            $sql = "SELECT
                    User.username as username,
                    Message.id as id,
                    Message.content as message,
                    Message.date as date
                    FROM Message
                    INNER JOIN User
                    ON User.id = Message.userId";
            $query = Database::queryAssoc($sql);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("getAllMessageJoinedToUser -> " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $sql = "SELECT * FROM Message";
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


    public function deleteMessage()
    {
        try {
            $sql = "DELETE FROM Message WHERE id = :id";
            $query = Database::queryAssoc($sql, [
                ':id' => $this->id
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Exception("deleteMessage -> " . $e->getMessage());
        }
    }
}
