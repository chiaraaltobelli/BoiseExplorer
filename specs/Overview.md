# Boise Explorer

## about.php
This PHP script serves an "About" page for the Boise Adventure Generator, providing an overview of the platform, its mission, how it works, the target audience, and additional services. It outlines the benefits and features of using the platform for planning activities in Boise, Idaho, aimed at enhancing the user's experience by simplifying decision-making and personalizing their adventures.

## activities.js
This JavaScript code, set to execute once the document is fully loaded, manages user interactions on the "Activities" page. It handles opening and closing for the 'add activity' modal popup, ensures at least one checkbox is checked before form submission (morning, afternoon, evening), and manages the display of error messages.

## activities.php
This PHP script controls the "Activities" page, displaying an "Add Activity" button and various activity categories only if the user is authenticated. It retrieves and organizes activity types and their specific activities from a database using a DAO, ensuring that only logged-in users can add new activities.

## add_activity_handler.php
This PHP script processes an activity submission form by sanitizing and validating user inputs, then using a DAO (Data Access Object) to save the data to a database. It handles errors and user feedback by storing messages in the session and redirecting back to the form with appropriate messages if there are any issues, or confirming the successful addition of the activity.

## add_activity.php
This PHP script serves a web form on a webpage for adding activities, enriched by client-side functionalities using JavaScript. It handles displaying a popup form where users can input details about new activities, including name, type, time of day, season, address, city, state, and zip code. It also manages session-based feedback, displaying error messages when required and retaining previously inputted values to ease user interaction. The script ensures only validated data is submitted, leveraging a DAO to fetch necessary data like activity types and location details to populate form selections.

## create_account_content.php
### NOTE: Move JS to separate file
This file constructs a user interface for a "Create New Account" form within a popup modal. It includes form elements for entering email, password, confirming password, and a "Remember me" checkbox. The form is submitted to a create_account_handler.php script for backend processing. The JavaScript is used to automatically show the popup when the page loads and to provide functionality for closing the popup by clicking the close button (&times;).

## create_account_handler.php
This PHP script handles the user registration process on a web platform. It begins by sanitizing the user inputs to prevent security risks like XSS attacks. The script validates the email format, password length and complexity, and checks whether the confirmed password matches the original. It also verifies if an account with the provided email already exists in the database. If the validations pass without errors, the password is securely hashed and the new user data is inserted into the database. Upon successful registration, the user is redirected to a confirmation page; otherwise, error messages are stored in the session and the user is redirected back to the registration form to correct the inputs.

## create_account.js
This JavaScript code listens for the DOM content to be fully loaded and then attaches an event listener to the form with the ID createAccountForm. When the form is submitted, the script checks if the values entered in the password and confirm password fields match. If they do not match, an alert is displayed to the user indicating that the passwords do not match, and the form submission is prevented. This ensures that the user cannot proceed without entering matching passwords, enhancing the form's data integrity before it's submitted to the server.

## create_account.php
This file serves as the starting point for a "Create Account" page on the Boise Explorer website, where new users can register for an account. It includes references to external resources like a favicon and a CSS file for pop-up styling. The main content of the page, including the user registration form, is dynamically loaded through the included create_account_content.php file, which separates the form logic and presentation from the page structure for better maintainability.

## Dao.php
This PHP script defines a Dao (Data Access Object) class that handles all database interactions for a web application. It manages connections to a MySQL database using PDO, and includes methods to perform CRUD (Create, Read, Update, Delete) operations like saving an activity, retrieving user details, and fetching lists of states, cities, and activity types. The class utilizes a logger for error handling and debugging, and is structured to support user sessions for tracking logged-in state. The methods also handle specific tasks like checking for existing activities, inserting new records, and generating lists of activities based on user inputs or default settings.

## footer.php
This file defines a site-wide footer, which includes a logo, copyright information, and a link to the license, ensuring consistent footer content across all web pages.

## generate_handler.php
This PHP script handles random activity generation, providing either a single random activity or a full day of activities based on user input. It interacts with a database through a DAO to fetch and display activities in an HTML format, depending on the type of itinerary requested by the user.

