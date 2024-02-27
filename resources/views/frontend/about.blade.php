@php
    $baseUrl = asset('frontend')."/";
@endphp
@extends('layouts.app-frontend')

@section('title','Home')
@section('content')
 <!-- Main Container Starts -->
  <div class="main-container">

    <!-- about-banner -->
    <div class="about-section">
      <div class="container">
        <h1 class="head-1 black">About SHF</h1>
      </div>
      <div class="about-bg">
        <img src="{{ $baseUrl }}img/about-bg.jpg" alt="">
      </div>
    </div>
    <!-- about-banner -->

    <!-- Welcome to SHF Laboratories -->
    <div class="about-wc">
      <div class="container">
        <h3 class="head-1 black center">
          Welcome to SHF Laboratories
        </h3>
        <p class="txt-1">SHF Laboratories has a commitment to mankind, a commitment of improving the quality of life for
          each and every individual through which we constantly strive to innovate, improve and increase the
          availability of cost-efficient generic medicines to the global market. We believe that medicine should be
          available to all people regardless of their location, and affordable for them at any income level such that
          the cost of medical treatment should not be a concern for any part of the population. A reason why Somaheal™
          is highly valuated all over the world has been exported to Southeast Asia, India, South America, Middle East,
          Eastern Europe and other countries and regions.
        </p>
      </div>
    </div>
    <!-- Welcome to SHF Laboratories -->

    <!-- somheal-about-image -->
    <div class="somheal-about-image">
      <div class="somheal-img">
        <img src="{{ $baseUrl }}img/somheal-about.png" alt="">
      </div>
    </div>
    <!-- somheal-about-image -->

    <!-- Product Efficiency -->
    <div class="eff-section">
      <div class="eff-bg">
        <img src="{{ $baseUrl }}img/eff-bg.jpg" alt="">
      </div>
      <div class="container">
        <div class="product-eff-wrap">
          <div class="product-eff-txt">
            <h2 class="head-1 green">Product Efficiency</h2>
            <div class="eff-content">
              <h3 class="head-2 white">Safe - Efficient - Modern</h3>
              <ul>
                <li>Nurture healthy growth in children with growth hormone deficiency, ensuring a promising future with
                  our
                  long-term treatment approach.</li>
                <li>Combat metabolic diseases and AIDS-related wasting, providing a holistic solution to promote overall
                  well-being.</li>
                <li>
                  Address Prader-Willi syndrome in children with growth deficiencies, fostering a balanced and healthier
                  lifestyle.
                </li>
                <li>Tackle intrauterine growth retardation and short stature, supporting continued growth and
                  development
                  after birth.</li>
                <li>Empower adults dealing with growth hormone deficiency (GHD), enabling them to lead an active and
                  fulfilling life.</li>
                <li>Facilitate long-term treatment for patients with Turner syndrome, promoting comprehensive care and
                  well-being.
                </li>
                <li>
                  Support individuals with idiopathic short stature, addressing growth concerns and enhancing
                  self-confidence.
                </li>
                <li>
                  Provide relief for those dealing with short bowel syndrome, contributing to improved digestive health.
                </li>
                <li>Aid in pediatric renal transplantation cases by addressing growth-related concerns before renal
                  failure.
                </li>
                <li>Combat SHOX gene deficiency, offering targeted solutions for improved growth and overall health.
                </li>
              </ul>
            </div>
          </div>
          <div class="product-eff-img">
            <img src="{{ $baseUrl }}img/product-eff.png" alt="">
          </div>
        </div>
      </div>
    </div>
    <!-- Product Efficiency -->


    <!-- Our Benefits -->
    <div class="welcome-section">
      <div class="welcome-bg">
        <img src="{{ $baseUrl }}img/welcome.jpg" alt="">
      </div>
      <div class="container">
        <div class="welcome-content">
          <div class="welcome-title">
            <h3 class="head-2 center">Our Benefits</h3>
          </div>
          <div class="welcome-txt">
            <p>Our utmost commitment is improving the quality of life for each and every individual. It is through this
              commitment that we constantly strive to innovate, improve and increase the availability of cost-efficient
              generic medicines to the global market.
            </p>


            <ul>
              {{-- <li><img src="{{ $baseUrl }}img/at-1.svg" alt=""> Advanced technology</li>
              <li><img src="{{ $baseUrl }}img/at-2.svg" alt=""> Trusted by doctors</li>
              <li><img src="{{ $baseUrl }}img/at-3.svg" alt=""> Used in hospitals</li> --}}
              <li><img src="{{ $baseUrl }}img/wc-icon-1.svg" alt=""> Advanced technology</li>
              <li><img src="{{ $baseUrl }}img/wc-icon-2.svg" alt=""> Trusted by doctors</li>
              <li><img src="{{ $baseUrl }}img/wc-icon-3.svg" alt=""> Used in hospitals</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Our Benefits -->

    <!-- Expertise-starts -->
    <div class="expertise-section center-sec bg-section">
      <div class="empower-bg bg-wrap">
        <img src="{{ $baseUrl }}img/expertise.jpg" alt="">
      </div>
      <div class="container">
        <div class="expertise-content">
          <h2 class="head-1 yellow">
            Leading Through Expertise
          </h2>
          <h3 class="head-2 white">Researched and Produced in Germany</h3>
          <p class="txt-2 white">Born from switzerland engineering and crafted with passion - our medications are the
            result of tireless research and development. We take immense pride in the quality and efficacy of our
            products. Our experts meticulously select only proven ingredients in precise dosages, rigorously testing
            each formula. This commitment to excellence yields rhGH you can trust completely, designed to elevate your
            performance.</p>
        </div>
        <div class="expertise-content expertise-content-2">
          <h3 class="head-2 white">We elevate expectations</h3>
          <div class="expertise-txt">
            <p class="txt-2 white">Our medications adhere to strict pharmaceutical standards. All raw ingredients are
              double-filtered using advanced 0.22um nylon filtration to ensure purity. Each production batch is
              meticulously documented for quality control. Combining this pharmaceutical rigor with tireless R&D yields
              supplements you can trust completely, designed to elevate your health.</p>
            <ul>
              <p class="txt-2 white">The key additions highlight:</p>
              <li>Pharmaceutical standards</li>
              <li>Double-filtration process</li>
              <li>Documentation for QC</li>
              <li>Combining pharmaceutical rigor with R&D</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
    <!-- Expertise-ends -->

  </div>
  <!-- Main Container Ends -->
@endsection