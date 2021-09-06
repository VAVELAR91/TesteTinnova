<?php 
$v->layout("_theme"); ?>
<div class="container">
    <div class="row">
        <div class="col"><h4>1) Votos em relação ao Total de Eleitores</h4></div>
    </div>
    <div class="row">
        <div class="col"><h4>Total de votos: <?= $total ?></h4></div>
    </div>    
    <div class="row">
        <div class="col">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Voto</th>   
                    <th scope="col">Quantidade</th>
                    <th scope="col">Percentual</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($votos)):
                    foreach ($votos as $voto):
                        $v->insert("fragments/votos",["voto" => $voto]);
                    endforeach; 
                endif;?>
            </tbody>
        </div>
    </div>
</div>