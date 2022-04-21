<div class="container">
    <div class="row my-3">
        <div class="col-sm-6 offset-sm-3">
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger text-center p-2">
                    <?= $_SESSION['erro'] ?>
                    <?php unset($_SESSION['erro']) ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['sucesso'])): ?>
                <div class="alert alert-success text-center p-2" role="alert">
                    <?= $_SESSION['sucesso'] ?>
                    <?php unset($_SESSION['sucesso']) ?>
                </div>
            <?php endif; ?>   
            <h3 class="text-center">Cadastros de Clientes</h3>

            <form action="?p=client_submit" method="post">

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" >
                </div>
                <div class="form-group">
                    <label for="">Senha</label>
                    <input type="password" name="senha1" id="senha1" class="form-control" placeholder="Senha" >
                </div>
                <div class="form-group">
                    <label for="">Confirme a Senha</label>
                    <input type="password" name="senha2" id="senha2" class="form-control" placeholder="Senha" >
                </div>
                <div class="form-group">
                    <label for="">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome completo" >
                </div>
                <div class="form-group">
                    <label for="">Morada</label>
                    <input type="text" name="morada" id="morada" class="form-control" placeholder="Morada" >
                </div>
                <div class="form-group">
                    <label for="">Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="Telefone(Opcional)">
                </div>
                <div class="form-group">
                    <input class="btn btn-success mt-2" type="submit" value="Enviar">
                </div>

            </form>

        </div>
    </div>
</div>