
<?php
/*
 * Following code will list all the students on a course
 */

//Enable cross domain Communication - Beware, this can be a security risk 
header('Access-Control-Allow-Origin: http://localhost:8383');

//include db connect class
require_once 'db_connect.php';

// Get access to datbase instance 
$db = Database::getInstance();

// Get database connection from database
$conn = $db->getConnection(); 

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create query using SQL string
$sql_query = "SELECT lecturerTable.moduleNo2, studentTable.firstName AS studentName, studentTable.lastName AS studentLastName
FROM lecturerTable
INNER JOIN studentTable  ON studentTable.moduleNo2=lecturerTable.moduleNo2
WHERE lecturerTable.lastName='Cullen';";
//INNER JOIN moduleTable ON moduleTable.moduleNo=lecturerTable.moduleNo2;
//WHERE lecturerTable.lastName='Cullen'
// Query database using connection
$result = $conn->query($sql_query);

// check for empty result
if (mysqli_num_rows($result) > 0)
 {
    // Create Array for JSON response
    $response = array();
    
    // Create Array called students inside response Array
    $response["students"] = array();
    
    // Loop through all results from Database
    while ($row = mysqli_fetch_array($result)) 
     {
            // Assign results for each database row, to temp module array
            $student = array();
            $student["studentName"] = $row["studentName"];
            $student["studentLastName"] = $row["studentLastName"];
            
            
           
           
             


       // push single student into final response array
        array_push($response["students"], $student);
    }
    // success
    $response["success"] = 1;

    // print JSON response
    print (json_encode($response));

}
else {
    // no students found
    $response["success"] = 0;
    $response["message"] = "No students found";

    // print no students JSON
    print (json_encode($response));
}
//second query
// Create query using SQL string 
/*$sql_query2 = "SELECT lecturerTable.moduleNo2, moduleTable.moduleName, lecturerTable.lastName, moduleTable.time,moduleTable.room
FROM lecturerTable
INNER JOIN moduleTable ON moduleTable.moduleNo=lecturerTable.moduleNo2
WHERE lecturerTable.lastName='Cullen';"; // query working

// Query database using connection
$result = $conn->query($sql_query2);

// check for empty result
if (mysqli_num_rows($result) > 0)
 {
    // Create Array for JSON response
    $response = array();
    
    // Create Array called students inside response Array
    $response["students2"] = array();
    
    // Loop through all results from Database
    while ($row = mysqli_fetch_array($result)) 
     {
            // Assign results for each database row, to temp module array
            $student2 = array();
            $student2["moduleName"] = $row["moduleName"];
            $student2["time"] = $row["time"];
            $student2["room"] = $row["room"];
           
           
             


       // push single student into final response array
        array_push($response["students2"], $student2);
    }
    // success
    $response["success"] = 1;

    // print JSON response
    print (json_encode($response));

}
else {
    // no students found
    $response["success"] = 0;
    $response["message"] = "No students found";

    // print no students JSON
    print (json_encode($response));
}*/
?>