## generate.js
This JavaScript code is designed to handle form submission for an activity type selection on a webpage without reloading the page. When the user clicks the 'generate-button', it prevents the default form submission, captures the selected activity type, and sends an asynchronous POST request to 'generate_handler.php'. The response from the server is then used to update the 'activities-container' on the webpage. If the request fails, it logs an error to the console. This approach enhances user experience by providing immediate feedback without page refresh.

## generate.php
This PHP script serves as the webpage for generating activity itineraries. It includes a dynamic drop-down menu for users to select either a single activity or a full day's itinerary. Upon making a selection, users can click the "Generate" button, which triggers client-side JavaScript to asynchronously fetch and display relevant activities on the page.

## header.php
This PHP script creates the header and navigation bar of the "Boise Explorer" website and includes necessary session initialization for user state management. It features a responsive header with branding and navigation links that dynamically highlight based on the current page. The header incorporates external stylesheets for site-wide and pop-up specific styling and includes separate PHP scripts for login status handling and a login modal.

## index_handler.php
This PHP script manages the subscription process for a newsletter or updates on the "Boise Explorer" website. Upon form submission, it validates the email address format and checks for an existing subscription in the database to prevent duplicates. If the email is new and valid, it is added to the subscriber list. In case of validation errors or database issues, appropriate error messages are stored in the session and the user is redirected back to the homepage with these messages. The script ensures only POST requests are handled, redirecting any other request types to the homepage to maintain secure and intended functionality.

## index.js
This JavaScript code, using jQuery, is designed to enhance the user interface by automatically managing the visibility of error messages on a webpage. When the document is ready, it triggers the error message containers identified by the class .error-messages to fade in over a period of 3000 milliseconds (3 seconds), remain visible for another 3000 milliseconds, and then fade out over 3000 milliseconds.

## index.php
This file, enhanced with PHP and JavaScript, serves as the home page for the "Boise Explorer" website. It introduces users to the site with a welcoming headline and provides a subscription form for a newsletter to keep visitors informed about Boise's latest adventures and stories. The page dynamically displays success messages when users successfully subscribe and shows any error messages stored in the session. These messages are managed visually by JavaScript to ensure they appear and disappear in a user-friendly manner, enhancing the interactivity of the site.

## login_handler.php
This PHP script handles user authentication for a website. It initiates a session and checks for POST data from a login form. If credentials are provided, it attempts to verify the user by checking the email and password against a database using the Dao. If authentication is successful, the user's ID is stored in the session, and they are redirected to a previously intended page or the homepage. If authentication fails, error flags are set in the session, and the user is redirected back to the login page or the referring page with an error query string indicating incorrect credentials.

## login_logout_buttons.php
This PHP script dynamically displays a login or logout button based on the user's authentication status. If the user is logged in, the button is set to "Logout" and linked to a logout script. If the user is not logged in, the button reads "Login" and doesn't redirect, potentially triggering a login popup instead.

## login.js
This JavaScript code manages the display of the login popup on the webpage. It activates the popup when the "Login" button is clicked and provides functionality to close the popup through a designated close button.

## login.php
This code defines a login popup with an integrated form for users to enter their email and password. It displays an error message for incorrect credentials and includes links for creating a new account, all encapsulated within a closeable modal design.

## logout.php
This PHP script effectively logs out a user by starting a session, immediately destroying it, and then redirecting the user to the homepage (index.php). The exit() function ensures that no further script execution occurs after the redirection.

## registration.php
This PHP script manages the display of error messages on a webpage titled "Invalid Account Registration". The script checks for any stored error messages in the session, displays them if present, and then clears the error messages from the session to prevent them from reappearing on subsequent page loads.

## CSS Styling
### popup.css
The popup.css styles primarily focus on designing a popup element that appears dynamically in a web application. They define the visual layout, transitions, and interactive elements within the popup, such as close buttons and form fields.

### style.css
The style.css styles define the layout and appearance of various elements in the web application. They include styles for the header, navigation links, sign-in button, error messages, page content, footer, typography, dropdown containers, forms, buttons, and responsive design adjustments for smaller screens.