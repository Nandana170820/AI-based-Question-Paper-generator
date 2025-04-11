<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      /* General Styling */
      * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: "Poppins", sans-serif;
      }

      body {
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          background: url('sign.jpg') no-repeat center center fixed;
          background-size: cover;
          padding: 20px;
      }

      .container {
          background: rgba(255, 255, 255, 0.5);
          width: 400px;
          padding: 2rem;
          border-radius: 15px;
          box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
          backdrop-filter: blur(10px);
          text-align: center;
          transition: transform 0.3s ease;
      }

      .container:hover {
          transform: translateY(-5px);
      }

      .form-title {
          font-family: "Lucida Handwriting", cursive;
          font-size: 2.5rem;
          color: #191970;
          margin-bottom: 0.5rem;
          text-align: center;
      }

      .subheading {
          font-family: "Brush Script MT", cursive;
          font-size: 1.5rem;
          color:rgb(35, 28, 173);
          margin-bottom: 1.5rem;
          text-align: center;
      }

      .input-group {
          position: relative;
          margin: 1rem 0;
      }

      .input-group i {
          position: absolute;
          left: 10px;
          top: 50%;
          transform: translateY(-50%);
          color: #555;
      }

      input {
          width: 100%;
          padding: 12px 12px 12px 40px;
          border: 1px solid #ccc;
          border-radius: 5px;
          font-size: 1rem;
          outline: none;
          transition: 0.3s;
      }

      input:focus {
          border-color: #6c63ff;
          box-shadow: 0 0 5px rgba(108, 99, 255, 0.6);
      }

      .btn {
          width: 100%;
          padding: 10px 0;
          font-size: 1.1rem;
          background-color: #6c63ff;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          transition: background 0.3s;
      }

      .btn:hover {
          background-color: #574bff;
      }

      .or {
          margin: 20px 0;
          font-size: 1rem;
          color: #777;
      }

      .links {
          margin-top: 1rem;
          font-size: 0.9rem;
          color: #555;
      }

      .links button {
          background: none;
          border: none;
          color: #6c63ff;
          font-weight: bold;
          cursor: pointer;
          transition: color 0.3s;
      }

      .links button:hover {
          color: #574bff;
      }
    </style>
</head>
<body>
    <!-- Login Form -->
    <div class="container" id="signIn">
        <h1 class="form-title">SmartQGen</h1>
        <p class="subheading">Sign Up</p>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">--------or--------</p>
        <div class="links">
            <p>Don't have an account yet?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fname">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <div class="links">
            <p>Already Have an Account?</p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
