<?php 
    use core\classes\Store;
    // $_SESSION['cliente'] = "Langa";
?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            <a href="?p=inicio"> 
                <h3>
                    <?= APP_NAME ?>
                </h3>
            </a>
        </div>
        <div class="col-6 text-end p-3">
            <a href="?p=inicio" class="nav-item">Home</a>
            <a href="?p=store"class="nav-item">Store</a>

            <!-- VERIFICAR SE EXISTE SESSAO DO CLIENTE -->
                <?php if(Store::clienteLogado()):?>

                    <a href="?p=minha_conta" class="nav-item">
                        <?= $_SESSION['usuario'] ?>
                    </a>
                    <a href="?p=logout" class="nav-item">Logout</a>

                <?php else: ?>

                  <a href="?p=novo_cliente" class="nav-item">Criar conta</a>
                    <a href="?p=login" class="nav-item">Login</a>

                <?php endif; ?>
            <a href="?p=carrinho" class="nav-item"><i class="fas fa-shopping-cart"></i></a>
            <span class="bagde bg-warning">10</span>
        </div>
    </div>
</div>