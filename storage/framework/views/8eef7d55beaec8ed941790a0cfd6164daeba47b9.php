
<?php $__env->startSection('content'); ?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <?php echo $__env->make('layout.breadcrumb', ['url' => [null => 'Kişilerim']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Kişilerim
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal"
                                    data-target="#newSideModal">
                                    <i class="fas fa-sm fa-plus"></i> Yeni
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Search Form -->
                    <?php echo e(Form::open(['url' => route('person.index'), 'method' => 'post'])); ?>

                    <div class="row kt-margin-b-20">
                        <div class="col-lg-3 kt-margin-b-10-tablet-and-mobile">
                            <?php echo e(Form::label('Kişi Tipi')); ?>

                            <?php echo e(Form::select('type', App\Models\PersonType::selectToArray(), 'default', ['class' => 'form-control', 'placeholder' => '--Tümü--'])); ?>

                        </div>
                        <div class="col-lg-6 kt-margin-b-10-tablet-and-mobile">
                            <?php echo e(Form::label('Ad Soyad / Şirket Unvanı:')); ?>

                            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ad Soyad / Şirket Unvanı Giriniz'])); ?>

                        </div>
                        <div class="col-lg-3 kt-margin-t-10-tablet-and-mobile" style="margin-top: 24px;text-align: right;">
                            <?php echo e(Form::submit('Ara', ['class' => 'btn btn-primary'])); ?>

                            <?php echo e(Form::reset('Sıfırla', ['class' => 'btn btn-secondary'])); ?>

                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-sm"></div>
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="dataTable">
                        <thead>
                            <tr>
                                <th>Tip</th>
                                <th>Ad Soyad</th>
                                <th>Telefon</th>
                                <th>Email</th>
                                <th style="width:100px">İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $personList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $person->type->name; ?></td>
                                    <td><?php echo e($person->name); ?></td>
                                    <td><?php echo e($person->phone); ?></td>
                                    <td><?php echo e($person->email); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary edit-person-btn"
                                                data-url="<?php echo e(route('person.edit')); ?>" data-id="<?php echo e($person->id); ?>"
                                                data-type="<?php echo e($person->type); ?>">Düzenle</button>
                                            <?php echo Form::open(['url' => route('person.destroy'), 'method' => 'DELETE']); ?>

                                            <?php echo Form::hidden('id', $person->id); ?>

                                            <?php echo Form::hidden('type', $person->type->id); ?>

                                            <button type="button" class="btn btn-sm btn-danger delete-btn">Sil</button>
                                            <?php echo Form::close(); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="newSideModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" style="color:#2C3E50;">Yeni Kişi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo e(Form::open(['url' => route('person.getModalContent')])); ?>

                <div class="modal-body">
                    <div class="form-group">
                        <?php echo e(Form::select('type', App\Models\PersonType::selectToArray(), 'default', ['class' => 'form-control', 'required' => ''])); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="button" class="btn new-person-button"
                        style="background: #149FFC; color: white;">Ekle</button>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="personModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" style="color:#2C3E50;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo e(Form::open(['url' => route('person.store'), 'method' => 'post'])); ?>

                <div class="modal-body" id="formContent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn save-person-btn"
                        style="background: #149FFC; color: white;">Ekle</button>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" id="personModalEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" style="color:#2C3E50;"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo e(Form::open(['url' => route('person.update'), 'method' => 'post'])); ?>

                <div class="modal-body" id="formContent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
                    <button type="submit" class="btn save-person-btn"
                        style="background: #149FFC; color: white;">Kaydet</button>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\arbsys\resources\views/mediator/person/index.blade.php ENDPATH**/ ?>