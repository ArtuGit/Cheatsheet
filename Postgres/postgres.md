## Connection

psql -h <HOST> -p <PORT> -U postgres -d <DB_NAME>
psql "postgresql://<USER_NAME>:<PASSWORD>@<HOST>:<PORT>/<DB_NAME>"

psql -h localhost -p 5432 -U postgres -d commerce
psql "postgresql://postgres:postgres@localhost:5432/commerce"
