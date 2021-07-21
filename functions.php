<?php
//cadastrar dados para newsletter
global $inserido;
$table_name = $wpdb -> prefix . 'newsletter';

if (!empty($_POST['cadastrar'])) {
	if ( ! empty( $_POST['user_login'] ) and ! empty( $_POST['user_email'] )) {

		$user_login = sanitize_text_field($_POST['user_login']);
		$user_email = sanitize_text_field($_POST['user_email']);

		global $wpdb;

		$inserido = $wpdb->insert( $table_name, array(
			'news_name'          => $user_login,
			'news_email'          => $user_email,
		) );
	}
}

//deletar
if (!empty($_GET['excluir'])) {
	global $wpdb;

	$id_user = sanitize_text_field( $_GET['excluir'] );
	$apagar_user      = $wpdb->delete( $table_name, array( 'ID' => $id_user ) );

}

//editar update
if ($_POST['salvar-editar'] = TRUE) {
		$edit_user_email = sanitize_text_field( $_POST['edited_user_email'] );
		$id_up = $cadastros_news->ID;

		global $wpdb;
		//$wpdb->update($table_name, $edit_user_email,$current_user);
	$wpdb->query( $wpdb->prepare("UPDATE $table_name SET 'news_email' = $edit_user_email WHERE 'ID'= $id_user"));

}

?>
