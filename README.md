# Baseball
This project demonstrates connecting to a database and using complex SQL queries to generate data from the database to display on the site.
The getDataFromSQL function in database_functions.php makes a connection to the database using PDO and an associative array of values from the database is returned.
Those values are then echoed onto the site in table format to give the user an organized table of data on the baseball players in the database. 

Used Lahman’s Baseball Database
https://www.seanlahman.com/baseball-archive/statistics/

If you wish to download the project code and run it, you need to install the database using a SQL dump from the web page above. You also need to give your database a name and set permissions for a username and password for select access.
You will need to set these variables in database.php equal to:
$servername = server name
$username = your username you set up for the database
$password = your password you set up for the database
$database = the name of the database you set up 
