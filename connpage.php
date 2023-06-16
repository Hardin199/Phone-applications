<?php
require "db_connect.php"
?>

<!DOCTYPE html>
<html lang="en">

<title>My users</title>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="container">
        <a href="new.php" class="text-light btn btn-primary my-2"> create account</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">operation</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php

                $sql = "select * from `mytable`";
                $result = mysqli_query($connect, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $fullname = $row['fullname'] . ' ' . $row['username'];
                        $password = $row['password'];
                        $Operation = $row['operation'];
                        echo '<tr>
        <th scope="row">' . $id . '</th>
        <td>' . $fullname . '</td>
        <td>' . $password . '</td>
        <td>' . $Operation . '</td>
        <td>
<button class="btn btn-primary"><a href="update1.php? updateid=' . $id . '" class="text-light"> update1</a></button>
<button class="btn btn-danger"><a href="delete1.php? deleteid=' . $id . '" class="text-light"> delete1</a></button>
</td>

           </tr>';
                    }
                }

                ?>
                </tr>
            </tbody>
        </table>
    </div>
</head>

<body>

</body>

</html>