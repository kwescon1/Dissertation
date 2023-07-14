#!/bin/bash

npm install

if [ "$APP_ENV" = "local" ]; then
    echo "Running npm"
    npm run watch
else
    npm run prod
fi
