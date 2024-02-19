<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        box-sizing: border-box;
    }

    .header {
        background-color: #f1f1f1;
        padding: 20px;
        text-align: center;
    }

    .header img {
        max-width: 100px;
        height: auto;
    }

    .content {
        background-color: #ffffff;
        padding: 20px;
    }

    .button {
        display: inline-block;
        background-color: #4CAF50;
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
    }
</style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://i.hizliresim.com/fvccyi9.png" alt="System Logo">
        </div>
        <div class="content">
            <h2>Yeni Üye</h2>
            <p>Arbsys yeni bir kullanıcı katıldı. Bilgileri aşağıdadır</p>
            <ul>
                <li>Adı : <?php echo e($user['name']); ?></li>
                <li>Email : <?php echo e($user['email']); ?></li>
                <li>Telefon : <?php echo e($user['phone']); ?></li>
            </ul>
            <p>Kaydı incelemek ve onaylamak için lütfen yönetici panelinde oturum açın.</p>
            <p><a href="<?php echo e(route('admin.home')); ?>" class="button">Yönetici Paneline Giriş Yapın</a></p>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\arbsys\resources\views/email/new_user.blade.php ENDPATH**/ ?>