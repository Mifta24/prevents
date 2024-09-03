<x-front-layout>
    <br>
    <br>
    <!-- Payment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Payment</h6>
                <h1 class="mb-5">Complete Your Payment</h1>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="wow fadeInUp" data-wow-delay="0.3s">
                        <form action="{{ route('process.payment',$registration->id) }}" method="POST">
                            @csrf

                            <!-- Event and Ticket Summary -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Event Summary</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Event Name:</strong> {{ $registration->event->name }}</p>
                                    <p><strong>Date:</strong> {{ $registration->created_at }}</p>
                                    <p><strong>Location:</strong> {{ $registration->event->location }}</p>
                                    <p><strong>Ticket Type:</strong> {{ $registration->ticket->type }}</p>
                                    <p><strong>Price:</strong> ${{ $registration->ticket->price }}</p>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Select Payment Method</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Payment Method</label>
                                        <select name="payment_method" class="form-select" id="payment_method" required>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="paypal">PayPal</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="bank_transfer">Gopay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Details -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5>Payment Details</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Credit Card Payment Fields -->
                                    <div id="credit_card_fields" style="display: none;">
                                        <div class="mb-3">
                                            <label for="card_number" class="form-label">Card Number</label>
                                            <input type="text" name="card_number" class="form-control" id="card_number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_expiry" class="form-label">Expiry Date</label>
                                            <input type="text" name="card_expiry" class="form-control" id="card_expiry">
                                        </div>
                                        <div class="mb-3">
                                            <label for="card_cvc" class="form-label">CVC</label>
                                            <input type="text" name="card_cvc" class="form-control" id="card_cvc">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Payment End -->
</x-front-layout>

<script>
    // JavaScript to toggle payment fields based on selected method
    document.getElementById('payment_method').addEventListener('change', function() {
        var paymentMethod = this.value;
        var creditCardFields = document.getElementById('credit_card_fields');

        if (paymentMethod === 'credit_card') {
            creditCardFields.style.display = 'block';
        } else {
            creditCardFields.style.display = 'none';
        }
    });
</script>
