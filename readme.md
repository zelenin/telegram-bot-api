# Telegram Bot API Client

[Telegram](https://telegram.org) [Bot](https://core.telegram.org/bots) [API](https://core.telegram.org/bots/api) Client.

## Installation

### Composer

The preferred way to install this extension is through [Composer](http://getcomposer.org/).

Either run

```
php composer.phar require "zelenin/telegram-bot-api" "~1.0"
```

or add

```
"zelenin/telegram-bot-api": "~1.0"
```

to the require section of your ```composer.json```

## Usage

```php
$api = ApiFactory::create($token);

try {
    $response = $api->sendMessage([
        'chat_id' => $chatId,
        'text' => 'Test message'
    ]);
    print_r($response);
    
    $response = $api->sendPhoto([
    	'chat_id' => $myId,
    	'photo' => fopen('/home/www/photo.jpg', 'r')
    ]);
    print_r($response);
} catch (\Zelenin\Telegram\Bot\Exception\NotOkException $e) {
    echo $e->getMessage();
}
```

See [Bot API documentation](https://core.telegram.org/bots/api) for other methods.

### Daemon

```php
$api = ApiFactory::create($token);

$daemon = new \Zelenin\Telegram\Bot\Daemon\NaiveDaemon($api);

$daemon
    ->onUpdate(function (\Zelenin\Telegram\Bot\Type\Update $update) {
        print_r($update);
    });

$daemon->run();
```

## Author

[Aleksandr Zelenin](https://github.com/zelenin/), e-mail: [aleksandr@zelenin.me](mailto:aleksandr@zelenin.me)
