@extends('layout.main')
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-1" style="background-color: white;">
                            <li class="breadcrumb-item"><a href="/home">Anasayfa</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Arabuluculuk Değişiklik Talepleri</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Liste
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="dataTable">
                        <thead>
                            <tr>
                                <th>Sistem No</th>
                                <th>Ad Soyad</th>
                                <th>Telefon</th>
                                <th>Email</th>
                                <th>Sicil No</th>
                                <th>İban</th>
                                <th>Toplantı Öneri</th>
                                <th>Toplantı Yeri</th>
                                <th style="width:100px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->request_email }}</td>
                                    <td>{{ $user->mediator->registration_no ?? '' }}</td>
                                    <td>{{ $user->mediator->iban ?? '' }}</td>
                                    <td>{{ isset($user->mediator->meeting_address_proposal) && $user->mediator->meeting_address_proposal ? 'Evet' : 'Hayır' }}
                                    </td>
                                    <td>{{ $user->mediator->meeting_address ?? '' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.change_request.confirmation', $user) }}"
                                                class="btn btn-success">Onayla</a>
                                            <button data-url="{{ route('admin.change_request.rejected', $user) }}"
                                                class="btn btn-danger reject_btn">Reddet</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="modal modal-stick-to-bottom fade" tabindex="-1" data-keyboard="false" data-backdrop="static"
                role="dialog" id="reject_modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="reject_form" action="" method="POST">
                            @csrf
                            <input type="hidden" name="user_id">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Değişiklik Talebi Reddetme
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Açıklama</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <textarea class="form-control" name="description" autocomplete="off" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                                <button type="submit" class="btn btn-success">Reddet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Modal-->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("body").delegate(".reject_btn", "click", function() {
            $("#reject_form").attr("action", $(this).data('url'));
            $("#reject_modal").modal("show");
        });
    </script>
@endsection
@section('style')
@endsection
