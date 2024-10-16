<?php
include '../partials/menu.php';
include '../php/config.php'; 
include('../partials/getUserData.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/userProfile.css"> <!-- Link to your CSS file -->
    <title>User Profile</title>
    <style>
        /* userProfile.css */
        body {
            background-color: #f9f9f9; /* Light background for contrast */
        }

        .profile-container {
            width: 90%;
            max-width: 800px;
            margin: 80px auto; /* Center and space out the profile card */
            padding: 20px;
            background-color: #ffffff; /* White background for the profile card */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px; /* Space below header */
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px; /* Size of the profile image */
            height: 100px;
            object-fit: cover; /* Cover to keep aspect ratio */
            margin-right: 100px; /* Space between image and text */
        }

        .profile-details {
            text-align: left; /* Align text to the left */
            width: 100%; /* Full width for details */
        }

        .profile-details p {
            margin: 8px 0; /* Spacing between details */
            font-size: 16px; /* Font size for details */
        }

        .profile-details strong {
            color: #333; /* Dark color for strong text */
        }

        .edit-button {
            background-color: #ffcc00; /* Edit button color */
            color: #fff;
            padding: 10px 20px; /* Padding for button */
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Pointer cursor for button */
            font-weight: bold; /* Bold text for button */
            text-align: center; /* Centered text in button */
            margin-top: 20px; /* Margin above button */
            transition: background-color 0.3s; /* Transition for hover effect */
        }

        .edit-button:hover {
            background-color: #e6b800; /* Darker shade on hover */
        }

        h2 {
            text-align: center; /* Center the title */
            margin: 20px 0; /* Margin for title */
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>
        <div class="profile-header">
            <img src="../assets/profile.png" alt="Profile Picture"> <!-- Add the path to your user's image -->
            <div class="profile-details">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                <button class="edit-button" onclick="location.href='editProfile.php'">Edit Details</button> <!-- Link to edit profile -->

            </div>
        </div>
    </div>
</body>
</html>
