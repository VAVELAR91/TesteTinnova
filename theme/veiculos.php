<?php 
$v->layout("_theme"); ?>

<div class="container">
    <div class="row">
        <div class="col"><h4>5) Cadastro de veículos</h4></div>
    </div>
    <div class="row">
        <div class="col-4">
            <select class="custom-select" id="q">
                <option selected>Escolha o filtro da pesquisa...</option>
                <option value="id">ID</option>
                <option value="veiculo">Veiculo</option>
                <option value="marca">Marca</option>
                <option value="ano">Ano</option>
            </select>
        </div>
        <div class="col-4">
            <input class="form-control" type="text" id="find">
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-primary btn-lg" onclick="PesquisarVeiculos()">Pesquisar</button>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-primary btn-lg" onclick="document.location.reload(true)">LimparFiltro</button>
        </div>
        <div class="col-2">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Modal">Novo Veiculo</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Veiculo</th>   
                    <th scope="col">Marca</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Vendido</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="veiculos">
                <?php 
                if(!empty($veiculos)):
                    foreach ($veiculos as $veiculo):
                        $v->insert("fragments/veiculos",["veiculo" => $veiculo]);
                    endforeach; 
                endif;?>
            </tbody>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalLabel">Novo Veiculo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" id="novo" action="<?= $router->route("web.postVeiculo"); ?>" method="post">
        <input type="hidden" id="id" name="id" value="0"></input>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="veiculo" class="col-form-label">Veiculo</label>
                    <input class="form-control form-control-sm" type="text" id="veiculo" name="veiculo" required maxlength="100" required>
                </div>
                <div class="form-group col-6">
                    <label for="procedimentoValor" class="col-form-label">Marca</label>
                    <select class="custom-select" id="marca" name="marca" required>
                        <option value="" hidden>Selecione</option>
                        <option value="Chevrolet">Chevrolet</option>
                        <option value="Ford">Ford</option>
                        <option value="Peogeot">Peogeot</option>
                        <option value="Volkswagen">Volkswagen</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="procedimentoComissao" class="col-form-label">Ano</label>
                    <input class="form-control form-control-sm" type="number" min="0" id="ano" name="ano" required>
                </div>
                <div class="form-group col-12">
                    <label for="procedimentoIntervalo" class="col-form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                </div>             
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"  onclick="closeModal()">Fechar</button>
            <button type="submit" class="btn btn-primary">Gravar</button>
        </div>
        </form>
    </div>
  </div>
</div>

<script>
    function PesquisarVeiculos(){
            let q = $('#q').val();
            if(q=='id'){
                $.ajax({
                    url: "<?= $router->route("web.findVeiculosById"); ?>",
                    type: "GET",
                    data: {
                        find: $('#find').val()
                    },
                    dataType: "json",
                    success: function(callback) {
                        $('#veiculos').html(callback.veiculo);
                    }
                });
            }else{             
                $.ajax({
                    url: "<?= $router->route("web.findVeiculos"); ?>",
                    type: "GET",
                    data: {
                        q: $('#q').val(),
                        find: $('#find').val()
                    },
                    dataType: "json",
                    success: function(callback) {
                        $('#veiculos').html(callback.veiculos);
                    }
                });
            }
    }  

    function closeModal() {
        document.getElementById('novo').reset();

        $('#Modal').modal('toggle');
    }

    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var veiculos = $("#veiculos");

            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                type: "POST",
                dataType: "json",
                success: function(callback) {
                    if (callback.veiculos) {
                        veiculos.html(callback.veiculos);                   
                    }
                    if (callback.message) {
                        alert(callback.message);
                    }
                }
            });

            closeModal() ;
        });

        $("body").on("click", "[data-action]", function(e) {
            e.preventDefault();

            if (confirm("Deseja realmente excluir este Veiculo?")) {
                var data = $(this).data();
                var div = $(this).parent();
                div = div.parent();

                $.ajax({
                url: data.action,
                data: data,
                type: "DELETE",
                dataType: "json",
                success: function(callback) {
                    div.fadeOut();
                }
            });
            }
        });

        $("body").on("click", "[data-edit]", function(e) {
            e.preventDefault();

            var data = $(this).data();
            
            $("#id").val(data.id);
            $("#veiculo").val(data.veiculo);
            $("#marca").val(data.marca);
            $("#ano").val(data.ano);
            $("#descricao").val(data.descricao);

            $('#Modal').modal();
        });
    });
</script>
