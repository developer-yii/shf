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
        Science from Switzerland
      </h1>
    </div>


    <div class="logo-big" style="height: auto;">
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
                <h2 class="head-1 black">Moving Forward With Science
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
                <h2 class="head-shf white">Somaheal </h2>
                <h3 class="head-1 white">Recombinant Human Growth Hormone
                  for injection </h3>
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


    <!-- Welcome to SHF Laboratories -->
    <div class="welcome-section">
      <div class="welcome-bg">
        <img src="{{ $baseUrl }}img/welcome.jpg" alt="">
      </div>
      <div class="container">
        <div class="welcome-content">
          <div class="welcome-title">
            <h3 class="head-2 center">Welcome to SHF Laboratories</h3>
          </div>
          <div class="welcome-txt">
            <p>Our utmost commitment is improving the quality of life for each and every individual. It is through
              this commitment that we constantly strive to innovate, improve and increase the availability of
              cost-efficient generic rHGH to the global market.
            </p>

            <ul>
              <li><img src="{{ $baseUrl }}img/wc-icon-1.svg" alt=""> Authenticity Check Available</li>
              <li><img src="{{ $baseUrl }}img/wc-icon-2.svg" alt=""> New Product Formula</li>
              <li><img src="{{ $baseUrl }}img/wc-icon-3.svg" alt=""> Wide Range of Application</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Welcome to SHF Laboratories -->

    <!-- Video -->
    <video width="100%" height="100%" autoplay playsinline muted loop>
      <source src="{{ $baseUrl }}video/shf-video.mp4" type="video/mp4">
    </video>
    <!-- Video -->

    <!-- Features Starts -->
    <div class="feature-section">
      <div class="feature-box">
        <div class="feature-txt">
          <div class="feature-icon">
            <img src="{{ $baseUrl }}img/feature-icon-1.svg" alt="">
          </div>
          <h3 class="head-2">Authenticity Check</h3>
          <p class="txt-1">Our authenticity check protects customers from counterfeits by verifying the originality of
            our product. This gives buyers confidence that they are purchasing a genuine high-quality item directly from
            our sellers.
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
          <h3 class="head-2">New Product Formula</h3>
          <p class="txt-1">Somaheal™ uses the most innovative Protein Secretion Technology to manufacture recombinant
            human growth hormone (rHGH). This advanced system allows for high-quality and consistent production of rHGH.
            GenhealTM leverages the latest biomanufacturing techniques to ensure the finest rHGH product.
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
          <h3 class="head-2">Wide Range of Application</h3>
          <p class="txt-1">Somaheal™ has a broad range of therapeutic uses for both adults and children, pending
            physician approval. Patients should always consult their doctor before using Somaheal to ensure appropriate
            and safe usage for their condition. Though it has wide applications, Somaheal™ should only be taken under
            medical supervision for approved indications.
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
          <h3 class="head-2 white">Researched and Produced in Switzerland</h3>
          <p class="txt-2 white">Born from Swiss engineering and crafted with passion - our rHGH is the result of
            tireless research and development. We take immense pride in the quality and efficacy of our products. Our
            experts meticulously select only proven ingredients in precise dosages, rigorously testing each formula.
            This commitment to excellence yields rHGH you can trust completely, designed to elevate your performance and
            for therapeutic usage.</p>
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
            Boost Your IGF Level
          </h2>
          <div class="endurance-txt">
            <h3 class="head-2 white">Accomplish your Target</h3>
            <p class="txt-1 white">Experience a transformative journey towards enhanced health and optimal fitness with
              Somaheal™. Our revolutionary product is designed to address a range of health concerns, promoting growth
              and
              well-being in various conditions.
            </p>
            <p class="txt-1 white">
              Somaheal™ is not just a product; it's a commitment to your well-being and
              fitness goals. Elevate your health, embrace growth, and achieve your fitness milestones with SomaHeal
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- Boost Your Endurance -->

    <div class="discover-products">
      <a href="{{ route('product.singleproduct') }}" class="button blue">Discover Products</a>
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
          <p class="txt-1 white">Somaheal™ (somatropin [rDNA origin] for injection) is one of the leading rHGH in South
            America that has been widely used in more than 300 Class A hospitals for pediatric, burn, surgery,
            epidemiology and other areas of clinical treatment. Somaheal™ conform both domestic and international
            quality standards and is one of the best rHGH products on the market today.
          </p>
        </div>
      </div>
    </div>
    <!-- Make Your Cycle -->

  </div>
  <!-- Main Container Ends -->
@endsection