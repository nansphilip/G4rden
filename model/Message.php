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


    /**
     * Adds a new message to the database.
     */
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


    /**
     * Gets a message by his id.
     * @return associated_array of the message
     */
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

    /**
     * Gets all messages of an user by its id.
     * @return array of associated_arrays of messages
     */
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

    /**
     * Gets all messages between two dates.
     * @param string $startDate
     * @param string $endDate
     * @return array of associated_arrays of messages
     */
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

    /**
     * Gets all messages with a word or a sentence in their content.
     * @param string $stringOfContent
     * @return array of associated_arrays of messages
     */
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

    /**
     * Gets all messages associated to their user.
     * @return array of associated_arrays of messages
     */
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
                    ON User.id = Message.userId
                    ORDER BY Message.date DESC";
            $query = Database::queryAssoc($sql);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("getAllMessageJoinedToUser -> " . $e->getMessage());
        }
    }

    /**
     * Gets all messages.
     * @return array of associated_arrays of messages
     */
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


    /**
     * Deletes a message by its id.
     */
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
