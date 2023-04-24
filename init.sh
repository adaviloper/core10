#!/bin/bash

composer install
./vendor/bin/sail up -d
cp .env.example .env
./vendor/bin/sail artisan key:generate

cd resources/js || exit
cp .env.example .env
npm install
npm run dev
