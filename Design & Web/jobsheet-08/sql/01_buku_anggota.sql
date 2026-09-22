-- Jobsheet 8: PostgreSQL schema for SIMPUS-Mini.
-- Create the database first, then run this file with:
-- psql -d simpus_mini -f sql/01_buku_anggota.sql

CREATE TABLE IF NOT EXISTS buku (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    year INTEGER NOT NULL CHECK (year BETWEEN 1900 AND 2026),
    isbn VARCHAR(50),
    stock INTEGER NOT NULL DEFAULT 0 CHECK (stock >= 0),
    category VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS anggota (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    member_number VARCHAR(50) NOT NULL UNIQUE,
    address VARCHAR(255),
    mobile_number VARCHAR(30),
    email VARCHAR(255)
);
