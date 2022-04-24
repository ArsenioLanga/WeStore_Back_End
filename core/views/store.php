<?php 

    print_r($_SESSION);

?>

<div class="container-fluid margin">
    <div class="row">
        <div class="col-12 text-center my-4">
            <a href="?p=store&c=todos" class="btn btn-primary">Todos</a>
            <?php foreach ($categorias as $categoria) : ?>
                <a href="?p=store&c=<?= $categoria ?>" class="btn btn-primary">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- LISTAR PRODUTOS -->
    <div class="row">
        <?php if (count($produtos) == 0) : ?>
            <div class="text-center">
                <h3>Nao existem produtos disponiveis para esta categoria</h3>
            </div>
        <?php else : ?>
            <?php foreach ($produtos as $produto) : ?>
                <div class="col-sm-3 p-1">
                    <div class="text-center p-3 card box-produto">
                        <img src="assets/image/produtos/<?= $produto['imagem'] ?>" class="img-fluid">
                        <h3><?= $produto['nome_produto'] ?></h3>
                        <h2><?= preg_replace("/\./", ",", $produto['preco']. " MZN") ?></h2>
                        <!-- <p><small><?= $produto['descricao'] ?></small></p> -->
                        <div class="">
                            <button class="btn btn-info" onclick="adicionar_carrinho(<?= $produto['id'] ?>)">
                                <i class="fa fa-shopping-cart"></i>
                                Adicionar ao carinho
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>