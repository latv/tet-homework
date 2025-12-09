# tet-homework


# run job command
docker compose exec products php artisan queue:work

#run feature test
sudo docker compose exec -e DB_CONNECTION=sqlite -e DB_DATABASE=:memory: products php artisan test tests/Feature/ProductCrudTest.php