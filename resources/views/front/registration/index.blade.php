<x-front-layout>
    <br>
    <br>
    <!-- Registration Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Registration</h6>
                <h1 class="mb-5">Register for {{ $event->name }} Event</h1>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="wow fadeInUp" data-wow-delay="0.3s">
                        <form action="{{ route('register.ticket', $event->slug) }}" method="POST">
                            @csrf


                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>


                            <!-- Ticket Information -->
                            <div class="mb-3">
                                <label for="ticket_type" class="form-label">Ticket Type</label>
                                <select name="ticket_id" class="form-select" id="type" required>
                                    @foreach($event->tickets as $ticket)
                                        <option value="{{ $ticket->id }}">{{ $ticket->type }} - ${{ $ticket->price }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Payment Information -->
                            {{-- <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select" id="payment_method" required>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div> --}}

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-primary">Terms and Conditions</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2">Register Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registration End -->
</x-front-layout>
