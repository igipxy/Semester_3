-- Jobsheet 10: accounts used by the login and session flow.
-- Run from the jobsheet-10 folder against the existing "web" database:
-- psql -U postgres -d web -f sql/02_users.sql

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'petugas'
);
