# CMS Base

This Library is the base for my CMS.


# Install 

1. Do at first to publish public files.

```
$ php artisan vendor:publish
```

2. Add except in VerifyCsrfToken to app/Http/Middleware/VerifyCsrfToken.php like

```app/Http/Middleware/VerifyCsrfToken.php
    protected $except = [
        '/topimage/pict/*',
        '/activity/pict/*',
    ];
```

3. Add ignore files to .gitignore.

```
/public/files/topimage/*
!/public/files/topimage/.gitkeep
/public/files/activity/*
!/public/files/activity/.gitkeep
```

# menus
- Activity