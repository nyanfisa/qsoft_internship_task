<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/core.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/data/users.php';
?>

<?php
$successMsg = "Вы успешно авторизовались";
$errorMsg = "Неверный логин или пароль";
$email='';
$password='';
$message = '';
$isAuthorised = false;


if (!empty($_POST) && isset($_POST['auth'])) { 

    $email = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    foreach ($users as $user) {
        if ($user['login'] === $email && $user['password'] === $password) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $email;

            header('Location: /login/');
            exit;
        }
    }
    
    $message = $errorMsg;
}
?>   



<?php
includeTemplate("header.php", ['title' => 'Авторизация', 'isAuthorised' => isAuthorised()]); //HEADER INCLUDE--> 
?>

            <div class="columns">
                <div class="column is-half-desktop">
                    <?php
                    if (!empty($message)): ?>
                    <?php includeTemplate('message.php', [
                        'message' => $message,
                        'type' => 'is_danger'
                    ]); ?>
                    <?php endif; ?>
                    

                    <form method="post" class="box">
                        <div class="field">
                            <label class="label">Логин</label>
                            <div class="control">
                                <input name = 'login' class="input" type="text" name="login" placeholder="login@example.com">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Пароль</label>
                            <div class="control">
                                <input name = 'password' class="input" type="password" name="password" placeholder="Введите пароль">
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type = 'submit' name = 'auth' class="button is-link">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

<?php includeTemplate("footer.php"); ?><!--FOOTER INCLUDE--> 