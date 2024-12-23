<?php 
$data=file_get_contents("data.json");
$Data=json_decode($data,true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border:1px solid;

        }
        td,th{
            padding:15px;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <table>
        <tr>
        <th>name</th>
        <th>email_id</th>
        <th>Phone</th>
        <th>password</th>
        </tr>
        
        <tr>
            <td><?php echo $Data['name']; ?></td>
            <td><?php echo $Data['email_id']; ?></td>
            <td><?php echo $Data['phone_number']; ?></td>
            <td><?php echo $Data['password']; ?></td>
        </tr>

    </table>
    <!--<a href="file-handling1.php">delete my data file</a>-->
</body>
</html>