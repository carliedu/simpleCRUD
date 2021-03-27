# simpleCRUD
A class to make CRUD operations on MySQL directly, without routes.

To create the Database/Table, use:

``CREATE TABLE Users (userCode VARCHAR(16) NOT NULL PRIMARY KEY, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL );``
``ALTER TABLE `Users` ADD UNIQUE KEY `userCodeKey` (`userCode`);``
``COMMIT;``

To install:

``composer require react/event-loop``
``composer require vlucas/phpdotenv``
``composer require react/mysql``

Edit file ``composer.json`` and add the namespace ``src``:

``{
    "require": {
        "react/event-loop": "^1.1",
        "vlucas/phpdotenv": "^5.3",
        "react/mysql": "^0.5.4"
    },
    "autoload": {
        "psr-4": {
            "src\\": "src"
        }
    }
}
``

``composer install``
``composer dump-autoload``

