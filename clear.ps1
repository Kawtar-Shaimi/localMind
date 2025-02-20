# Set the path to your Laravel project directory (adjust if needed)
$projectPath = Get-Location

# Change to the Laravel project directory
Set-Location -Path $projectPath

# Clear the view cache
Write-Host Clearing the view cache...
php artisan view:clear

# Clear the application cache
Write-Host Clearing the application cache...
php artisan cache:clear

# Clear the route cache
Write-Host Clearing the route cache...
php artisan route:clear

# Clear the config cache
Write-Host Clearing the config cache...
php artisan config:clear

php artisan serve

Write-Host All tasks completed successfully!