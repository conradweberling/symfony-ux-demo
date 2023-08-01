# Symfony UX Demo

This project is a playground for exploring the powerful features offered by Symfony UX. The components of Symfony UX introduces a range of packages, aiming to simplify user interactions significantly.

## Setup

#### Run composer
```sh
symfony composer install
```

#### Build frontend
```sh
yarn install
yarn build
```

#### Add domain (optional)
```sh
symfony proxy:start
symfony proxy:domain:attach symfony-ux-demo
```

#### Run the app
```sh
symfony server:start -d
```
