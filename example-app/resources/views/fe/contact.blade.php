@extends('fe.index')
@section('main')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('index')}}"><i class="icon-home"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Contact Us
                </li>
            </ol>
        </div>
    </nav>

    <div id="map"><iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.6585385736216!2d105.78092597500091!3d21.04634448717487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3b4220c2bd%3A0x1c9e359e2a4f618c!2sB%C3%A1ch%20Khoa%20Aptech!5e0!3m2!1svi!2s!4v1698914299628!5m2!1svi!2s"
        height="100%" width="100%" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>

    <div class="container contact-us-container">
        <div class="contact-info">
            <div class="row">

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="sicon-location-pin"></i>
                        <div class="feature-box-content">
                            <h3>Address</h3>
                            <h5>HTC Building, 250 Hoang Quoc Viet Street, Co Nhue Ward, Cau Giay District, Hanoi, Vietnam</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="fa fa-mobile-alt"></i>
                        <div class="feature-box-content">
                            <h3>Phone Number</h3>
                            <h5>0968276996</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-envelope"></i>
                        <div class="feature-box-content">
                            <h3>E-mail Address</h3>
                            <h5>tuyensinh@bachkhoa-aptech.edu.vn</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box text-center">
                        <i class="far fa-calendar-alt"></i>
                        <div class="feature-box-content">
                            <h3>Working Days/Hours</h3>
                            <h5>Mon - Sat / 9:00AM - 8:00PM</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h2 class="mt-6 mb-2">Send Us a Message</h2>

                <form class="mb-0" action="#">
                    <div class="form-group">
                        <label class="mb-1" for="contact-name">Your Name
                            <span class="required">*</span></label>
                        <input type="text" class="form-control" id="contact-name" name="contact-name"
                            required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="contact-email">Your E-mail
                            <span class="required">*</span></label>
                        <input type="email" class="form-control" id="contact-email" name="contact-email"
                            required />
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="contact-message">Your Message
                            <span class="required">*</span></label>
                        <textarea cols="30" rows="1" id="contact-message" class="form-control"
                            name="contact-message" required></textarea>
                    </div>

                    <div class="form-footer mb-0">
                        <button type="submit" class="btn btn-dark font-weight-normal">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6">
                <h2 class="mt-6 mb-1">Frequently Asked Questions</h2>
                <div id="accordion">
                    <div class="card card-accordion">
                        <a class="card-header" href="#" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            Product or service related questions:
                        </a>

                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <p>What is your product or service?.</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                            What are the benefits of your product or service?
                        </a>

                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <p>How to contact customer service?
                                What is your return policy?
                                What is your shipping policy?
                                What are your international taxes, duties, etc., that I have to pay?
                                When will I receive my order?
                                What do I do if I never received my order?
                                What do I do if I receive a defective order?
                                How to make changes to an order I've already placed?
                                Where are you located?</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                            Questions about using the website:
                        </a>

                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <p>How to search on your website?
                                How to create an account on your website?
                                How to place an order for your product or service on your website?</p>
                        </div>
                    </div>

                    <div class="card card-accordion">
                        <a class="card-header collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseFour" aria-expanded="true" aria-controls="collapseThree">
                            General questions
                        </a>

                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                            <p>How to contact customer service?
                                What is your return policy?
                                What is your shipping policy?
                                What are your international taxes, duties, etc., that I have to pay?
                                When will I receive my order?
                                What do I do if I never received my order?
                                What do I do if I receive a defective order?
                                How to make changes to an order I've already placed?
                                Where are you located?
                                How is your product or service made?
                                Where do the materials come from?.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8"></div>
</main>
@endsection