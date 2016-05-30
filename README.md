Bootbox for Xajax
=================

This package implements javascript alert in Xajax applications using the Bootstrap Bootbox library.
http://bootboxjs.com.

Features
--------

- Enrich the Xajax response with alert functions.
- Automatically insert the Js file of the Bootbox library into the HTML page.

Installation
------------

Add the following line in the `composer.json` file.
```json
"require": {
    "lagdo/xajax-bootbox": "dev-master"
}
```

Or run the command
```bash
composer require lagdo/xajax-bootbox
```

Configuration
------------

By default the plugin loads the version 4.3.0 of Js file from the Xajax website.

- assets.lagdo-software.net/libs/bootbox/4.3.0/bootbox.min.js

This can be disabled by setting the `assets.include.bootbox` option to `false`.

Usage
-----

This example shows how to print a notification.
```
function myFunction()
{
    $response = new \Xajax\Response\Response();

    // Process the request
    // ...

    // Print a notification with Bootbox
    $response->bootbox->success("You did it!!!");

    return $response;
}
```

The `bootbox` attribute of Xajax response provides the following functions.
```
public function info($message, $title = null);      //
public function success($message, $title = null);   //
public function warning($message, $title = null);   //
public function error($message, $title = null);     //
```

Contribute
----------

- Issue Tracker: github.com/lagdo/xajax-bootbox/issues
- Source Code: github.com/lagdo/xajax-bootbox

License
-------

The project is licensed under the BSD license.
