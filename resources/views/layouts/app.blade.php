<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tole Kos - Temukan Rumah Sewa Impian Anda</title>
    <meta name="description" content="Layanan penyewaan rumah terbaik dengan berbagai pilihan properti berkualitas.">
    
    <!-- Fonts -->
    <link rel="icon" type="image/png" href="{{ asset('images/t.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        blue: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                    },
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .thumbnail-item.active img {
            border: 3px solid #3b82f6;
        }
        
        @media (min-width: 768px) {
            .aspect-w-16 {
                position: relative;
                padding-bottom: calc(9 / 16 * 100%);
            }
            .aspect-h-9 {
                position: absolute;
                height: 100%;
                width: 100%;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-0 text-2xl font-bold text-blue-600">
                <img src="{{ asset('images/t.png') }}" alt="Logo" class=" h-11 w-11">
                <span></span>
            </a>

                
                <div class="hidden md:flex flex-1 justify-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-blue-600 transition">Beranda</a>
                    <a href="#properties" class="text-gray-800 hover:text-blue-600 transition">Properti</a>
                    <a href="#features" class="text-gray-800 hover:text-blue-600 transition">Fitur</a>
                </div>
                
                
                
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-500 hover:text-gray-800">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden mt-4 pb-4">
                <a href="{{ route('home') }}" class="block py-2 text-gray-800 hover:text-blue-600">Beranda</a>
                <a href="#properties" class="block py-2 text-gray-800 hover:text-blue-600">Properti</a>
                <a href="#features" class="block py-2 text-gray-800 hover:text-blue-600">Fitur</a>
                <a href="#contact" class="block py-2 mt-2 bg-blue-600 text-white text-center font-semibold rounded">Hubungi Kami</a>
            </div>
        </nav>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Tole Kos</h3>
                    <p class="mb-4 text-gray-400">Kami menyediakan layanan penyewaan rumah terbaik dengan harga terjangkau dan fasilitas lengkap.</p>
                    <div class="flex space-x-4">
                    <a href="https://wa.me/6287824795784" 
                        class="text-white hover:text-blue-400" 
                        target="_blank" 
                        rel="noopener noreferrer">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                        <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#properties" class="text-gray-400 hover:text-white transition">Properti</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>Tempen Baturono RT 04, RW 02</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-blue-400"></i>
                            <span>+62 878 2479 5784</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-blue-400"></i>
                            <span>tolekosbusiness@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Tole Kos. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
        
        // Hide mobile menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                
                if (targetId !== '#') {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>