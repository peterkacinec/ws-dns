<form action="/update?id=<?= isset($data['id']) ? $data['id'] : ''?>" method="post">
    <h1>edit dns</h1>
    <?= include('_form.php');?>
</form>

