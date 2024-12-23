<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ["auth", "mediator"], 'namespace' => 'Mediator'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::view('/ilgili-yargi-kararlari', 'mediator/related_judicial_decisions')->name('related_judicial_decisions');
    Route::view('/yararli-baglantilar', 'mediator/useful_links')->name('useful_links');
    //Route::view('/arabuluculuk-asgari-ucret-tarifesi', 'mediator/calculation/asgari_ucret_tarifesi')->name('asgari_ucret_tarifesi');
    Route::view('/savciliklara-duzenlenecek-makbuz-ornekleri', 'mediator/calculation_tools/savciliklara_duzenlenecek_makbuz_ornekleri')->name("makbuz_ornekleri");

    //Görüş Öneri İşlemleri

    Route::prefix("gorus-oneri")->group(function () {
        Route::get("/", 'SystemRequestController@index')->name("system_request.index");
        Route::post("/store", 'SystemRequestController@store')->name("system_request.store");
    });

    Route::prefix("arabulucu")->group(function () {
        Route::get("/", 'MediatorController@index')->name("mediator.profile");
        Route::put('/{mediator}/guncelle', 'MediatorController@update')->name("mediator.update");
        // Route::post('/password_change', 'MediatorController@password_change');
        // Route::post('/soother_letter_option', 'MediatorController@letter_option_save');
        // Route::post('/soother_logo_save', 'MediatorController@logo_save');
    });

    //Dava Dosyası İşlemleri
    Route::get('/dosyalarim', 'LawsuitController@index')->name('lawsuit.index');
    Route::get('/arsivlenmis-dosyalarim', 'LawsuitController@archive_index')->name('lawsuit.archive_index');
    Route::prefix('lawsuit')->group(function () {
        Route::get('/archive/{lawsuit}', 'LawsuitController@archive')->name("lawsuit.archive");
        Route::get('/un-archive/{lawsuit}', 'LawsuitController@unArchive')->name("lawsuit.unArchive");
        Route::post('/getModalContent', 'LawsuitController@getModalContent')->name("lawsuit.getModalContent");
        Route::post("/getPersonToSideModalContent", 'LawsuitController@getPersonToSideModalContent')->name("lawsuit.getPersonToSideModalContent");
    });

    Route::get('/bildirimler', 'NotificationController@index')->name("notification.index");
    Route::get('/{notification}/okundu-olarak-isaretle', 'NotificationController@update')->name("notification.read");

    Route::prefix("dosya")->group(function () {
        Route::name("lawsuit.")->group(function () {
            Route::get("yeni", [App\Http\Controllers\Mediator\LawsuitController::class, "create"])->name("create");
            Route::post("kaydet", [App\Http\Controllers\Mediator\LawsuitController::class, "store"])->name("store");
            Route::get("{lawsuit}/duzenle", [App\Http\Controllers\Mediator\LawsuitController::class, "edit"])->name("edit");
            Route::put("{lawsuit}/guncelle", [App\Http\Controllers\Mediator\LawsuitController::class, "update"])->name("update");
            Route::delete("{lawsuit}/sil", [App\Http\Controllers\Mediator\LawsuitController::class, "destroy"])->name("destroy");
            Route::match(["get", "post"], "raporlama", [App\Http\Controllers\Mediator\LawsuitController::class, "report"])->name("report");
            Route::get("{lawsuit}/evraklar", [App\Http\Controllers\Mediator\DocumentController::class, "index"])->name("document");
            Route::get("{lawsuit}/notlar", [App\Http\Controllers\Mediator\LawsuitController::class, "noteView"])->name("note_view");
            Route::post("{lawsuit}/not-kaydet", [App\Http\Controllers\Mediator\LawsuitController::class, "noteSave"])->name("note.save");
            Route::post("udf-oku", [App\Http\Controllers\Mediator\LawsuitController::class, "saveWithFile"])->name("save_with_file");
            Route::post("confirm_udf", [App\Http\Controllers\Mediator\LawsuitController::class, "confirm_udf"])->name("confirm_udf");
            Route::get("dosya-tipleri", [App\Http\Controllers\Mediator\LawsuitController::class, "getTypes"])->name("get_types");
            Route::get("{lawsuit}/loglar", [App\Http\Controllers\Mediator\Logs::class, "index"])->name("logs");
            Route::get("{lawsuit}/taraflar", [App\Http\Controllers\Mediator\SideController::class, "index"])->name("sides");
        });

        //TUTANAKLAR
        //Davet Mektubu
        Route::name("invitation_letter.")->group(function () {
            Route::get('/{lawsuit}/davet-mektubu-olustur', [App\Http\Controllers\Mediator\InvitationLetterController::class, "create"])->name('create');
            Route::post('/{lawsuit}/davet-mektubu-kaydet', [App\Http\Controllers\Mediator\InvitationLetterController::class, "store"])->name('store');
            Route::post('/{lawsuit}/davet-mektubu-onizle', [App\Http\Controllers\Mediator\InvitationLetterController::class, "preview"])->name('preview');

        });

        //KVKK Belgesi
        Route::name("kvkk.")->group(function () {
            Route::get('/{lawsuit}/kvkk-belgesi-olustur', [App\Http\Controllers\Mediator\KvkkController::class, "create"])->name('create');
            Route::post('/{lawsuit}/kvkk-belgesi-kaydet', [App\Http\Controllers\Mediator\KvkkController::class, "store"])->name('store');
            Route::post('/{lawsuit}/kvkk-belgesi-onizle', [App\Http\Controllers\Mediator\KvkkController::class, "preview"])->name('preview');
        });

        //Bilgilendirme Tutanağı
        Route::name("arbiter_process_info_protocol.")->group(function () {
            Route::get('/{lawsuit}/bilgilendirme-tutanagi-olustur', [App\Http\Controllers\Mediator\ArbiterProcessInfoProtocolController::class, "create"])->name('create');
            Route::post('/{lawsuit}/bilgilendirme-tutanagi-kaydet', [App\Http\Controllers\Mediator\ArbiterProcessInfoProtocolController::class, "store", "store"])->name('store');
            Route::post('/{lawsuit}/bilgilendirme-tutanagi-onizle', [App\Http\Controllers\Mediator\ArbiterProcessInfoProtocolController::class, "preview", "preview"])->name('preview');
        });

        //Arabulucu Belirleme Tutanağı
        Route::name("arbiter_define_protocol.")->group(function () {
            Route::get('/{lawsuit}/arabulucu-belirleme-tutanagi-olustur', [App\Http\Controllers\Mediator\ArbiterDefineProtocolController::class, "create"])->name('create');
            Route::post('/{lawsuit}/arabulucu-belirleme-tutanagi-kaydet', [App\Http\Controllers\Mediator\ArbiterDefineProtocolController::class, "store"])->name('store');
            Route::post('/{lawsuit}/arabulucu-belirleme-tutanagi-onizle', [App\Http\Controllers\Mediator\ArbiterDefineProtocolController::class, "preview"])->name('preview');
        });

        //İlk Toplantı Tutanağı
        Route::name("meeting_protocol.")->group(function () {
            Route::get('/{lawsuit}/ilk-toplanti-tutanagi-olustur', [App\Http\Controllers\Mediator\MeetingProtocolController::class, "create"])->name('create');
            Route::post('/{lawsuit}/ilk-toplanti-tutanagi-kaydet', [App\Http\Controllers\Mediator\MeetingProtocolController::class, "store"])->name('store');
            Route::post('/{lawsuit}/ilk-toplanti-tutanagi-onizle', [App\Http\Controllers\Mediator\MeetingProtocolController::class, "preview"])->name('preview');
        });

        //Anlaşma Belgesi
        Route::name("agreement_document.")->group(function () {
            Route::get('/{lawsuit}/anlasma-belgesi-olustur', [App\Http\Controllers\Mediator\AgreementDocumentController::class, "create"])->name('create');
            Route::post('/{lawsuit}/anlasma-belgesi-kaydet', [App\Http\Controllers\Mediator\AgreementDocumentController::class, "store"])->name('store');
            Route::post('/{lawsuit}/anlasma-belgesi-onizle', [App\Http\Controllers\Mediator\AgreementDocumentController::class, "preview"])->name('preview');
        });

        //Ücret Sözlesmesi
        Route::name("wage_agreement.")->group(function () {
            Route::get('/{lawsuit}/ucret-sozlesmesi-olustur', [App\Http\Controllers\Mediator\WageAgreementController::class, "create"])->name('create');
            Route::post('/{lawsuit}/ucret-sozlesmesi-kaydet', [App\Http\Controllers\Mediator\WageAgreementController::class, "store"])->name('store');
            Route::post('/{lawsuit}/ucret-sozlesmesi-onizle', [App\Http\Controllers\Mediator\WageAgreementController::class, "preview"])->name('preview');
            Route::post("/wage_agreement_aaut_first", [App\Http\Controllers\Mediator\WageAgreementController::class, "aautFirst"])->name('aaut_first');
            Route::post("/wage_agreement_aaut_second", [App\Http\Controllers\Mediator\WageAgreementController::class, "aautSecond"])->name('aaut_second');
        });

        //Son Tutanak
        Route::name("final_protocol.")->group(function () {
            Route::get('/{lawsuit}/son-tutanak-olustur', [App\Http\Controllers\Mediator\FinalProtocolController::class, "create"])->name('create');
            Route::post('/{lawsuit}/son-tutanak-kaydet', [App\Http\Controllers\Mediator\FinalProtocolController::class, "store"])->name('store');
            Route::post('/{lawsuit}/son-tutanak-onizle', [App\Http\Controllers\Mediator\FinalProtocolController::class, "preview"])->name('preview');
        });

        //Yetki İtirazı Üst Yazı'
        Route::name("authority_objection.")->group(function () {
            Route::get('/{lawsuit}/yetki-itirazi-ust-yazi-olustur', [App\Http\Controllers\Mediator\AuthorityObjectionController::class, "create"])->name('create');
            Route::post('/{lawsuit}/yetki-itirazi-ust-yazi-kaydet', [App\Http\Controllers\Mediator\AuthorityObjectionController::class, "store"])->name('store');
            Route::post('/{lawsuit}/yetki-itirazi-ust-yazi-onizle', [App\Http\Controllers\Mediator\AuthorityObjectionController::class, "preview"])->name('preview');
        });

        //Yetki Belgesi
        Route::name("authority_document.")->group(function () {
            Route::get('/{lawsuit}/yetki-belgesi-olustur', [App\Http\Controllers\Mediator\AuthorityDocumentController::class, "create"])->name('create');
            Route::post('/{lawsuit}/yetki-belgesi-kaydet', [App\Http\Controllers\Mediator\AuthorityDocumentController::class, "store"])->name('store');
            Route::post('/{lawsuit}/yetki-belgesi-onizle', [App\Http\Controllers\Mediator\AuthorityDocumentController::class, "preview"])->name('preview');
        });
    });

    Route::get("/dosya/{lawsuit}/davet-mektubu", 'InvitationLetterController@show')->name('invitation_letter.show');
    Route::post('/isnull_side_email', 'InvitationLetterController@isNullSideEmail')->name('invitation_letter.isnull_side_email');
    Route::post('/dosya/davet-mektubu/mail-gonder', 'InvitationLetterController@sendEmail')->name('invitation_letter.send_email');
    Route::get('/update_meeting_adress/{name?}', 'InvitationLetterController@updateMeeting');

    Route::get('/lawsuit_subject_types/{lawsuit_type_id}', 'LawsuitController@getSubjectTypes');
    Route::post('/get_lawsuit_subjects', 'LawsuitController@getSubjects')->name("get_lawsuit_subjects");
    Route::get('/lawsuit_subject_all_types', 'LawsuitController@allSubjectTypes');
    Route::post('/lawsuit_process_type_update', 'LawsuitController@processTypeUpdate');
    Route::post('/lawsuit_agreement_type_update', 'LawsuitController@agreementTypeUpdate');
    Route::post('/lawsuit_filter_by_params', 'LawsuitController@filterByParams');

    Route::post('/side_filter_by_params', [App\Http\Controllers\Mediator\SideController::class, "filterByParams"])->name('side.filter');
    Route::post("/side/{side}/edit", [App\Http\Controllers\Mediator\SideController::class, "edit"])->name("mediator.side.edit");
    Route::post("/side/update", [App\Http\Controllers\Mediator\SideController::class, "update"])->name("mediator.side.update");
    Route::post("/side/getEditModalContent", [App\Http\Controllers\Mediator\SideController::class, "getEditModalContent"])->name("side.getEditModalContent");
    Route::get('/side/{side_id}', 'Side\SideController@show')->name('side.show');
    Route::delete('/side/{side}/delete', [App\Http\Controllers\Mediator\SideController::class, "destroy"])->name('mediator.side.destroy');
    // Route::post('/side', 'Side\SideController@store')->name('side.store');
    Route::put('/side/{side_id}', 'Side\SideController@update')->name('side.update');

    Route::prefix("evrak")->group(function () {
        Route::post("/yukle", "DocumentController@fileUpload")->name("document.file_upload");
        Route::get("/{document}/{type}/{side}", "DocumentController@fileDownload")->name("document.file_download");
        Route::delete("/{document}/sil", "DocumentController@destroy")->name("document.destroy");
        Route::post("/{document}/guncelle", "DocumentController@update")->name("document.update");
        Route::get('/{document}/pdf-indir', 'Document\PdfController@index')->name("document.pdf_download");
        Route::get("/{document}/xml-indir", 'Document\XmlController@index')->name("document.xml_download");
        Route::get('/{document}/docx-indir', 'Document\DocxController@index')->name("document.docx_download");
        Route::get("/{document}/icerik", "DocumentController@getcontent")->name("document.getcontent");
    });

    Route::post('/print_side', 'DocumentController@printDocument')->name('document.print_document');
    Route::post('/udf-donusturucu', 'UdfController@create');

    //Kişi İşlemleri
    Route::match(["get", "post"], '/kisilerim', 'PersonController@index')->name('person.index');
    Route::prefix("kisi")->group(function () {
        Route::post('/ekle', 'PersonController@store')->name('person.store');
        Route::post('/{person}/goruntule', 'PersonController@show')->name('person.show');
        Route::post("/duzenle", 'PersonController@edit')->name('person.edit');
        Route::post("/guncelle", 'PersonController@update')->name('person.update');
        Route::delete('/sil', 'PersonController@destroy')->name('person.destroy');
        Route::post("/getModalContent", 'PersonController@getModalContent')->name("person.getModalContent");
        Route::post("/{person}/getEditModalContent", 'PersonController@getEditModalContent')->name("person.getEditModalContent");
    });

    //Hesaplama Araçları
    Route::get('/hesaplama-araclari', 'CalculationToolsController@hesaplama_araclari')->name("calculation.index");
    Route::match(["get", "post"], '/saat-ucreti-aaut-birinci-kisim-hesaplama', 'CalculationToolsController@aaut_birinci_kisim')->name("calculation.aaut_birinci_kisim");
    Route::match(["get", "post"], '/saat-ucreti-aaut-ikinci-kisim-hesaplama', 'CalculationToolsController@aaut_ikinci_kisim')->name("calculation.aaut_ikinci_kisim");
    Route::match(["get", "post"], '/serbest-meslek-makbuzu-hesaplama', 'CalculationToolsController@serbest_meslek_makbuzu_hesaplama')->name("calculation.serbest_meslek_makbuzu");
    Route::get('/dava-sarti-uygulamalarinda-sure-hesaplama', 'CalculationToolsController@dava_sarti_uygulamalarinda_sure_get');
    Route::post('/dava-sarti-uygulamalarinda-sure-hesaplama', 'CalculationToolsController@dava_sarti_uygulamalarinda_sure_post');
    Route::get('/iscilik-alacaklari-ise-iade', 'CalculationToolsController@iscilik_alacaklari_ise_iade');
    Route::post('/iscilik_alacaklari_sayfasi_hesaplama', 'CalculationToolsController@iscilik_alacaklari_ise_iade_hesaplama');
    Route::get('/iscilik_alacaklari_odeme_tablosu', 'CalculationToolsController@iscilik_alacaklari_odeme_tablosu');
    Route::post('/iscilik_alacaklari_odeme_tablosu_hesaplama', 'CalculationToolsController@iscilik_alacaklari_odeme_tablosu_hesaplama');
    Route::get('/iscilik-alacaklari-alacak-kalemleri-tablosu', 'CalculationToolsController@iscilik_alacaklari_alacak_kalemleri_tablosu');
    Route::post('/iscilik_alacaklari_alacak_kalemleri_tablosu_hesaplama', 'CalculationToolsController@iscilik_alacaklari_alacak_kalemleri_tablosu_hesaplama');

    Route::prefix("mevzuat")->group(function () {
        Route::get("/", 'LegislationController@index')->name("legislation.index");
        Route::get("/{legislation}/{slug}", 'LegislationController@show')->name("legislation.show");
    });

    //Bakanlık Görüşleri
    Route::get('/bakanlik-gorusleri', 'MinisteriesOpinionsController@index')->name("ministeries_opinions");

    Route::post("/api/get_mediation_center_address", "DataController@getMediationCenterAddress")->name("get_mediation_center_address");
    Route::post("/api/get_person_data", "DataController@getPersonData")->name("api.get_person_data");
    Route::post("/api/get_lawywer_data", "DataController@getLawyerData")->name("api.get_lawywer_data");
    Route::post("/api/get_company_data", "DataController@getCompanyData")->name("api.get_company_data");
    Route::post("/api/get_person_modal_content", "DataController@getPersonModalContent")->name("api.get_person_modal_content");
});
