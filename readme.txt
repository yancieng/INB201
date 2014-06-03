Installation instructions:

1. Install XAMPP (this project was created using version 1.8.3, but later versions may still work); the installation file is located on the USB (if for some reason it isn’t, or the file doesn’t work, you can get it at https://www.apachefriends.org/download.html)

2. Copy-paste the “INB201” folder into C:\xampp\htdocs (or the htdocs folder of wherever you chose to install XAMPP)

3. Start up the XAMPP Control Panel and activate/start both the Apache and MySQL modules

4. Click the “Admin” button (next to Start/Stop) for the MySQL module (or type localhost/phpmyadmin into your browser’s address bar)

5. Click the “Import” option on the top bar of the phpMyAdmin interface

6. In “File to Import”, click the “Browse” button where it says “Browse your computer:” and find the database’s .sql file (available on the USB as hospital.sql), leave all other options as-is and click “Go” at the bottom of the page

7. If the database imports correctly, type “localhost/INB201” into the browser’s address bar to access the site

8. Each different role has different functions on the site; the following are the login details for each (written as Role: Username – Password):
  a. Doctor: 0001 – doctor
  b. Nurse: 0003 – nurse
  c. Receptionist: 0004 – receptionist
  d. Administrator: 0005 – administrator
