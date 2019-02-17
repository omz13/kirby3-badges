# Kirby3 badges

 ![License](https://img.shields.io/github/license/mashape/apistatus.svg) ![Kirby Version](https://img.shields.io/badge/Kirby-3-black.svg) [![Issues](https://img.shields.io/github/issues/omz13/kirby3-badges.svg)](https://github.com/omz13/kirby3-badges/issues)

**Requirement:** Kirby 3

## Coffee, Beer, etc.

This plugin is free. However, to show your support, especially if using it in a commercial project, you are welcome (greatly encouraged) to:
- [make a donation 🍻](https://www.paypal.me/omz13/10) or
- [buy me ☕☕](https://buymeacoff.ee/omz13) or
- [buy a Kirby license using this affiliate link](https://a.paddle.com/v2/click/1129/36191?link=1170)

## Documentation

### Purpose

For a [Kirby3](https://getkirby.com)-powered site, this plugin (_omz13/badges_) provides a KirbyTag (called `badge`) that allows badges to be rendered in a page.

- This plugin is a convenience wrapper around [PHP Badges Library](https://github.com/badges/poser).
- No configuration is really necessary as it comes with sensible defaults.
- The render style can be specified in the configuration file and overridden on a per tag basis.
- The color for the value can be specified in the configuration file and overridden on a per tag basis.
- There are sensible defaults if you forget to provide the necessary key and/or value data in a tag.
- The badge is rendered locally, provided as a SVG image, and wrapped in a `<div>` with an optional `class`.

#### Roadmap

The non-binding list of further features and implementation notes are:

- [ ] Page-level function
- [x] Put a joke or two into README
- [x] Use the word _epistemological_ in README to confuse everybody (except people who do or have done philosophy or art history).

### Installation

Pick one of the following per your epistemological model:

- `composer require --no-dev omz13/kirby3-badges`; the plugin will automagically appear in `site/plugins`.
- Download a zip of the latest release - [master.zip](https://github.com/omz13/kirby3-badges/archive/master.zip) - and copy the contents to your `site/plugins/kirby3-badges`.
- `git submodule add https://github.com/omz13/kirby3-badges.git site/plugins/kirby3-badges`.

For the record: installation by composer is cool; supporting installation by zip and submodule was an absolute pain, especially as I am an installation by composer person, so do feel guilted into getting me Coffee, Beer, etc., because this is for _your_ benefit and _not mine_ (and yes, I would have have preferred to spend my time somewhere warm and sunny instead of being hunched over a keyboard while the snow falls outside and the thermometer shows no inclination to get above 0C).

### Configuration

The following mechanisms can be used to modify the plugin's behavior.

#### via `config.php`

In your site's `site/config/config.php` the following entries prefixed with `omz13.badges.` can be used:

- `style` - optional - the name of the rendering style to apply.

  Possible values are:
    - `flat` (default if not specified)
    - `flat-square`
    - `plastic`

- `color` - optional - the name or RGBHEX value to be used for the badge's name.

  If not specified, `428F7E` is assumed.

- `class` - optional - the code for the badge will be wrapped in a `<DIV>` with a _classname_ specified here.

  If not specified, the `<DIV>` wrapper has no class.

For example:

```php
<?php

return [
  'omz13.badges.style' => 'plastic',
  'omz13.badges.class' => 'badge',
  ],
];
```

## Use

```
"(badge:" key value [ color [ "style:"style ] ] ")"
```

When writing content, this plugin provide a new tag, `badge`, which has two mandatory parameters that specify the `key` and `value` for the badge; an optional third parameter specifies the color for the value, either as a named color (e.g. `red`) or a RGBhex (e.g. `428F7E`).

An optional attribute of `style` can be used to override the default style (c.f. `style` in _Configuration_).

Parameters can be separated by spaces (` `), commas (`,`), or semicolons (`;`).

If `key` is not supplied, then `???` will be used.

If `value` is not supplied, then `???` will be used.

### Examples:

Use the (implicit) style from the configuration, or explictly set:

```
  - (badge: style, implicit - from configuration)
  - (badge: style, explicit flat style:flat)
  - (badge: style, explicit plastic style:plastic)
  - (badge: style, explicit flat-square style:flat-square)
```

![pix](docs/style.png)

Applying some color:

```
- (badge: copyright ; public domain ; green  )
- (badge: stability: unstable orange)
- (badge: licence MIT)
- (badge: statis YES yellow)
```

![pix](docs/colors.png)

Missing key and/or value:

```
- (badge:)
- (badge: wibble)
```

![pix](docs/missing.png)

## Disclaimer

This plugin is provided "as is" with no guarantee. Use it at your own risk and always test it yourself before using it in a production environment. If you find any issues, please [create a new issue](https://github.com/omz13/kirby3-badges/issues/new).

## License

[MIT](https://opensource.org/licenses/MIT)

You are prohibited from using this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
