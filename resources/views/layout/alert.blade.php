@if (session('success'))
    <script>
        swal.fire({
            title: "Başarılı!",
            text: "{{ session('success') }}",
            icon: "success",
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
            icon: "error",
            type: "error",
            confirmButtonClass: 'btn btn-danger',
        });
    </script>
@endif
@if (session('warning'))
    <script>
        swal.fire({
            title: "Uyarı!",
            text: "{{ session('warning') }}",
            icon: "warning",
            type: "warning",
            confirmButtonClass: 'btn btn-warning',
        });
    </script>
@endif
@if (session('info'))
    <script>
        swal.fire({
            title: "Bilgi!",
            text: "{{ session('info') }}",
            icon: "info",
            type: "info",
            confirmButtonClass: 'btn btn-info',
        });
    </script>
@endif