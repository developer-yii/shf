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
        <h1 class="head-1 black">About Xandoz</h1>
      </div>
      <div class="about-bg">
        <img src="{{ $baseUrl }}img/about-bg.jpg" alt="">
      </div>
    </div>
    <!-- about-banner -->

    <!-- Welcome to Xandoz Laboratories -->
    <div class="about-wc">
      <div class="container">
        <h3 class="head-2 center">
          Welcome to Xandoz Laboratories
        </h3>
        <p class="txt-1">Xandoz Laboratories has a commitment to mankind, a commitment of improving the quality of life
          for each and
          every individual through which we constantly strive to innovate, improve and increase the availability of
          cost-efficient generic medicines to the global market. We believe that medicine should be available to all
          people regardless of their location, and affordable for them at any income level such that the cost of medical
          treatment should not be a concern for any part of the population.
        </p>
      </div>
    </div>
    <!-- Welcome to Xandoz Laboratories -->


    <!-- Product Efficiency -->
    <div class="eff-section">
      <div class="eff-bg">
        <img src="{{ $baseUrl }}img/eff-bg.jpg" alt="">
      </div>
      <div class="container">
        <h2 class="head-1 green">Product Efficiency</h2>
        <div class="eff-content">
          <h3 class="head-2 white">Medication efficiency for men</h3>
          <div class="eff-txt">
            <p class="txt-2 white">Formulated for men, our steroids aid strength and performance restoration. Developed
              alongside
              cancer researchers, our products help men regain prior levels after illness. Enhanced delivery methods
              like
              our patented encapsulation technology allow key ingredients like nandrolone to be rapidly absorbed,
              assisting
              athletes in accelerated workout recovery.</p>
            <div class="eff-icon">
              <img src="{{ $baseUrl }}img/eff-men.svg" alt="">
            </div>
          </div>
        </div>
        <div class="eff-content eff-content-2">
          <h3 class="head-2 white">Medication efficiency for women</h3>
          <div class="eff-txt">
            <p class="txt-2 white">Uniquely formulated for women, our medicals support female strength while respecting
              delicate hormonal balance. Developed in collaboration with women's health researchers, our products help
              maintain normal hormone levels, even during intense training. With our patented delivery system, key
              ingredients like magnesium are rapidly absorbed while being gentle on the female reproductive tract.</p>
            <div class="eff-icon">
              <img src="{{ $baseUrl }}img/eff-women.svg" alt="">
            </div>
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
        <div class="expertise-content expertise-content-2">
          <h3 class="head-2 white">We elevate expectations</h3>
          <div class="expertise-txt">
            <p class="txt-2 white">our supplements adhere to strict pharmaceutical standards. All raw ingredients are
              double-filtered using advanced 0.45um nylon filtration to ensure purity. Each production batch is
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