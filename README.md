# Gutenbuild

Zero to Gutenburg with Docker.

## Scenario

You want to add a Gutenburg block to your WordPress plugin. You don't want to install the `npm`s and the `node`s. You want to get stuff done.

Enter gutenbuild.

### Gutenbuild

```bash
docker run -v `pwd`/src:/var/app/src -v `pwd`/build:/var/app/build coplusco/gutenbuild
```

Your `./build` directory live updates with runnable Guten-code.

```php
<?php
/**
 * @wordpress-plugin
 * Plugin Name: My Fantastic Block
 * Plugin URI: http://gutenbuild.local/
 * Description: Blocks are the future.
 */

function gutenbuild_init_block() {

	$script_asset = require_once( __DIR__ . '/build/index.asset.php' );

	wp_register_script(
		'create-block-gutenbuild-example-block-editor',
		plugins_url( 'build/index.js', __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	register_block_type(
		'create-block/premium-content',
		[
			'editor_script' => 'create-block-premium-content-block-editor',
		]
	);
}

add_action( 'init', 'gutenbuild_init_block' );
```

### @wordpress/env

Don't have it?

```
npm install -g @wordpress/env
```

Launch it:

```
wp-env start
```

And see your block in action:

```
http://localhost:8888/wp-admin
```

Login with `admin` and `password`. To see your block in action.