<?php

if (isset($_POST['but_submit'])) {

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'pickmypack';
    $mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);

    $uname = mysqli_real_escape_string($mysqli, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($mysqli, $_POST['txt_pwd']);

    if ($uname != "" && $password != "") {

        $query = "SELECT  `email`, `password` FROM `users` ";
        $result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);

        while ($row = mysqli_fetch_array($result)) {

            $unames = $row['email'];
            $passwords = $row['password'];
        }


        if ($uname == $unames && $password == $passwords) {
            $_SESSION['uname'] = $uname;
            header('Location: home.php');
        } else {
            echo "Invalid username and password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
</head>

<body>
    <header class="text-gray-700 body-font">
        <a class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">
            <img width="150px" height="150px" src="logo.png" alt="">
            <span class="ml-3 text-xl" style="margin-left: -10px; font-family: 'Yellowtail', cursive;">PickMyPack</span>
        </a>
        </div>
    </header>

    <section class="text-gray-700 body-font">
        <div class="container px-5 py-24 mx-auto flex flex-wrap items-center">
            <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
                <img src="https://t3.ftcdn.net/jpg/01/59/06/22/240_F_159062233_uaViyrTlRoAm3XfOSnJ7o44REQBFIoX3.jpg" alt="">
            </div>
            <div class="lg:w-2/6 md:w-1/2 bg-gray-200 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0">
                <form method="post" action="">
                    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Login</h2>
                    <div class="relative mb-4">
                        <label for="full-name" class="leading-7 text-sm text-gray-600">Username</label>
                        <input type="text" name="txt_uname" id="txt_uname" type="text" class="textbox" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-600">Password</label>
                        <input type="password" name="txt_pwd" id="txt_pwd" type="password" class="textbox" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" id="but_submit" type="submit" value="Submit" name="but_submit">Submit</button>
                </form>
            </div>

        </div>
    </section>

</body>

</html>