## Getting Started

To get started, require the package:

```bash
composer require elmogy/larafast
```

### Install the package

After including larafast, you have to install it by running the following command:

```bash
php artisan larafast:install
```

After installing the package you will find a directory called `unit_template` inside `core/Base`, that's the directory that has the default views that will be included in every unit you generate (after running this command `php artisan larafast:unit UnitName --module=ModuleName` keep reading to learn more about this command).

Please take a look at the blade files inside `core/Base/views` and `core/Base/unit_template` you will notice that `$global` variable is shared across all the views.
