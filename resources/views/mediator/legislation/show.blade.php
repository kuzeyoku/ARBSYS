@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Anasayfa</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('legislation.index') }}">İlgili Mevzuat</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $legislation->title }}</li>
                        </ol>
                    </nav>
                </div>
                @if ($otherLegislations->count() > 0)
                    <div class="kt-subheader__toolbar">
                        <div class="kt-subheader__wrapper">
                            <div class="dropdown dropdown-inline" data-toggle-="kt-tooltip" title="Quick actions"
                                data-placement="left">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                        class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                            <path
                                                d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z"
                                                fill="#000000"></path>
                                        </g>
                                    </svg> Diğer Mevzuatlar
                                </a>
                                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                                    <ul class="kt-nav">
                                        @foreach ($otherLegislations as $item)
                                            <li class="kt-nav__item">
                                                <a href="{{ route('legislation.show', [$item->id, $item->slug]) }}"
                                                    class="kt-nav__link">
                                                    <span class="kt-nav__link-text">{{ $item->title }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="kt-container kt-grid__item">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{ $legislation->title }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-12">
                            {!! $legislation->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
