# PHP AWS SQS Wrapper

## Installation

Aws Sqs Wrapper installation is very simple. Open the terminal and run this command

`composer require bariseser/sqs`

##Consume Message
```php
$consumer = (new SqsConsumer())
    ->setQueueUrl("http://localhost:4566/000000000000/client_api.fifo");

while (true) {
    $messages = $consumer->messages();
    if (!empty($messages->get('Messages'))) {
        foreach ($messages->get('Messages') as $message) {
            echo $message['Body'].PHP_EOL;
        }
    } else {
        echo "No messages in queue". PHP_EOL;
    }
}
```

##Produce Message
```php
$producer = (new SqsConsumer())
    ->setQueueUrl("http://localhost:4566/000000000000/client_api.fifo");
$producer->setMessageBody(json_encode(['title' => "baris eser", 'id' => 12345]))->publish();
```

Getting help / Contact
---
* bariseser@gmail.com
* [Issue](https://github.com/bariseser/php-password-hash/issues)

Contributing
---
1 - Fork the Project

2 - Ensure you have Composer installed (see Composer Download Instructions)

3 - Install Development Dependencies

```bash
composer install
```

4 - Run the Test Suite
```bash
vendor/bin/phpunit
```

5 - Send us a Pull Request