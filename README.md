# tet-homework


# run job command for excel import
docker compose exec products php artisan queue:work

#run feature test
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: products php artisan test tests/Feature/ProductCrudTest.php
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: coupons php artisan test tests/Feature/CouponTest.php