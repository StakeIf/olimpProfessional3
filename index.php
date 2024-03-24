<?php
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'olimp' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'olimp' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'db.php');

$showUsers = [];

if (isset($_GET['search'])) {
    $input = htmlspecialchars($_GET['search']);
    $inputs = explode(' ', $input);

    /** @var array $users */
    foreach ($users as $us) {
        $FIO = $us['surname'] . ' ' . $us['name'] . ' ' . $us['patronymic'] . ' ' . $us['mail'];
        $k = 0;
        foreach ($inputs as $inp) {
            $pos = mb_stripos($FIO, $inp);
            if ($pos === false) {
                break;
            } else {
                $k++;
            }
        }
        if ($k == count($inputs)) {
            $showUsers[] = $us;
        }
    }
} else {
    /** @var array $users */
    $showUsers = $users;
}
?>

<div class='container'>

    <br>
    <form action="">
        <input type="text" name="search" id="search" value="<?= $_GET['search'] ?? '' ?>"
               placeholder="Введите пользователя" required>
        <input type="submit">
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>ФИО</th>
            <th>mail</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($showUsers as $us): ?>
            <tr>
                <td width="700">
                    <?= $us['surname'] . ' ' . $us['name'] . ' ' . $us['patronymic'] ?>
                </td>
                <td width="700">
                    <?= $us['mail'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'olimp' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'template' . DIRECTORY_SEPARATOR . 'header.php'); ?>