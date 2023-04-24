#!/bin/bash

# Backend
composer install
./vendor/bin/sail up -d
cp .env.example .env
./vendor/bin/sail artisan key:generate

# Frontend
cd resources/js || exit
cp .env.example .env
npm install
npm run dev
