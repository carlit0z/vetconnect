<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetConnect | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon"
        href="https://cdn.vectorstock.com/i/500p/88/11/horse-dog-cat-animal-logo-template-vector-34498811.jpg"
        type="image/x-icon">
    <style>
        /* Global styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f9;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #34495e;
            color: #fff;
            padding-top: 50px;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #1abc9c;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        /* Toggle button styling */
        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #1abc9c;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1000;
            border-radius: 5px;
        }

        .toggle-btn i {
            font-size: 20px;
        }

        /* Content styling */
        .content {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVcbNG21L0Q6qTFKzHubaBbYElybEm757Ua8ggOWnW8gbY0CRfyy_sLOUj67W3wOJhrRA&usqp=CAU');
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            transition: margin-left 0.3s ease-in-out;
        }

        .content.full {
            margin-left: 0;
        }

        .header {
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .header h2 {
            font-size: 28px;
            color: #2c3e50;
        }

        .header p {
            font-size: 16px;
            color: #7f8c8d;
        }

        /* Cards styling */
        .cards {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            width: 300px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .card p {
            font-size: 14px;
            color: #7f8c8d;
            margin-bottom: 20px;
        }

        .card .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #27ae60;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .card .btn:hover {
            background-color: #2ecc71;
        }

        footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: black;
            margin-top: 10px;
        }

        /* Responsiveness */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 0;
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            .content.full {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <button id="toggle-btn" class="toggle-btn">
        <i class="fas fa-bars"></i>
    </button>
    <div class="sidebar">
        <ul class="menu">
            <li><a href="#dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="#pet-list"><i class="fas fa-paw"></i> Daftar Hewan</a></li>
            <li><a href="#consultation"><i class="fas fa-briefcase-medical"></i> Konsultasi</a></li>
            <li><a href="#chat"><i class="fas fa-comments"></i> Chat</a></li>
            <li><a href="#profile"><i class="fas fa-user"></i> Profil</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>
    </div>
    <main class="content">
        <header class="header">
            <h2>Selamat Datang, Pengguna!</h2>
            <p>Kelola kebutuhan hewan peliharaan Anda dengan mudah.</p>
        </header>
        <section class="cards">
            <div class="card">
                <h3>Daftar Hewan</h3>
                <p>Daftarkan dan Kelola informasi tentang hewan peliharaan Anda.</p>
                <a href="#pet-list" class="btn">Daftar Sekarang</a>
            </div>
            <div class="card">
                <h3>Konsultasi</h3>
                <p>Ajukan konsultasi kepada dokter hewan profesional.</p>
                <a href="#consultation" class="btn">Buat Konsultasi</a>
            </div>
            <div class="card">
                <h3>Chat</h3>
                <p>Bicarakan langsung dengan dokter hewan.</p>
                <a href="#chat" class="btn">Chat Sekarang</a>
            </div>
        </section>

        <footer>
            <p>&copy; 2024 VetConnect. Semua hak dilindungi.</p>
        </footer>
    </main>


    <script>
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            content.classList.toggle('full');
        });
    </script>
</body>

</html>