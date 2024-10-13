<?php
$envFile = parse_ini_file(".env");
$ENVIRONMENT = $envFile['ENV'];

/**
 * Message class
 * A message has an ID, a content, a date and a userId.
 * It also has methods to add, get, update and delete messages.
 */
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

            $sql = "INSERT INTO Message (content, date, userId) VALUES (:content, :date, :userId)";
            Database::queryAssoc($sql, [
                ':content' => $this->content,
                ':date' => $this->date,
                ':userId' => $this->userId
            ]);
        } catch (PDOException $e) {
            throw new Error("addMessage -> " . $e->getMessage());
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
            throw new Error("getMessageById -> " . $e->getMessage());
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
     * Gets all messages with a word or a sentence in their content 
     * and with a specified user
     * @param string $stringOfContent, $userId
     * @return array of associated_arrays of messages
     */
    public static function getMessagesByUserAndContent($userId, $stringOfContent)
    {
        try {
            $sql = "SELECT * FROM Message WHERE content LIKE :content AND userId = :userId";
            $query = Database::queryAssoc($sql, [
                ':content' => "%" . $stringOfContent . "%",
                ':userId' => $userId
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
                Message.id as id,
                Message.content as message,
                Message.date as date
                FROM Message
                INNER JOIN User ON User.id = Message.userId
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

    /**
     * @return mixed
     */


    // ========================== //
    // ===== Update methods ===== //
    // ========================== //

    /**
     * Updates the username for all his messages
     */
    public function updateAllAuthorMessages($userId)
    {
        try {
            $sql = "UPDATE Message SET userId = :newUserId WHERE userId = :userId";
            $query = Database::queryBool($sql, [
                ':newUserId' => $userId,
                ':userId' => $this->userId
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Exception("updateAllAuthorMessages -> " . $e->getMessage());
        }
    }

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
            $query = Database::queryBool($sql, [
                ':id' => $this->id
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Error("deleteMessage -> " . $e->getMessage());
        }
    }

    /**
     * Deletes all messages of an user by its id
     * @param string $userId
     * @return bool
     */
    public static function deleteAllMessagesByUserId($userId)
    {
        try {
            $sql = "DELETE FROM Message WHERE userId = :userId";
            $query = Database::queryBool($sql, [
                ':userId' => $userId
            ]);
            return $query;
        } catch (PDOException $e) {
            throw new Error("deleteAllMessagesByUserId -> " . $e->getMessage());
        }
    }
}
