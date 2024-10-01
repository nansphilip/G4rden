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
    public function addMessage($content, $date, $userId)
    {
        $sql = "INSERT INTO Message (content, date, userId) VALUES (:content, :date, :userId)";
        $query = Database::queryAssoc($sql, [
            ':content' => $content,
            ':date' => $date,
            ':userId' => $userId
        ]);
        return $query[0];
    }

    /**
     * Gets a message by his id.
     * @param int $id
     * @return associated_array of the message
     */
    public function getMessageById($id)
    {
        $sql = "SELECT * FROM Message WHERE id = :id";
        $query = Database::queryAssoc($sql, [
            ':id' => $id
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
    public static function getAllMessageJoin()
    {
        $sql = "SELECT m.id as id, u.username as username, m.content as message, m.date as date FROM message m INNER JOIN user u ON u.id = m.userId";
        $query = Database::queryAssoc($sql);
        return $query;
    }

    /**
     * Gets all messages by their userId.
     * @param int $userId
     * @return array of associated_arrays of messages
     */
    public function getMessagesByUserId($userId)
    {
        $sql = "SELECT * FROM Message WHERE userId = :userId";
        $query = Database::queryAssoc($sql, [
            ':userId' => $userId
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
    public function deleteMessage($id)
    {
        $sql = "DELETE FROM Message WHERE id = :id";
        $query = Database::queryAssoc($sql, [
            ':id' => $id
        ]);
        return $query[0];
    }
}
?>