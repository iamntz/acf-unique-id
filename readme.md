## What's this?

An ACF field type that generates a unique ID.

## Installation

1. Download the whole repo
2. Upload the `acf-unique-id` folder to your `wp-content/plugins` folder
3. Activate the plugin via the Plugins admin page
4. Create a new field via ACF and select the Unique ID type

### Composer instalation

`composer require iamntz/acf-unique-id`

In your theme/plugin, include it:


### Field options

By default, the generated field gives you a random 16 character string, separated by dashes similar to this:

```
ade5-8d58-b319-1678
```

You can change the length of the string, and the separator in the field options.

Also, you can enable debug, so the field will be visible in the admin area, and you can see the generated ID.

## License

MIT.