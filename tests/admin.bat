
@echo off

php artisan tinker --execute="$user = new App\Models\User; $user->email='admin@example.com'; $user->password=bcrypt('mariachata123'); $user->AL_id=3; $user->save(); exit"






