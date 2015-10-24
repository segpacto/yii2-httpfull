HttpFull
========
Extension conversion of 'Httpful' to yii2 extension

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Since it is not published on packages.org needs to be installed manually using composer
add to your composer.json

```php
"repositories":[
    {
        "type": "git",
        "url": "https://path.to/your/repo"
    }
]

since the file is local the 'url' should be "url" : "file:///path_to_your_file"
```


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
// Make a request to the GitHub API with a custom
// header of "X-Trvial-Header: Just as a demo".
$url = "https://api.github.com/users/nategood";
$response = \HttpFull\Request::get($url)
    ->expectsJson()
    ->withXTrivialHeader('Just as a demo')
    ->send();

echo "{$response->body->name} joined GitHub on " .
                        date('M jS', strtotime($response->body->created_at)) ."\n";
```

Ex 1:
Send off a GET request. Get automatically parsed JSON response.
The library notices the JSON Content-Type in the response and automatically parses the response into a native PHP object.

```php
$uri = "https://www.googleapis.com/freebase/v1/mqlread?query=%7B%22type%22:%22/music/artist%22%2C%22name%22:%22The%20Dead%20Weather%22%2C%22album%22:%5B%5D%7D";
$response = \HttpFull\Request::get($uri)->send();

echo 'The Dead Weather has ' . count($response->body->result->album) . " albums.\n";
```

Ex 2:

```php
$uri = 'https://example.net/person.xml';
$response = \HttpFull\Request::get($uri)
    ->expectsXml()
    ->send();

echo "Name: $response->body->name";
```

Note : This is based on the <a href='https://github.com/nategood/httpful'>package</a>
shared by <a href='https://github.com/nategood'>nategood</a>. This is only
a conversion to use as Yii2 extension.
For further explanation and documentation of the package go directly their <a href='http://phphttpclient.com/'>documentation</a>.
