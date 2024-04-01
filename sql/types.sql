/*Create Types*/
USE BoiseExplorer;

INSERT INTO UserType VALUES 
(null, 'Admin'),
(null, 'Standard');

INSERT INTO UserAccount VALUES 
(null, 'chiara.j.altobelli@gmail.com', 'Coffee465$', 1);

INSERT INTO TimeOfDay VALUES 
(null, 'Any'),
(null, 'Morning'),
(null, 'Afternoon'),
(null, 'Evening');

INSERT INTO Season VALUES 
(null, 'Any'),
(null, 'Warm Weather'),
(null, 'Cold Weather');

INSERT INTO City VALUES 
(null, 'Boise'),
(null, 'Caldwell'),
(null, 'Nampa'),
(null, 'Meridian'),
(null, 'Eagle'),
(null, 'Kuna'),
(null, 'Garden City');

INSERT INTO State VALUES 
(null, 'Idaho');

INSERT INTO Country VALUES 
(null, 'United States');

INSERT INTO ActivityType VALUES
(null, 'Dining'),
(null, 'Entertainment'),
(null, 'Outdoor Recreation'),
(null, 'Arts & Culture'),
(null, 'Shopping');