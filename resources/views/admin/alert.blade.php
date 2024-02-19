<div class="kt-container  kt-container--fluid  ">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger mb-1">
                {{ $error }}
            </div>
        @endforeach
    @endif
</div>
@if (session('success'))
    <script>
        swal.fire({
            title: "Başarılı!",
            text: "{{ session('success') }}",
            type: "success",
            confirmButtonClass: 'btn btn-success',
        });
    </script>
@endif
@if (session('error'))
    <script>
        swal.fire({
            title: "Hata!",
            text: "{{ session('error') }}",
            type: "error",
            confirmButtonClass: 'btn btn-danger',
        });
    </script>
@endif
