@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        @include('layout.breadcrumb', ['url' => [null => 'Faydalı Bağlantılar']])
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-4">
                    <a href="https://adb.adalet.gov.tr/Home/ArabulucuListesi" target="_blank">
                        <div class="kt-portlet kt-iconbox">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M5.74714567,17.0425758 C4.09410362,15.9740356 3,14.1147886 3,12 C3,8.6862915 5.6862915,6 9,6 C11.7957591,6 14.1449096,7.91215918 14.8109738,10.5 L17.25,10.5 C19.3210678,10.5 21,12.1789322 21,14.25 C21,16.3210678 19.3210678,18 17.25,18 L8.25,18 C7.28817895,18 6.41093178,17.6378962 5.74714567,17.0425758 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Güncel Arabulucular Listesi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://adb.adalet.gov.tr/Home/SSSorularDetay/4" target="_blank">
                        <div class="kt-portlet kt-iconbox">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "
                                                    x="16.3255682" y="2.94551858" width="3" height="18"
                                                    rx="1" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Adliye Arabuluculuk Büroları İletişim</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://adb.adalet.gov.tr/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M18,16 L9,16 C8.44771525,16 8,15.5522847 8,15 C8,14.4477153 8.44771525,14 9,14 L17,14 C17.5522847,14 18,13.5522847 18,13 C18,12.4477153 17.5522847,12 17,12 L9,12 C7.34314575,12 6,13.3431458 6,15 C6,16.6568542 7.34314575,18 9,18 L19.5,18 C21,18 21,18.5 21,19 C21,19.5 21,20 19.5,20 L7,20 C4.790861,20 3,18.209139 3,16 L3,8 C3,5.790861 4.790861,4 7,4 L17,4 C19.209139,4 21,5.790861 21,8 L21,13.0000005 C21,14.6568542 19.6568542,16 18,16 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Arabuluculuk
                                                Daire Başkanlığı</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.adalet.gov.tr/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--wave">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z"
                                                    fill="#000000" />
                                                <path
                                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Adalet
                                                Bakanlığı</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.resmigazete.gov.tr/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--animate">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M10.5,8 L6,19 C6.0352633,19.1332661 6.06268417,19.2312688 6.08226261,19.2940083 C6.43717645,20.4313361 8.07642225,21 9,21 C10.5,21 11,19 12.5,19 C14,19 14.5917308,20.9843119 16,21 C16.9388462,21.0104588 17.9388462,20.3437921 19,19 L14.5,8 L10.5,8 Z"
                                                    fill="#000000" />
                                                <path d="M11.3,6 L12.5,3 L13.7,6 L11.3,6 Z M14.5,8 L10.5,8 L14.5,8 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Resmi Gazete</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.ticaretsicil.gov.tr/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                                <path
                                                    d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                    fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Türkiye Ticaret Sicil Gazetesi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://giris.turkiye.gov.tr/Giris/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slow">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M12.9863016,8.83409843 C12.9953113,8.88805868 13,8.94348179 13,9 L13,11 L17,11 C18.1045695,11 19,11.8954305 19,13 L19,16 L5,16 L5,13 C5,11.8954305 5.8954305,11 7,11 L11,11 L11,9 C11,8.94348179 11.0046887,8.88805868 11.0136984,8.83409843 C9.84135601,8.42615464 9,7.31133193 9,6 C9,4.34314575 10.3431458,3 12,3 C13.6568542,3 15,4.34314575 15,6 C15,7.31133193 14.158644,8.42615464 12.9863016,8.83409843 Z"
                                                    fill="#000000" />
                                                <rect fill="#000000" opacity="0.3" x="5" y="18" width="14"
                                                    height="2" rx="1" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">E-Devlet</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.turkiye.gov.tr/sgk-tescil-ve-hizmet-dokumu" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                <path
                                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path
                                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                    fill="#000000" fill-rule="nonzero" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">SGK Tescil ve Hizmet Dökümü</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://www.kaysis.gov.tr/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                            class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M5,5 L19,5 C19.5522847,5 20,5.44771525 20,6 C20,6.55228475 19.5522847,7 19,7 L5,7 C4.44771525,7 4,6.55228475 4,6 C4,5.44771525 4.44771525,5 5,5 Z M5,13 L19,13 C19.5522847,13 20,13.4477153 20,14 C20,14.5522847 19.5522847,15 19,15 L5,15 C4.44771525,15 4,14.5522847 4,14 C4,13.4477153 4.44771525,13 5,13 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M5,9 L19,9 C19.5522847,9 20,9.44771525 20,10 C20,10.5522847 19.5522847,11 19,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L19,17 C19.5522847,17 20,17.4477153 20,18 C20,18.5522847 19.5522847,19 19,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Kaysis</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://mersis.gtb.gov.tr" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            version="1.0" id="Layer_1" width="800px" height="800px"
                                            viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                                            <path fill="#ffc107"
                                                d="M60,52V4c0-2.211-1.789-4-4-4H14v51v3h42v8H10c-2.209,0-4-1.791-4-4s1.791-4,4-4h2v-3V0H8  C5.789,0,4,1.789,4,4v54c0,3.313,2.687,6,6,6h49c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1v-8C59.104,54,60,53.104,60,52z M23,14h12  c0.553,0,1,0.447,1,1s-0.447,1-1,1H23c-0.553,0-1-0.447-1-1S22.447,14,23,14z M42,28H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h19  c0.553,0,1,0.447,1,1S42.553,28,42,28z M49,22H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h26c0.553,0,1,0.447,1,1S49.553,22,49,22z" />
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">Mersis</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="https://pttkep.gov.tr/" target="_blank">
                        <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            version="1.0" id="Layer_1" width="800px" height="800px"
                                            viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                                            <path fill="#ffc107"
                                                d="M60,52V4c0-2.211-1.789-4-4-4H14v51v3h42v8H10c-2.209,0-4-1.791-4-4s1.791-4,4-4h2v-3V0H8  C5.789,0,4,1.789,4,4v54c0,3.313,2.687,6,6,6h49c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1v-8C59.104,54,60,53.104,60,52z M23,14h12  c0.553,0,1,0.447,1,1s-0.447,1-1,1H23c-0.553,0-1-0.447-1-1S22.447,14,23,14z M42,28H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h19  c0.553,0,1,0.447,1,1S42.553,28,42,28z M49,22H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h26c0.553,0,1,0.447,1,1S49.553,22,49,22z" />
                                        </svg>
                                    </div>
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                        </h3>
                                        <div class="kt-iconbox__content">
                                            <p class="kt-link">PTT Kep</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                        <div class="kt-portlet__body">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.0" id="Layer_1" width="800px" height="800px" viewBox="0 0 64 64"
                                        enable-background="new 0 0 64 64" xml:space="preserve">
                                        <path fill="#ffc107"
                                            d="M60,52V4c0-2.211-1.789-4-4-4H14v51v3h42v8H10c-2.209,0-4-1.791-4-4s1.791-4,4-4h2v-3V0H8  C5.789,0,4,1.789,4,4v54c0,3.313,2.687,6,6,6h49c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1v-8C59.104,54,60,53.104,60,52z M23,14h12  c0.553,0,1,0.447,1,1s-0.447,1-1,1H23c-0.553,0-1-0.447-1-1S22.447,14,23,14z M42,28H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h19  c0.553,0,1,0.447,1,1S42.553,28,42,28z M49,22H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h26c0.553,0,1,0.447,1,1S49.553,22,49,22z" />
                                    </svg>
                                </div>
                                <div class="kt-iconbox__desc">
                                    <h3 class="kt-iconbox__title">
                                    </h3>
                                    <div class="kt-iconbox__content">
                                        <button class="btn kt-link view-pdf" pdf-link="{{ asset('uploads/barolar.pdf') }}"
                                            data-toggle="modal" data-target="#myModal">Baro İletişim Bilgileri</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                        <div class="kt-portlet__body">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.0" id="Layer_1" width="800px" height="800px" viewBox="0 0 64 64"
                                        enable-background="new 0 0 64 64" xml:space="preserve">
                                        <path fill="#ffc107"
                                            d="M60,52V4c0-2.211-1.789-4-4-4H14v51v3h42v8H10c-2.209,0-4-1.791-4-4s1.791-4,4-4h2v-3V0H8  C5.789,0,4,1.789,4,4v54c0,3.313,2.687,6,6,6h49c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1v-8C59.104,54,60,53.104,60,52z M23,14h12  c0.553,0,1,0.447,1,1s-0.447,1-1,1H23c-0.553,0-1-0.447-1-1S22.447,14,23,14z M42,28H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h19  c0.553,0,1,0.447,1,1S42.553,28,42,28z M49,22H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h26c0.553,0,1,0.447,1,1S49.553,22,49,22z" />
                                    </svg>
                                </div>
                                <div class="kt-iconbox__desc">
                                    <h3 class="kt-iconbox__title">
                                    </h3>
                                    <div class="kt-iconbox__content">
                                        <button class="btn kt-link view-pdf"
                                            pdf-link="{{ asset('uploads/adliye_arabuluculuk_burolari_iletisim.pdf') }}"
                                            data-toggle="modal" data-target="#myModal">Adliye Arabuluculuk Büroları
                                            İletişim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-fast">
                        <div class="kt-portlet__body">
                            <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.0" id="Layer_1" width="800px" height="800px" viewBox="0 0 64 64"
                                        enable-background="new 0 0 64 64" xml:space="preserve">
                                        <path fill="#ffc107"
                                            d="M60,52V4c0-2.211-1.789-4-4-4H14v51v3h42v8H10c-2.209,0-4-1.791-4-4s1.791-4,4-4h2v-3V0H8  C5.789,0,4,1.789,4,4v54c0,3.313,2.687,6,6,6h49c0.553,0,1-0.447,1-1s-0.447-1-1-1h-1v-8C59.104,54,60,53.104,60,52z M23,14h12  c0.553,0,1,0.447,1,1s-0.447,1-1,1H23c-0.553,0-1-0.447-1-1S22.447,14,23,14z M42,28H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h19  c0.553,0,1,0.447,1,1S42.553,28,42,28z M49,22H23c-0.553,0-1-0.447-1-1s0.447-1,1-1h26c0.553,0,1,0.447,1,1S49.553,22,49,22z" />
                                    </svg>
                                </div>
                                <div class="kt-iconbox__desc">
                                    <h3 class="kt-iconbox__title">
                                    </h3>
                                    <div class="kt-iconbox__content">
                                        <button class="btn kt-link view-pdf"
                                            pdf-link="{{ asset('uploads/savcilik_idari_isler_vergi_numaralari.pdf') }}"
                                            data-toggle="modal" data-target="#myModal">Savcılık İdari İşler Vergi
                                            Numaraları</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>
    <div id="pdfModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <embed id="pdf-viewer" src="" frameborder="0" width="100%" height="800px"
                        sandbox="">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.view-pdf').on("click", function() {
                var pdf_link = $(this).attr('pdf-link');
                $('#pdf-viewer').attr('src', pdf_link + '#toolbar=0&navpanes=0&scrollbar=0&zoom=150');
                $('#pdfModal').modal('show');
            });
        });
    </script>
@endsection
@section('style')
@endsection
