# tet-homework setup

# copy docker compose .env
```
cp env.example .env
```

# copy each container 
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

# Generate Keys and run migration
```
docker compose exec main php artisan key:generate
docker compose exec coupons php artisan key:generate
docker compose exec products php artisan key:generate

docker compose exec main php artisan migrate
docker compose exec coupons php artisan migrate
docker compose exec products php artisan migrate
```

# run job command for excel import
```
docker compose exec products php artisan queue:work
```

# run feature test
```
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: products php artisan test tests/Feature/ProductCrudTest.php
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: coupons php artisan test tests/Feature/CouponTest.php
```