<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | VetConnect</title>
    <link rel="shortcut icon"
        href="https://cdn.vectorstock.com/i/500p/88/11/horse-dog-cat-animal-logo-template-vector-34498811.jpg"
        type="image/x-icon">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        /* Body & Background */
        body {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVcbNG21L0Q6qTFKzHubaBbYElybEm757Ua8ggOWnW8gbY0CRfyy_sLOUj67W3wOJhrRA&usqp=CAU');
            font-size: 16px;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Login Form Section */
        .login-section {
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #ff8c00;
            box-shadow: 0 0 5px rgba(255, 140, 0, 0.5);
        }

        /* Button */
        .login-btn {
            width: 100%;
            padding: 15px;
            background-color: #ff8c00;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #ffcc80;
        }

        /* Links */
        .signup-link {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        .signup-link a {
            color: #ff8c00;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: white;
            margin-top: 10px;
        }

        /* Hover Effect for Form */
        .login-section:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body>
    <section class="login-section">
        <div class="login-container">
            <h2>Masuk ke Akun Anda</h2>
            <form action="proses.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="input-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <p class="signup-link">Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 VetConnect. Semua Hak Dilindungi.</p>
    </footer>

</body>

</html>