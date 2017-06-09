The Sass vardump is a generated file which contains every Sass variable and value passed from the Customizer into Sass. The Sass compiler does not normally display the available variables, so this vardump acts as a convenient cheat-sheet for easy reference when developing themes.

It also includes every `title` and `subtitle` custom control as comments, which helps break down the sections appropriately.

The [Comprehensive Example](https://github.com/jtmcgrath/wpcsass/wiki/Comprehensive-Example) will output the following Sass Vardump file:

```

// Title
// Subtitle

// Range Control
$range: 15px;

// Radio Control
$radio_1: a;
$radio_2: a;
$radio_3: a;
$radio_4: a;

// Alpha Colour Control
$alpha_colour: #444444;

// Standard Controls
$colour: #444;
$text: default;
$checkbox: true;
$select: a;
$textarea: '';
$image: '';

// Background Section
$background_section_bgcolor: '';
$background_section_bgimage: '';
$background_section_bgrepeat: no-repeat;
$background_section_bgposition: center;
$background_section_bgattachment: scroll;
$background_section_bgsize: cover;

// Border Section
$border_section_borderwidth: 0px;
$border_section_bordercolor: '';
$border_section_borderstyle: solid;
$border_section_borderradius: 0px;

// Typography Section
$typography_section_font_family: inherit;
$typography_section_font_size: 16px;
$typography_section_font_style: inherit;
$typography_section_font_weight: 400;
$typography_section_line_height: 1.5;

// Inherit Examples
$inherit_colour_inherit: $alpha_colour;
$inherit_colour: $alpha_colour;
$another_inherit_colour_inherit: $alpha_colour;
$another_inherit_colour: $alpha_colour;
$inherit_range_inherit: $range;
$inherit_range: $range;
$inherit_radio_inherit: $inherit_radio;
$inherit_radio: a;

```