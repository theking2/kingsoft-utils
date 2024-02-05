# utils
Currently two classes:
 * Format for formatting
 * Html for some handy web page functions like wrap_tag and check_request_params

## bootstrap
Load SETTINGS with
```php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/kingsoft/utils/settings.inc.php';
```

Prior Set `SETTINGS_FILE` to something else than settings.ini if you want.

After this the `SETTINGS` constant is available with an array of arrays containing the content of the settings file.
