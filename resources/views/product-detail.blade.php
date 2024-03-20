@php
    $baseUrl = asset('storage/product_images');
    $baseUrl1 = asset('frontend') . '/';
@endphp
@extends('layouts.app-frontend')

@section('title', 'Product Detail')
@section('content')
    <div class="main-container">

        <div class="products-section">
            <div class="product-top-bg"></div>

            <div class="p-detail-wrap">

                <div class="head-bg-pd">
                    <img src="{{ $baseUrl }}/{{ $product['banner_image'] }}" alt="">
                </div>
                <!-- <h2 class="head-1 center black">Testosterone Enanthate</h2> -->

                <div class="p-detail-box">
                    <div class="p-detail-sec">
                        <div class="p-detail-left">
                            <div class="product-small">
                                <img src="{{ $baseUrl }}/{{ $product['image'] }}" alt="">
                            </div>
                            <h3 class="head-2">{{ $product['name'] }}</h3>
                            <div class="details-share">
                                <div class="details">
                                    <div class="detail">
                                        <h4>Ingredient</h4>
                                        <h5>{{$product->ingredients->implode('ingredient_name', ', ')}}</h5>
                                    </div>
                                    <div class="detail">
                                        <h4>Volume</h4>
                                        <h5>{{ $product['total_volume'] }}{{ getUnitByVolumeType($product['volume_type'])['unit'] }}</h5>
                                    </div>
                                    <div class="detail">
                                        <h4>Tension</h4>
                                        <h5>{{ $product['tension'] }} / vial</h5>
                                    </div>
                                    <div class="detail">
                                        <h4>Use</h4>
                                        <h5>{{ $productUse }}</h5>
                                    </div>
                                </div>
                                <div class="share">
                                    <h4>Share</h4>
                                    <a href="javascript:void(0);" id="shareButton">
                                        <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_23_707)">
                                                <path d="M29.0136 32.8413H4.34713C2.32445 32.8413 0.680664 31.1973 0.680664 29.1748V9.84152C0.680664 7.81883 2.32445 6.17505 4.34713 6.17505H9.01383C9.56583 6.17505 10.0138 6.62304 10.0138 7.17504C10.0138 7.72704 9.56583 8.17503 9.01383 8.17503H4.34713C3.42844 8.17503 2.68064 8.92282 2.68064 9.84152V29.1748C2.68064 30.0933 3.42844 30.8413 4.34713 30.8413H29.0136C29.9323 30.8413 30.6804 30.0933 30.6804 29.1748V17.8414C30.6804 17.2894 31.1284 16.8414 31.6804 16.8414C32.2324 16.8414 32.6803 17.2894 32.6803 17.8414V29.1748C32.6803 31.1973 31.0363 32.8413 29.0136 32.8413Z" fill="black" />
                                                <path d="M9.67821 22.1575C9.60497 22.1575 9.53149 22.1494 9.45824 22.1306C9.00634 22.0254 8.67969 21.6387 8.67969 21.1748V19.1749C8.67969 12.007 14.5117 6.175 21.6796 6.175H22.0128V1.84154C22.0128 1.43359 22.2609 1.06689 22.6395 0.913575C23.0167 0.761721 23.45 0.853517 23.7328 1.14819L32.3994 10.1481C32.7727 10.5348 32.7727 11.1481 32.3994 11.5348L23.7328 20.5347C23.45 20.8294 23.014 20.9202 22.6395 20.7693C22.2609 20.616 22.0128 20.2493 22.0128 19.8414V15.5082H20.4288C16.2343 15.5082 12.4648 17.8387 10.5903 21.5894C10.4182 21.9361 10.0569 22.1575 9.67821 22.1575ZM21.6796 8.17498C16.0795 8.17498 11.4424 12.3815 10.7637 17.8013C13.1875 15.0975 16.6635 13.5082 20.4288 13.5082H23.0128C23.5648 13.5082 24.0128 13.9562 24.0128 14.5082V17.3614L30.2913 10.8415L24.0128 4.3215V7.17499C24.0128 7.72698 23.5648 8.17498 23.0128 8.17498H21.6796Z" fill="black" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_23_707">
                                                    <rect width="32" height="32" fill="white"
                                                        transform="translate(0.679688 0.841309)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="p-detail-right">
                            <a class="popup-link" href="{{ $baseUrl }}/{{ $product['big_image'] }}">
                                <div class="small-image-box">
                                    <img src="{{ $baseUrl }}/{{ $product['big_image'] }}" alt="">
                                    <div class="open-icon">
                                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M41.8047 2.0166H6.55469C5.38647 2.01788 4.26647 2.48253 3.44042 3.30858C2.61436 4.13463 2.14972 5.25464 2.14844 6.42285V21.1104C2.14844 21.4999 2.30318 21.8735 2.57862 22.1489C2.85407 22.4244 3.22765 22.5791 3.61719 22.5791C4.00672 22.5791 4.38031 22.4244 4.65575 22.1489C4.93119 21.8735 5.08594 21.4999 5.08594 21.1104V6.42285C5.08644 6.03347 5.24135 5.66018 5.51668 5.38485C5.79202 5.10951 6.16531 4.95461 6.55469 4.9541H41.8047C42.1941 4.95461 42.5674 5.10951 42.8427 5.38485C43.118 5.66018 43.2729 6.03347 43.2734 6.42285V41.6729C43.2729 42.0622 43.118 42.4355 42.8427 42.7109C42.5674 42.9862 42.1941 43.1411 41.8047 43.1416H27.1172C26.7277 43.1416 26.3541 43.2963 26.0786 43.5718C25.8032 43.8472 25.6484 44.2208 25.6484 44.6104C25.6484 44.9999 25.8032 45.3735 26.0786 45.6489C26.3541 45.9244 26.7277 46.0791 27.1172 46.0791H41.8047C42.9729 46.0778 44.0929 45.6132 44.919 44.7871C45.745 43.9611 46.2097 42.8411 46.2109 41.6729V6.42285C46.2097 5.25464 45.745 4.13463 44.919 3.30858C44.0929 2.48253 42.9729 2.01788 41.8047 2.0166Z" fill="#C0C0C0" />
                                            <path d="M6.55469 46.0791H18.3047C19.4729 46.0778 20.5929 45.6132 21.419 44.7871C22.245 43.9611 22.7097 42.8411 22.7109 41.6729V29.9229C22.7097 28.7546 22.245 27.6346 21.419 26.8086C20.5929 25.9825 19.4729 25.5179 18.3047 25.5166H6.55469C5.38647 25.5179 4.26647 25.9825 3.44042 26.8086C2.61436 27.6346 2.14972 28.7546 2.14844 29.9229V41.6729C2.14972 42.8411 2.61436 43.9611 3.44042 44.7871C4.26647 45.6132 5.38647 46.0778 6.55469 46.0791ZM5.08594 29.9229C5.08644 29.5335 5.24135 29.1602 5.51668 28.8848C5.79202 28.6095 6.16531 28.4546 6.55469 28.4541H18.3047C18.6941 28.4546 19.0674 28.6095 19.3427 28.8848C19.618 29.1602 19.7729 29.5335 19.7734 29.9229V41.6729C19.7729 42.0622 19.618 42.4355 19.3427 42.7109C19.0674 42.9862 18.6941 43.1411 18.3047 43.1416H6.55469C6.16531 43.1411 5.79202 42.9862 5.51668 42.7109C5.24135 42.4355 5.08644 42.0622 5.08594 41.6729V29.9229Z" fill="#C0C0C0" />
                                            <path d="M24.6097 23.6175C24.89 23.8835 25.2617 24.0317 25.6481 24.0317C26.0345 24.0317 26.4062 23.8835 26.6865 23.6175L35.9294 14.3748V18.1729C35.9294 18.5624 36.0841 18.936 36.3596 19.2114C36.635 19.4869 37.0086 19.6416 37.3981 19.6416C37.7877 19.6416 38.1612 19.4869 38.4367 19.2114C38.7121 18.936 38.8669 18.5624 38.8669 18.1729V10.8291C38.8608 10.4415 38.7041 10.0714 38.43 9.79724C38.1558 9.5231 37.7858 9.36641 37.3981 9.36035H30.0544C29.6648 9.36035 29.2913 9.51509 29.0158 9.79054C28.7404 10.066 28.5856 10.4396 28.5856 10.8291C28.5856 11.2186 28.7404 11.5922 29.0158 11.8677C29.2913 12.1431 29.6648 12.2979 30.0544 12.2979H33.8524L24.6097 21.5407C24.3344 21.8161 24.1797 22.1896 24.1797 22.5791C24.1797 22.9686 24.3344 23.3421 24.6097 23.6175Z" fill="#C0C0C0" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            <a href="{{route('contact')}}" class="button green">Buy this product</a>
                            {{-- @if (Auth::user())
                                <a href="{{ route('user.product.detail', ['id' => $product->id]) }}"
                                    class="button green">Buy this product</a>
                            @else
                                <a href="#sign-in" data-id="{{ $product->id }}"
                                    data-route="{{ route('user.product.detail', ['id' => $product->id]) }}"
                                    class="popup-link button green">Buy this product</a>
                            @endif --}}
                        </div>
                    </div>

                    <div class="descr">
                        <h4>{{ $product['name'] }} has the following pharmacological actions:</h4>
                        <hr>
                        <!-- <p>{!! $product['description'] !!}</p> -->
                        <p><b>Linear and skeletal growth (Primary action):</b>
                            <br>Somaheal&trade; operates by activating specific growth hormone receptors present in chondrocytes, osteoblasts, hepatocytes, adipocytes, and fibroblasts. These receptors are also found in other tissues, including the brain and gastrointestinal tract, where the role of growth hormone remains unclear. The Growth Hormone stimulates skeletal and soft tissue growth by facilitating cell division, amino acid uptake, and protein synthesis. Its effects are primarily mediated by hepatic and peripheral insulin-like growth factor-1 (IGF-1) production, resulting in:
                        </p>

                        <ul class="custom-desc">
                            <li>Skeletal growth in pediatric patients with growth hormone deficiency, impacting the epiphyseal growth plates of long bones and increasing the growth rate and IGF-1 levels comparable to human growth hormone.</li>
                            <li>An increase in the number and size of muscle cells.</li>
                            <li>Augmentation of internal organ size and red cell mass.</li>
                            <li>Elevated cellular protein synthesis, leading to a positive nitrogen balance, as evidenced by a decrease in urinary nitrogen excretion and blood urea nitrogen (BUN).</li>
                        </ul>

                        <p><b>Carbohydrate metabolism:</b>
                            <br>Somaheal&#39;s actions are primarily mediated by hepatic and peripheral insulin-like growth factor-1 (IGF-1) production, resulting in immediate but brief insulin-like effects followed by more substantial anti-insulin-like effects. These include decreased glucose utilization (hyperglycemia) and lipolysis within 2-4 hours. While large doses of Somaheal&trade; may impair glucose tolerance and induce insulin resistance, the exact mechanism is not fully understood. In children with hypopituitarism, fasting hypoglycemia may be improved by growth hormone therapy. In non-growth hormone-deficient short children, Somaheal&trade; may induce hyperinsulinemia without impairing glucose tolerance.
                        </p>
                        <p>&nbsp;</p>

                        <p><b>Lipid metabolism:</b>
                            <br>Somaheal&trade; administration leads to a reduction in body fat stores, mobilization of lipid stores, and an increase in plasma fatty acids due to its anti-insulin-like effect. This lipolytic effect is observed in growth hormone-deficient children during the initial months of treatment, resulting in the loss of subcutaneous fat. Patients receiving Somaheal&trade; may experience a decrease in mean cholesterol levels. Mineral Metabolism: Somaheal&trade; induces the retention of sodium, potassium, and phosphates, believed to be linked to cell growth. Growth-hormone deficient patients exhibit an increase in serum inorganic phosphate after Somaheal&trade; administration, attributed to metabolic activity associated with bone growth and increased tubular reabsorption of phosphate by the kidneys. Serum calcium remains largely unaffected, with an increase in urinary calcium excretion offset by a simultaneous rise in its absorption from the intestine.
                        </p>
                        <p>&nbsp;</p>

                        <p><b>Connective tissue metabolism:</b>
                            <br>Somaheal&trade; stimulates the synthesis of chondroitin sulfate and collagen, along with increased urinary excretion of hydroxyproline.
                        </p>
                        <p>&nbsp;</p>

                        <p><b>Product efficiency:</b></p>

                        <ul class="custom-desc">
                            <li>Nurture healthy growth in children with growth hormone deficiency, ensuring a promising future with our long-term treatment approach.</li>
                            <li>Combat metabolic diseases and AIDS-related wasting, providing a holistic solution to promote overall well-being.</li>
                            <li>Address Prader-Willi syndrome in children with growth deficiencies, fostering a balanced and healthier lifestyle.</li>
                            <li>Tackle intrauterine growth retardation and short stature, supporting continued growth and development after birth.</li>
                            <li>Empower adults dealing with growth hormone deficiency (GHD), enabling them to lead an active and fulfilling life.</li>
                            <li>Facilitate long-term treatment for patients with Turner syndrome, promoting comprehensive care and well-being.</li>
                            <li>Support individuals with idiopathic short stature, addressing growth concerns and enhancing self-confidence.</li>
                            <li>Provide relief for those dealing with short bowel syndrome, contributing to improved digestive health.</li>
                            <li>Aid in pediatric renal transplantation cases by addressing growth-related concerns before renal failure.</li>
                            <li>Combat SHOX gene deficiency, offering targeted solutions for improved growth and overall health.</li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="product-bottom-section">
                <div class="container">
                    <div class="bottom-box">
                        <h3 class="head-3 center">Check authenticity.</h3>
                        <div class="bottom-btns">
                            <a href="{{ route('frontend.authenticity') }}" class="button blue">Authenticate Product</a>
                        </div>

                        <div class="bottom-image">
                            <img src="{{ $baseUrl1 }}img/products-bottom.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        $('.popup-link').magnificPopup({
            type: 'image'
        });

        document.addEventListener("DOMContentLoaded", function() {
            var shareButton = document.getElementById("shareButton");

            shareButton.addEventListener("click", function() {
                if (isMobile()) {
                    // Open sharing options for mobile
                    openMobileShareMenu();
                } else {
                    // Copy the URL to clipboard for desktop
                    copyToClipboard(window.location.href);
                }
            });

            function isMobile() {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            }

            function openMobileShareMenu() {
                // Implement code to open sharing options on mobile (e.g., using share APIs)
                // Example: You can use the Web Share API for modern browsers
                if (navigator.share) {
                    navigator.share({
                        title: "Share this page",
                        url: window.location.href
                    }).then(() => {
                        console.log("Shared successfully.");
                    }).catch((error) => {
                        console.error("Error sharing:", error);
                    });
                } else {
                    // Fallback for browsers that do not support Web Share API
                    // Implement your custom sharing logic or use a third-party sharing library
                    alert("Share functionality not supported on this device.");
                }
            }

            function copyToClipboard(text) {
                var textArea = document.createElement("textarea");
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("copy");
                document.body.removeChild(textArea);
                toastr.success("URL copied to clipboard!");
            }
        });
    </script>
@endsection
