wait_for_db() {
  echo "Waiting for database..."
  while ! nc -z mysql8 3306; do
    sleep 1
  done
  echo "Database is ready"
}

wait_for_db

echo "Apply database migrations"

php artisan migrate

echo "Done migrate database"

php artisan storage:link

php artisan serve --host=0.0.0.0 --port=80