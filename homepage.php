<?php
session_start();
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Question Paper Generator</title>
    <style>
        /* Global Styles */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            background: url('upload.avif') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            max-width: 500px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9); /* Semi-transparent container */
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(211, 194, 194, 0.05);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-family: 'Apple Chancery', cursive;
            color: #333;
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 40px;
            color: #444;
        }

        .links a {
            display: inline-block;
            margin: 20px;
            padding: 12px 24px;
            font-size: 1.1rem;
            text-decoration: none;
            color: white;
            border: 2px solid white;
            border-radius: 30px;
            background: rgba(38, 85, 179, 0.8); /* Button background */
            transition: background 0.3s, transform 0.2s;
        }

        .links a:hover {
            background:rgb(42, 107, 168);
            transform: scale(1.1);
        }

        .logout {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 1rem;
            text-decoration: none;
            color: white;
            background:rgb(30, 9, 162);
            border-radius: 30px;
            transition: background 0.3s, transform 0.2s;
        }

        .logout:hover {
            background:rgb(70, 65, 132);
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to SmartQGen</h1>

        <!-- Navigation Links -->
        <div class="links">
            <a href="upload_syllabus.php">📚 Upload Your Files</a>
        </div>

        <!-- Logout Button -->
        <a class="logout" href="logout.php">🚪 Logout</a>
    </div>
</body>

</html>
