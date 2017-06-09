In addition to using settings in your Sass files, you can also use them in your theme's php files.

- [Get Setting](#get-setting)
- [Get Settings](#get-settings)
- [Get Path](#get-path)

***

### Get Setting

Returns the value for a single setting.

*Method*
```php
$wpcsass->get_setting( $setting_id );
```

*Example*
```php
$my_setting = $wpcsass->get_setting( 'my_setting' );
```

***

### Get Settings

Returns an array containing values for all available settings.

*Method*
```php
$wpcsass->get_settings();
```

*Example*
```php
$settings = $wpcsass->get_settings();
```

***

### Get path

Returns the path to the requested file.

*Method*
```php
$wpcsass->get_path( $file, $type );
```

*Example*
```php
$wpcsass->get_path( 'sass_output', 'live' );
```

*File Options*
- 'input_directory'
- 'vardump'
- 'sass_output'
- 'stylesheet'

*Type Options*
- 'live' (returns a uri)
- 'local' (returns a local file path)