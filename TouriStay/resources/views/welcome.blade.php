<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Bienvenue</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }
        .world-map {
            background-image: url('https://images.unsplash.com/photo-1526778548025-fa2f459cd5ce?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .world-map::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(66,99,235,0.85) 0%, rgba(27,188,155,0.85) 100%);
        }
        .auth-btn {
            transition: all 0.3s ease;
        }
        .auth-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .country-flag {
            border-radius: 50%;
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <i class="fas fa-futbol text-blue-600 text-2xl mr-2"></i>
                    <a href="" class="text-2xl font-bold">
                        <span class="text-blue-600">TouriStay</span><span class="text-green-500">2030</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="auth-btn bg-white hover:bg-gray-50 text-blue-600 border border-blue-600 px-5 py-2 rounded-full font-medium transition duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="auth-btn bg-gradient-to-r from-blue-600 to-green-500 hover:from-blue-700 hover:to-green-600 text-white px-5 py-2 rounded-full font-medium transition duration-300">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="world-map min-h-screen flex items-center justify-center relative overflow-hidden">
            <div class="container mx-auto px-6 py-24 relative z-10">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Left Content -->
                    <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                            Bienvenue sur votre<br><span class="pulse inline-block">TouriStay 2030</span>
                        </h1>
                        <p class="text-xl text-white mb-8 max-w-lg">
                            La plateforme qui connecte les voyageurs aux meilleurs logements pour le Mondial 2030 au Maroc, en Espagne et au Portugal.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="" class="bg-white text-blue-600 hover:bg-blue-50 px-8 py-3 rounded-full font-semibold transition duration-300 flex items-center justify-center">
                                <i class="fas fa-search mr-2"></i> Explorer
                            </a>
                            <a href="" class="bg-transparent text-white border-2 border-white hover:bg-white hover:text-blue-600 px-8 py-3 rounded-full font-semibold transition duration-300 flex items-center justify-center">
                                <i class="fas fa-info-circle mr-2"></i> En savoir plus
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right Content - Floating Country Flags -->
                    <div class="md:w-1/2 relative h-64 md:h-auto">
                        <div class="absolute top-0 left-1/4 animate-bounce" style="animation-duration: 3s;">
                            <img src="https://flagcdn.com/w80/ma.png" alt="Morocco" class="country-flag">
                        </div>
                        <div class="absolute top-1/3 right-1/4 animate-bounce" style="animation-duration: 2.5s; animation-delay: 0.5s;">
                            <img src="https://flagcdn.com/w80/es.png" alt="Spain" class="country-flag">
                        </div>
                        <div class="absolute bottom-0 left-1/3 animate-bounce" style="animation-duration: 3.5s; animation-delay: 1s;">
                            <img src="https://flagcdn.com/w80/pt.png" alt="Portugal" class="country-flag">
                        </div>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-16">
                    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-6 text-center border border-white border-opacity-20">
                        <i class="fas fa-home text-white text-3xl mb-4"></i>
                        <h3 class="text-white text-2xl font-bold mb-2">+10,000</h3>
                        <p class="text-white opacity-80">Logements disponibles</p>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-6 text-center border border-white border-opacity-20">
                        <i class="fas fa-city text-white text-3xl mb-4"></i>
                        <h3 class="text-white text-2xl font-bold mb-2">+50</h3>
                        <p class="text-white opacity-80">Villes couvertes</p>
                    </div>
                    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-6 text-center border border-white border-opacity-20">
                        <i class="fas fa-users text-white text-3xl mb-4"></i>
                        <h3 class="text-white text-2xl font-bold mb-2">+5,000</h3>
                        <p class="text-white opacity-80">Utilisateurs satisfaits</p>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Down Arrow -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
                <a href="#features" class="text-white">
                    <i class="fas fa-chevron-down text-2xl"></i>
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <i class="fas fa-futbol text-blue-500 text-xl mr-2"></i>
                    <span class="text-xl font-bold">
                        <span class="text-blue-500">TouriStay</span><span class="text-green-400">2030</span>
                    </span>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <p class="text-gray-400 text-sm mt-4 md:mt-0">&copy; 2025 TouriStay 2030. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>