<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Réinitialisation du mot de passe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="" class="text-2xl font-bold text-blue-600">TouriStay<span class="text-green-500">2030</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">
                        S'inscrire
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-12">
        <!-- Password Reset Form Card -->
        <div class="max-w-md mx-auto">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-500 to-green-400 rounded-t-xl shadow-lg p-6">
                <h1 class="text-2xl font-bold text-white text-center">Mot de passe oublié</h1>
                <p class="text-white text-center mt-2">Récupérez l'accès à votre compte</p>
            </div>

            <!-- Card Body -->
            <div class="bg-white rounded-b-xl shadow-lg p-8">
                <div class="mb-6 text-gray-600 bg-blue-50 p-4 rounded-lg border-l-4 border-blue-500">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation qui vous permettra de choisir un nouveau mot de passe.
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                class="w-full border border-gray-300 rounded-md pl-10 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-bold shadow-md transition duration-300 flex items-center justify-center">
                        <i class="fas fa-paper-plane mr-2"></i> Envoyer le lien de réinitialisation
                    </button>

                    <!-- Back to Login Link -->
                    <div class="mt-6 text-center">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i> Retour à la page de connexion
                        </a>
                    </div>
                </form>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md p-6 mt-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Accès rapides</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 flex items-center transition duration-300">
                        <div class="rounded-full bg-blue-100 p-3 mr-3">
                            <i class="fas fa-home text-blue-600"></i>
                        </div>
                        <span class="text-gray-700">Accueil</span>
                    </a>
                    <a href="#" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 flex items-center transition duration-300">
                        <div class="rounded-full bg-green-100 p-3 mr-3">
                            <i class="fas fa-info-circle text-green-600"></i>
                        </div>
                        <span class="text-gray-700">À propos</span>
                    </a>
                    <a href="#" class="bg-gray-50 hover:bg-gray-100 rounded-lg p-4 flex items-center transition duration-300">
                        <div class="rounded-full bg-purple-100 p-3 mr-3">
                            <i class="fas fa-question-circle text-purple-600"></i>
                        </div>
                        <span class="text-gray-700">Aide</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">TouriStay 2030</h3>
                    <p class="text-gray-400">La plateforme idéale pour proposer votre hébergement durant le Mondial 2030.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens utiles</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Comment ça marche</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Nous contacter</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-blue-400"></i>
                            <span class="text-gray-400">contact@touristay2030.com</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-blue-400"></i>
                            <span class="text-gray-400">+212 5XX XXX XXX</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2025 TouriStay 2030. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>