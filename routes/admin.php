<?php

use Illuminate\Support\Facades\Route;

Route::group(["middleware" => ["auth", "admin"], "prefix" => "admin", "namespace" => "Admin"], function () {
    Route::get('/', 'HomeController@index')->name('admin.home');
    Route::get("cache-clear", "HomeController@cacheClear")->name("admin.cache-clear");
    //Kullanıcı İşlemleri
    Route::prefix("kullanici")->group(function () {
        Route::get('/', 'UserController@index')->name("admin.users");
        Route::post('/ekle', 'UserController@store')->name("admin.user.store");
        Route::get("/{user}/duzenle", 'UserController@edit')->name("admin.user.edit");
        Route::put("/{user}/guncelle", 'UserController@update')->name("admin.user.update");
        Route::delete('/{user}/sil', 'UserController@destroy')->name("admin.user.destroy");
        Route::get('/{user}/onayla', 'UserController@userConfirm')->name("admin.user.confirm");
        Route::get('/{user}/askiya-al', 'UserController@userBan')->name("admin.user.ban");
        Route::post('/{user}/sure-guncelle', 'UserController@dateUpdate')->name("admin.user.date.update");
    });

    Route::get('/faturalar', 'Billing\BillingController@index');

    //Arabulucu İşlemleri
    Route::get('/kullanici-degisiklik-talepleri', 'ChangeRequestController@index')->name('admin.change_request.index');
    //Route::get('/arabulucu/{user}/duzenle', 'ChangeRequestController@edit')->name("admin.change_request.edit");
    //Route::put('/arabulucu/{user}/guncelle', 'ChangeRequestController@update')->name("admin.change_request.update");
    Route::get('/degisiklik-onay/{user}', 'ChangeRequestController@confirmation')->name("admin.change_request.confirmation");
    Route::post('/degisiklik-red/{user}', 'ChangeRequestController@rejected')->name("admin.change_request.rejected");

    //Vergi Dairesi İşlemleri
    Route::prefix("vergi-dairesi")->group(function () {
        Route::get("/", 'TaxOfficesController@index')->name("admin.tax_offices");
        Route::post("/ekle", 'TaxOfficesController@store')->name("admin.tax_offices.store");
    });

    //Hesaplama Araçları İşlemleri
    Route::prefix("hesaplama-araclari")->group(function () {
        Route::get("/", 'CalculationToolsController@index')->name("admin.calculation_tools");
        Route::post("/guncelle", 'CalculationToolsController@update')->name("admin.calculation_tools.update");
    });


    //Template İşlemleri
    Route::prefix("template")->group(function () {
        Route::get("/", 'TemplateController@index')->name("admin.templates");
        Route::get("subjects/{lawsuit_subject_type}", "TemplateController@subjects")->name("admin.template.subjects");
        Route::get("/{lawsuit_subject_type}/list", 'TemplateController@getLawsuitSubjectTypeTemplates')->name("admin.template.getLawsuitSubjectTypeTemplates");
        Route::get("/{lawsuit_subject_type}/{lawsuit_subject?}/duzenle", 'TemplateController@edit')
            ->where("lawsuit_subject", ".*")
            ->name("admin.template.edit");
        Route::put("/{template}/guncelle", 'TemplateController@update')->name("admin.template.update");
        Route::get("/yeni", 'TemplateController@create')->name("admin.template.create");
        Route::post("/kaydet", 'TemplateController@store')->name("admin.template.store");
    });

    //Duyuru İşlemleri
    Route::prefix("bildirim")->group(function () {
        Route::get('/', 'NotificationController@index')->name("admin.notifications");
        Route::get('/bildirim-olustur', 'NotificationController@create')->name("admin.notification.create");
        Route::post('/bildirim-kaydet', 'NotificationController@store')->name("admin.notification.store");
    });

    //Görüş Öneri İşlemleri //TODO:Admin Görüş Öneri Bölümüne Bakılacak
    Route::resource('/gorus-oneri', 'System\SystemRequestController')->names("admin.gorus-oneri");
    Route::get('/gorus-ve-oneri-kategorileri', 'System\SystemRequestCategoryController@index')->name('admin.system_request_category.index');
    Route::get('/gorus-ve-oneri-kategori-olustur', 'System\SystemRequestCategoryController@create')->name('admin.system_request_category.create');
    Route::get('/gorus-ve-oneri-kategori/{id}/duzenle', 'System\SystemRequestCategoryController@edit')->name('admin.system_request_category.edit');


    Route::prefix("bakanlik-gorusleri")->group(function () {
        Route::get("/", "MinisteriesOpinionsController@index")->name("admin.ministeries_opinions");
        Route::get("/yeni", "MinisteriesOpinionsController@create")->name("admin.ministeries_opinions.create");
        Route::post("/ekle", "MinisteriesOpinionsController@store")->name("admin.ministeries_opinions.store");
        Route::get("/{item}/duzenle", "MinisteriesOpinionsController@edit")->name("admin.ministeries_opinions.edit");
        Route::put("/{item}/guncelle", "MinisteriesOpinionsController@update")->name("admin.ministeries_opinions.update");
        Route::delete("/{item}/sil", "MinisteriesOpinionsController@destroy")->name("admin.ministeries_opinions.destroy");
    });

    Route::prefix("mevzuat")->group(function () {
        Route::get("/", "LegislationController@index")->name("admin.legislation");
        Route::get("/yeni", "LegislationController@create")->name("admin.legislation.create");
        Route::post("/ekle", "LegislationController@store")->name("admin.legislation.store");
        Route::get("/{legislation}/duzenle", "LegislationController@edit")->name("admin.legislation.edit");
        Route::put("/{legislation}/guncelle", "LegislationController@update")->name("admin.legislation.update");
        Route::delete("/{legislation}/sil", "LegislationController@destroy")->name("admin.legislation.destroy");
    });

    Route::get("/tanimlar/uyuzmazliklar", [App\Http\Controllers\Admin\LawsuitSubjectTypeController::class, "index"])->name("admin.lawsuit_subject_type.index");

    Route::post("/tanimlar/uyusmazlik-turu/ekle", [App\Http\Controllers\Admin\LawsuitSubjectTypeController::class, "store"])->name("admin.lawsuit_subject_type.store");
    Route::delete("/tanimlar/uyusmazlik-turu/{lawsuit_subject_type}/sil", [App\Http\Controllers\Admin\LawsuitSubjectTypeController::class, "destroy"])->name("admin.lawsuit_subject_type.destroy");

    Route::post("/tanimlar/uyusmazlik-konusu/ekle", [App\Http\Controllers\Admin\LawsuitSubjectController::class, "store"])->name("admin.lawsuit_subject.store");
    Route::delete("/tanimlar/uyusmazlik-konusu/{lawsuit_subject}/sil", [App\Http\Controllers\Admin\LawsuitSubjectController::class, "destroy"])->name("admin.lawsuit_subject.destroy");

    Route::get("/tanimlar/muzakere-edilen-hususlar", [App\Http\Controllers\Admin\MattersDiscussedController::class, "index"])->name("admin.matters_discussed.index");
});
