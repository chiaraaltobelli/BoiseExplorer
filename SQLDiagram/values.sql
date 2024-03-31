/*Insert Values*/
USE BoiseExplorer;

INSERT INTO UserAccount VALUES 
(null, 'chiara.j.altobelli@gmail.com', 'Coffee465$', 1);

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

INSERT INTO activity (ActivityID, ActivityName, SeasonID, ActivityTypeID, TimeOfDayID, UserID, AddressID)
VALUES
(NULL, 'Kathryn Albertson Park', DEFAULT, DEFAULT, 3, 1, 1),
(NULL, 'Ann Morrison Park', DEFAULT, DEFAULT, 3, 1, 2),
(NULL, 'Greenbelt', DEFAULT, DEFAULT, 3, 1, 3),
(NULL, 'Esther Simplot Park', DEFAULT, DEFAULT, 3, 1, 4),
(NULL, 'Julia Davis Park', DEFAULT, DEFAULT, 3, 1, 5),
(NULL, 'Military Reserve', DEFAULT, DEFAULT, 3, 1, 6),
(NULL, 'Goldy''s Breakfast Bistro', '07:00:00', '14:00:00', 1, 1, 7),
(NULL, 'Americana Pizza', '12:00:00', '21:30:00', 1, 1, 8),
(NULL, 'The Gas Lantern Drinking Company', '16:00:00', DEFAULT, 1, 1, 9),
(NULL, 'Payette Brewing Company', '11:00:00', '22:00:00', 1, 1, 10),
(NULL, 'Wyld Child', '11:00:00', '21:00:00', 1, 1, 11),
(NULL, 'The STIL', '12:00:00', '22:00:00', 1, 1, 12),
(NULL, 'Boise Art Museum', '10:00:00', '17:00:00', 4, 1, 13),
(NULL, 'Basque Museum & Cultural Center', '10:00:00', '16:00:00', 4, 1, 14),
(NULL, 'Discovery Center', '10:00:00', '16:30:00', 4, 1, 15),
(NULL, 'Children’s Museum of Idaho', '10:00:00', '17:00:00', 4, 1, 16),
(NULL, 'Idaho Botanical Garden', '09:00:00', '17:00:00', 4, 1, 17),
(NULL, 'Egyptian Theater', '11:00:00', '14:00:00', 2, 1, 18),
(NULL, 'The Flicks: Rick''s Cafe Americain', '12:00:00', '21:30:00', 2, 1, 19),
(NULL, 'The Basque Market', '11:00:00', '17:00:00', 5, 1, 20),
(NULL, 'Mixed Greens Modern Gifts', '10:00:00', '18:00:00', 5, 1, 21),
(NULL, 'Zoo Boise', '10:00:00', '17:00:00', 2, 1, 22);

