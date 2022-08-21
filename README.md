# Converted.in Backend/Full stack Evaluation Task

- Time for task delivery will be 3 days, that doesn’t mean it will take all that
time, it’s designed to take less than working day. Make sure to log the
time you spent developing each sub task
- Task delivery upload to your Github repo and reply to this email with the link
- The development approach is left for you to use your best judgment ،
however it might be good though if you shared your thoughts about the
approach you have chosen and what else could be improved/implemented


### TASK:
Create an application where the admin can create a task(title, description,
assigned_to_id, assigned_by_id) and assign it to any non-admin user. The Statistics
table should hold the number of tasks assigned to each user.
The application should contain three pages according to the following

- [x] Page 1: Task creation page contains the following input fields
  - [x] Admin Name (dropdown)
  - [x] title (text)
  - [x] description (text area)
  - [X] Assigned User (dropdown)

After submitting the task creation form, redirect the user to the Task List page.

- [x] Page 2: Task List page contains (title, description, assigned name, admin
   name) paginated as 10 tasks per view
- [x] Page 3: Statistics page holds user task count statistics (top 10 users with
   highest tasks count)
   - Required:
     - [x] Create database using artisan command
     - [x] Create seed for 10000 users, 100 admins
     - [x] Write tests (minimum 3)
   - Bonus:
     - [x] Update Statistics table using a background job.
     - [x] Confirm the test run in the github actions after each commit.
     - [ ] Cache user list for displaying in the Task creation page.

-------------------------------------

## Requirments:

- PHP 8.1 or later.
- MySQL 5.7 or later.

## installation Steps

- Step 1: git clone url project.
- Step 2: `composer install` for download the required packages.
- Step 3: create database with name "converted_in_task"
- Step 4: `cp .env.example .env` to copy env file.
- Step 5: `php artisan key:generate` to generate new app key.
- Step 6: `php artisan migrate` to run database migration.
- Step 7: `php artisan db:seed` to run database seeder for create default user.
- Step 8: `npm install && npm run build` for compiling your fresh scaffolding.
- Step 9: `php artisan serve` to deploy the module
- Step 10: `php artisan update-statistic` to save or update statistic
- Step 11: `php artisan test` to run tests.

### NOTE

if you get any errors in this steps, when seeding the database, related to existing data, please run the following:

- run `php artisan config:cache` to reset setting to is last good case.
- run `chmod -R 777 storage` to give permissions to storage folder for read/wire actions.
- run `chown www-data -R storage` for the same reason described above.
