#!/bin/bash

composer install
./vendor/bin/sail up -d
cp .env.example .env

cd resources/js || exit
cp .env.example .env
npm install
npm run dev
