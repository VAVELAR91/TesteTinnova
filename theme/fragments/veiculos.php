<tr>
    <th scope="row"><?= $veiculo->veiculo; ?></th>
    <td><?= $veiculo->marca; ?></td>
    <td><?= $veiculo->ano; ?></td>
    <td><?= $veiculo->getVendido(); ?></td>
    <th><a href="#" data-edit="" 
            data-id="<?= $veiculo->id; ?>" 
            data-veiculo="<?= $veiculo->veiculo?>"
            data-marca="<?= $veiculo->marca ?>" 
            data-ano="<?= $veiculo->ano ?>" 
            data-descricao="<?= $veiculo->descricao; ?>">
            <i class="fas fa-search"></i></a></th>
    <th><a href="#" data-action="<?= $router->route("web.deleteVeiculo"); ?>" data-id="<?= $veiculo->id; ?>"><i class="fas fa-trash-alt"></i></a></th>
</tr>