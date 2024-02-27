/*Create Boise Explorer database*/
CREATE DATABASE BoiseExplorer;

USE BoiseExplorer;

/*Create tables*/
CREATE TABLE Neighborhood (
    NeighborhoodID	INT         	AUTO_INCREMENT PRIMARY KEY,
    Neighborhood	VARCHAR(32)     NOT NULL
); 

CREATE TABLE UserType (
    UserTypeID 		INT         	AUTO_INCREMENT PRIMARY KEY,
    UserType		VARCHAR(32)		NOT NULL
); 

CREATE TABLE UserAccount (
    UserID 			INT         	AUTO_INCREMENT PRIMARY KEY,
    UserEmail		VARCHAR(256)	NOT NULL,
    UserPassword	VARCHAR(64)		NOT NULL,
    UserTypeID		INT				NOT NULL,
	CONSTRAINT fk_UserAccount_UserType FOREIGN KEY (UserTypeID) REFERENCES UserType(UserTypeID)
); 

CREATE TABLE City (
	CityID 		INT				AUTO_INCREMENT PRIMARY KEY,
    City		VARCHAR(100)	NOT NULL
);

CREATE TABLE State (
	StateID 		INT				AUTO_INCREMENT PRIMARY KEY,
    State			VARCHAR(64)		NOT NULL
);

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

CREATE TABLE Activity (
    ActivityID    	INT             AUTO_INCREMENT PRIMARY KEY,
    ActivityName  	VARCHAR(64)     NOT NULL,
	OpenHour		TIME            NOT NULL,
    ClosedHour		TIME            NOT NULL,
        CHECK (ClosedHour > OpenHour),
    isOutdoor		BOOL     NOT NULL,
	ActivityTypeID 	INT 			NOT NULL,
    NeighborhoodID 	INT 			NOT NULL,
    UserID			INT,
    AddressID		INT			NOT NULL,
    CONSTRAINT fk_Activity_ActivityType FOREIGN KEY (ActivityTypeID) REFERENCES ActivityType(ActivityTypeID),
	CONSTRAINT fk_Activity_Neighborhood FOREIGN KEY (NeighborhoodID) REFERENCES Neighborhood(NeighborhoodID),
    CONSTRAINT fk_Activity_UserAccount FOREIGN KEY (UserID) REFERENCES UserAccount(UserID),
    CONSTRAINT fk_Activity_Address FOREIGN KEY (AddressID) REFERENCES Address(AddressID)
);

CREATE TABLE Itinerary (
	ItineraryID		INT		AUTO_INCREMENT PRIMARY KEY,
    CreationDate	DATE	NOT NULL,
    UserID			INT		NOT NULL,
	CONSTRAINT fk_Itinerary_UserAccount FOREIGN KEY (UserID) REFERENCES UserAccount(UserID)
);

CREATE TABLE TimeOfDay (
	TimeOfDayID		INT				AUTO_INCREMENT PRIMARY KEY,
    TimeOfDay		VARCHAR(32)		NOT NULL
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

    