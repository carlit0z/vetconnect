<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetConnect - Aplikasi Konsultasi Online dengan Dokter Hewan</title>
    <link rel="shortcut icon"
        href="https://cdn.vectorstock.com/i/500p/88/11/horse-dog-cat-animal-logo-template-vector-34498811.jpg"
        type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* Hero Section */
        .hero {
            background-image: url('https://cdn.royalcanin-weshare-online.io/m7kRAm0B2t6cTeuUuQmG/v2/ec-pill-assist-hub-how-to-give-your-cat-a-pill-hero');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero-content {
            max-width: 600px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .cta-btn {
            padding: 15px 30px;
            background-color: #ff8c00;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-btn:hover {
            background-color: #e87c00;
        }

        /* Features Section */
        .features {
            padding: 50px 0;
            background-color: #f7f7f7;
            text-align: center;
        }

        .features h2 {
            font-size: 32px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .features-grid {
            display: flex;
            justify-content: space-around;
            gap: 40px;
        }

        .feature-item {
            width: 30%;
            text-align: center;
        }

        .feature-item img {
            width: 70px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .feature-item h3 {
            font-size: 24px;
            margin-top: 20px;
            font-weight: 600;
        }

        .feature-item p {
            margin-top: 10px;
            font-size: 16px;
            color: #666;
        }

        /* Testimonials Section */
        .testimonials {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVcbNG21L0Q6qTFKzHubaBbYElybEm757Ua8ggOWnW8gbY0CRfyy_sLOUj67W3wOJhrRA&usqp=CAU');
            padding: 50px 0;
            background-color: #fff;
            text-align: center;
        }

        .testimonials h2 {
            font-size: 32px;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .testimonial-item {
            margin-bottom: 40px;
        }

        .testimonial-item p {
            font-size: 18px;
            margin-bottom: 10px;
            font-style: italic;
        }

        .testimonial-item h4 {
            font-size: 20px;
            font-weight: 600;
            color: #ff8c00;
        }

        /* CTA Section */
        .cta {
            padding: 100px 20px;
            background: linear-gradient(135deg, #ff8c00, #ffcc80);
            text-align: center;
            color: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .cta h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: 700;
            line-height: 1.4;
            color: #ffffff;
        }

        .cta-btn {
            padding: 18px 35px;
            background-color: white;
            color: #ff8c00;
            font-size: 20px;
            font-weight: 600;
            border-radius: 50px;
            /* Membuat tombol lebih bulat */
            text-decoration: none;
            text-transform: uppercase;
            /* Membuat teks tombol lebih menarik */
            letter-spacing: 1.5px;
            /* Spasi antar huruf sedikit lebih besar */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* Tambahkan bayangan pada tombol */
            transition: all 0.3s ease-in-out;
            /* Efek transisi lebih halus */
        }

        .cta-btn:hover {
            background-color: #ffcc80;
            color: white;
            transform: translateY(-5px);
            /* Efek hover tombol terangkat */
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
            /* Bayangan lebih besar saat hover */
        }


        /* Footer Section */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }

        footer p {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>VetConnect</h1>
            <p>Aplikasi Konsultasi Online dengan Dokter Hewan</p>
            <a href="#features" class="cta-btn">Mulai Konsultasi</a>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="features" class="features">
        <h2>Fitur Utama</h2>
        <div class="features-grid">
            <div class="feature-item">
                <img src="https://png.pngtree.com/png-vector/20190116/ourlarge/pngtree-vector-list-icon-png-image_322087.jpg"
                    alt="Fitur 1">
                <h3>Daftar Hewan Anda</h3>
                <p>Daftarkan hewan peliharaan Anda untuk memulai konsultasi dengan dokter hewan.</p>
            </div>
            <div class="feature-item">
                <img src="https://png.pngtree.com/png-vector/20190116/ourlarge/pngtree-vector-list-icon-png-image_322087.jpg"
                    alt="Fitur 2">
                <h3>Jadwal Konsultasi</h3>
                <p>Pilih jadwal yang sesuai untuk berkonsultasi dengan dokter hewan.</p>
            </div>
            <div class="feature-item">
                <img src="https://png.pngtree.com/png-vector/20190116/ourlarge/pngtree-vector-list-icon-png-image_322087.jpg"
                    alt="Fitur 3">
                <h3>Chat dengan Dokter</h3>
                <p>Lakukan konsultasi langsung dengan dokter hewan melalui chat video atau teks.</p>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonials">
        <h2>Apa Kata Pengguna</h2>
        <div class="testimonial-item">
            <p>"VetConnect membantu saya dengan cepat dalam mendapatkan bantuan medis untuk anjing saya. Layanan yang
                sangat berguna!"</p>
            <h4>- Ani, Pemilik Anjing</h4>
        </div>
        <div class="testimonial-item">
            <p>"VetConnect mempermudah saya berkonsultasi dengan dokter hewan tanpa harus keluar rumah. Layanan luar
                biasa!"</p>
            <h4>- Susan, Pemilik Kura-Kura</h4>
        </div>
        <div class="testimonial-item">
            <p>"Saya sangat puas dengan pelayanan dokter hewan di VetConnect. Mudah dan nyaman!"</p>
            <h4>- Budi, Pemilik Kucing</h4>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <h2>Siap untuk Mencoba VetConnect?</h2>
        <a href="login.php" class="cta-btn">Masuk Sekarang</a>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 VetConnect. Semua Hak Cipta Dilindungi.</p>
    </footer>
</body>

</html>