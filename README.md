How to install

Firstly, set environment variable of `DATABASE_URL` in the `.env` file

Installing dependencies: <br />
`composer install`

Create database: <br />
`php bin/console doctrine:database:create`
`php bin/console doctrine:schema:create`

Install assets:  <br />
`yarn install`

Build assets:  <br />
`yarn run encore production`