Betong
=========
![betong-logo](https://cloud.githubusercontent.com/assets/13795561/19984580/587e1fac-a20f-11e6-9e50-91cceeffd220.png)
A modern Concrete5 starting point. Trying to make it as easy as possible to get started with a Concrete5 site.

    composer create-project adamlindqvist/betong
    
## Features
- Gulp with Laravel Elixir
- Clean project structure
- Package boilerplate
- Theme boilerplate
- PHP Helpers

## Gulp

Betong has integrated [Elixir](https://laravel.com/docs/5.3/elixir). It provides a clean, fluent API for defining basic Gulp tasks for your Betong application.

#### Installation

Before triggering Elixir, you must first ensure that [Node.js](https://nodejs.org/en/) is installed on your machine.

```sh
node -v
```

If you don't have Node on your machine you can install it by visiting their [download page](https://nodejs.org/download/).

Within a fresh installation of Betong, you'll find a `package.json` file in the root. Think of this like your `composer.json` file, except it defines Node dependencies instead of PHP. You may install the dependencies it references by running:

```sh
npm install
```

If you are developing on a Windows system or you are running your VM on a Windows host system, you may need to run the `npm install` command with the `--no-bin-links` switch enabled:

```sh
npm install --no-bin-links
```

#### Usage

To use Elixir and Gulp, please run one of the following commands:

For more information about Elixir please visit the [official document page](https://laravel.com/docs/5.3/elixir).

    
## Package boilerplate
Betong ships with a example package which contains code to accomplish common tasks directly from the code:
- Install pagetypes
- Install pagetemplates
- Install custom-blocks
- Install attributes
- Install composer-fields and attach them to a pagetype

See the controller.php in `public/package/betong/controller.php`


## Helpers
Below is a list of all supported helper methods.

Arrays | Strings | Miscellaneous
------ | ------- | -------------
[array_add](https://laravel.com/docs/5.3/helpers#method-array-add) | [camel_case](https://laravel.com/docs/5.3/helpers#method-camel-case) | [collect](https://laravel.com/docs/5.3/helpers#method-collect)
[array_collapse](https://laravel.com/docs/5.3/helpers#method-array-collapse) | [class_basename](https://laravel.com/docs/5.3/helpers#method-class-basename) | [dd](https://laravel.com/docs/5.3/helpers#method-dd)
[array_divide](https://laravel.com/docs/5.3/helpers#method-array-divide) | [e](https://laravel.com/docs/5.3/helpers#method-e) | [dump](https://laravel.com/docs/5.3/helpers#method-dd)
[array_dot](https://laravel.com/docs/5.3/helpers#method-array-dot) | [ends_with](https://laravel.com/docs/5.3/helpers#method-ends-with) | [elixir](https://laravel.com/docs/5.3/helpers#method-elixir)
[array_except](https://laravel.com/docs/5.3/helpers#method-array-except) | [snake_case](https://laravel.com/docs/5.3/helpers#method-snake-case) | [value](https://laravel.com/docs/5.3/helpers#method-value)
[array_first](https://laravel.com/docs/5.3/helpers#method-array-first) | [starts_with](https://laravel.com/docs/5.3/helpers#method-starts-with) | 
[array_flatten](https://laravel.com/docs/5.3/helpers#method-array-flatten) | [str_contains](https://laravel.com/docs/5.3/helpers#method-str-contains) |
[array_forget](https://laravel.com/docs/5.3/helpers#method-array-forget) | [str_finish](https://laravel.com/docs/5.3/helpers#method-str-finish) |
[array_get](https://laravel.com/docs/5.3/helpers#method-array-get) | [str_is](https://laravel.com/docs/5.3/helpers#method-str-is) |
[array_has](https://laravel.com/docs/5.3/helpers#method-array-has) | [str_limit](https://laravel.com/docs/5.3/helpers#method-str-limit) |
[array_last](https://laravel.com/docs/5.3/helpers#method-array-last) | [str_plural](https://laravel.com/docs/5.3/helpers#method-str-plural) |
[array_only](https://laravel.com/docs/5.3/helpers#method-array-only) | [str_random](https://laravel.com/docs/5.3/helpers#method-str-random) |
[array_pluck](https://laravel.com/docs/5.3/helpers#method-array-pluck) | [str_singular](https://laravel.com/docs/5.3/helpers#method-str-singular) |
[array_prepend](https://laravel.com/docs/5.3/helpers#method-array-prepend) | [str_slug](https://laravel.com/docs/5.3/helpers#method-str-slug) |
[array_pull](https://laravel.com/docs/5.3/helpers#method-array-pull) | [studly_case](https://laravel.com/docs/5.3/helpers#method-studly-case) |
[array_set](https://laravel.com/docs/5.3/helpers#method-array-set) | [title_case](https://laravel.com/docs/5.3/helpers#method-title-case) |
[array_sort](https://laravel.com/docs/5.3/helpers#method-array-sort) |  |
[array_sort_recursive](https://laravel.com/docs/5.3/helpers#method-array-sort-recursive) |  |
[array_where](https://laravel.com/docs/5.3/helpers#method-array-where) |  |
[head](https://laravel.com/docs/5.3/helpers#method-head) |  |
[last](https://laravel.com/docs/5.3/helpers#method-last) |  |
