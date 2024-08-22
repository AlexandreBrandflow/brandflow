<?php 
////
//// PLUGINS MENUS

function bfw_import_menus($json) {
	$menus = json_decode($json, true);
	if (!$menus) {
			wp_die('Erreur: Le fichier JSON est invalide.');
	}

	foreach ($menus as $menu_slug => $menu_items) {
			$menu_id = wp_create_nav_menu($menu_slug);
			if (is_wp_error($menu_id)) {
					wp_die('Erreur: Échec de la création du menu ' . $menu_slug);
			}

			foreach ($menu_items as $item) {
					$item_data = array(
							'menu-item-title' => $item['title'],
							'menu-item-url' => $item['url'],
							'menu-item-status' => 'publish',
							'menu-item-attr-title' => $item['attr_title'],
							'menu-item-classes' => $item['classes'],
							'menu-item-xfn' => $item['xfn'],
							'menu-item-target' => $item['target'],
							'menu-item-object' => $item['object'],
							'menu-item-object-id' => $item['object_id'],
							'menu-item-type' => $item['type'],
							'menu-item-parent-id' => $item['menu_item_parent'],
							'menu-item-position' => $item['menu_order'],
					);

					$item_id = wp_update_nav_menu_item($menu_id, 0, $item_data);
					if (is_wp_error($item_id)) {
							wp_delete_nav_menu($menu_id);
							wp_die('Erreur: Échec de la création de l\'élément de menu ' . $item['title']);
					}
			}
	}
}

function bfw_add_import_menu_link() {
	add_management_page('Importer Menus', 'Importer Menus', 'manage_options', 'import-menus', 'bfw_import_menus_page');
}
add_action('admin_menu', 'bfw_add_import_menu_link');

function bfw_import_menus_page() {
	if (isset($_FILES['import_file'])) {
			$file = $_FILES['import_file']['tmp_name'];
			$json = file_get_contents($file);
			if ($json === false) {
					echo '<div class="error"><p>Erreur: Impossible de lire le fichier importé.</p></div>';
			} else {
					bfw_import_menus($json);
					echo '<div class="updated"><p>Menus importés avec succès.</p></div>';
			}
	}
	echo '<div class="wrap"><h2>Importer les Menus</h2>';
	echo '<form method="post" enctype="multipart/form-data">';
	echo '<input type="file" name="import_file" />';
	echo '<input type="submit" class="button button-primary" value="Importer" />';
	echo '</form></div>';
}
