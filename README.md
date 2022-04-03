<p align="center"><a href="https://atl-software.net" target="_blank"><img src="https://atl-software.net/wp-content/uploads/2017/03/logo.png" width="400"></a></p>



<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## ATL Software - Tecnical Interview

ATL-Sofware is a web application with the purpose of a job vacancy. It has been developed in several layers using a facade as design pattern.

Why Facade?

- Because facade pattern is commonly used in PHP applications, where the facade classes simplify the work with complex libraries or APIs.
- The Facade class provides a simple interface to the complex logic of one or several sub-classes.
- The Face delegates the client request to the appropriate object within AtlSoftware\App.


## Learning ATL-Software 

ATL-Software is accessible as framework, and provides tools to create API and robust applications.


## Required

```bash
$ require php ^8.0 | pdo | pdo-mysql | composer | phpdotenv
```

## Usage


The `.env` file is generally kept out of version control since it can contain API keys an password. A separate `.env-example`
file is created with all the required enviroment. Must add your application configuration to a .env file in the root of your project. <strong>Make sure the .env file is added to your .gitignore so it is not checked-in the code</strong>


- <strong>Run composer install</strong>

```bash
$ composer install
```

- <strong>Create databases and tables</strong> You will see a example for *contacts* ad *phones* tables.

```bash
 .database.sql
```

- <strong>Make sure your server is point to the following path </strong>

```bash
 /atl-software/public/index.php
```


- <strong>API controller </strong> Create your controller using the following method [index,show,update,store,destroy].
To maintain the framework and take benefit of `Routing.php` and  `Controller.php`.

```bash
 namespace \AtlSoftware\Controllers\Api
```

- <strong>Models </strong> Create your entity using trait to provide database query [select,update,delete].
To maintain the framework and take benefit of the repository pattern using  `AtlSoftware\Models\Entity\Repository.php`

```php
namespace AtlSoftware\Models\Entity;

use AtlSoftware\Models\Database;
use AtlSoftware\Models\Entity\Repository;


class Contact extends Database
{
    use Repository;

    public $id;

    public $fields = [ ];

    public $table = "";
    
    public function __construct()
    {
        parent::__construct();
    }
}

```


## POSTMAN | test you api | collection file


```file
 ATL-Software API.postman_collection.json
```

