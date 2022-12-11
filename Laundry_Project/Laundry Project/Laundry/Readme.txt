1.Run "Laundry Project\SQL\CreateDatabase.sql" on mysql clent to create database and tables, please notes that Admin/321 created by default

2.Put the project code "Laundry Project\Laundry" into your webpage server, like xampp

3.Change to your mysql connection info in below file
  Laundry Project\Laundry\dbConnect.php
  line3   ---   $conn = mysqli_connect("localhost", "root", "");
  
4.Start your webpage server, and open web browser, go to http://localhost/laundry/index.html
 