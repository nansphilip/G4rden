<?php

/**
 * Class Subject
 * Represents a subject in the system.
 */
class Subject
{
    public $subjectId;
    public $name;
    public $description;
    public $isValidated;
    public $userId;

    /**
     * Subject constructor.
     * @param int|null $subjectId The ID of the subject.
     * @param string|null $name The name of the subject.
     * @param string|null $description The description of the subject.
     * @param bool|null $isValidated Whether the subject is validated.
     * @param int|null $userId The ID of the user who created the subject.
     */
    public function __construct($subjectId = null, $name = null, $description = null, $isValidated = null, $userId = null)
    {
        $this->subjectId = $subjectId;
        $this->name = $name;
        $this->description = $description;
        $this->isValidated = $isValidated;
        $this->userId = $userId;
    }

    // ======================= //
    // ===== Add methods ===== //
    // ======================= //

    /**
     * Adds a new subject to the database and fills the current instance of the object.
     * @param string $name The name of the subject.
     * @param string $description The description of the subject.
     * @param bool $isValidated Whether the subject is validated.
     * @param int|null $userId The ID of the user who created the subject (optional).
     * @return array Information about the added subject.
     * @throws Error If an error occurs during the addition.
     */
    public function addSubject($name, $description, $isValidated, $userId = null)
    {
        try {
            // Get environment
            $envFile = parse_ini_file(".env");
            $ENVIRONMENT = $envFile['ENV'];

            // Check if in production
            if ($ENVIRONMENT !== "DEV") {
                $getRowCount = Database::queryAssoc("SELECT COUNT(*) as recordsAmount FROM Subject;");
                $recordsAmount = $getRowCount[0]['recordsAmount'];

                // If records amount is >= 20, throw an error to prevent the database from being overloaded
                if ($recordsAmount >= 20) {
                    throw new Error("Records amount reached the maximum limit of 20 subjects.");
                }
            }

            // Insert the subject into the database
            $sql = "INSERT INTO Subject (name, description, isValidated, userId) VALUES (:name, :description, :isValidated, :userId)";
            Database::queryAssoc($sql, [
                ':name'        => $name,
                ':description' => $description,
                ':isValidated' => $isValidated,
                ':userId'      => $userId
            ]);

            // Get the last inserted id
            $lastInsertId = Database::lastInsertId();
            // Get the currently inserted subject
            $subjectArray = $this->getSubjectById($lastInsertId);
            // Fill the current instance of the object
            $this->fillSubjectInstance($subjectArray);
            // Return the current subject
            return $subjectArray;
        } catch (PDOException $e) {
            throw new Error("addSubject -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Fill methods ==== //
    // ======================= //

    /**
     * Fills the instance of the object with subject data.
     * @param array $subjectArray Associative array containing the subject's data.
     * @throws Error If an error occurs during the filling of the instance.
     */
    public function fillSubjectInstance($subjectArray)
    {
        try {
            // Set properties in instance object
            foreach ($subjectArray as $key => $value) {
                $this->$key = $value;
            }
        } catch (Exception $e) {
            throw new Error("fillSubjectInstance -> " . $e->getMessage());
        }
    }

    // ======================= //
    // ===== Get methods ===== //
    // ======================= //

    /**
     * Retrieves a subject by its ID.
     * @param int $subjectId The ID of the subject.
     * @return array|null The subject's data or null if the subject is not found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getSubjectById($subjectId)
    {
        try {
            // Get subject
            $sql = "SELECT * FROM Subject WHERE subjectId = :subjectId";
            $query = Database::queryAssoc($sql, [
                ':subjectId' => $subjectId
            ]);
            // If no result, return null
            if (empty($query)) {
                return null;
            }
            // Return associative array of subject
            return $query[0];
        } catch (PDOException $e) {
            throw new Error("getSubjectById -> " . $e->getMessage());
        }
    }

    /**
     * Retrieves a list of subjects with details about the latest message on each subject.
     * Only validated subjects are included in the result, ordered by the date of the last message.
     * @param int $limit The maximum number of subjects to retrieve.
     * @return array|null An array of subjects with their last activity details, or null if no results are found.
     * @throws Error If an error occurs during the query execution.
     */
    public static function getLastSubjectsByLastActivity($limit = 10)
    {
        try {
            // Limiter le nombre maximum de sujets
            $limit = (int)$limit;

            // Récupérer les derniers messages pour chaque sujet
            $sql = "SELECT
                    Sjt.subjectId,
                    Sjt.name,
                    Sjt.description,
                    Sjt.isValidated,
                    Sjt.userId AS creatorId,
                    User1.username AS creatorName,
                    Message.content AS lastMessage,
                    Message.date AS lastMessageDate,
                    User2.username AS lastMessageAuthor
                FROM Subject Sjt
                INNER JOIN User User1 ON Sjt.userId = User1.userId
                LEFT JOIN (
                    SELECT Msg2.subjectId, Msg2.content, Msg2.userId, Msg2.date
                    FROM Message Msg2
                    INNER JOIN (
                        SELECT subjectId, MAX(date) AS max_date
                        FROM Message
                        GROUP BY subjectId
                    ) Msg3 ON Msg2.subjectId = Msg3.subjectId AND Msg2.date = Msg3.max_date
                ) Message ON Sjt.subjectId = Message.subjectId
                LEFT JOIN User User2 ON Message.userId = User2.userId
                WHERE Sjt.isValidated = 1
                ORDER BY Message.date DESC
                LIMIT {$limit}
            ";

            // Exécuter la requête SQL
            $query = Database::queryAssoc($sql);

            // Si aucun résultat, retourner null
            if (empty($query)) {
                return null;
            }

            // Retourner le résultat
            return $query;
        } catch (PDOException $e) {
            throw new Error("getLastSubjectsByLastActivity -> " . $e->getMessage());
        }
    }

    /**
     * Retrieves all subjects from the database.
     * @return array|null An array of all subjects or null if none are found.
     * @throws Error If an error occurs during retrieval.
     */
    public function getAll()
    {
        try {
            // Get all subjects
            $sql = "SELECT * FROM Subject";
            $query = Database::queryAssoc($sql);
            // If no result, return null
            if (empty($query)) {
                return null;
            }
            // Return an array of associative arrays of subjects
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
     * Deletes a subject by its ID.
     * @param int $subjectId The ID of the subject.
     * @return array|null The data of the deleted subject or null if the subject is not found.
     * @throws Error If an error occurs during deletion.
     */
    public function deleteSubject($subjectId)
    {
        try {
            // Check if the subject exists
            $subjectArray = $this->getSubjectById($subjectId);
            // Return null if the subject doesn't exist
            if (is_null($subjectArray)) {
                return null;
            }
            // Prepare the SQL query
            $sql = "DELETE FROM Subject WHERE subjectId = :subjectId";
            // Delete the subject
            Database::queryAssoc($sql, [
                ':subjectId' => $subjectId
            ]);
            // Return the deleted subject
            return $subjectArray;
        } catch (PDOException $e) {
            throw new Error("deleteSubject -> " . $e->getMessage());
        }
    }
}
