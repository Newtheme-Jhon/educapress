<div>
    <section class="bg-white rounded-lg shadow-lg mt-4" wire:ignore>
        <div class="py-3 px-3">
            <x-input class="w-full" placeholder="Ponga un nombre para su tarjeta" id="card-holder-name" type="text"/>
    
            <!-- Stripe Elements Placeholder -->
            <div id="card-element" class="form-control mt-2"></div>
            
            <button id="card-button">
                Process Payment
            </button>
        </div>
    </section>

@push('js')

    <script src="https://js.stripe.com/v3/"></script>
    
    <script>
        const stripe = Stripe("{{config('services.stripe.public_key')}}");
    
        const elements = stripe.elements();
        const cardElement = elements.create('card');
    
        cardElement.mount('#card-element');
    </script>

    <script>
        const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
 
cardButton.addEventListener('click', async (e) => {
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card', cardElement, {
            billing_details: { name: cardHolderName.value }
        }
    );
 
    if (error) {
        // Display "error.message" to the user...
    } else {
        // The card has been verified successfully...
    }
});
    </script>

@endpush

</div>
