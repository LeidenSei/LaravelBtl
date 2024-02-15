@extends('fe.index')
@section('main')
<main class="main about">
    <div class="page-header page-header-bg text-left"
        style="background: 50%/cover #D4E1EA url('{{ asset('fe-asset') }}/assets/images/page-header-bg.jpg');">
        <div class="container">
            <h1><span>ABOUT US</span>
                OUR COMPANY</h1>
            <a href="{{route('contact')}}" class="btn btn-dark">Contact</a>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="about-section">
        <div class="container">
            <h2 class="subtitle">OUR STORY</h2>
            <p>A Global Brand
                With global headquarters and an extensive network of logistics hubs and customer service centers, we’re here to create that feeling of home for everyone, anywhere.
                Corporate Offices: Purple Pins
                Our corporate headquarters in Boston and Berlin are surrounded by world-class technology and educational institutions, providing access to top talent.
                Fulfillment & Home Delivery Network: Yellow Pins
                We operate 18 fulfillment and 38 delivery centers representing millions of square feet across the U.S., Germany, Canada, and the U.K.
                Sales & Service Centers: Green Pins
                Our Sales & Service teams in the U.S., Germany, Ireland, Canada, and the U.K. along with our virtual team allow us to meet the needs of our global customer base.</p>

            <p class="lead">“ Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                default model search for evolved over sometimes by accident, sometimes on purpose ”</p>
        </div><!-- End .container -->
    </div><!-- End .about-section -->

    <div class="features-section bg-gray">
        <div class="container">
            <h2 class="subtitle">WHY CHOOSE US</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-shipped"></i>

                        <div class="feature-box-content p-0">
                            <h3>Free Shipping</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industr.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-us-dollar"></i>

                        <div class="feature-box-content p-0">
                            <h3>100% Money Back Guarantee</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industr.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->

                <div class="col-lg-4">
                    <div class="feature-box bg-white">
                        <i class="icon-online-support"></i>

                        <div class="feature-box-content p-0">
                            <h3>Online Support 24/7</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has been the industr.</p>
                        </div><!-- End .feature-box-content -->
                    </div><!-- End .feature-box -->
                </div><!-- End .col-lg-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .features-section -->

    <div class="testimonials-section">
        <div class="container">
            <h2 class="subtitle text-center">HAPPY CLIENTS</h2>

            <div class="testimonials-carousel owl-carousel owl-theme images-left" data-owl-options="{
                'margin': 20,
                'lazyLoad': true,
                'autoHeight': true,
                'dots': false,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '992': {
                        'items': 2
                    }
                }
            }">
                <div class="testimonial">
                    <div class="testimonial-owner">
                        <figure>
                            <img src="{{ asset('fe-asset') }}/assets/images/clients/client1.png" alt="client">
                        </figure>

                        <div>
                            <strong class="testimonial-title">John Smith</strong>
                            <span>SMARTWAVE CEO</span>
                        </div>
                    </div><!-- End .testimonial-owner -->

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum
                            dolor sit amet, consectetur elitad adipiscing cas non placerat mi.</p>
                    </blockquote>
                </div><!-- End .testimonial -->

                <div class="testimonial">
                    <div class="testimonial-owner">
                        <figure>
                            <img src="{{ asset('fe-asset') }}/assets/images/clients/client2.png" alt="client">
                        </figure>

                        <div>
                            <strong class="testimonial-title">Bob Smith</strong>
                            <span>SMARTWAVE CEO</span>
                        </div>
                    </div><!-- End .testimonial-owner -->

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum
                            dolor sit amet, consectetur elitad adipiscing cas non placerat mi.</p>
                    </blockquote>
                </div><!-- End .testimonial -->

                <div class="testimonial">
                    <div class="testimonial-owner">
                        <figure>
                            <img src="{{ asset('fe-asset') }}/assets/images/clients/client1.png" alt="client">
                        </figure>

                        <div>
                            <strong class="testimonial-title">John Smith</strong>
                            <span>SMARTWAVE CEO</span>
                        </div>
                    </div><!-- End .testimonial-owner -->

                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum
                            dolor sit amet, consectetur elitad adipiscing cas non placerat mi.</p>
                    </blockquote>
                </div><!-- End .testimonial -->
            </div><!-- End .testimonials-slider -->
        </div><!-- End .container -->
    </div><!-- End .testimonials-section -->

    <div class="counters-section bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="200" data-speed="2000"
                            data-refresh-interval="50">200</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">MILLION CUSTOMERS</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="1800" data-speed="2000"
                            data-refresh-interval="50">1800</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">TEAM MEMBERS</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper line-height-1">
                        <span class="count-to" data-from="0" data-to="24" data-speed="2000"
                            data-refresh-interval="50">24</span><span>HR</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper">
                        <span class="count-to" data-from="0" data-to="265" data-speed="2000"
                            data-refresh-interval="50">265</span>+
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div><!-- End .col-md-4 -->

                <div class="col-6 col-md-4 count-container">
                    <div class="count-wrapper line-height-1">
                        <span class="count-to" data-from="0" data-to="99" data-speed="2000"
                            data-refresh-interval="50">99</span><span>%</span>
                    </div><!-- End .count-wrapper -->
                    <h4 class="count-title">SUPPORT AVAILABLE</h4>
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .counters-section -->
</main><!-- End .main -->
@endsection