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

## Module

To create a new module, run the following:

`php artisan larafast:module ModuleName`

Here is an example:

```bash
php artisan larafast:module Todo
```

## Unit

To create a new unit, there are 2 commands we have to run:

### Initialization

`php artisan larafast:unit UnitName --module=ModuleName --init`

To initialize the unit with basic stuff (model, API controller and Web Controller) and after running the command you can configure the unit, here is an example:

```bash
php artisan larafast:unit Task --module=Todo --init
```

then navigate to `core/Todo/data/Task.json` and update it like in the following:

```json
{
  "attributes": {
    "name": {
      "type": "string"
    },
    "description": {
      "type": "text",
      "definition": "nullable"
    },
    "priority": {
      "type": "enum:low,medium,high",
      "definition": "nullable|default:medium"
    },
    "is_done": {
      "type": "boolean",
      "definition": "default:false"
    }
  },
  "relations": {
      this feature will be released soon...
  }
}
```

Please note the following:

`attributes`: contains the unit attributes (you can think of attributes as the columns of the table in the database).

`type`: the type of the attribute, please check all available types [here](https://laravel.com/docs/8.x/migrations#available-column-types)

`definition`: it holds the column modifiers & indexes in the database, please check all available modifiers & indexes from [here](https://laravel.com/docs/8.x/migrations#column-modifiers) and [here](https://laravel.com/docs/8.x/migrations#available-index-types)

You may have noticed that the values in `type` and `definition` are designed the same way as we do in the validation rules.

### Publishing

`php artisan larafast:unit UnitName --module=ModuleName`

To create all the related stuff (migration, request, resource, factory, unit test ...etc) based on the previous command:

```bash
php artisan larafast:unit Task --module=Todo
```

### Notes

* when overriding a unit (for example Task unit) by running the command in `Publishing` section again, all related migration files will be deleted for this unit (for example create table migration file and adding new column/s migration file).
