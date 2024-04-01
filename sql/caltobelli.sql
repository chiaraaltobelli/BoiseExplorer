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
    UserTypeID		INT				NOT NULL,
	CONSTRAINT fk_UserAccount_UserType FOREIGN KEY (UserTypeID) REFERENCES UserType(UserTypeID)
); 

INSERT INTO UserAccount VALUES 
(null, 'chiara.j.altobelli@gmail.com', 'Coffee465$', 1);

CREATE TABLE City (
	CityID 		INT				AUTO_INCREMENT PRIMARY KEY,
    City		VARCHAR(100)	NOT NULL
);

INSERT INTO City VALUES 
(null, 'Boise'),
(null, 'Caldwell'),
(null, 'Nampa'),
(null, 'Meridian'),
(null, 'Eagle'),
(null, 'Kuna'),
(null, 'Garden City');

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

INSERT INTO zipcode VALUES 
(NULL, '83702'),
 (NULL, '83703'),
 (NULL, '83704'),
 (NULL, '83705'),
 (NULL, '83706'),
 (NULL, '83709'),
 (NULL, '83712'),
 (NULL, '83713'),
 (NULL, '83714'),
 (NULL, '83716'),
 (NULL, '83616'),
 (NULL, '83642'),
 (NULL, '83646'),
 (NULL, '83634'),
 (NULL, '83605'),
 (NULL, '83606'),
 (NULL, '83651'),
 (NULL, '83686'),
 (NULL, '83687');

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

INSERT INTO address (Address1, CityID, StateID, ZipCodeID, CountryID)
VALUES 
('1001 S Americana Blvd', 1, 1, 5, 1),
('1000 S Americana Blvd', 1, 1, 5, 1),
('700 S Capitol Blvd', 1, 1, 1, 1),
('3206 W Pleasanton Ave', 1, 1, 1, 1),
('700 S Capitol Blvd', 1, 1, 1, 1),
('750 Mountain Cove Rd', 1, 1, 1, 1),
('108 S Capitol Blvd', 1, 1, 1, 1),
('304 S Americana Blvd', 1, 1, 1, 1),
('701 W Fulton St', 1, 1, 1, 1),
('733 S Pioneer St', 1, 1, 1, 1),
('13 S Latah St Suite 103', 1, 1, 4, 1),
('13 S Latah St Suite 101', 1, 1, 4, 1),
('670 Julia Davis Dr', 1, 1, 1, 1),
('611 W Grove St', 1, 1, 1, 1),
('131 W Myrtle St', 1, 1, 1, 1),
('790 S Progress Ave', 4, 1, 12, 1),
('2355 N Old Penitentiary Rd', 1, 1, 7, 1),
('700 W Main St', 1, 1, 1, 1),
('646 W Fulton St', 1, 1, 1, 1),
('608 W Grove St', 1, 1, 1, 1),
('213 N 9th St', 1, 1, 1, 1),
('355 Julia Davis Dr', 1, 1, 1, 1);

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
(null, 'Any'),
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

INSERT INTO Activity (ActivityName, Morning, Afternoon, Evening, SeasonID, ActivityTypeID, UserID, AddressID)
VALUES 
('Kathryn Albertson Park', TRUE, TRUE, TRUE, 2, 3, 1, 1),
('Ann Morrison Park', TRUE, TRUE, TRUE, 2, 3, 1, 2),
('Greenbelt', TRUE, TRUE, TRUE, 2, 3, 1, 3),
('Esther Simplot Park', TRUE, TRUE, TRUE, 2, 3, 1, 4),
('Julia Davis Park', TRUE, TRUE, TRUE, 2, 3, 1, 5),
('Military Reserve', TRUE, TRUE, TRUE, 2, 3, 1, 6),
('Goldy''s Breakfast Bistro', TRUE, FALSE, FALSE, 1, 1, 1, 7),
('Americana Pizza', FALSE, TRUE, TRUE, 1, 1, 1, 8),
('The Gas Lantern Drinking Company', FALSE, TRUE, TRUE, 1, 1, 1, 9),
('Payette Brewing Company', FALSE, TRUE, TRUE, 1, 1, 1, 10),
('Wyld Child', FALSE, TRUE, TRUE, 1, 1, 1, 11),
('The STIL', FALSE, TRUE, TRUE, 1, 1, 1, 12),
('Boise Art Museum', TRUE, TRUE, FALSE, 1, 4, 1, 13),
('Basque Museum & Cultural Center', TRUE, TRUE, FALSE, 1, 4, 1, 14),
('Discovery Center', TRUE, TRUE, FALSE, 1, 4, 1, 15),
('Children’s Museum of Idaho', TRUE, TRUE, FALSE, 1, 4, 1, 16),
('Idaho Botanical Garden', TRUE, TRUE, FALSE, 1, 4, 1, 17),
('Egyptian Theater', FALSE, TRUE, TRUE, 1, 2, 1, 18),
('The Flicks: Rick''s Cafe Americain', FALSE, TRUE, TRUE, 1, 2, 1, 19),
('The Basque Market', FALSE, TRUE, FALSE, 1, 5, 1, 20),
('Mixed Greens Modern Gifts', TRUE, TRUE, FALSE, 1, 5, 1, 21),
('Zoo Boise', TRUE, TRUE, FALSE, 1, 2, 1, 22);

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

    