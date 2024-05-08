@extends('layouts.front-master')
@section('page-css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="pageBreadcrum"><span>Home</span> / Checkout</div>

            <div class="checkout-page-flex">
                <div class="checkout-outer-wrpr">
                    <div class="checkout-form">
                        <div class="payment-icons">
                            <img src="{{ asset('assets/img/subscription/Group 2761.png') }}" alt="Visa" />
                            <img src="{{ asset('assets/img/subscription/Group 2762.png') }}" alt="Mastercard" />
                            <img src="{{ asset('assets/img/subscription/Group 2764.png') }}" />
                            <img src="{{ asset('assets/img/subscription/Group 2765.png') }}" />
                        </div>
                        <form>
                            <div class="form-group">
                                <input type="text" id="card-number" name="card-number" placeholder="Credit/Debit Card"
                                    required />
                            </div>
                            <div class="form-group">
                                <input type="text" id="card-name" name="card-name" placeholder="Name on Card" required />
                            </div>
                            <div class="cvv-wrp">
                                <div class="form-group">
                                    <input type="text" id="expiry" name="expiry" placeholder="Expiry" required />
                                </div>
                                <div class="form-group">
                                    <input type="text" id="cvv" name="cvv" placeholder="CVV" required />
                                </div>
                            </div>
                            <button type="submit" class="btn-confirm font-roboto">Confirm Payment</button>
                        </form>
                    </div>
                    <div class="notice-wrp">
                        <p class="font-roboto">
                            * You can cancel your subscription anytime by choosing the Freemium
                            Plan. Cancel plan at least one day before each renewal date. Plan
                            automatically renews until cancelled.
                        </p>
                    </div>
                </div>

                <div class="subscriptions">
                    <div class="subscription-card">
                        <div class="img-wrp">
                            <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}" alt="Subscription Image" />
                            <div class="price">
                                <p>Basic</p>
                                <div class="price-plan">
                                    <div class="monthly" onclick="togglePrice('monthly')">
                                        <p>$69.95</p>
                                        <p>per month</p>
                                    </div>
                                    <div class="yearly" onclick="togglePrice('yearly')">
                                        <p>$69.95</p>
                                        <p>per year</p>
                                        <p>10% savings</p>
                                    </div>
                                    <div class="switch"></div>
                                </div>
                            </div>
                        </div>
                        <div class="subscription-details">
                            <p class="short-d">
                                Basic Plan is recommended for small businesses or infrequent job
                                posting.
                            </p>
                            <div class="points">
                                <ul>
                                    <li>
                                        <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                            class="pointer-icon" />Post
                                        up to 2 active job ads at a time.
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                            class="pointer-icon" />Post
                                        up to 2 active job ads at a time.
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                            class="pointer-icon" />Post
                                        up to 2 active job ads at a time.
                                    </li>
                                    <li>
                                        <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                            class="pointer-icon" />Post
                                        up to 2 active job ads at a time. Post up to 2 active job ads
                                        at a time
                                    </li>
                                </ul>
                                {{-- <div class="view-btn">
                            <button class="view-more">View More</button>
                        </div> --}}
                            </div>
                            <button class="subscribe-button">Select</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="success-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="img-icon">
                        <img src="img/star.png" alt="">
                    </div>
                    <h3>Your Payment
                        was Successful</h3>
                    <p>You can now access your subscription.</p>
                    <button id="get-started-btn" class="btn-confirm">Get Started</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('assets/js/admin/recruiter/subscribe.js') }}"></script>
@endsection
