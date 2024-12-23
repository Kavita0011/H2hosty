<?php
// if form submitted
if ($_POST['submit']) {
    function user_data()
    {
        $user_name = htmlspecialchars($_POST['user_name'],ENT_QUOTES,'UTF-8');
        $user_email = htmlspecialchars($_POST['user_email'],ENT_QUOTES,'UTF-8');
        $user_phone = htmlspecialchars($_POST['user_phone'],ENT_QUOTES,'UTF-8');
        $user_password =htmlspecialchars( $_POST['user_password'],ENT_QUOTES,'UTF-8');
        $data = array('name' => $user_name,'email_id' => $user_email, 'phone_number' => $user_phone, 'password' => $user_password);
        return json_encode($data);
    }

$file="data.json";
if(file_exists($file)){
$handle=fopen($file,'a');
// fwrite($handle,", ".user_data());

    if(file_put_contents("$file",user_data())){
    // echo "data submitted successfully";
}
}
else{
    $handle=fopen($file,"w");
    fwrite($handle,user_data());
}
fclose($handle);
echo "data submitted succesfully ,<a href='read.php'>see your data</a>";
}
?>
<?php
// Database connection
// $conn = mysqli_connect("localhost", "root", "", "test");

// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// // Get raw user input
// $raw_comment = $_POST['user_name'];

// // Sanitize input
// $sanitized_comment = htmlspecialchars($raw_comment, ENT_QUOTES, 'UTF-8');

// // Use prepared statements to insert sanitized input
// $sql = "INSERT INTO user (name) VALUES (?)";
// $stmt = mysqli_prepare($conn, $sql);
// mysqli_stmt_bind_param($stmt, "s", $sanitized_comment);

// if (mysqli_stmt_execute($stmt)) {
//     echo "Comment saved successfully!";
// } else {
//     echo "Error: " . mysqli_stmt_error($stmt);
// }

// // Close resources
// mysqli_stmt_close($stmt);
// mysqli_close($conn);
?>

