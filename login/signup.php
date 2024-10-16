<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" href="../styles/signup.css">
    <link rel="stylesheet" type="text/css" href="../styles/privacy.css">
    <style>
        /* Add styles for the error messages */
        .error-message {
            color: red;
            font-size: 0.7em;
            margin-top: 5px;
            display: none; /* Initially hidden */
            
            

        }
        #firstNameError{
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CREATE AN ACCOUNT</h1>
        <form action="../php/Signup.php" method="POST">
            <div class="input-field">
                <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                <span id="firstNameError" class="error-message"><br>First name should contain only letters.</span>
            </div>
            <div class="input-field">
                <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                <span id="lastNameError" class="error-message"><br>Last name should contain only letters.</span>
            </div>
            <div class="input-field">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="input-field">
                <input type="text" name="address" placeholder="Location" required>
            </div>

            <!-- Adjusted password fields to stay inline -->
            <div class="input-field-inline">
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>

            <div class="input-field phone-container">
                <input type="text" class="country-code" value="+63" readonly>
                <input type="tel" name="phone_number" placeholder="656 4548 313" class="phone-number" required>
            </div>

            <div class="policy-link">
                <input type="checkbox" name="agree_policy" id="agree_policy" required>
                <label for="agree_policy">I agree to the <a href="#" id="policyLink">Privacy Policy</a></label>
            </div>

            <!-- Modal Popup Structure -->
            <div id="policyModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="policyContent"></div> <!-- This will hold the PHP/HTML content -->
                </div>
            </div>

            <button class="submit-button" type="submit">Signup</button>

            <div class="login-link">
                Already have an account? <a href="login.php">Log in here</a>
            </div>
        </form>
    </div>

    <script>
        // Capitalize first letter of first and last names
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
        }

        // Validate name field in real time
        function validateNameInput(event) {
            const input = event.target;
            const value = input.value.trim();
            const namePattern = /^[A-Za-z]+$/;
            const errorElement = input.nextElementSibling;

            if (!namePattern.test(value)) {
                errorElement.style.display = 'inline';  // Show error
            } else {
                errorElement.style.display = 'none';  // Hide error
                input.value = capitalizeFirstLetter(value);  // Capitalize first letter
            }
        }

        // Attach real-time validation to first and last name fields
        document.getElementById('first_name').addEventListener('input', validateNameInput);
        document.getElementById('last_name').addEventListener('input', validateNameInput);

        // Modal functionality remains the same
        var modal = document.getElementById("policyModal");
        var policyLink = document.getElementById("policyLink");
        var span = document.getElementsByClassName("close")[0];

        policyLink.onclick = function(event) {
            event.preventDefault();
            
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "../website/privacy.html", true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById("policyContent").innerHTML = xhr.responseText;
                    modal.style.display = "flex";
                }
            };
            xhr.send();
        };

        span.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>
    
</body>
</html>
