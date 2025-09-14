# utils
Currently two classes:
 * Format for formatting
 * Html for some handy web page functions like wrap_tag and check_request_params

## bootstrap
Define the `SETTINGS` constant with
```php
require __DIR__ . '/vendor/kingsoft/utils/settings.inc.php';
```

Prior Set `SETTINGS_FILE` to something else than settings.ini if you want.

After this the `SETTINGS` constant is available with an array of arrays containing the content of the settings file.
