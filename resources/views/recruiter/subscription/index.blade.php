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
            <div class="pageBreadcrum"><span>Home</span> / Subscription</div>

            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="subscriptions">
                        @if ($subsPlanLists->isNotEmpty())
                            @foreach ($subsPlanLists as $subsPlanList)
                                <div class="subscription-card">
                                    <div class="img-wrp">
                                        <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}"
                                            alt="Subscription Image" />
                                        <div class="price">
                                            <p class="font-roboto">{{ $subsPlanList->plan_name }}</p>
                                            <div class="price-plan">
                                                @if ($subsPlanList->plan_name == 'Freemium')
                                                    <div class="free">
                                                        <p class="font-roboto">Free</p>
                                                    </div>
                                                @elseif ($subsPlanList->plan_name == 'Executive')
                                                    <div class="free">
                                                        <p class="font-roboto">Customized</p>
                                                    </div>
                                                @else
                                                    <div class="monthly" onclick="togglePrice('monthly')">
                                                        @if ($subsPlanList->montly_price != null)
                                                            <p class="font-roboto">${{ $subsPlanList->montly_price }}</p>
                                                            <p class="font-roboto">per month</p>
                                                        @endif
                                                    </div>
                                                    <div class="yearly" onclick="togglePrice('yearly')">
                                                        @if ($subsPlanList->yearly_price != null)
                                                            <p class="font-roboto">${{ $subsPlanList->yearly_price }}</p>
                                                            <p class="font-roboto">per year</p>
                                                            <p class="font-roboto">10% savings</p>
                                                        @endif
                                                    </div>
                                                    <div class="switch"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="subscription-details">
                                        <p class="short-d font-roboto">
                                            {{ $subsPlanList->description }}
                                        </p>
                                        <div class="points">
                                            {{-- {!! '<img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                            alt="" class="pointer-icon" />' . $subsPlanList->static_content !!} --}}
                                            {{-- {!! '<img src="' . asset('assets/img/subscription/pointer.svg') . '" alt="" class="pointer-icon" />' . $subsPlanList->static_content !!} --}}

                                            <ul>
                                                {!! $subsPlanList->static_content !!}
                                                {{-- <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time.
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time.
                                                </li>
                                                <li>
                                                    <img src="{{ asset('assets/img/subscription/pointer.svg') }}"
                                                        alt="" class="pointer-icon" />Post up to 2
                                                    active job ads at a time. Post up to 2
                                                    active job ads at a time
                                                </li> --}}
                                            </ul>
                                            {{-- <div class="view-btn">
                                            <button class="view-more">View More</button>
                                        </div> --}}
                                        </div>
                                        {{-- <a href="{{ route('recruiter.checkout') }}" class="subscribe-button">Select</a> --}}
                                        <a href="{{ route('recruiter.checkout', $subsPlanList->id) }}"><button
                                                class="subscribe-button font-roboto">Select</button></a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h4 class="mt-5">No Subscription Plan Found!</h4>
                        @endif

                        {{-- <div class="subscription-card">
                            <div class="img-wrp">
                                <div class="recommend-tab">
                                    <p>Recommended</p>
                                </div>
                                <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}"
                                    alt="Subscription Image" />
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
                                    Basic Plan is recommended for small businesses or infrequent
                                    job posting.
                                </p>
                                <div class="points">
                                    <ul>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time. Post up to 2
                                            active job ads at a time
                                        </li>
                                    </ul>
                                    <div class="view-btn">
                                        <button class="view-more">View More</button>
                                    </div>
                                </div>
                                <button class="subscribe-button">Select</button>
                            </div>
                        </div>
                        <div class="subscription-card">
                            <div class="img-wrp">
                                <div class="recommend-tab">
                                    <p>Recommended</p>
                                </div>
                                <img src="{{ asset('assets/img/subscription/Mask Group 111.png') }}"
                                    alt="Subscription Image" />
                                <div class="price">
                                    <p>Basic</p>
                                    <div class="free">
                                        <p>Free</p>
                                    </div>
                                </div>
                            </div>
                            <div class="subscription-details">
                                <p class="short-d">
                                    Basic Plan is recommended for small businesses or infrequent
                                    job posting.
                                </p>
                                <div class="points">
                                    <ul>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/img/subscription/pointer.svg') }}" alt=""
                                                class="pointer-icon" />Post up to 2
                                            active job ads at a time.
                                        </li>
                                    </ul>
                                </div>
                                <button class="subscribe-button">Select</button>
                            </div>
                        </div> --}}
                    </div>
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
