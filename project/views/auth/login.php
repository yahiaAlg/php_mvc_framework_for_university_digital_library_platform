   <style>
       * {
           margin: 0;
           padding: 0;
           box-sizing: border-box;
           font-family: "Rubik", "sans-serif";
       }

       body {
           background-color: #414040;
           color: #fafafa;
           min-height: 100vh;
           display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           padding: 20px;
       }

       .login-container {
           margin-top: 10%;
           width: 100%;
           width: 50vw;
           background-color: #eee;
           padding: 40px;
           border-radius: 8px;
           box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
       }

       .login-title {
           font-family: "Rubik", "sans-serif";
           font-size: 30px;
           font-weight: 700;
           color: #666;
           margin-bottom: 40px;
           text-align: center;
           letter-spacing: 0.5px;
       }

       .form-group {
           margin-bottom: 20px;
       }

       .form-input {
           width: 100%;
           padding: 12px;
           border: 1px solid #ddd;
           border-radius: 4px;
           font-size: 16px;
       }

       .form-input:focus {
           outline: none;
           border-color: #b52626;
       }

       .forgot-password {
           display: block;
           text-align: center;
           margin-bottom: 20px;
           color: #555;
           text-decoration: none;
           font-size: 14px;
       }

       .forgot-password:hover {
           color: #b52626;
       }

       .login-button {
           background-color: #555;
           color: #ddd;
           border: none;
           padding: 15px 30px;
           margin: 15px auto;
           font-size: 18px;
           font-weight: 400;
           border-radius: 25px;
           cursor: pointer;
           transition: background-color 0.3s ease;
           display: block;
           width: 200px;
       }

       .login-button:hover {
           background-color: #333;
       }

       .signup-link {
           text-align: center;
           font-size: 14px;
           color: #666;
       }

       .signup-link a {
           color: #666;
           text-decoration: none;
       }

       .signup-link a:hover {
           text-decoration: underline;
           color: #b52626;
       }

       .footer,
       .footer-bottom {
           background-color: transparent;
           width: 100%;
       }

       @media (max-width: 768px) {
           .login-container {
               max-width: 350px;
               padding: 30px;
           }
       }
   </style>

   <div class="login-container">
       <h2 class="login-title">Log In</h2>
       <form method="POST">
           <div class="form-group">
               <input type="email" name="email" class="form-input" placeholder="Email" required>
           </div>
           <div class="form-group">
               <input type="password" name="password" class="form-input" placeholder="Password" required>
           </div>
           <a href="#" class="forgot-password">Forgotten your password?</a>
           <button type="submit" class="login-button">LOG IN</button>
           <div class="signup-link">
               Don't have an account? <a href="/register">Apply now</a>
           </div>
       </form>
   </div>