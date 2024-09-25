<?php
class Message
{
    public $id;
    public $content;
    public $date;
    public $user_id;

    public function __construct($id, $content, $date, $user_id)
    {
        $this->id = $id;
        $this->content = $content;
        $this->date = $date;
        $this->user_id = $user_id;
    }

    /**
     * Adds a new message to the database.
     * @param string $content
     * @param string $date
     * @param int $user_id
     * @return associated_array of the message
     */
    public function addMessage($content, $date, $user_id)
    {
        $sql = "INSERT INTO Message (content, date, user_id) VALUES (:content, :date, :user_id)";
        $query = Database::queryAssoc($sql, [
            ':content' => $content,
            ':date' => $date,
            ':user_id' => $user_id
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
     * Gets all messages by their user_id.
     * @param int $user_id
     * @return array of associated_arrays of messages
     */
    public function getMessagesByUserId($user_id)
    {
        $sql = "SELECT * FROM Message WHERE user_id = :user_id";
        $query = Database::queryAssoc($sql, [
            ':user_id' => $user_id
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