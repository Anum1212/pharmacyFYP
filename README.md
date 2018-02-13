# pharmacyFYP

#steps to follow after cloning
1) run ```composer install``` in root directory
2) copy a default .env file in root directory
3) run ``` php artisan key:generate``` in root directory
4) setup db connection in .env file
5) setup mail in .env file
6) run ```php artisan migrate in``` root directory

now you are all set to test the code

for admin account use ```php artisan tinker```
example
1) $admin = new App\Admin – we initialize our model and hit enter
2) $admin->name = “nameHere” – we create admin name and hit enter
3) $admin->email = “xyz@example.com” – we create admin email and hit enter
4) $admin->password = Hash::make('passwordHere') – we create admin password and hash it
5) $admin->save() – this command save our admin in database. As you can see in the console it returns true. Great work, now we have an admin.


make changes in env file to change all over app name

make changes in config/mail to set default sent from settings
