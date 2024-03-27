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
    });

    Route::get('/bildirimler', 'NotificationController@index')->name("notification.index");
    Route::get('/{notification}/okundu-olarak-isaretle', 'NotificationController@update')->name("notification.read");

    Route::prefix("dosya")->group(function () {
        Route::get('/yeni', 'LawsuitController@create')->name('lawsuit.create');
        Route::post('/kaydet', 'LawsuitController@store')->name('lawsuit.store');
        Route::get('/{lawsuit}/duzenle', 'LawsuitController@edit')->name('lawsuit.edit');
        Route::put('/{lawsuit}/guncelle', 'LawsuitController@update')->name('lawsuit.update');
        Route::delete("/{lawsuit}/sil", 'LawsuitController@destroy')->name("lawsuit.destroy");
        Route::match(["get", "post"], '/raporlama', 'LawsuitController@report')->name('lawsuit.report');
        Route::get('/{lawsuit}/evraklar', 'DocumentController@index')->name('lawsuit.document');
        Route::get('/{lawsuit}/notlar', 'LawsuitController@noteView')->name('lawsuit.note_view');
        Route::post('/{lawsuit}/not-kaydet', 'LawsuitController@noteSave')->name('lawsuit.note.save');
        Route::post('/udf-oku', 'LawsuitController@saveWithFile')->name('lawsuit.save_with_file');
        Route::post('/confirm_udf', 'LawsuitController@confirm_udf')->name('lawsuit.confirm_udf');
        Route::get('/dosya-tipleri', 'LawsuitController@getTypes');
        Route::get('/{lawsuit}/loglar', 'Logs@index')->name('lawsuit.logs');
        Route::get('/{lawsuit}/taraflar', 'SideController@index')->name('lawsuit.sides');

        //TUTANAKLAR
        //Davet Mektubu
        Route::get('/{lawsuit}/davet-mektubu-olustur', [App\Http\Controllers\Mediator\InvitationLetterController::class, "create"])->name('invitation_letter.create');
        Route::post('/{lawsuit}/davet-mektubu-kaydet', [App\Http\Controllers\Mediator\InvitationLetterController::class, "store"])->name('invitation_letter.store');
        Route::post('/{lawsuit}/davet-mektubu-onizle', [App\Http\Controllers\Mediator\InvitationLetterController::class, "preview"])->name('invitation_letter.preview');

        //KVKK Belgesi
        Route::get('/{lawsuit}/kvkk-belgesi-olustur', 'KvkkController@create')->name('kvkk.create');
        Route::post('/{lawsuit}/kvkk-belgesi-kaydet', 'KvkkController@store')->name('kvkk.store');
        Route::post('/{lawsuit}/kvkk-onizle', 'KvkkController@preview')->name('kvkk.preview');

        //Bilgilendirme Tutanağı
        Route::get('/{lawsuit}/bilgilendirme-tutanagi-olustur', 'ArbiterProcessInfoProtocolController@create')->name('arbiter_process_info_protocol.create');
        Route::post('/{lawsuit}/bilgilendirme-tutanagi-kaydet', 'ArbiterProcessInfoProtocolController@store')->name('arbiter_process_info_protocol.store');
        Route::post('/{lawsuit}/bilgilendirme-tutanagi-onizle', 'ArbiterProcessInfoProtocolController@preview')->name('arbiter_process_info_protocol.preview');

        //Arabulucu Belirleme Tutanağı
        Route::get('/{lawsuit}/arabulucu-belirleme-tutanagi-olustur', 'ArbiterDefineProtocolController@create')->name('arbiter_define_protocol.create');
        Route::post('/{lawsuit}/arabulucu-belirleme-tutanagi-kaydet', 'ArbiterDefineProtocolController@store')->name('arbiter_define_protocol.store');
        Route::post('/{lawsuit}/arabulucu-belirleme-tutanagi-onizle', 'ArbiterDefineProtocolController@preview')->name('arbiter_define_protocol.preview');

        //İlk Toplantı Tutanağı
        Route::get('/{lawsuit}/toplanti-tutanagi-olustur', 'MeetingProtocolController@create')->name("meeting_protocol.create");
        Route::post('/{lawsuit}/toplanti-tutanagi-kaydet', 'MeetingProtocolController@store')->name('meeting_protocol.store');
        Route::post('/{lawsuit}/toplanti-tutanagi-onizle', 'MeetingProtocolController@preview')->name('meeting_protocol.preview');

        //Anlaşma Belgesi
        Route::get('/{lawsuit}/anlasma-belgesi-olustur', 'AgreementDocumentController@create')->name("agreement_document.create");
        Route::post('/{lawsuit}/anlasma-belgesi-kaydet', 'AgreementDocumentController@store')->name('agreement_document.store');
        Route::post('/{lawsuit}/anlasma-belgesi-onizle', 'AgreementDocumentController@preview')->name('agreement_document.preview');

        //Ücret Sözlesmesi
        Route::get('/{lawsuit}/ucret-sozlesmesi-olustur', 'WageAgreementController@create')->name("wage_agreement.create");
        Route::post('/{lawsuit}/ucret-sozlesmesi-kaydet', 'WageAgreementController@store')->name('wage_agreement.store');
        Route::post('/{lawsuit}/ucret-sozlesmesi-onizle', 'WageAgreementController@preview')->name('wage_agreement.preview');
        Route::post('/wage_agreement_aaut_first', 'WageAgreementController@aautFirst')->name('wage_agreement.aaut_first');
        Route::post('/wage_agreement_aaut_second', 'WageAgreementController@aautSecond')->name('wage_agreement.aaut_second');

        //Son Tutanak
        Route::get('/{lawsuit}/son-tutanak-olustur', 'FinalProtocolController@create')->name("final_protocol.create");
        Route::post('/{lawsuit}/son-tutanak-kaydet', 'FinalProtocolController@store')->name('final_protocol.store');
        Route::post('/{lawsuit}/son-tutanak-onizle', 'FinalProtocolController@preview')->name('final_protocol.preview');

        //Yetki İtirazı Üst Yazı'
        Route::get('/{lawsuit}/yetki-itirazi-ust-yazi-olustur', 'AuthorityObjectionController@create')->name('authority_objection.create');
        Route::post('/{lawsuit}/yetki-itirazi-ust-yazi-kaydet', 'AuthorityObjectionController@store')->name('authority_objection.store');
        Route::post('/{lawsuit}/yetki-itirazi-ust-yazi-onizle', 'AuthorityObjectionController@preview')->name('authority_objection.preview');

        //Yetki Belgesi
        Route::get('/{lawsuit}/yetki-belgesi-olustur', 'AuthorityDocumentController@create')->name('authority_document.create');
        Route::post('/{lawsuit}/yetki-belgesi-kaydet', 'AuthorityDocumentController@store')->name('authority_document.store');
        Route::post('/{lawsuit}/yetki-belgesi-onizle', 'AuthorityDocumentController@preview')->name('authority_document.preview');
    });

    Route::get("/dosya/{lawsuit}/davet-mektubu", 'InvitationLetterController@show')->name('invitation_letter.show');
    Route::post('/isnull_side_email', 'InvitationLetterController@isNullSideEmail')->name('invitation_letter.isnull_side_email');
    Route::post('/dosya/davet-mektubu/mail-gonder', 'InvitationLetterController@sendEmail')->name('invitation_letter.send_email');
    Route::get('/update_meeting_adress/{name?}', 'InvitationLetterController@updateMeeting');

    Route::get('/lawsuit_subject_types/{lawsuit_type_id}', 'LawsuitController@getSubjectTypes');
    Route::get('/lawsuit_subjects/{lawsuit_subject_type_id}', 'LawsuitController@getSubjects');
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
    Route::post("/api/get_company_data", "DataController@getLawsuitData")->name("api.get_company_data");
});
