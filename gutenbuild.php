<?php
/**
 * @wordpress-plugin
 * Plugin Name: Gutenbuild
 * Plugin URI: http://gutenbuild.local/
 * Description: Blocks are the future.
 */

function gutenbuild_init_block() {
	$script_asset = require_once( __DIR__ . '/build/index.asset.php' );

	wp_register_script(
		'gutenbuild-example-block-editor',
		plugins_url( 'build/index.js', __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	wp_register_style(
		'gutenbuild-editor-style',
		plugins_url( 'editor.css', __FILE__ ),
		[]
	);

	wp_register_style(
		'gutenbuild-style',
		plugins_url( 'style.css', __FILE__ ),
		[]
	);

	register_block_type(
		'create-block/gutenbuild',
		[
			'editor_script' => 'gutenbuild-example-block-editor',
			'editor_style' => 'gutenbuild-editor-style',
			'style' => 'gutenbuild-style',
		]
	);
}

add_action( 'init', 'gutenbuild_init_block' );

