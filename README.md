HttpFull
========
Extension conversion of 'Httpful' to yii2 extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Since it is not published on packages.org needs to be installed manually using composer
add to your composer.json

"repositories":[
    {
        "type": "git",
        "url": "https://path.to/your/repo"
    }
]

since the file is local the 'url' should be "url" : "file:///path_to_your_file"


Either run

```
php composer.phar require --prefer-dist segpacto/yii2-httpfull "*"
```

or add

```
"segpacto/yii2-httpfull": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \HttpFull\AutoloadExample::widget(); ?>```
