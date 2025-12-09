# TET homework setup

# Copy docker compose `.env` (root directory)
```
cp env.example .env
```

# Copy each container `.env`
```
cp main/.env.example main/.env
cp coupons/.env.example coupons/.env
cp products/.env.example products/.env
```
# After this ensure database connection is correctly setup from root `docker-compose.yml` file

# Build and run containers
```
docker-compose up -d --build
```

# Generate keys and run migration
```
docker compose exec main php artisan key:generate
docker compose exec coupons php artisan key:generate
docker compose exec products php artisan key:generate

docker compose exec main php artisan migrate
docker compose exec coupons php artisan migrate
docker compose exec products php artisan migrate
```

# Run job command for excel import
```
docker compose exec products php artisan queue:work
```

# Run feature test
```
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: products php artisan test tests/Feature/ProductCrudTest.php
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: coupons php artisan test tests/Feature/CouponTest.php
```

# Devlopment setup

Uncoment lines in `docker-compose.yml` file where is saying in comment 'uncomment ...'.

Inside in folders `packages` create three seprate folders 'coupons', 'helper', 'products'

in these three folder clone these github repositories (should correspond respectivaly)
```
https://github.com/latv/coupons
https://github.com/latv/helper
https://github.com/latv/products
```

and restart (if it`s not started) docker containers
```
sudo docker compose down
sudo docker compose up -d
```