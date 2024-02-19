<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa | Arabulucu Süreç Yönetim Sistemi</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link rel="shortcut icon" href="/assets/media/logos/arbsysLOGO.png" />
    <!-- Aos animation css file link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<body>
    <!-- Header start -->
    <header class="header">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div class="logos">
            <img width="65" src="{{ asset('images/landing_page/logo.png') }}" alt="">
            <a href="{{ route('frontend.index') }}" data-aos="zoom-in-left" data-aos-delay="150" class="logo">
                <span>ARBSYS</span>
            </a>
        </div>
        <nav class="navbar">
            <a href="#home" data-aos="zoom-in-left" data-aos-delay="300">Anasayfa</a>
            <a href="#about" data-aos="zoom-in-left" data-aos-delay="450">Hakkımızda</a>
            <a href="#pricing" data-aos="zoom-in-left" data-aos-delay="600">Fiyatlar</a>
            <a href="#blog" data-aos="zoom-in-left" data-aos-delay="600">Blog</a>
        </nav>
        @guest
            <div>
                <a href="{{ route('login') }}" class="btn">üye girişi</a>
                <a href="{{ route('register') }}" class="btn">Kayıt Ol</a>
            </div>
        @else
            @can('admin')
                <a href="{{ route('admin.home') }}" class="btn">Yönetim Paneli</a>
            @elsecan("mediator")
                <a href="{{ route('home') }}" class="btn">Hesabım</a>
            @endcan
        @endguest
    </header>
    <section class="home" id="home">
        <div class="content">
            <h3>Arabuluculuk <br>Süreç Yönetim Sistemi </h3>
            <a href="#services" class="btn-header">Özellikler</a>
    </section>
    <section class="about" id="about">
        <div class="video-container" data-aos="fade-right" data-aos-delay="300">
            <video src="{{ asset('images/landing_page/about.mp4') }}" muted autoplay loop class="video"></video>
        </div>
        <div class="content" data-aos="fade-left" data-aos-delay="600">
            <span>Biz Kimiz ?</span>
            <h3>Arabulucu Sistemi</h3>
            <p>ArbSys, arabuluculuk sürecindeki her
                adımınızda, sizi doğru şekilde
                yönlendirerek, süreci en hızlı ve en pratik şekilde yönetmenize yardımcı olur. <br><br>

                ArbSys, süreçteki etkinliğinizi artırır ve hazırlanması gereken belgelerin hatasız oluşturulmasını
                sağlar.</p>
            <a href="#pricing" class="btn">Şimdi Ücretsiz dene</a>
        </div>
    </section>
    <!-- about end -->

    <!-- services start -->
    <section class="services" id="services">
        <div class="heading">
            <span>Arabuluculuk süreçlerinizi yönetirken ihtiyacınız olan tüm özellikleri bir araya getirdik</span>
            <h1>ArbSys'in Özellikleri</h1>
        </div>

        <div class="box-container">
            <div class="box">
                <ion-icon name="desktop-outline"></ion-icon>
                <h3>Web Tabanlı Tasarım</h3>
                <p>ArbSys, bilgisayarınız üzerinde herhangi bir kuruluma, güncellemeye veya yedeklemeye ihtiyaç

                    duymaksızın çalışmanıza olanak

                    sağlar. Dosyalarınıza internet bağlantısı olan her yerden ve her zaman erişim imkanı sunmaktadır.
                </p>
            </div>
            <div class="box">
                <ion-icon name="bar-chart-outline"></ion-icon>
                <h3>
                    Raporlar ve İstatistikler</h3>
                <p>ArbSys ile sistemde kayıtlı tüm arabuluculuk dosyalarınızdan ihtiyacınıza uygun standart ya da
                    özelleştirilmiş raporlar hazırlayabilir ve istatistiki verilerinizi görebilirsiniz.</p>
            </div>
            <div class="box">
                <ion-icon name="folder-outline"></ion-icon>
                <h3>
                    Hatasız ve Eksiksiz Dosyalar</h3>
                <p>ArbSys, kullanıcıya özgülenmiş veri tabanı özelliği sayesinde, tüm arabuluculuk sürecinin baştan sona
                    kadar en güvenli, en hızlı ve en kolay şekilde başlatıp sonuçlandırılması olanağı sağlar.</p>
            </div>
            <div class="box">
                <ion-icon name="cog-outline"></ion-icon>
                <h3>Otomatik Aktarım</h3>
                <p>UYAP sistemi üzerinden gönderilen başvuru formları, ArbSys tarafından okunarak gerekli bilgilerin
                    tutanak şablonlarınıza aktarılması ve uygun alanlara işlenmesi sayesinde hem olası hataların önüne
                    geçilir hem de zamandan önemli ölçüde tasarruf sağlanır.</p>
            </div>
            <div class="box">
                <ion-icon name="documents-outline"></ion-icon>
                <h3>Bilgi Aktarımı</h3>
                <p>Süreç içinde hazırlanan belgeleriniz .doc, .docx, (MS Word), .pdf ve .udf (UYAP Kelime İşlemci)
                    formatlarında kaydedilebilir ve yazıcıya aktarılabilir. Bu belgeleri her zaman bilgisayarınıza
                    indirmeniz ve istediğiniz belgeleri dosyadaki taraflara e-posta ekinde göndermeniz mümkündür.</p>
            </div>
            <div class="box">
                <ion-icon name="document-lock-outline"></ion-icon>
                <h3>Bilgi Güvenliği</h3>
                <p>Arabuluculuk süreçlerinde oluşturulan veya arabulucu tarafından sisteme yüklenen tüm belgeler güvenli
                    sunucularda ve şifrelenmiş şekilde saklanır. Bu sayede dosyalarınızın fiziki nedenlerle (voltaj
                    dengesizliği ya da darbe gibi) fiziksel sebepler nedeniyle bozulması ya da üçüncü kişiler tarafından
                    -iradeniz dışında- silinmesi veya değiştirilmesi mümkün değildir.</p>
            </div>
            <div class="box">
                <ion-icon name="person-outline"></ion-icon>
                <h3>
                    Kullanıcı Dostu Arayüz</h3>
                <p>ArbSys, son derece yalın ve işlevsel bir arayüze sahip olup sizi karmaşık menülerle uğraştırmaz.
                    İhtiyacı olan verileri dosyanızın ilk açılışı sırasında alır ve süreç boyunca konforlu bir kullanım
                    sunar. </p>
            </div>
            <div class="box">
                <ion-icon name="cash-outline"></ion-icon>
                <h3>Ödemeler Kontrol Altında</h3>
                <p>ArbSys, sistemde kayıtlı dosyalarınıza ilişkin arabuluculuk ücretlerinizi istediğiniz (vadelerde /
                    tarihlerde) size hatırlatır ve talebiniz doğrultusunda taraflara hatırlatma mesajı gönderir. </p>
            </div>
            <div class="box">
                <ion-icon name="checkmark-done-outline"></ion-icon>
                <h3>Ekstra Özellikler</h3>
                <p>ArbSys, ayrıntılı ve emsalsiz hesaplama araçları sayesinde gerek arabuluculukta süre ve ücret
                    hesaplama, gerek serbest meslek makbuzu hazırlama gerekse işçilik alacakları ve tazminatları
                    konusunda hesaplama yapabilme imkanı sunar.</p>
            </div>
        </div>

    </section>
    <!-- services end -->

    <!-- destinations start -->
    <section class="destination" id="destination">
        <div class="heading">
            <h1>Kolay Takip Edilebilen Süreç</h1>
        </div>

        <div class="box-container">
            <div class="box" onmouseover="step1()">
                <h3>1</h3>
                <p>Taraf Bilgilerini Girin</p>
            </div>
            <div class="box" onmouseover="step2()">
                <h3>2</h3>
                <p>Toplantılarınızı Planlayın</p>
            </div>
            <div class="box" onmouseover="step3()">
                <h3>3</h3>
                <p>Toplantılarınızı Yönetin</p>
            </div>
            <div class="box" onmouseover="step4()">
                <h3>4</h3>
                <p>Belgelerinizi Yönetin</p>
            </div>
        </div>

        <div class="content" id="step-1">
            <p>
                <b>1-Taraf Bilgilerini Girin</b> <br><br>
                Taraflara ait kimlik ve iletişim bilgilerinin girişi sağlanır. <br> Sistemden yapılan görevlendirme
                dosyalarında yer alan bilgiler otomatik olarak ArbSys'e aktarılır.
            </p>
        </div>
        <div class="content" id="step-2">
            <p>
                <b>2- Toplantılarınızı Planlayın</b> <br><br>
                ArbSys, arabuluculuk sürecinizi planlamanıza ve tarafları toplantıya kolayca davet etmenize yardımcı
                olur.
                <br><br>
                Sistem üzerinden taraflara davet mektubunun e-posta ile gönderilmesi ve katılımcıların takvimlerine <br>
                toplantı bilgilerinin işlenmesi sağlanır.
            </p>
        </div>
        <div class="content" id="step-3">
            <p>
                <b>3- Toplantılarınızı Yönetin</b> <br><br>
                ArbSys, uyuşmazlık konusuna göre ihtiyacınız olan şablonu belirlemenize yardımcı olur ve gerekli veri
                girişlerini yaparak hem size zaman kazandırır hem de toplantı tutanaklarınızın eksiksiz ve hatasız
                şekilde oluşturulmasını sağlar.
            </p>
        </div>
        <div class="content" id="step-4">
            <p>
                <b>4- Belgelerinizi Yönetin</b> <br><br>
                ArbSys, sistemde oluşturduğunuz veya sisteme yüklediğiniz belgelerinize her zaman, güvenli şekilde
                ulaşılabilmenize ve yazdırılabilmenize olanak sağlar.
                <br><br>
                <i>(*) Yasa gereği arabulucunun süreçte oluşturulan belgeleri beş (5) yıl saklama yükümlülüğü
                    bulunmaktadır.</i>
            </p>
        </div>

    </section>
    <!-- destinations end -->

    <!-- pricing start -->
    <section class="pricing" id="pricing">
        <div class="pricingTable">

            <ul class="pricingTable-content">
                <li class="pricingTable-item">
                    <h1 class="pricingTable-header">Başlangıç</h1>
                    <p class="pricingTable-pricing"><span>TL</span><span>0</span><span> + KDV Aylık</span></p>
                    <ul class="pricingTable-options">
                        <li> <img src="{{ asset('images/landing_page/check.svg') }}" alt=""> Önce 14 gün
                            ücretsiz
                            deneyin!</li>
                        <li> <img src="{{ asset('images/landing_page/check.svg') }}" alt=""> Kalan günler
                            için
                            diğer
                            paketlerimizden faydalanın.
                        </li>
                    </ul>
                    <button class="pricingTable-btn">Hemen Satın Al</button>
                </li>

                <li class="pricingTable-item">
                    <h1 class="pricingTable-header">Yıllık Abonelik</h1>
                    <p class="pricingTable-pricing"><span>TL</span><span>29</span><span> + KDV Aylık</span></p>
                    <ul class="pricingTable-options">
                        <li> <img src="{{ asset('images/landing_page/check.svg') }}" alt=""> 348₺ + KDV
                            olarak
                            yıllık
                            faturalandırılır</li>
                        <li> <img src="{{ asset('images/landing_page/check.svg') }}" alt=""> Aylık aboneliğe
                            göre 120₺
                            daha hesaplı</li>
                    </ul>
                    <button class="pricingTable-btn">Hemen Satın Al</button>
                </li>

                <li class="pricingTable-item">
                    <h1 class="pricingTable-header">Aylık Abonelik</h1>
                    <p class="pricingTable-pricing"><span>TL</span><span>39</span><span> + KDV Aylık</span></p>
                    <ul class="pricingTable-options">
                        <li> <img src="{{ asset('images/landing_page/check.svg') }}" alt=""> Her ay
                            faturalandırılır
                        </li>
                        <li> <img src="{{ asset('images/landing_page/check.svg') }}" alt=""> Dilediğinizde
                            yıllık
                            aboneliğe geçerek aylık 10₺ daha
                            hesaplı kullanabilirsiniz</li>
                    </ul>
                    <button class="pricingTable-btn">Hemen Satın Al</button>
                </li>
            </ul>

        </div>
    </section>
    <!-- pricing end -->

    <!-- review start -->
    <section class="review">

        <div class="box-container">
            <div class="box">
                <p>“I'm a testimonial. Click to edit me and add text that says something nice about you and your
                    services.״</p>
                <div class="user">
                    <img src="{{ asset('images/landing_page/pic-1.png') }}" alt="">
                    <div class="info">
                        <h3>Jen B.</h3>
                        <span>Milestone</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <p>“I'm a testimonial. Click to edit me and add text that says something nice about you and your
                    services.״</p>
                <div class="user">
                    <img src="{{ asset('images/landing_page/pic-1.png') }}" alt="">
                    <div class="info">
                        <h3>Jen B.</h3>
                        <span>Milestone</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <p>“I'm a testimonial. Click to edit me and add text that says something nice about you and your
                    services.״</p>
                <div class="user">
                    <img src="{{ asset('images/landing_page/pic-1.png') }}" alt="">
                    <div class="info">
                        <h3>Jen B.</h3>
                        <span>Milestone</span>
                    </div>
                </div>
            </div>
            <div class="box">
                <p>“I'm a testimonial. Click to edit me and add text that says something nice about you and your
                    services.״</p>
                <div class="user">
                    <img src="{{ asset('images/landing_page/pic-1.png') }}" alt="">
                    <div class="info">
                        <h3>Jen B.</h3>
                        <span>Milestone</span>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- review end -->

    <!-- banner start -->
    <div class="banner ml6">
        <div class="content text-wrapper">
            <h3 class="letters">Arabulucular İçİn Arabulucular tarafından tasarlandı</h3>
        </div>
    </div>
    <!-- banner end -->

    <!-- reference start -->
    <section class="reference">
        <div class="box-container">
            <div class="box">
                <img src="{{ asset('images/landing_page/references.webp') }}" alt="">
            </div>
            <div class="box">
                <img src="{{ asset('images/landing_page/references.webp') }}" alt="">
            </div>
            <div class="box">
                <img src="{{ asset('images/landing_page/references.webp') }}" alt="">
            </div>
            <div class="box">
                <img src="{{ asset('images/landing_page/references.webp') }}" alt="">
            </div>
        </div>
    </section>
    <!-- reference end -->

    <!-- Footer start -->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <div class="logos">
                    <img width="65" src="{{ asset('images/landing_page/logo.png') }}" alt="">
                    <a href="{{ route('frontend.index') }}" class="logo">
                        Arabuluculuk Süreç Yönetim Sistemi
                    </a>
                </div>
                <p>Arabuluculuk tutanaklarını hatasız ve hızlı bir şekilde hazırlamak için, arabulucular tarafından arabulucular için tasarlandı</p>
                <div class="share">
                    <a href="" class="fab fa-facebook"></a>
                    <a href="" class="fab fa-instagram"></a>
                    <a href="" class="fab fa-linkedin"></a>
                </div>
            </div>

            <div class="box">
                <h3>Hızlı Menü</h3>
                <a href="#home" class="links"><i class="fas fa-arrow-right"></i>&nbsp; Anasayfa</a>
                <a href="#about" class="links"><i class="fas fa-arrow-right"></i>&nbsp; hakkımızda</a>
                <a href="#pricing" class="links"><i class="fas fa-arrow-right"></i>&nbsp; fiyatlar</a>
                <a href="#blog" class="links"><i class="fas fa-arrow-right"></i>&nbsp; blog</a>
            </div>

            <div class="box">
                <h3>İletişim bilgileri</h3>
                <p><i class="fas fa-map"></i>Neva Tekno Yazılım Limited Şirketi
                    İTOB OSB Mahallesi 10032 Sokak No:2 Menderes/İzmir</p>
                <p><i class="fas fa-phone"></i>+90 543 898 92 00</p>
                <p style="text-transform: lowercase;"><i class="fas fa-envelope"></i>destek@arbsys.com.tr</p>
            </div>
        </div>
        <div class="bottom">
            <img src="{{ asset('assets/visa-mastercard.png') }}" alt="">
        </div>
    </section>

    <!-- Footer end -->
    <!-- custom js file link  -->
    <script src="{{ asset('js/page/landing_page/script.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
