<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
        data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('mediator')): ?>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">DOSYALAR</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="javascript:;" class="kt-menu__link dosyac">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-folder-open')); ?>
                        </span>
                        <span class="kt-menu__link-text dosyac">Dosya Aç</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('person.index')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-address-card')); ?>
                        </span>
                        <span class="kt-menu__link-text">Kişilerim</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('lawsuit.index')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-gavel')); ?>
                        </span>
                        <span class="kt-menu__link-text">Dosyalarım</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">ARAÇLAR</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('calculation.index')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-calculator')); ?>
                        </span>
                        <span class="kt-menu__link-text">Hesaplama Araçları</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('lawsuit.report')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-search')); ?>
                        </span>
                        <span class="kt-menu__link-text">Raporlama</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">BAĞLANTILAR</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('legislation.index')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-file-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">İlgili Mevzuat</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('useful_links')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-link')); ?>
                        </span>
                        <span class="kt-menu__link-text">Yararlı Bağlantılar</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('related_judicial_decisions')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-list-ol')); ?>
                        </span>
                        <span class="kt-menu__link-text">İlgili Yargı Kararları</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('ministeries_opinions')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-comment-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">Bakanlık Görüşleri ve Duyuruları</span>
                    </a>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">HESABIM</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('mediator.profile')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-user')); ?>
                        </span>
                        <span class="kt-menu__link-text">Arabulucu Bilgileri</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('system_request.index')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-comment-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">Görüş ve Öneriler</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-sign-out-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">Çıkış</span>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </a>
                </li>
            <?php elseif (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin')): ?>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Yönetim</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('admin.change_request.index')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon" <?php if($demands > 0): ?> style="color:red" <?php endif; ?>>
                            <?php echo e(svg('far-check-circle')); ?>
                        </span>
                        <span class="kt-menu__link-text">Kullanıcı Değişiklik Talepleri (<?php echo e($demands); ?>)</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('admin.users')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-user')); ?>
                        </span>
                        <span class="kt-menu__link-text">Kullanıcı Üyelik İşlemleri</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('admin.calculation_tools')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-calculator')); ?>
                        </span>
                        <span class="kt-menu__link-text">Hesaplama Aracı İşlemleri</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('admin.templates')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-layer-group')); ?>
                        </span>
                        <span class="kt-menu__link-text">Şablon işlemleri</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href="<?php echo e(route('admin.notifications')); ?>" class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('far-bell')); ?>
                        </span>
                        <span class="kt-menu__link-text">Bildirim işlemleri</span>
                    </a>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-file-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">Bakanlık Görüşleri</span>
                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " style="display: none; overflow: hidden;" kt-hidden-height="80"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="<?php echo e(route('admin.ministeries_opinions.create')); ?>" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Ekle</span>
                                </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="<?php echo e(route('admin.ministeries_opinions')); ?>" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Liste</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-file-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">Mevzuat</span>
                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " style="display: none; overflow: hidden;" kt-hidden-height="80"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="<?php echo e(route('admin.legislation.create')); ?>" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Ekle</span>
                                </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="<?php echo e(route('admin.legislation')); ?>" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Liste</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                    <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-code-branch')); ?>
                        </span>
                        <span class="kt-menu__link-text">Tanımlamalar</span>
                        <i class="kt-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="kt-menu__submenu " style="display: none; overflow: hidden;" kt-hidden-height="80"><span
                            class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="<?php echo e(route('admin.lawsuit_subject_type.index')); ?>" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Uyuşmazlık Türleri & Konuları</span>
                                </a>
                            </li>
                            <li class="kt-menu__item " aria-haspopup="true">
                                <a href="<?php echo e(route('admin.tax_offices')); ?>" class="kt-menu__link ">
                                    <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                    <span class="kt-menu__link-text">Vergi Daireleri</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">HESABIM</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        class="kt-menu__link ">
                        <span class="kt-menu__link-icon">
                            <?php echo e(svg('fas-sign-out-alt')); ?>
                        </span>
                        <span class="kt-menu__link-text">Çıkış</span>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php /**PATH C:\laragon\www\arbsys\resources\views/layout/sidebar.blade.php ENDPATH**/ ?>