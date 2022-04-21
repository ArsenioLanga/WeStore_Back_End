

<div class="container-fluid margin">
    <div class="row">
        <div class="col-12">
            <h1>WebStore</h1>  
        </div>
    </div>

    <!-- LISTAR PRODUTOS -->
    <div class="row">

    <?php foreach($produtos as $produto):?>
        <div class="col-sm-3">
            <div class="text-center p-3">
                <img src="assets/image/produtos/<?=$produto['imagem']?>" class="img-fluid">
                <h3><?= $produto['nome_produto']?></h3>
                <h2><?= $produto['preco']?></h2>
                <p><small><?= $produto['descricao']?></small></p>
                <div class="">
                    <button>
                        Adicionar ao carinho
                    </button>
                </div>
            </div>
        </div>
     <?php endforeach;?>
    </div>
</div>

<!-- 
    ["id"]=>
  string(1) "1"
  ["categoria"]=>
  string(5) "homem"
  ["nome_produto"]=>
  string(16) "t-shirt vermelha"
  ["descricao"]=>
  string(43) "lMollit elit exercitation ullamco voluptate"
  ["imagem"]=>
  string(19) "tshirt_vermelha.png" tshirt_vermelha.png tshirt_vermelha.png
  ["preco"]=>
  string(6) "290.50"
  ["stock"]=>
  string(3) "100"
  ["visivel"]=>
  string(1) "1"
  ["created_at"]=>
  string(19) "2022-04-21 21:32:47"
  ["updated_at"]=>
  string(19) "2022-04-21 21:32:47"
  ["deleted_at"]=>
  NULL
}
            
        

 -->