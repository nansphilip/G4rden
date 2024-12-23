<?php

/**
 * Class Message
 * Represents a message in the system.
 */
class Message
{
    public $messageId;
    public $content;
    public $date;
    public $userId;
    public $subjectId;

    /**
     * Message constructor.
     * @param int|null $messageId The ID of the message.
     * @param string|null $content The content of the message.
     * @param string|null $date The date of the message.
     * @param int|null $userId The ID of the user who created the message.
     * @param int|null $subjectId The ID of the subject to which the message is related.
     */
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
     * Adds a new message to the database and fill the current instance of object.
     * @param string $content The content of the message.
     * @param string $date The date of the message.
     * @param int $userId The user's ID.
     * @param int|null $subjectId The ID of the subject (optional).
     * @return array|null Information about the added message.
     * @throws Error If an error occurs during the addition.
     */
    public function addMessage($content, $date, $userId, $subjectId = null)
    {
        try {
            // Get environment
            $envFile = parse_ini_file(".env");
            $ENVIRONMENT = $envFile['ENV'];

            // Check if in production
            if ($ENVIRONMENT !== "DEV") {
                $getRowCount = Database::queryAssoc("SELECT COUNT(*) as recordsAmount FROM Message;");
                $recordsAmount = $getRowCount[0]['recordsAmount'];

                // If records amount is >= 2000, throw an error to prevent the database from being overloaded
                if ($recordsAmount >= 2000) {
                    throw new Error("Records amount reached the maximum limit of 2000 messages.");
                }
            }

            // Insert the message in the database
            $sql = "INSERT INTO Message (content, date, userId, subjectId) VALUES (:content, :date, :userId, :subjectId)";
            Database::queryAssoc($sql, [
                ':content' => $content,
                ':date' => $date,
                ':userId' => $userId,
                ':subjectId' => $subjectId
            ]);

            // Get the last inserted id
            $lastInsertId = Database::lastInsertId();
            // Get the current inserted message
            $messageArray = $this->getMessageById($lastInsertId);
            // Fill the current instance of object
            $this->fillMessageInstance($messageArray);
            // Return the current message
            return $messageArray;
        } catch (PDOException $e) {
            throw new Error("addMessage -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Fill methods ==== //
    // ======================= //

    /**
     * Fills the instance of the object with message data.
     * @param array $messageArray Associative array containing the message's data.
     * @throws Error If an error occurs during the filling of the instance.
     */
    public function fillMessageInstance($messageArray)
    {
        try {
            // Set properties in instance object
            foreach ($messageArray as $key => $value) {
                $this->$key = $value;
            }
        } catch (PDOException $e) {
            throw new Error("fillMessageInstance -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Get methods ===== //
    // ======================= //

    /**
     * Retrieves a message by its ID.
     * @param int $messageId The ID of the message.
     * @return array|null The message's data or null if the message is not found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getMessageById($messageId)
    {
        try {
            // Get message
            $sql = "SELECT * FROM Message WHERE messageId = :messageId";
            $query = Database::queryAssoc($sql, [
                ':messageId' => $messageId
            ]);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Return associated array of message
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getMessageById -> " . $e->getMessage());
        }
    }

    /**
     * Gets all messages with a word or a sentence in their content.
     * @param string $stringOfContent The string to search for in the message content.
     * @param int $limit The maximum number of messages to retrieve.
     * @return array|null An array of associative arrays of messages or null if no messages are found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getMessagesByPieceOfContent($stringOfContent, $limit = 10)
    {
        try {
            // Limit de maximum amount of messages
            $limit = (int)$limit;

            $sql = "SELECT 
                Message.messageId AS messageId,
                Message.content AS content,
                Message.date AS date,
                User.username AS username,
                User.userId AS userId
                FROM Message
                INNER JOIN User ON User.userId = Message.userId
                WHERE content
                LIKE :content
                LIMIT $limit";

            // Prepare the SQL query
            $query = Database::queryAssoc($sql, [
                ':content' => '%' . $stringOfContent . '%'
            ]);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Return associated array of message
            return $query;
        } catch (PDOException $e) {
            throw new Error("getMessagesByPieceOfContent -> " . $e->getMessage());
        }
    }

    /**
     * Retrieves the latest messages from a subject, associated with their users, ordered by date.
     * @param string|null $subject The subject of the messages. If null, retrieves messages with no subject.
     * @param int $limit The maximum number of messages to retrieve.
     * @return array|null The latest messages or null if no messages are found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getLastMessageJoinedToUser($subject, $limit = 10)
    {
        try {
            // Limit de maximum amount of messages
            $limit = (int)$limit;

            // Check if the subject is null
            $subjectSql = is_null($subject) ? 'AND Message.subjectId IS NULL' : 'AND Message.subjectId = :subjectId';
            $arrayToPrepare = is_null($subject) ? [] : [':subjectId' => $subject];

            // Get the last messages joined with them users
            $sql = "SELECT
                Message.messageId AS messageId,
                Message.content AS content,
                Message.date AS date,
                User.username AS username,
                User.userId AS userId
                FROM Message
                INNER JOIN User ON User.userId = Message.userId
                {$subjectSql}
                ORDER BY Message.date DESC
                LIMIT $limit";

            // Prepare the SQL query
            $query = Database::queryAssoc($sql, $arrayToPrepare);
            // If no result, return null
            if (is_null($query)) {
                return null;
            }
            // Return associated array of message
            return array_reverse($query);
        } catch (PDOException $e) {
            throw new Error("getLastMessageJoinedToUser -> " . $e->getMessage());
        }
    }

    // ========================== //
    // ===== Delete methods ===== //
    // ========================== //

    /**
     * Deletes a message by its ID.
     * @param int $messageId The ID of the message.
     * @return array|null The data of the deleted message or null if the message is not found.
     * @throws Error If an error occurs during deletion.
     */
    public function deleteMessageById($messageId)
    {
        try {
            // Check if the message exists
            $messageArray = $this->getMessageById($messageId);
            // Return null if the message doesn't exist
            if (is_null($messageArray)) {
                return null;
            }
            // Prepare the SQL query
            $sql = "DELETE FROM Message WHERE messageId = :messageId";
            // Delete the message
            Database::queryAssoc($sql, [
                ':messageId' => $messageId
            ]);
            // Return the deleted message
            return $messageArray;
        } catch (PDOException $e) {
            throw new Error("deleteMessageById -> " . $e->getMessage());
        }
    }
}
