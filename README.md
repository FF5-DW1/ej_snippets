# Snippati

## Ejercicio del proyecto social snippets de Desarrollo fullstack 1 de Factoría F5

## Empezar

    docker compose up -d

## Abrir una terminal en docker:

    docker exec -ti <container> /bin/bash

## Compilar assets (css, js...)

No es necesario entrar en el contenedor para lanzar un <code>'npm install'</code> o <code>'npm run build'</code>

    docker exec <container> npm run build