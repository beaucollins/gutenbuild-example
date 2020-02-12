# Gutenbuild

Zero to Gutenburg with Docker and @wordpress/env.

1. Start building
   ```bash
   docker run -v `pwd`/src:/var/app/src -v `pwd`/build:/var/app/build coplusco/gutenbuild
   ```
2. Boot WordPress
   ```bash
   wp-env start
   open http://localhost:8888/
   ```
3. ???
4. Blocks!

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