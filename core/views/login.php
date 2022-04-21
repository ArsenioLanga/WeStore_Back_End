<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">
            <div>
                <?php if(isset($_SESSION['erro'])): ?>
                    <div class="alert alert-danger text-center p-2">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif; ?>
                <h3 class="text-center">LOGIN</h3>
                <form action="?p=login_submit" method="post">
                    <div class="my-3">
                        <label for="">Usuario</label>
                        <input type="email" name="usuario" placeholder="Usuario" required class="form-control">
                    </div>
                    <div class="my-3">
                        <label for="">Senha</label>
                        <input type="password" name="senha" placeholder="Senha" required class="form-control">
                    </div>
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Entrar">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>