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

    /**
     * Adds a new message to the database.
     * @param string $content
     * @param string $date
     * @param int $userId
     * @return associated_array of the message
     */
    public function addMessage()
    {
        $sql = "INSERT INTO Message (content, date, userId) VALUES (:content, :date, :userId)";
        $query = Database::queryAssoc($sql, [
            ':content' => $this->content,
            ':date' => $this->date,
            ':userId' => $this->userId
        ]);
        return $query[0];
    }

    /**
     * Gets a message by his id.
     * @param int $id
     * @return associated_array of the message
     */
    public function getMessageById()
    {
        $sql = "SELECT * FROM Message WHERE id = :id";
        $query = Database::queryAssoc($sql, [
            ':id' => $this->id
        ]);
        return $query[0];
    }

    /**
     * Gets all messages.
     * @return array of associated_arrays of messages
     */
    public static function getAll()
    {
        $sql = "SELECT * FROM Message";
        $query = Database::queryAssoc($sql);
        return $query;
    }

    /**
     * Gets all messages with join SQL query
     * @return array of associated_arrays of messages
     */
    public static function getAllMessageJoinedToUser()
    {
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
    }

    /**
     * Gets all messages by their userId.
     * @param int $userId
     * @return array of associated_arrays of messages
     */
    public function getMessagesByUserId()
    {
        $sql = "SELECT * FROM Message WHERE userId = :userId";
        $query = Database::queryAssoc($sql, [
            ':userId' => $this->userId
        ]);
        return $query;
    }

    /**
     * Gets all messages by date between two dates.
     * @param string $startDate
     * @param string $endDate
     * @return array of associated_arrays of messages
     */
    public function getMessagesByDateBetween($startDate, $endDate)
    {
        $sql = "SELECT * FROM Message WHERE date BETWEEN :startDate AND :endDate";
        $query = Database::queryAssoc($sql, [
            ':startDate' => $startDate,
            ':endDate' => $endDate
        ]);
        return $query;
    }

    /**
     * Gets all messages with a word or a sentence in their content.
     * @param string $content
     * @return array of associated_arrays of messages
     */
    public function getMessagesByPeaceOfContent($stringOfContent)
    {
        $sql = "SELECT * FROM Message WHERE content LIKE :content";
        $query = Database::queryAssoc($sql, [
            ':content' => $stringOfContent
        ]);
        return $query;
    }

    /**
     * Deletes a message by his id.
     * @param int $id
     * @return associated_array of the message
     */
    public function deleteMessage()
    {
        $sql = "DELETE FROM Message WHERE id = :id";
        $query = Database::queryAssoc($sql, [
            ':id' => $this->id
        ]);
        return $query[0];
    }
}
