> # READ THIS FIRST

> It is highly recommended for all contributors to update this file whenever there's a major update in source code. Use [this tool](https://stackedit.io/app#) for easy editing or [visit this page](https://help.github.com/articles/basic-writing-and-formatting-syntax/) for comprehensive guide on markdown syntax.

  

# Introduction

This package consists of following three commands:

## app:cleanup
This utility calls one or more of the following commands, depending on the given parameters:

- `auth:clear-resets`
- `cache:clear`
- `config:clear`
- `debugbar:clear`
- `route:clear`
- `view:clear`
- `session:clear`
- `log:clear`

It will call the commands if they are registered. All commands except last two are built in to Laravel or some other packages. Continue below to study about last two commands that are exposed by this package.

### Signature
``` bash
app:cleanup {--all} {--auth} {--cache} {--config} {--debugbar} {--route} {--view} {--session} {--log}
```

### Usage Examples
``` bash
php artisan app:clean
php artisan app:clean --view --cache
php artisan app:clean --all
```
## session:clear
This command is exposed by this package. It clears all the files from storage/framework/sessions folder.
### Signature
```
session:clear
```

### log:clear
This command is also exposed by this package. It deletes all `laravel*.log` files from storage/logs folder.

### Signature
```
log:clear
```


  

## Usage Examples

-  `php artisan env:switch dev`

-  `php artisan env:switch prod --force`

# To-dos

Following are the approved items:

- `session:clear` command deletes all files from sessions folder. However if session driver is different than `file` than it won't work. It needs to work with other drivers as well, specially with `redis` driver.

  

# Wishlist

Add the suggestions in this wishlist. Only approved wishlist items can be moved to To-dos list:

- Item-1