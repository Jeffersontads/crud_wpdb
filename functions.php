<?php
//newsletter
//prefixos (wp)

$table_name = $wpdb -> prefix . 'newsletter';

if (!empty($_POST['cadastrar'])) {
	if ( ! empty( $_POST['user_login'] ) and ! empty( $_POST['user_email'] )) {

		$user_login = sanitize_text_field($_POST['user_login']);
		$user_email = sanitize_text_field($_POST['user_email']);
		//$data = sanitize_text_field($_POST['data']);

		global $wpdb;
		$user_data = date( 'Y-m-d H:m:s' );

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
//	$apagar_user_meta = $wpdb->delete( $table_name1, array( 'user_id' => $id_user ) );
}

//update
		if ( !empty( $_GET['update'] ) ) {
			global $wpdb;
			$id_user = sanitize_text_field( $_GET['update'] );

			$new_user_login = sanitize_text_field($_GET['user_login']);
			$new_user_email = sanitize_text_field($_GET['user_email']);

			$wpdb->update(
				$table_name,
				array($new_user_login, $new_user_email,
				),
				array( 'ID' => $id_user ), //where
				array( '%s','%s' ), //data format
				array( '%s','%s' ) //where format
			);
		}

