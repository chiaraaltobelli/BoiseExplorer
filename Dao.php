<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/Logger.php';
// require_once __DIR__ . '/database.php';

use Katzgrau\KLogger\Logger;
use Psr\Log\LogLevel;

class Dao {
    //Database credentials
    private $host = 'us-cluster-east-01.k8s.cleardb.net';
    private $db = 'heroku_19905b6cee32fd5';
    private $user = 'bd27d135b8e3a9';
    private $pass = 'd7142ae8';

    private $logger;

    //Constructor to initialize class properties
    public function __construct() {
        $this->logger = new Logger("log.txt", LogLevel::WARNING);
        // global $db_credentials; // Make $db_credentials accessible within the class
        //Assign database credentials to class properties
        // $this->host = $db_credentials['host'];
        // $this->db   = $db_credentials['db'];
        // $this->user = $db_credentials['user'];
        // $this->pass = $db_credentials['pass'];
    }

    public function getLogger() {
        return $this->logger;
    }

    public function getConnection() {
        try {
            $connection = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->logger->error("Connection success.");
            return $connection;
        } catch (PDOException $e) {
            $this->logger->error("Connection failed: " . $e->getMessage());
            return null;
        }
    }
    

    public function saveActivity($activityName, $activityType, $morning, $afternoon, $evening, $season, $address, $city, $state, $zip) {
        //Check if user is logged in
        if (!isset($_SESSION['userID'])) {
            $this->logger->error("User is not logged in.");
            return 'login_required'; 
        }
    
        //Set userID and get connection
        $userID = $_SESSION['userID']; 
        $conn = $this->getConnection();
        $this->checkConnection($conn);
    
        try {
            //Check if activity already exists
            $existingActivityId = $this->getActivityIdByName($conn, $activityName, $userID);
            if ($existingActivityId) {
                $this->logger->error("Activity '{$activityName}' already exists.");
                return 'activity_exists'; 
            }
    
            // Continue with saving if the activity does not exist
            $cityId = $this->getOrCreateCityId($conn, $city);
            $stateId = $this->getOrCreateStateId($conn, $state);
            $zipId = $this->getOrCreateZipId($conn, $zip);
            $addressId = $this->insertAddress($conn, $address, $cityId, $stateId, $zipId);
            $seasonId = $this->getSeasonId($conn, $season);
            $activityTypeId = $this->getActivityTypeId($conn, $activityType);
    
            $saveQuery = "INSERT INTO Activity (ActivityName, Morning, Afternoon, Evening, SeasonID, ActivityTypeID, UserID, AddressID) 
                          VALUES (:activityName, :morning, :afternoon, :evening, :seasonId, :activityTypeId, :userID, :addressId)";
            $stmt = $conn->prepare($saveQuery);
            $stmt->bindParam(':activityName', $activityName);
            $stmt->bindParam(':morning', $morning);
            $stmt->bindParam(':afternoon', $afternoon);
            $stmt->bindParam(':evening', $evening);
            $stmt->bindParam(':seasonId', $seasonId);
            $stmt->bindParam(':activityTypeId', $activityTypeId);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':addressId', $addressId);
            $stmt->execute();
    
            return 'success';
        } catch (PDOException $e) {
            $this->logger->error("Error saving activity: " . $e->getMessage());
            return 'database_error';
        }
    }
    
    
    public function getActivityIdByName($conn, $activityName, $userId) {
        try {
            // Query to check if the activity exists either under the default user or the current user
            $stmt = $conn->prepare("SELECT ActivityID FROM Activity WHERE ActivityName = ? AND (UserID = 1 OR UserID = ?)");
            $stmt->execute([$activityName, $userId]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['ActivityID'] : null;
        } catch (PDOException $e) {
            $this->logger->error("Error retrieving activity by name: " . $e->getMessage());
            return null;
        }
    }
   
    private function getUserID($conn, $userEmail) {
        $stmt = $conn->prepare("SELECT UserID FROM UserAccount WHERE UserEmail = ?");
        $stmt->bindParam(1, $userEmail);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['UserID'];
    }

    private function getOrCreateCityId($conn, $city) {
        $stmt = $conn->prepare("SELECT CityID FROM City WHERE City = ?");
        $stmt->bindParam(1, $city);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO City (City) VALUES (?)");
            $stmt->bindParam(1, $city);
            $stmt->execute();
            return $conn->lastInsertId();
        }
        return $row['CityID'];
    }
    
    private function getOrCreateStateId($conn, $state) {
        $stmt = $conn->prepare("SELECT StateID FROM State WHERE State = ?");
        $stmt->bindParam(1, $state);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO State (State) VALUES (?)");
            $stmt->bindParam(1, $state);
            $stmt->execute();
            return $conn->lastInsertId();
        }
        return $row['StateID'];
    }
    
    private function getOrCreateZipId($conn, $zip) {
        $stmt = $conn->prepare("SELECT ZipCodeID FROM ZipCode WHERE ZipCode = ?");
        $stmt->bindParam(1, $zip); 
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            $stmt = $conn->prepare("INSERT INTO ZipCode (ZipCode) VALUES (?)");
            $stmt->bindParam(1, $zip); 
            $stmt->execute();
            return $conn->lastInsertId();
        }
        return $row['ZipCodeID'];
    }

    private function insertAddress($conn, $address1, $cityId, $stateId, $zipId) {
        // Insert the address into the address table
        $countryId = 1; //Assuming default country ID is 1
        $address2 = ""; //Default blank, not currently in use
        $stmt = $conn->prepare("INSERT INTO Address (Address1, Address2, CityID, StateID, ZipCodeID, CountryID) VALUES (?, ?, ?, ?, ?, ?)");
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
        $stmt = $conn->prepare("SELECT SeasonID FROM Season WHERE Season = ?");
        $stmt->execute([$season]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null; //if season is not found
        }
        return $row['SeasonID'];
    }
    
    private function getActivityTypeId($conn, $activityType) {
        $stmt = $conn->prepare("SELECT ActivityTypeID FROM ActivityType WHERE ActivityType = ?");
        $stmt->execute([$activityType]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null; //if activity type is not found
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
			return array();
		}
    }

    public function getStates() {
        $conn = $this->getConnection();
        $this->checkConnection($conn);
        try {
            $stmt = $conn->query("SELECT State FROM State");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                $this->logger->error("No states found in the database.");
            }
            return $result;
        } catch (PDOException $e) {
            $this->logger->error("Error in getStates: " . $e->getMessage());
            return array();
        }
    }  

    public function getCities() {
        $conn = $this->getConnection();
        $this->checkConnection($conn);
        try {
            $stmt = $conn->query("SELECT City FROM City");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                $this->logger->error("No cities found in the database.");
            }
            return $result;
        } catch (PDOException $e) {
            $this->logger->error("Error in getCities: " . $e->getMessage());
            return array();
        }
    }   
    
    public function getSeasons() {
        $conn = $this->getConnection();
        $this->checkConnection($conn);
        try {
            $stmt = $conn->query("SELECT Season FROM Season");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                $this->logger->error("No seasons found in the database.");
            }
            return $result;
        } catch (PDOException $e) {
            $this->logger->error("Error in getSeasons: " . $e->getMessage());
            return array();
        }
    }  

    public function getTimeOfDay() {
        $conn = $this->getConnection();
        $this->checkConnection($conn);
        try {
            $stmt = $conn->query("SELECT TimeOfDay FROM TimeOfDay");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (empty($result)) {
                $this->logger->error("No 'TimeOfDay' found in the database.");
            }
            return $result;
        } catch (PDOException $e) {
            $this->logger->error("Error in getTimeOfDay: " . $e->getMessage());
            return array();
        }
    }  

    public function getActivityTypesWithActivities() {
        $userID = $_SESSION['userID'] ?? null; //check if user is logged in

        $conn = $this->getConnection();
        if (!$conn) {
            return [];
        }
    
        $sql = "SELECT t.ActivityType, a.ActivityName 
                FROM ActivityType t 
                JOIN Activity a ON t.ActivityTypeID = a.ActivityTypeID 
                WHERE a.UserID = 1";  //Default activities
    
        if ($userID) {
            $sql .= " OR a.UserID = :userID";  //Add user-specific activities
        }
    
        $sql .= " ORDER BY t.ActivityType, a.ActivityName";
        $stmt = $conn->prepare($sql);
    
        if ($userID) {
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        }
    
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $activityTypesWithActivities = [];
        foreach ($results as $row) {
            $activityTypesWithActivities[$row['ActivityType']][] = $row['ActivityName'];
        }
    
        return $activityTypesWithActivities;
    }     

    private function checkConnection($conn) {
        if (!$conn) {
            //Failed to get database connection
            $this->logger->error("Failed to get database connection."); // Log error
            return false;
        }
        return true;
    }


    public function createUser($email, $hashedPassword) {
        try {
            //Check if user already exists
            $existingUser = $this->getUserByEmail($email);
            if ($existingUser) {
                //User with this email already exists
                return false;
            }
            
            //Create a new user
            $conn = $this->getConnection();
            $this->checkConnection($conn);
            
            //Prepare SQL statement to insert user into the database
            $stmt = $conn->prepare("INSERT INTO UserAccount (UserEmail, UserPassword) VALUES (?, ?)");
            $stmt->execute([$email, $hashedPassword]);
            return true; //User creation successful
        } catch (PDOException $e) {
            $this->logger->error("Error creating user: " . $e->getMessage());
            return false; //User creation failed
        }
    }
    
    public function getUserByEmail($email) {
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare("SELECT UserID, UserPassword FROM UserAccount WHERE UserEmail = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            // Fetch result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if result is found and log the UserID (Be cautious with what you log in production environments!)
            if ($result) {
                $this->logger->error("Fetched user with UserID: " . $result['UserID']);
            } else {
                $this->logger->error("No user found with email: " . $email);
            }
            
            return $result;
        } catch (PDOException $e) {
            $this->logger->error("Error retrieving user by email: " . $e->getMessage());
            return null;
        }
    }
    
    

    public function getActivitiesByTimeOfDay() {
        $userID = $_SESSION['userID'] ?? null; // Check if user is logged in
        $this->logger->error("User ID: " . ($userID ?? "Not logged in")); // Log the userID
        
        $conn = $this->getConnection();
    
        if (!$conn) {
            return [];
        }
    
        try {
            // Fetch activities grouped by time of day
            $sql = "SELECT ActivityName, Morning, Afternoon, Evening
                    FROM Activity
                    WHERE UserID = 1 "; // Get default activities
    
            if ($userID) {
                $sql .= "OR UserID = :userID"; // Get user added activities
            }
    
            $stmt = $conn->prepare($sql);
    
            if ($userID) {
                $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            }
    
            $stmt->execute();
            $results = $stmt->fetchAll(PDO:: FETCH_ASSOC);
    
            // Initialize an array to store activities grouped by time of day
            $activitiesByTimeOfDay = [
                "Morning" => [],
                "Afternoon" => [],
                "Evening" => []
            ];
    
            foreach ($results as $activity) {
                if ($activity['Morning']) {
                    $activitiesByTimeOfDay["Morning"][] = $activity['ActivityName'];
                }
                if ($activity['Afternoon']) {
                    $activitiesByTimeOfDay["Afternoon"][] = $activity['ActivityName'];
                }
                if ($activity['Evening']) {
                    $activitiesByTimeOfDay["Evening"][] = $activity['ActivityName'];
                }
            }
    
            return $activitiesByTimeOfDay;
        } catch (PDOException $e) {
            $this->logger->error("Error fetching activities by time of day: " . $e->getMessage());
            return [];
        }
    }    

    public function getRandomActivitiesByTimeOfDay($numPerTimeOfDay = 1) {
        // Fetch all activities organized by time of day
        $allActivities = $this->getActivitiesByTimeOfDay();
        
        // Array to store randomly selected activities
        $randomActivitiesByTimeOfDay = [
            "Morning" => [],
            "Afternoon" => [],
            "Evening" => []
        ];
    
        // Temporary storage to keep track of selected activities
        $selectedActivities = [];
    
        // Iterate through each time of day and select random activities
        foreach (['Morning', 'Afternoon', 'Evening'] as $timeOfDay) {
            $possibleActivities = array_diff($allActivities[$timeOfDay], $selectedActivities); // Exclude already selected activities
    
            if (count($possibleActivities) > 0) {
                // Shuffle the array to randomize and then pick the first $numPerTimeOfDay elements
                shuffle($possibleActivities);
                $selected = array_slice($possibleActivities, 0, $numPerTimeOfDay);
                $randomActivitiesByTimeOfDay[$timeOfDay] = $selected;
                $selectedActivities = array_merge($selectedActivities, $selected); //Add to selected to avoid repetition
            }
        }
    
        return $randomActivitiesByTimeOfDay;
    }    

    public function getRandomActivity() {
        $conn = $this->getConnection();
        $sql = "SELECT ActivityName FROM Activity ORDER BY RAND() LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $activity = $stmt->fetch(PDO::FETCH_ASSOC);
        return $activity;
    }
}
?>
