<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TouriStay 2030 - Paiement</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>

</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-blue-600">TouriStay<span class="text-green-500">2030</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    <i class="far fa-bell text-xl"></i>
                    <i class="far fa-user-circle text-xl"></i>
                    <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition duration-300">
                        Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 text-white p-6">
                <h1 class="text-2xl font-bold">Finalisation de la Réservation</h1>
            </div>

            <div class="p-6">
                <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 mb-6">
                    <p class="text-yellow-700">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Vous devez payer pour finaliser votre réservation
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Détails de la Réservation -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Détails de la Réservation</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Hébergement:</span>
                                <span class="font-medium">Appartement Vue Mer</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Date d'arrivée:</span>
                                <span class="font-medium">15 Juillet 2025</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Date de départ:</span>
                                <span class="font-medium">20 Juillet 2025</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nombre de nuits:</span>
                                <span class="font-medium">5 nuits</span>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif des Coûts -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Récapitulatif</h2>
                        <div class="bg-gray-100 p-4 rounded-md">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Prix par nuit:</span>
                                <span class="font-medium">100 €</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Nombre de nuits:</span>
                                <span class="font-medium">5</span>
                            </div>
                            <hr class="my-2 border-gray-300">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total:</span>
                                <span class="text-blue-600">500 €</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Méthodes de Paiement -->
                {{-- <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Méthodes de Paiement</h2>
                    <div class="grid md:grid-cols-3 gap-4">
                        <button class="bg-white border rounded-lg p-4 flex flex-col items-center hover:bg-gray-100 transition">
                            <i class="fab fa-cc-visa text-4xl text-blue-800 mb-2"></i>
                            <span>Carte de Crédit</span>
                        </button>
                        <button class="bg-white border rounded-lg p-4 flex flex-col items-center hover:bg-gray-100 transition">
                            <i class="fab fa-paypal text-4xl text-blue-500 mb-2"></i>
                            <span>PayPal</span>
                        </button>
                        <button class="bg-white border rounded-lg p-4 flex flex-col items-center hover:bg-gray-100 transition">
                            <i class="fas fa-university text-4xl text-green-600 mb-2"></i>
                            <span>Virement</span>
                        </button>
                    </div>
                </div> --}}
                       
                <!-- Bouton de Paiement -->
                <form id="payment-form" action="{{ route('paiement.process') }}" method="POST">
                    @csrf
                    <div id="card-element" class="form-control"></div>
                    <input type="hidden" name="stripeToken" id="stripe-token">
                    <div id="card-errors" class="text-red-500 mt-2"></div>
                    <div class="mt-8 text-center">
                        <button type="submit" id="submit-button" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-md font-medium text-lg transition duration-300">
                            Procéder au Paiement
                        </button>
                    </div>
                </form>
                <!-- Download Invoice Button -->
<div class="mt-8 text-center">
    <a href="{{ route('invoice.download', ['id' => $reservation->id]) }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        Télécharger la Facture (PDF)
    </a>
</div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer-->
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
{{-- 
    <script type="https://javascript" >
        var stripe = Stripe('{{env("STRIPE_KEY")}}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');


        </script> --}}


        <script>
            var stripe = Stripe('{{ env("STRIPE_KEY") }}');
            var elements = stripe.elements();
        
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');
        
            var form = document.getElementById('payment-form');
            var submitButton = document.getElementById('submit-button');
            var cardErrors = document.getElementById('card-errors');
            var tokenInput = document.getElementById('stripe-token');
        
            form.addEventListener('submit', async function(event) {
                event.preventDefault();
                submitButton.disabled = true;
        
                const { token, error } = await stripe.createToken(cardElement);

        
                if (error) {
                    cardErrors.textContent = error.message;
                    submitButton.disabled = false;
                } else {
                    console.log(token.id);
                    
                    tokenInput.value = token.id; // Set the token in the hidden input
                    form.submit(); // Submit the form with the token
                }
            });
        </script>
        
</body>
</html>