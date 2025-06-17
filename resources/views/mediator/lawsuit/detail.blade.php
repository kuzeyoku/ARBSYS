<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                <h3 class="kt-portlet__head-title">
                    Dosya Detayları
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body py-4 px-4">
            <div class="row">
                <!-- SOL PANEL -->
                <div class="col-md-4">
                    <!-- Uyuşmazlık Türü -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Uyuşmazlık Türü</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="font-weight-bold">Uyuşmazlık Dava Şartı Kapsamında mı?</label>
                                <p class="mb-2">{{$lawsuit->lawsuit_type->name}}</p>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Uyuşmazlık Türü</label>
                                <p class="mb-2">{{$lawsuit->lawsuit_subject_type->name}}</p>
                            </div>
                            <div class="mb-3">
                                <label class="font-weight-bold">Uyuşmazlık Konusu</label>
                                <p class="mb-0">{{$lawsuit->lawsuit_subject->name}}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dosya Tarihleri -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Dosya Tarihleri</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="font-weight-bold small">BAŞVURU DOSYA NO</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar mr-2"></i>
                                        <span>{{$lawsuit->application_document_no}}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="font-weight-bold small">YIL</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar mr-2"></i>
                                        <span>2025</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="font-weight-bold small">KALAN SÜRE</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span class="font-weight-bold">{!! $lawsuit->remaining_date!!}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="font-weight-bold small">BAŞVURU TARİHİ</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar mr-2"></i>
                                        <span class="small">{{$lawsuit->application_date}}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="font-weight-bold small">GÖREVIN KABUL TARİHİ</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar mr-2"></i>
                                        <span class="small">{{$lawsuit->job_date}}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="font-weight-bold small">SON TARİH</label>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar mr-2"></i>
                                       {!! $lawsuit->dead_line["code"] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- İletişim Bilgileri ve Logları -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">İletişim Bilgileri ve Logları</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Kişi</th>
                                        <th>Telefon</th>
                                        <th>SMS</th>
                                        <th>Eposta</th>
                                        <th>Kargo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="font-weight-bold">BAŞVURUCU</td>
                                        <td colspan="4"></td>
                                    </tr>

                                    @foreach($lawsuit->claimants() as $claimant)
                                        <tr>
                                            <td>
                                                <i class="fas fa-user mr-2"></i>
                                                {{ $claimant->detail->name }}
                                            </td>

                                            <td>{!! $claimant->hasComminication("phone") !!}</td>
                                            <td>{!! $claimant->hasComminication("sms") !!}</td>
                                            <td>{!! $claimant->hasComminication("email") !!}</td>
                                            <td>{!! $claimant->hasComminication("cargo") !!}</td>
                                        </tr>
                                        @if($claimant->sub_sides())
                                            @foreach($claimant->sub_sides() as $subSide)
                                                <tr>
                                                    <td class="font-weight-bold">VEKİLİ</td>
                                                    <td colspan="4"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fas fa-user mr-2"></i>
                                                        {{$subSide->detail->name}}
                                                    </td>
                                                    <td><i class="fas fa-check text-success"></i></td>
                                                    <td><i class="fas fa-square text-muted"></i></td>
                                                    <td><i class="fas fa-square text-muted"></i></td>
                                                    <td><i class="fas fa-check text-success"></i></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @foreach($lawsuit->defendants() as $defendant)
                                        <tr>
                                            <td class="font-weight-bold">DİĞER TARAF</td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fas fa-building mr-2"></i>{{$defendant->detail->name}}
                                            </td>
                                            <td>{!! $defendant->hasComminication("phone") !!}</td>
                                            <td>{!! $defendant->hasComminication("sms") !!}</td>
                                            <td>{!! $defendant->hasComminication("email") !!}</td>
                                            <td>{!! $defendant->hasComminication("cargo") !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ORTA PANEL - Dosyanın Evrakları -->
                <div class="col-md-5">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Dosyanın Evrakları</h6>
                        </div>
                        {{$lawsuit->lawsuit_subject->document_templates}}
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                    <tr class="@if($lawsuit->hasDocument(1)) table-success @endif">
                                        <td>
                                            <a href="{{route("invitation_letter.create",$lawsuit)}}"
                                               class="btn @if($lawsuit->hasDocument(1)) btn-success @else btn-outline-secondary @endif btn-sm mr-2">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                            Davet Mektubu
                                        </td>
                                        <td class="text-right text-white">
                                            @if($lawsuit->hasDocument(1))
                                                <button class="btn btn-sm btn-primary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(1))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(1))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <a class="btn btn-sm btn-primary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <a class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="@if($lawsuit->hasDocument(2)) table-success @endif">
                                        <td>
                                            <a href="{{route("arbiter_process_info_protocol.create",$lawsuit)}}"
                                               class="btn @if($lawsuit->hasDocument(2)) btn-success @else btn-outline-secondary @endif btn-sm mr-2">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                            Arabuluculuk Bilgilendirme Tutanağı
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(2))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="{{route("kvkk.create",$lawsuit)}}"
                                               class="btn @if($lawsuit->hasDocument(3)) btn-success @else btn-outline-secondary @endif btn-sm mr-2">
                                                <i class="fas fa-plus-circle"></i>
                                            </a>
                                            KVKK Bilgilendirme Tutanağı Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(3))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(3))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(3))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Arabulucu Belirleme Tutanağı')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Arabulucu Belirleme Tutanağı Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(4))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Toplantı Tutanağı')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Toplantı Tutanağı Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(5))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Anlaşma Belgesi')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Anlaşma Belgesi Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(6))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Ücret Sözleşmesi')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Ücret Sözleşmesi Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(7))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Son Tutanak')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Son Tutanak Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(8))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Yetki İtirazı Üst Yazı')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Yetki İtirazı Üst Yazı Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(9))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="createDocument('Yetki Belgesi')">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Yetki Belgesi Oluştur
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(10))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-secondary btn-sm mr-2"
                                                    onclick="addCustomDocument()">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                            Evrak Ekle
                                        </td>
                                        <td class="text-right">
                                            @if($lawsuit->hasDocument(11))
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1 print-btn"
                                                        data-url="{{route("document.getcontent",$lawsuit->getDocument(2))}}">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-secondary mr-1">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SAĞ PANEL -->
                <div class="col-md-3">
                    <!-- Butonlar -->
                    <div class="d-flex flex-column mb-3">
                        <a href="{{route("lawsuit.edit",$lawsuit)}}" class="btn btn-primary mb-2">Dosyayı Bilgileri
                            Düzenle</a>
                        <button class="btn btn-primary mb-2">Tarafları Düzenle</button>
                        <button class="btn btn-primary mb-2">İletişim Logları</button>
                        <button class="btn btn-primary mb-2">Dosya Notlarım</button>
                        <button class="btn btn-danger mb-2">Dosyayı Sil</button>
                        <button class="btn btn-primary mb-2">Dosyayı Arşivle</button>
                    </div>

                    <!-- Dosya Notlarım -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0">Dosya Notlarım</h6>
                        </div>
                        <div class="card-body">
                            {{Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Dosya ile ilgili notlarınızı buraya yazabilirsiniz...'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>