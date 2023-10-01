<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Filter And Search</title>
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css" />
    <!-- Custom CSS -->
    <style>
      /* Top right corner buttons */
      .top-right-buttons {
        position: absolute;
        top: 10px;
        right: 10px;
      }

      .top-right-buttons button {
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
      }

      .top-right-buttons button:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <!-- Top right corner buttons for Login/register and Logout -->
    <div class="top-right-buttons" id="auth-buttons">
      <button id="login-btn" onclick="location.href='login.php'">Login</button>
      <button id="register-btn" onclick="location.href='register.php'">
        Sign Up
      </button>
      <button id="logout-btn" style="display: none">Logout</button>
    </div>

    <div class="wrapper">
      <div id="search-container">
        <input
          type="search"
          id="search-input"
          placeholder="Search product name here.."
        />
        <button id="search">Search</button>
      </div>
      <div id="buttons">
        <button class="button-value" onclick="filterProduct('all')">All</button>
        <button class="button-value" onclick="filterProduct('Topwear')">
          Topwear
        </button>
        <button class="button-value" onclick="filterProduct('Bottomwear')">
          Bottomwear
        </button>
        <button class="button-value" onclick="filterProduct('Jacket')">
          Jacket
        </button>
        <button class="button-value" onclick="filterProduct('Watch')">
          Watch
        </button>
      </div>
      <div id="products"></div>
    </div>
    <!-- Script -->
    <script src="script.js"></script>
    <script>
      // Sample user authentication state (change this with your real authentication logic)
      const isAuthenticated = false;

      // Function to toggle the visibility of authentication buttons based on the user's state
      function toggleAuthButtons() {
        const loginBtn = document.getElementById("login-btn");
        const registerBtn = document.getElementById("register-btn");
        const logoutBtn = document.getElementById("logout-btn");

        if (isAuthenticated) {
          loginBtn.style.display = "none";
          registerBtn.style.display = "none";
          logoutBtn.style.display = "block";
        } else {
          loginBtn.style.display = "block";
          registerBtn.style.display = "block";
          logoutBtn.style.display = "none";
        }
      }

      // Call the function to set the initial visibility of buttons
      toggleAuthButtons();
    </script>
  </body>
</html>
