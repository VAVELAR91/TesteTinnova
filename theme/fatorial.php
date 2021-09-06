<?php $v->layout("_theme"); ?>
<div class="container">
    <div class="row">
        <div class="col"><h4>3) Fatorial</h4></div>
    </div>
    <div class="row">
        <div class="col-4"><h4>Insira o numero:</h4></div>
        <div class="col-2"><input type="number" min="0" id="numero"></div>
    </div>
    <div class="row">
        <div class="col-2"><button type="button" class="btn btn-primary btn-lg" onclick="Fatorial()">Fatorial</button></div>
    </div>
    <div class="row">
        <div class="col"><h4 id="resultado"></h4></div>
    </div>
</div>

<?php 
$v->start('scripts'); ?>
<script>
    function Fatorial(){
        let input = $('#numero').val();

        if(input==''){
            alert('Preencha o campo com algum numero inteiro');
            return
        }

        $.ajax({
            url: "<?= $router->route("web.getFatorial"); ?>",
            data: {
                numero: input
            },
            type: "POST",
            dataType: "json",
            success: function(callback) {
                $('#resultado').html('Resultado: '+callback.resultado);
            }
        });
    }
</script>
<?php $v->stop() ?>