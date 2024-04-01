<!-- <?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/vendor/klogger/src/Logger.php';



use Katzgrau\KLogger\Logger; // Ensure correct namespace import
use Psr\Log\LogLevel; // Import LogLevel from Psr\Log namespace

class Dao {
    private $host = "us-cluster-east-01.k8s.cleardb.net";
    private $db = "heroku_19905b6cee32fd5";
    private $user = "bd27d135b8e3a9";
    private $pass = "d7142ae8";
    private $logger; // Add logger property

    public function __construct() {
        $this->logger = new Logger("log.txt", LogLevel::WARNING); // Initialize logger
    }

    public function getLogger() {
        return $this->logger;
    }

    public function getConnection() {
        try {
            $connection = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->logger->error("Connection success."); // Log success
            return $connection;
        } catch (PDOException $e) {
            $this->logger->error("Connection failed: " . $e->getMessage()); // Log error
            return null;
        }
    }
    

    public function saveActivity($activityName, $activityType, $morning, $afternoon, $evening, $season, $address, $city, $state, $zip) {
        session_start();

        if (!isset($_SESSION['email'])) {
            $this->logger->error("User is not logged in."); // Log error
            return false;
        }

        $userEmail = $_SESSION['email'];
        $this->logger->info("saveActivity: [{$userEmail}],[{$activityName}],[{$activityType}],[{$morning}],[{$afternoon}],[{$evening}],[{$season}],[{$address}],[{$city}],[{$state}],[{$zip}]"); // Log info

        $conn = $this->getConnection();

        $this->checkConnection($conn);

        try {
            $cityId = $this->getOrCreateCityId($conn, $city);
            $stateId = $this->getOrCreateStateId($conn, $state);
            $zipId = $this->getOrCreateZipId($conn, $zip);

            $addressId = $this->insertAddress($conn, $address, $cityId, $stateId, $zipId);
            $seasonId = $this->getSeasonId($conn, $season);
            $activityTypeId = $this->getActivityTypeId($conn, $activityType);
            $userId = $this->getUserID($conn, $userEmail);

            $saveQuery = "INSERT INTO activity (ActivityName, Morning, Afternoon, Evening, SeasonID, ActivityTypeID, UserID, AddressID) 
                          VALUES (:activityName, :morning, :afternoon, :evening, :seasonId, :activityTypeId, :userId, :addressId)";
            $stmt = $conn->prepare($saveQuery);
            $stmt->bindParam(':activityName', $activityName);
            $stmt->bindParam(':morning', $morning);
            $stmt->bindParam(':afternoon', $afternoon);
            $stmt->bindParam(':evening', $evening);
            $stmt->bindParam(':seasonId', $seasonId);
            $stmt->bindParam(':activityTypeId', $activityTypeId);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':addressId', $addressId);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            $this->logger->error("Error saving activity: " . $e->getMessage());
            return false;
        }
    }

    private function getUserID($conn, $userEmail) {
        $stmt = $conn->prepare("SELECT UserID FROM userAccount WHERE UserEmail = ?");
        $stmt->bindParam(1, $userEmail); // Bind user email parameter
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['UserID'];
    }

    private function getOrCreateCityId($conn, $city) {
        $stmt = $conn->prepare("SELECT CityID FROM city WHERE City = ?");
        $stmt->bindParam(1, $city); // Bind city parameter
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO city (City) VALUES (?)");
            $stmt->bindParam(1, $city); // Bind city parameter
            $stmt->execute();
            return $conn->lastInsertId();
        }
        return $row['CityID'];
    }
    
    private function getOrCreateStateId($conn, $state) {
        $stmt = $conn->prepare("SELECT StateID FROM state WHERE State = ?");
        $stmt->bindParam(1, $state); // Bind state parameter
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO state (State) VALUES (?)");
            $stmt->bindParam(1, $state); // Bind state parameter
            $stmt->execute();
            return $conn->lastInsertId();
        }
        return $row['StateID'];
    }
    
    private function getOrCreateZipId($conn, $zip) {
        $stmt = $conn->prepare("SELECT ZipCodeID FROM zipcode WHERE ZipCode = ?");
        $stmt->bindParam(1, $zip); // Bind zip parameter
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO zipcode (ZipCode) VALUES (?)");
            $stmt->bindParam(1, $zip); // Bind zip parameter
            $stmt->execute();
            return $conn->lastInsertId();
        }
        return $row['ZipCodeID'];
    }

    private function insertAddress($conn, $address1, $cityId, $stateId, $zipId) {
        // Insert the address into the address table
        $countryId = 1; // Assuming default country ID is 1, modify as needed
        $address2 = ""; //leave blank
        $stmt = $conn->prepare("INSERT INTO address (Address1, Address2, CityID, StateID, ZipCodeID, CountryID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $address1);
        $stmt->bindParam(2, $address2);
        $stmt->bindParam(3, $cityId);
        $stmt->bindParam(4, $stateId);
        $stmt->bindParam(5, $zipId);
        $stmt->bindParam(6, $countryId);
        $stmt->execute();
        
        // Return the last inserted address ID
        return $conn->lastInsertId();
    }

    private function getSeasonId($conn, $season) {
        $stmt = $conn->prepare("SELECT SeasonID FROM season WHERE Season = ?");
        $stmt->execute([$season]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            // Handle if season not found
            return null;
        }
        return $row['SeasonID'];
    }
    
    private function getActivityTypeId($conn, $activityType) {
        $stmt = $conn->prepare("SELECT ActivityTypeID FROM ActivityType WHERE ActivityType = ?");
        $stmt->execute([$activityType]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            // Handle if activity type not found
            return null;
        }
        return $row['ActivityTypeID'];
    }

	    
    public function getActivityTypes() {
        $this->logger->error("getActivityTypes reached"); 
		$conn = $this->getConnection();
        $this->checkConnection($conn);
	
		try {
			$stmt = $conn->query("SELECT ActivityType FROM ActivityType");
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			// Handle query execution error
			return array();
		}
    }

    private function checkConnection($conn) {
        if (!$conn) {
            // Failed to get database connection
            $this->logger->error("Failed to get database connection."); // Log error
            return false;
        }
        return true;
    }


    public function createUser($email, $hashedPassword) {
        try {
            // Check if user already exists
            $existingUser = $this->getUserByEmail($email);
            if ($existingUser) {
                // User with this email already exists
                return false;
            }
            
            // Create a new user
            $conn = $this->getConnection();
            $this->checkConnection($conn);
            
            // Prepare SQL statement to insert user into the database
            $stmt = $conn->prepare("INSERT INTO userAccount (UserEmail, UserPassword) VALUES (?, ?)");
            $stmt->execute([$email, $hashedPassword]);
            return true; // User creation successful
        } catch (PDOException $e) {
            // Handle database error
            $this->logger->error("Error creating user: " . $e->getMessage());
            return false; // User creation failed
        }
    }
    

    public function getUserByEmail($email) {
        try {
            // Retrieve user by email
            $conn = $this->getConnection();
            // Prepare SQL statement to select user by email
            $stmt = $conn->prepare("SELECT * FROM UserAccount WHERE UserEmail = ?");
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database error
            $this->logger->error("Error retrieving user by email: " . $e->getMessage());
            return null; // Return null instead of false
        }
    }
    
}
?> -->
