@extends('layout.nav')
@section('title')
    Help & Support
@endsection
@section('content')
<section class="help-support">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Help and Support</h2>
            </div>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
        <div class="row">
            <!-- FAQ Section -->
            <div class="col-lg-6">
                <h3>Frequently Asked Questions</h3>
                <div class="faq-item">
                    <h5>How do I create a seller account?</h5>
                    <p>To create a seller account, click on the "Become a Seller" button and fill out the registration form. Once submitted, our team will review your application.</p>
                </div>
                <div class="faq-item">
                    <h5>What are the fees for selling on your platform?</h5>
                    <p>We charge a small commission fee on each sale. The exact percentage depends on the product category. For more details, please refer to our pricing page.</p>
                </div>
                <div class="faq-item">
                    <h5>How do I contact customer support?</h5>
                    <p>You can reach out to our customer support team by filling out the contact form below or emailing us directly at support@example.com.</p>
                </div>
                <div class="faq-item">
                    <h5>What payment methods do you support?</h5>
                    <p>We support various payment methods, including credit/debit cards, PayPal, and bank transfers. Sellers can choose their preferred payment method during setup.</p>
                </div>
            </div>

            <!-- Contact Form Section -->
            <div class="col-lg-6">
                <div class="contact-form">
                    <h3>Contact Us</h3>
                    <p>If you have any questions or need assistance, please fill out the form below, and our support team will get back to you shortly.</p>
                    <form action="{{ route('contact') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Your Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter the subject">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
