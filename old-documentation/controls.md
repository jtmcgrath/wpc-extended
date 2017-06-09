In addition to the default controls, the plugin includes several custom controls plus a shortcut for creating a comprehensive set of background controls via a single setting. All of the available controls are described below.

- [Inherit](#inherit)
- [Presentation](#presentation)
	- [Title](#title)
	- [Description](#description)
	- [Subtitle](#subtitle)
- [Range](#range)
- [Radio](#radio)
- [Section Shorthands](#section-shorthands)
	- [Background Section](#background-section)
	- [Border Section](#border-section)
	- [Typography Section](#typography-section)
- [Alpha Colour](#alpha-colour)
- [Standard Controls](#standard-controls)
	- [Colour](#colour)
	- [Text](#text)
	- [Checkbox](#checkbox)
	- [Select](#select)
	- [Textarea](#textarea)
	- [Image](#image)

***

### Inherit

The `inherit` setting lets you create a setting which can be set to copy the value of *another* setting.

As an example, many themes would include two main colours which would be used consistently throughout the theme - a `primary` colour and a `secondary` colour. One major downside to the Customizer is that it doesn't support this concept; you would have to enter these colours separately into wherever they are meant to be used.

With the `inherit` setting, you can do this easily. You simply add an `array` to your setting's options containing a list of the settings you want it to be able to reference, and the plugin handles everything for you. It displays the available inherit options as a set of radio buttons, plus a "Custom" option which reveals a separate control when selected which allows the user to specify a non-inherited value.

The `inherit` setting can be added to any of the controls listed below except the `Section Shorthands`. The array can contain any number of settings.

![Inherit](http://i.imgur.com/uWaSbvi.png)

Setting only:

```php
'inherit' => array(
	'primary_colour'   => 'Primary',
	'secondary_colour' => 'Secondary'
)
```

Full example:

```php
'setting_id' => array(
	'label'   => 'Custom Setting',
	'section' => 'custom_section',
	'type'    => 'colour',
	'default' => '#444',
	'inherit' => array(
		'primary_colour'   => 'Primary',
		'secondary_colour' => 'Secondary'
	)
)
```

***

### Presentation

This custom control allows you to add presentational text into the layout of the Customizer. It comes in three flavours: **Title**, **Subtitle**, and **Description**.

![Presentation Controls](http://i.imgur.com/XdTG54h.png)

#### Title

Adds a stylised `<h1>` tag containing a label.

```php
'title_setting' => array(
	'label'   => 'Example Title',
	'section' => 'custom_section',
	'type'    => 'title'
)
```

#### Subtitle

Adds a stylised `<h3>` tag containing a label.

```php
'subtitle_setting' => array(
	'label'   => 'Example Subtitle',
	'section' => 'custom_section',
	'type'    => 'subtitle'
)
```

#### Description

Adds a `<p>` tag containing text.

```php
'description_setting' => array(
	'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	'section'     => 'custom_section',
	'type'        => 'description'
)
```

***

### Range

The range control allows you to create a slider with minimum and maximum values. It includes a label which displays the current value. You can also click on the label itself and manually type in the number you want.

![Range Control](http://i.imgur.com/fQzrQqW.png)

```php
'range_setting' => array(
	'label'   => 'Range',
	'section' => 'custom_section',
	'type'    => 'range',
	'default' => '3',
	'units'   => 'px',
	'range'   => array(
		'min'  => '0',
		'max'  => '20',
		'step' => '1'
	)
)
```

***

### Radio

The radio control adds some cleaner presentation to the typical radio functionality. Options are wrapped intelligently, showing either two or three per line depending on the total number. The labels are styled to match the Customizer's button style, with the addition of a checkmark on the selected option.

![Radio Control](http://i.imgur.com/LGa1SB9.png)

```php
'radio_setting_3' => array(
	'label'   => 'Radio 3',
	'section' => 'custom_section',
	'type'    => 'radio',
	'choices' => array(
		'a' => 'Option A',
		'b' => 'Option B',
		'c' => 'Option C',
		'd' => 'Option D'
	)
)
```

***

### Section Shorthands

The background, border, and typography sections are all shorthands which allow you to add multiple connected controls without typing them all in manually.

#### Background Section

A background section includes a colour control, an image control, and several radio controls. The radio controls are only visible when an image has been selected, because they control the `background-repeat`, `background-position`, `background-attachment`, and `background-size` properties.

*Note: the background colour control can use either the default or the alpha colour picker.*

![Background Section](http://i.imgur.com/oWpje8n.png)

```php
'background_setting' => array(
	'label'   => 'Background',
	'section' => 'custom_section',
	'type'    => 'background_section',
	'alpha'   => true,
	'default' => '#444'
)
```

#### Border Section

A border section includes `border-width`, `border-color`, `border-style`, and `border-radius` controls. The `border-color` and `border-style` controls are hidden when the `border-width` control equals `0`.

![Border Section](http://i.imgur.com/UMDODqk.png)

```php
'border_setting' => array(
	'label'   => 'Border',
	'section' => 'custom_section',
	'type'    => 'border_section',
	'default' => #444
)
```

#### Typography Section

A typography section includes `font-family`, `font-size`, `font-style`, `font-weight`, and `line-height` controls.

![Typography Section](http://i.imgur.com/wCIDsaP.png)

```php
'typography_setting' => array(
	'label'   => 'Typography',
	'section' => 'custom_section',
	'type'    => 'typography_section'
)
```

***

### Alpha Colour

The alpha colour control was created by Braad Martin, [and is available on GitHub](https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker). It works almost exactly the same as the standard colour control, but with an added transparency option.

![Alpha Colour Control](http://i.imgur.com/OBTRHFo.png)

```php
'alpha_setting' => array(
	'label'   => 'Alpha Colour',
	'section' => 'custom_section',
	'type'    => 'colour',
	'alpha'   => true,
	'default' => '#444'
)
```

***

### Standard Controls

The standard Customizer controls are also available.

![Standard Controls](http://i.imgur.com/TP834Nr.png)

#### Colour

```php
'colour_setting' => array(
	'label'   => 'Standard Colour',
	'section' => 'custom_section',
	'type'    => 'colour',
	'default' => '#444'
)
```

#### Text

```php
'text_setting' => array(
	'label'   => 'Text',
	'section' => 'custom_section',
	'type'    => 'text',
	'default' => 'default'
)
```

#### Checkbox

```php
'checkbox_setting' => array(
	'label'   => 'Checkbox',
	'section' => 'custom_section',
	'type'    => 'checkbox'
)
```

#### Select

```php
'select_setting' => array(
	'label'   => 'Select',
	'section' => 'custom_section',
	'type'    => 'select',
	'choices' => array(
		'a' => 'Option A',
		'b' => 'Option B',
		'c' => 'Option C'
	)
)
```

#### Textarea

```php
'textarea_setting' => array(
	'label'   => 'Textarea',
	'section' => 'custom_section',
	'type'    => 'textarea'
)
```

#### Image

```php
'image_setting' => array(
	'label'   => 'Image',
	'section' => 'custom_section',
	'type'    => 'image'
)
```