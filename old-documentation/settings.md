You can change several settings to customise the plugin. These are all method calls which change variables within the WPC_Sass object in order to change its behaviour.

### Contents

- [Set Sass Template Directory](#set-sass-template-directory)
- [Set Sass Template Directory URI](#set-sass-template-directory-uri)
- [Set Sass Input Directory](#set-sass-input-directory)
- [Set Sass Entry Point](#set-sass-entry-point)
- [Set Sass Output Directory](#set-sass-output-directory)
- [Set Sass Vardump](#set-sass-vardump)
- [Set Sass Output](#set-sass-output)
- [Set Live Stylesheet](#set-live-stylesheet)
- [Set CSS Backup Quantity](#set-css-backup-quantity)

***

### Set Sass Template Directory

This setting controls the `local` root file path.

*Default*
```
stylesheet_directory
```

*Method*
```php
$wpcsass->set_template_directory( $directory );
```

*Example*
```php
$wpcsass->set_template_directory( get_stylesheet_directory() );
```

***

### Set Sass Template Directory URI

This setting controls the `live` root file path.

*Default*
```
stylesheet_directory_uri
```

*Method*
```php
$wpcsass->set_template_directory_uri( $directory );
```

*Example*
```php
$wpcsass->set_template_directory_uri( get_stylesheet_directory_uri() );
```

***

### Set Sass Input Directory

This setting controls the location of the directory which contains your non-compiled `scss` files within the root folder.

*Default*
```
sass
```

*Method*
```php
$wpcsass->set_sass_input_directory( $directory );
```

*Example*
```php
$wpcsass->set_sass_input_directory( 'sass' );
```

***

### Set Sass Entry point

This setting controls the entry point filename which the Sass compiler looks for within the *Sass input directory*.

*Default*
```
style.scss
```

*Method*
```php
$wpcsass->set_sass_entry_point( $filename );
```

*Example*
```php
$wpcsass->set_sass_entry_point( 'style.scss' );
```

***

### Set Sass Output Directory

This setting controls the location of the directory into which the plugin places the generated `css` files within the root folder.

*Default*
```
sass_output
```

*Method*
```php
$wpcsass->set_sass_output_directory( $directory );
```

*Example*
```php
$wpcsass->set_sass_output_directory( 'sass_output' );
```

***

### Set Sass Vardump

This setting controls the filename of the Sass vardump file. [Click here for a brief explanation of this file.](#sass-vardump)

*Default*
```
_customizer_variables.scss
```

*Method*
```php
$wpcsass->set_sass_vardump( $filename );
```

*Example*
```php
$wpcsass->set_sass_vardump( '_customizer_variables.scss' );
```

***

### Set Sass Output

This setting controls the filename of the main output file which the plugin generates.

*Default*
```
style.css
```

*Method*
```php
$wpcsass->set_sass_output( $filename );
```

*Example*
```php
$wpcsass->set_sass_output( 'style.css' );
```

***

### Set Live Stylesheet

This setting controls the filename of the live stylesheet which the plugin overwrites when saving.

*Default*
```
style.css
```

*Method*
```php
$wpcsass->set_live_stylesheet( $filename );
```

*Example*
```php
$wpcsass->set_live_stylesheet( 'style.css' );
```

***

### Set CSS Backup Quantity

This setting controls the number of backup copies of the `style.css` file that the plugin generates.

*Default*
```
1
```

*Method*
```php
set_css_backup_quantity( $quantity );
```

*Example*
```php
set_css_backup_quantity( 3 );
```