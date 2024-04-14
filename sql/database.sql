/*Create Boise Explorer database*/
CREATE DATABASE BoiseExplorer;

USE BoiseExplorer;

/*Create tables*/
CREATE TABLE UserType (
    UserTypeID 		INT         	AUTO_INCREMENT PRIMARY KEY,
    UserType		VARCHAR(32)		NOT NULL
); 

INSERT INTO UserType VALUES 
(null, 'Admin'),
(null, 'Standard');

CREATE TABLE UserAccount (
    UserID 			INT         	AUTO_INCREMENT PRIMARY KEY,
    UserEmail		VARCHAR(256)	NOT NULL,
    UserPassword	VARCHAR(64)		NOT NULL,
    UserTypeID		INT	DEFAULT 2	NOT NULL,
	CONSTRAINT fk_UserAccount_UserType FOREIGN KEY (UserTypeID) REFERENCES UserType(UserTypeID)
); 

CREATE TABLE City (
	CityID 		INT				AUTO_INCREMENT PRIMARY KEY,
    City		VARCHAR(100)	NOT NULL
);

INSERT INTO City VALUES 
(null, 'Boise');

CREATE TABLE State (
	StateID 		INT				AUTO_INCREMENT PRIMARY KEY,
    State			VARCHAR(64)		NOT NULL
);

INSERT INTO State VALUES 
(null, 'Idaho');

CREATE TABLE ZipCode (
    ZipCodeID 	INT AUTO_INCREMENT PRIMARY KEY,
    ZipCode 	VARCHAR(10) NOT NULL,
	CONSTRAINT chk_zip_code CHECK (
		ZipCode REGEXP '^[0-9]' AND ZipCode REGEXP '^[0-9-]+$'
	)
);

CREATE TABLE Country (
	CountryID	INT				AUTO_INCREMENT PRIMARY KEY,
    Country		VARCHAR(64)		NOT NULL
);

INSERT INTO Country VALUES 
(null, 'United States');

CREATE TABLE Address (
	AddressID	INT				AUTO_INCREMENT PRIMARY KEY,
    Address1	VARCHAR(64)		NOT NULL,
    Address2	VARCHAR(64),
    CityID		INT				NOT NULL,
    StateID		INT				NOT NULL,
    ZipCodeID	INT				NOT NULL,
    CountryID	INT				NOT NULL,
	CONSTRAINT fk_Address_City FOREIGN KEY (CityID) REFERENCES City(CityID),
    CONSTRAINT fk_Address_State FOREIGN KEY (StateID) REFERENCES State(StateID),
	CONSTRAINT fk_Address_ZipCode FOREIGN KEY (ZipCodeID) REFERENCES ZipCode(ZipCodeID),
	CONSTRAINT fk_Address_Country FOREIGN KEY (CountryID) REFERENCES Country(CountryID)
);

CREATE TABLE ActivityType (
    ActivityTypeID	INT         	AUTO_INCREMENT PRIMARY KEY,
    ActivityType  	VARCHAR(32)     NOT NULL
); 

INSERT INTO ActivityType VALUES
(null, 'Dining'),
(null, 'Entertainment'),
(null, 'Outdoor Recreation'),
(null, 'Arts & Culture'),
(null, 'Shopping');

CREATE TABLE Season (
    SeasonID	INT         	AUTO_INCREMENT PRIMARY KEY,
    Season 		VARCHAR(32)     NOT NULL
); 

INSERT INTO Season VALUES 
(null, 'Any'),
(null, 'Warm Weather'),
(null, 'Cold Weather');

CREATE TABLE TimeOfDay (
	TimeOfDayID		INT				AUTO_INCREMENT PRIMARY KEY,
    TimeOfDay		VARCHAR(32)		NOT NULL
);

INSERT INTO TimeOfDay VALUES 
(null, 'Morning'),
(null, 'Afternoon'),
(null, 'Evening');

CREATE TABLE Activity (
    ActivityID    	INT             AUTO_INCREMENT PRIMARY KEY,
    ActivityName  	VARCHAR(64)     NOT NULL,
	Morning			BOOLEAN	DEFAULT FALSE NOT NULL,
	Afternoon		BOOLEAN	DEFAULT FALSE NOT NULL,
	Evening 		BOOLEAN	DEFAULT FALSE NOT NULL,
	SeasonID		INT				NOT NULL,
	ActivityTypeID 	INT 			NOT NULL,
    UserID			INT,
    AddressID		INT			NOT NULL,
	CONSTRAINT fk_Activity_Season FOREIGN KEY (SeasonID) REFERENCES Season(SeasonID),
    CONSTRAINT fk_Activity_ActivityType FOREIGN KEY (ActivityTypeID) REFERENCES ActivityType(ActivityTypeID),
    CONSTRAINT fk_Activity_UserAccount FOREIGN KEY (UserID) REFERENCES UserAccount(UserID),
    CONSTRAINT fk_Activity_Address FOREIGN KEY (AddressID) REFERENCES Address(AddressID)
);

CREATE TABLE Itinerary (
	ItineraryID		INT		AUTO_INCREMENT PRIMARY KEY,
    CreationDate	DATETIME	NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UserID			INT		NOT NULL,
	CONSTRAINT fk_Itinerary_UserAccount FOREIGN KEY (UserID) REFERENCES UserAccount(UserID)
);

CREATE TABLE ItineraryActivity (
	ItineraryActivityID		INT				AUTO_INCREMENT PRIMARY KEY,
    ActivityOrder			INT				NOT NULL,
    TimeOfDayID				INT				NOT NULL,				
    ActivityID				INT				NOT NULL,
    ItineraryID				INT				NOT NULL,
	CONSTRAINT fk_ItineraryActivity_Itinerary FOREIGN KEY (ItineraryID) REFERENCES Itinerary(ItineraryID),
	CONSTRAINT fk_ItineraryActivity_TimeOfDay FOREIGN KEY (TimeOfDayID) REFERENCES TimeOfDay(TimeOfDayID),
    CONSTRAINT fk_ItineraryActivity_Activity FOREIGN KEY (ActivityID) REFERENCES Activity(ActivityID)
);

CREATE TABLE Subscriber (
	SubscriberID INT				AUTO_INCREMENT PRIMARY KEY,
    SubscriberEmail		VARCHAR(256)	NOT NULL
);

    