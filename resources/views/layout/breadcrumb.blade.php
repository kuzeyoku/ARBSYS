<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-1" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                    @foreach ($url as $url => $title)
                        @if ($loop->last)
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
</div>
