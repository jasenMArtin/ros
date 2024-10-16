<?php 
include('../php/faqs.php');
include('../partials/getUserData.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/contactMap.css"> 
       <script>
        function validateForm(event) {
            // Check if the user is logged in
            var isLoggedIn = <?php echo json_encode($user_id !== null); ?>; // Returns true or false
            
            if (!isLoggedIn) {
                // If not logged in, alert the user and prevent form submission
                alert("You need to log in or sign up first before submitting this form.");
                event.preventDefault(); // Prevents form from submitting
            }
        }
    </script>
</head>

<body>

<div class="container">
    <div class="contact-info">
        <h2>संपर्क जानकारी (Contact Information)</h2>
        <p><strong>पता:</strong> 1234 Main St, City, Country</p>
        <p><strong>फोन:</strong> +123 456 7890</p>
        <p><strong>ईमेल:</strong> example@example.com</p>
        <div class="social-icons">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-square"></i> </a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i> </a>
        </div>
    </div>

    <!-- Contact form -->
    <form method="POST" onsubmit="validateForm(event)">
        <div class="input-field">
            <label>आपका नाम (Your Name):</label>
            <input type="text" name="name" placeholder="आपका नाम (Your Name)" 
                value="<?php echo $user_id ? htmlspecialchars($name) : ''; ?>" readonly required <?php echo $user_id ? : ''; ?>>
        </div>
        
        <div class="input-field">
            <label>आपका फोन नंबर (Your Phone Number):</label>
            <input type="tel" name="phone" placeholder="आपका फोन नंबर (Your Phone Number)" 
            value="<?php echo $user_id ? htmlspecialchars($phone_number) : ''; ?>"readonly required>
        </div>

        <div class="input-field">
            <label>Message:</label>
            <textarea name="message" placeholder="Your message..." required></textarea>
        </div>
        
        <button type="submit" class="submit-button">Contact Us</button>
    </form>

</div>

<div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.251135136951!2d-122.084!3d37.421998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb7b2b1f923d7%3A0x3c0dfb70aa0f10d6!2sGoogleplex!5e0!3m2!1sen!2sus!4v1635788689101!5m2!1sen!2sus"
        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>


<?php if (isset($_SESSION['message'])): ?>
    <script>
        alert("<?php echo $_SESSION['message']; ?>");
        <?php unset($_SESSION['message']); // Clear the message after displaying ?>
        exit()
    </script>
<?php endif; ?>

</body>
</html>