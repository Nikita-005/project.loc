<h1>Вход</h1>

<?php if (!empty($error)): ?>
    <div style="background-color: red"><?= $error ?></div>
<?php endif; ?>

<form action="" method="POST">
    <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
    <label>Password <input type="password" name="password" ></label>
    <input type="submit" value="Войти">
</form>