<?php
/*
Template Name: Formulário Newsletter
*/
?>

<?php get_header(); ?>
<div class="col-6">
    <h2 class="text-center">Cadastrar-se em nossa Newsletter</h2>
    <div id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulário de Cadastro</h5>

                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" id="campoNome" name="user_login">
                            <br>
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="campoEmail" name="user_email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar-se">
                </div>
            </div>
        </div>
    </div>
</div>
<!--EDITAR CADASTRO-->
<div class="col-6">
    <h2 class="text-center">Editar Cadastro</h2>
    <div id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulário de edição</h5>

                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome de Usuário</label>
                            <input type="text" class="form-control" id="campoNome" name="new_user_login">
                            <br>
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="campoEmail" name="new_user_email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-warning"  data-dismiss="modal">Salvar edição</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
global $wpdb;
$resultado = $wpdb->get_results( "SELECT * FROM wp_newsletter ORDER BY ID ASC" );

?>
<div class="col-12 container-fluid">
    <div class="mt-5">
        <h2 class="text-center">Lista com os cadastros para newsletter</h2>
        <!--Tabela com os dados retornados da banco-->
        <table class="table mt-5">

            <thead>
            <tr>
                <th scope="col">Id usuário</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Data de Cadastro</th>
                <th scope="col" class="text-center">Ações</th>
            </tr>
            </thead>
            <tbody>
			<?php
			foreach ( $resultado as $cadastros_news ) {
			    global $new_user_id;
			    $new_user_id = $cadastros_news->ID;
			    ?>
                <tr>
                    <th scope="row"><?php echo $cadastros_news->ID; ?></th>
                    <td><?php echo $cadastros_news->news_name; ?></td>
                    <td><?php echo $cadastros_news->news_email; ?></td>
                    <th scope="row"><?php echo date( "d/m/Y H:m:s", strtotime( $cadastros_news->news_data ) ); ?></th>
                    <th scope="row">    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Editar</button></th>
                    <th scope="row"><a href="?excluir=<?php echo $cadastros_news->ID; ?>" class="btn btn-danger text-center"> Excluir </a></th>
                </tr>
			<?php } ?>
            </tbody>
        </table>

	    <?php
	    global $apagar_user_meta;
	    global $apagar_user;
        if ($apagar_user AND $apagar_user_meta == TRUE) { ?>
            <div class="alert-success">
			    <?php echo "DELETADO COM SUCESSO!"; ?>
            </div>
	    <?php } ?>
    </div>
</div>
<?php get_footer(); ?>