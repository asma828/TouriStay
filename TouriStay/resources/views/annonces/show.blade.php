<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - {{ $annonce->titre }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="{{ route('proprietaire.dashboard') }}" class="text-2xl font-bold text-blue-600">TouriStay<span class="text-green-500">2030</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    <i class="far fa-bell text-xl"></i>
                    <i class="far fa-user-circle text-xl"></i>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('touriste.dashboard') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i> Retour au tableau de bord
            </a>
        </div>

        <!-- Listing Details -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <!-- Image Gallery -->
            <div class="h-96 bg-gray-300 relative">
                <img src="{{ asset('storage/' . $annonce->images) }}" alt="{{ $annonce->titre }}" class="w-full h-full object-cover">
                <div class="absolute bottom-0 right-0 p-4 flex space-x-2">
                    
                </div>
            </div>
            
            <!-- Listing Info -->
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $annonce->titre }}</h1>
                        <p class="text-gray-600 text-lg mb-2">{{ $annonce->ville }}, Maroc</p>
                        <div class="flex items-center text-yellow-500 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-gray-600 ml-2">4.8 (12 avis)</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-bold text-blue-600">{{ $annonce->prix }} €<span class="text-gray-600 text-lg font-normal">/nuit</span></p>
                        <p class="text-gray-600">Disponible: {{ $annonce->disponible_du->format('d/m/Y') }} - {{ $annonce->disponible_au->format('d/m/Y') }}</p>
                    </div>
                </div>
                
                <hr class="my-6">
                
                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Description</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $annonce->description }}</p>
                </div>
                
                <!-- Equipments -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Équipements</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                            $equipements = json_decode($annonce->equipements, true) ?? [];
                        @endphp
                        
                        @foreach($equipements as $equipement)
                            <div class="flex items-center">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                <span class="text-gray-700">{{ $equipement }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Reservation Button -->
            <button onclick="openModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-medium transition duration-300 mb-6">
                  Réserver
            </button>
                <!-- Stats -->
                <div class="bg-gray-100 p-6 rounded-lg mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Statistiques de l'annonce</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <p class="text-3xl font-bold text-blue-600">24</p>
                            <p class="text-gray-600">Vues totales</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-green-600">4</p>
                            <p class="text-gray-600">Réservations</p>
                        </div>
                        <div class="text-center">
                            <p class="text-3xl font-bold text-purple-600">8</p>
                            <p class="text-gray-600">Favoris</p>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

     <!-- Reservation Modal -->
     <div id="reservationModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Réserver cet hébergement</h2>
    
            <!-- Reservation Form -->
            <form id="reservationForm" action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
                
                <div class="mb-4">
                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                    <input type="text" 
                           id="date_debut" 
                           name="date_debut" 
                           placeholder="Sélectionnez la date d'arrivée"
                           class="border p-2 w-full rounded-md"
                           required>
                    <div id="date_debut_error" class="text-red-500 text-sm mt-1"></div>
                </div>
    
                <div class="mb-4">
                    <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de départ</label>
                    <input type="text" 
                           id="date_fin" 
                           name="date_fin" 
                           placeholder="Sélectionnez la date de départ"
                           class="border p-2 w-full rounded-md"
                           required>
                    <div id="date_fin_error" class="text-red-500 text-sm mt-1"></div>
                </div>
    
                <div id="reservation_global_error" class="text-red-500 text-sm mb-4"></div>
    
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium w-full">
                    Confirmer la réservation
                </button>
            </form>
    
            <button onclick="closeModal()" class="mt-4 text-gray-500 hover:text-gray-700">Annuler</button>
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

    <script>
        function openModal() {
            document.getElementById('reservationModal').classList.remove('hidden');
        }
    
        function closeModal() {
            document.getElementById('reservationModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
    const dateDebutInput = document.querySelector('input[name="date_debut"]');
    const dateFinInput = document.querySelector('input[name="date_fin"]');

    dateDebutInput.addEventListener('change', function() {
        dateFinInput.min = dateDebutInput.value;
    });
});
    </script>
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the available date range from the Blade template
        const availableFrom = "{{ $annonce->disponible_du->format('Y-m-d') }}";
        const availableTo = "{{ $annonce->disponible_au->format('Y-m-d') }}";
    
        // Clear previous error messages
        function clearErrors() {
            document.getElementById('date_debut_error').textContent = '';
            document.getElementById('date_fin_error').textContent = '';
            document.getElementById('reservation_global_error').textContent = '';
        }
    
        // Initialize Flatpickr for date selection
        const dateDebutPicker = flatpickr("#date_debut", {
            minDate: availableFrom,
            maxDate: availableTo,
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                dateFinPicker.set('minDate', dateStr);
                document.getElementById('date_debut_error').textContent = '';
            }
        });
    
        const dateFinPicker = flatpickr("#date_fin", {
            minDate: availableFrom,
            maxDate: availableTo,
            dateFormat: "Y-m-d",
            onChange: function() {
                document.getElementById('date_fin_error').textContent = '';
            }
        });
    
        // Form submission handler
        document.getElementById('reservationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            clearErrors();
    
            const startDate = document.getElementById('date_debut').value;
            const endDate = document.getElementById('date_fin').value;
    
            // Basic validation
            if (!startDate) {
                document.getElementById('date_debut_error').textContent = 'Veuillez sélectionner une date d\'arrivée';
                return;
            }
    
            if (!endDate) {
                document.getElementById('date_fin_error').textContent = 'Veuillez sélectionner une date de départ';
                return;
            }
    
            // Check availability via AJAX
            fetch("{{ route('check.availability') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    annonce_id: "{{ $annonce->id }}",
                    date_debut: startDate,
                    date_fin: endDate
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    // If available, submit the form
                    this.submit();
                } else {
                    // Handle unavailability
                    const globalErrorElement = document.getElementById('reservation_global_error');
                    
                    if (data.overlapping && data.overlapping.length > 0) {
                        let errorMessage = 'Ces dates ne sont pas disponibles. ';
                        data.overlapping.forEach(reservation => {
                            errorMessage += `Déjà réservé du ${reservation.date_debut} au ${reservation.date_fin}. `;
                        });
                        globalErrorElement.textContent = errorMessage;
                    } else {
                        globalErrorElement.textContent = 'Ces dates ne sont pas disponibles. Veuillez choisir d\'autres dates.';
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                document.getElementById('reservation_global_error').textContent = 'Une erreur est survenue. Veuillez réessayer.';
            });
        });
    });
        </script>

    
</body>
</html>