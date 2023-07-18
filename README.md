# Laravel Single Save

This package is designed to optimize the model saving process of your Laravel applications. Wrapping the code in a specific method callback performs a single database update at the end of the callback execution. This optimizes the application's performance, especially during complex transactions or scenarios with frequent model updates.

## Installation

1. Install the package using composer:

```bash
composer require chack1172/laravel-single-save
```

2. Add the Eloquent trait to your models:

```php
<?php
...
use Chack1172\SingleSave\Eloquent\SingleSave;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SingleSave;
}
```

# Usage

Wrap all the queries inside **singleSave** method:

```php
class User extends Authenticatable
{
    use SingleSave;

    public function updateName($name)
    {
        $this->name = $name;
        $this->save();
    }

    public function updatePassword($password)
    {
        $this->password = $password;
        $this->save();
    }
}

// ...
$user->singleSave(function ($user) {
    $user->updateName('Marco Rossi');
    $user->updatePassword('1234');
});
```

This code will run a single query when the callback is terminated updating both `name` and `password` in the database.

## License
This project is licensed under the MIT License. Please see [License File](LICENSE) for more information.
