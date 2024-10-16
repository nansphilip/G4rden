<?php
$envFile = parse_ini_file(".env");
$ENVIRONMENT = $envFile['ENV'];

/**
 * Message class
 * A message has an messageId, a content, a date and a userId.
 * It also has methods to add, get, update and delete messages.
 */
class Message
{
    public $messageId;
    public $content;
    public $date;
    public $userId;
    public $subjectId;

    public function __construct($messageId = null, $content = null, $date = null, $userId = null, $subjectId = null)
    {
        $this->messageId = $messageId;
        $this->content = $content;
        $this->date = $date;
        $this->userId = $userId;
        $this->subjectId = $subjectId;
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
            // Get environment
            $envFile = parse_ini_file(".env");
            $ENVIRONMENT = $envFile['ENV'];

            // Check if in production
            if ($ENVIRONMENT == "PROD") {
                $getRowCount = Database::queryAssoc("SELECT COUNT(*) FROM Message;");
                $recordsAmount = $getRowCount[0]['COUNT(*)'];

                // If records amount is >= 2000, throw an error to prevent the database from being overloaded
                if ($recordsAmount >= 2000) {
                    throw new Error("Records amount reached the maximum limit of 2000 messages.");
                }
            }

            $sql = "INSERT INTO Message (content, date, userId, subjectId) VALUES (:content, :date, :userId, :subjectId)";
            Database::queryAssoc($sql, [
                ':content' => $this->content,
                ':date' => $this->date,
                ':userId' => $this->userId,
                ':subjectId' => $this->subjectId
            ]);
        } catch (PDOException $e) {
            throw new Error("addMessage -> " . $e->getMessage());
        }
    }


    // ======================= //
    // ===== Get methods ===== //
    // ======================= //


    /**
     * Fill instance object with data from database
     * @param $messageId
     * @return associated_array of the message
     */
    public function getMessageById($messageId)
    {
        try {
            $sql = "SELECT * FROM Message WHERE messageId = :messageId";
            $query = Database::queryAssoc($sql, [
                ':messageId' => $messageId
            ]);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Set properties in instance object
            foreach ($query as $key => $value) {
                $this->$key = $value;
            }
            // Return instance object
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getMessageById -> " . $e->getMessage());
        }
    }

    /**
     * Gets all messages of an user by its messageId.
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
            throw new Error("getMessagesByUserId -> " . $e->getMessage());
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
            throw new Error("getMessagesByDateBetween -> " . $e->getMessage());
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
            throw new Error("getMessagesByPeaceOfContent -> " . $e->getMessage());
        }
    }

    /**
     * Gets the 10 last messages associated to their user.
     * @return array of associated_arrays of messages
     */
    public static function getLastMessageJoinedToUser($limit = 10)
    {
        try {
            $limit = (int)$limit;
            $sql = "SELECT
                User.username as username,
                Message.messageId as messageId,
                Message.content as content,
                Message.date as date
                FROM Message
                INNER JOIN User ON User.userId = Message.userId
                ORDER BY Message.date DESC
                LIMIT $limit";
            $query = Database::queryAssoc($sql);
            return array_reverse($query);
        } catch (PDOException $e) {
            throw new Error("getLastMessageJoinedToUser -> " . $e->getMessage());
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
            throw new Error("getAll -> " . $e->getMessage());
        }
    }


    // ========================== //
    // ===== Update methods ===== //
    // ========================== //


    // ========================== //
    // ===== Delete methods ===== //
    // ========================== //


    /**
     * Deletes a message by its messageId.
     */
    public function deleteMessage()
    {
        try {
            $sql = "DELETE FROM Message WHERE messageId = :messageId";
            $query = Database::queryAssoc($sql, [
                ':messageId' => $this->messageId
            ]);
            if (is_null($query)) {
                return null;
            }
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("deleteMessage -> " . $e->getMessage());
        }
    }
}
