<?php
/*
Template Name: Custom Home Page
*/
?>

<?php get_header(); ?>
    <div class="col-12 container-fluid">
        <form method="POST">
            <div class="mb-3">
                <h2>CADASTRE-SE NA NEWSLETTER</h2>
                <label class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="campoNome" name="user_login">
                <br>
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="user_email" id="campoEmail">
                <input type="submit" name="cadastrar" class="btn btn-success" value="CADASTRAR-SE">
            </div>
			<?php

			global $inserido;
			if ( $inserido == true ) { ?>
                <div class="alert-success">
					<?php echo "CADASTRO FEITO COM SUCESSO!"; ?>
                </div>
			<?php } ?>
        </form>
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
					//var_dump($cadastros_news); exit();
					?>
                    <tr>
                        <th scope="row"><?php echo $cadastros_news->ID; ?></th>
                        <td><?php echo $cadastros_news->news_name; ?></td>
                        <td><?php echo $cadastros_news->news_email; ?></td>
                        <th scope="row"><?php echo $cadastros_news->news_data; ?></th>
                        <th scope="row">
                            <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#exampleModal"
                                    data-whateverID="<?php echo $cadastros_news->ID; ?>"
                                    data-whatevernome="<?php echo $cadastros_news->news_name; ?>"
                                    data-whateveremail="<?php echo $cadastros_news->news_email; ?>">
                                Editar
                            </button>
                        </th>
                        <th scope="row"><a href="?excluir=<?php echo $cadastros_news->ID; ?>"
                                           class="btn btn-danger text-center"> Excluir </a></th>
                    </tr>
				<?php } ?>
                </tbody>
            </table>

			<?php
			global $apagar_user_meta;
			global $apagar_user;
			if ( $apagar_user and $apagar_user_meta == true ) { ?>
                <div class="alert-success">
					<?php echo "DELETADO COM SUCESSO!"; ?>
                </div>
			<?php } ?>
        </div>

        <!-- Modal para aditar os cadastros-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title"
                            id="exampleModalLabel">Editar cadastro</h2>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <label class="form-label">Nome de Usuário</label>
                            <input readonly type="text" class="form-control" id="campoNome" name="edited_user_login"
                                   placeholder="<?php echo $cadastros_news->news_name; ?>">
                            <br>
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="input-email" name="edited_user_email">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" name="salvar-editar" class="btn btn-warning" value="SALVAR EDIÇÃO">
                        </div>
                    </form>
                </div>
            </div>
        </div>

		<?php
		global $id_user;
		var_dump($cadastros_news->ID);
		?>
    </div>

    <!--//pega os dados que vem do post php para inserir no campo imput da modal para editar-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>

        $('#exampleModal').on('shown.bs.modal', function (event) {

            var button = $(event.relatedTarget);
            //var recipient = button.data('whatever');
            //var recipientID = button.data('whateverID');
            //var recipientnome = button.data('whatevernome');
            var recipientcampoEmail = button.data('whateveremail');

            var modal = $(this);
            //modal.find('.modal-title').text('New message to ' + recipient);
            //modal.find('.modal-body input').val(recipient);
            modal.find('#input-email').val(recipientcampoEmail);

        });

    </script>
<?php get_footer(); ?>
