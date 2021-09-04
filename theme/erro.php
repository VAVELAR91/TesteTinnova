<?php $v->layout("_theme"); ?>

<div class="erro">
    <h4>Ooops erro <?= $error; ?>!</h4>
</div>

<?= $v->start("sidebar"); ?>
<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalLogin">
<a href="<?= url(); ?>"><h5 class="text-white h5">Voltar</h5></a>
</button>
<?= $v->stop(); ?>