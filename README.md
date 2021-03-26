# simpleCRUD
A class to make CRUD operations on MySQL directly, without routes.

To create the Database/Table, use:

``CREATE TABLE Users
(
    userCode TEXT(16) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    CONSTRAINT users_email_uindex UNIQUE (email)
);``

