<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Akun | VetConnect</title>
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

        /* Register Form Section */
        .register-section {
            margin-top: 20px;
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .register-container h2 {
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            color: #333;
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
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        .input-group input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        /* Button */
        .register-btn {
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

        .register-btn:hover {
            background-color: #ffcc80;
        }

        /* Links */
        .login-link {
            text-align: center;
            font-size: 14px;
            margin-top: 15px;
        }

        .login-link a {
            color: #ff8c00;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Hover Effect for Form */
        .register-section:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body>
    <section class="register-section">
        <div class="register-container">
            <h2>Daftar untuk Akun Baru</h2>
            <form action="proses.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="input-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                </div>
                <button type="submit" class="register-btn">Daftar</button>
                <p class="login-link">Sudah punya akun? <a href="login.php">Masuk Sekarang</a></p>
            </form>
        </div>
    </section>
</body>

</html>