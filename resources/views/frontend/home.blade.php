@php    
    $baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')


  <div class="intro-section inactive">

    <div class="intro-bg">
      <img src="{{ $baseUrl }}img/intro-bg.jpg" alt="">
    </div>

    <div class="intro-title">
      <div class="intro-logo">
        <img src="{{ $baseUrl }}img/intro-logo.svg" alt="">
      </div>
      <h1 class="head-1 center">
        Steroids made in Germany
      </h1>
    </div>


    <div class="logo-big">
      <img src="{{ $baseUrl }}img/logo-big.svg" alt="">
    </div>

  </div>


  <!-- Main Container Starts -->
  <div class="main-container">


    <!-- Banner Swiper -->
    <div class="banner-section">
      <div class="progress-line">
        <div class="progress-bar"></div>
      </div>
      <div class="swiper swiper-banner">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="banner-wrap">
              <div class="banner-bg"></div>
              <div class="banner-head">
                <h2 class="head-1 black">Moving Forward With Sience
                  For Best Results</h2>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="banner-wrap">
              <div class="banner-bg">
                <img src="{{ $baseUrl }}img/banner-2.jpg" alt="">
              </div>
              <div class="banner-head">
                <h2 class="head-1 white">With Xandoz Together
                  Against Cancer</h2>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="banner-wrap">
              <div class="banner-bg">
                <img src="{{ $baseUrl }}img/banner-3.jpg" alt="">
              </div>
              <div class="banner-head">
                <h2 class="head-1">We Research For Sport
                  Performance</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Swiper -->


    <!-- Welcome to Xandoz Laboratories -->
    <div class="welcome-section">
      <div class="welcome-bg">
        <img src="{{ $baseUrl }}img/welcome.jpg" alt="">
      </div>
      <div class="container">
        <div class="welcome-content">
          <div class="welcome-title">
            <h3 class="head-2 center">Welcome to Xandoz Laboratories</h3>
          </div>
          <div class="welcome-txt">
            <p>Our utmost commitment is improving the quality of life for each and every individual. It is through this
              commitment that we constantly strive to innovate, improve and increase the availability of cost-efficient
              generic medicines to the global market.
            </p>


            <ul>
              <li><img src="{{ $baseUrl }}img/wc-icon-1.svg" alt=""> Advanced technology</li>
              <li><img src="{{ $baseUrl }}img/wc-icon-2.svg" alt=""> Trusted by doctors</li>
              <li><img src="{{ $baseUrl }}img/wc-icon-3.svg" alt=""> Used in hospitals</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Welcome to Xandoz Laboratories -->

    <!-- Features Starts -->
    <div class="feature-section">
      <div class="feature-box">
        <div class="feature-txt">
          <div class="feature-icon">
            <img src="{{ $baseUrl }}img/feature-icon-1.svg" alt="">
          </div>
          <h3 class="head-2">Advanced technology</h3>
          <p class="txt-1">Our laboratories use advanced processing and production technologies for producing clean and
            safe products
          </p>
        </div>
        <div class="feature-img">
          <img src="{{ $baseUrl }}img/feature-img-1.png" alt="">
        </div>
      </div>
      <div class="feature-box">
        <div class="feature-txt">
          <div class="feature-icon">
            <img src="{{ $baseUrl }}img/feature-icon-2.svg" alt="">
          </div>
          <h3 class="head-2">Trusted by doctors</h3>
          <p class="txt-1">Our products are carefully researched under independent clinical trials and show outstanding
            proven results
          </p>
        </div>
        <div class="feature-img">
          <img src="{{ $baseUrl }}img/feature-img-2.png" alt="">
        </div>
      </div>
      <div class="feature-box">
        <div class="feature-txt">
          <div class="feature-icon">
            <img src="{{ $baseUrl }}img/feature-icon-3.svg" alt="">
          </div>
          <h3 class="head-2">Used in hospitals</h3>
          <p class="txt-1">Our clients are leading hospitals all over Asia and South America, private clinics in North
            America and Europe
          </p>
        </div>
        <div class="feature-img">
          <img src="{{ $baseUrl }}img/feature-img-3.png" alt="">
        </div>
      </div>
    </div>
    <!-- Features Ends -->

    <!-- Empower-starts -->
    <div class="empower-section bg-section bg-half-overlay">
      <div class="empower-bg bg-wrap">
        <img src="{{ $baseUrl }}img/empower-bg.jpg" alt="">
      </div>
      <div class="container">
        <div class="empower-content">
          <h2 class="head-1 center white">
            Empower The Best
            Performance
          </h2>
          <div class="empower-bottom">
            <img src="{{ $baseUrl }}img/empower-bottom.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Empower-ends -->

    <!-- Expertise-starts -->
    <div class="expertise-section center-sec bg-section">
      <div class="empower-bg bg-wrap">
        <img src="{{ $baseUrl }}img/expertise.jpg" alt="">
      </div>
      <div class="container">
        <div class="expertise-content">
          <h2 class="head-1 white">
            Leading Through Expertise
          </h2>
          <h3 class="head-2 white">Researched and Produced in Germany</h3>
          <p class="txt-2 white">Born from German engineering and crafted with passion - our supplements are the result
            of
            tireless research
            and development. We take immense pride in the quality and efficacy of our products. Our experts meticulously
            select only proven ingredients in precise dosages, rigorously testing each formula. This commitment to
            excellence yields steroids you can trust completely, designed to elevate your performance.</p>
        </div>
      </div>

      <div class="learn-wrap">
        <a href="{{ route('frontend.about') }}" class="button blue">Learn More</a>
      </div>
    </div>
    <!-- Expertise-ends -->

    <!-- Boost Your Endurance -->
    <div class="endurance-section center-sec bg-section bg-half-overlay rev">
      <div class="empower-bg  bg-wrap">
        <img src="{{ $baseUrl }}img/endurance-wrap.png" alt="">
      </div>
      <div class="container">
        <div class="endurance-content">
          <h2 class="head-1 green center">
            Boost Your Endurance
          </h2>
          <h3 class="head-2 white">Accomplish your Target</h3>
          <p class="txt-1 white">Push past your limits with our advanced endurance supplements. Scientifically
            formulated
            to boost stamina and energy, our products help you maintain intense focus while challenging your body and
            mind. Stay strong throughout your toughest workouts and races with our innovative endurance line.
          </p>
        </div>
      </div>
    </div>
    <!-- Boost Your Endurance -->

    <div class="discover-products">
      <a href="{{ route('products.list') }}" class="button blue">Discover Products</a>
    </div>

    <!-- Make Your Cycle -->
    <div class="cycle-section center-sec bg-section bg-half-overlay">
      <div class="empower-bg  bg-wrap">
        <img src="{{ $baseUrl }}img/cycle.jpg" alt="">
      </div>
      <div class="container">
        <div class="expertise-content">
          <h2 class="head-1 blue">
            Make Your Cycle
          </h2>
          <h3 class="head-2 white">Discover your Product</h3>
          <p class="txt-1 white">Our high-potency formulations utilize researched compounds like testosterone,
            trenbolone
            and nandrolone to rapidly augment strength, accelerate muscle protein synthesis, and maximize hypertrophic
            gains. With precise dosing and enhanced bioavailability, our body-sculpting supplements facilitate
            accelerated
            recovery while amplifying muscle mass.
          </p>
        </div>
      </div>
    </div>
    <!-- Make Your Cycle -->

  </div>
  <!-- Main Container Ends -->

@endsection