# Advanced Novat Tech - Admin Dashboard

A comprehensive Laravel admin dashboard with user management, product management, and role-based access control.

## Features

### 🔐 Authentication & Authorization
- **Laravel Breeze** for authentication
- **Spatie Laravel Permission** for role-based access control
- **Super Admin** account with full access
- **Role-based permissions**: Admin, Manager, Editor, Viewer

### 👥 User Management
- Create, edit, and delete users
- Assign roles and permissions
- User profile management
- Role-based access control

### 📦 Product Management
- Create, edit, delete, and list products
- Product categories and brands
- Multiple image uploads (Spatie Media Library)
- SEO-friendly URLs with slugs
- Stock management and pricing

### 🏷️ Category & Brand Management
- Create, edit, delete categories and brands
- Image uploads for categories and brands
- Active/inactive status management

### ⚙️ Settings Management
- Site configuration (title, description, contact info)
- Social media links
- Logo and favicon uploads
- SEO meta settings

### 🎨 UI/UX Features
- **Bootstrap 5** responsive design
- Modern sidebar navigation
- Statistics dashboard with cards
- Font Awesome icons
- Mobile-friendly responsive layout

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL/SQLite
- Node.js & NPM

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd advanced_novat_tech
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

## Default Login Credentials

- **Email**: admin@example.com
- **Password**: password
- **Role**: Super Admin

## Admin Routes

### Dashboard
- `/admin` - Main dashboard with statistics

### User Management (Super Admin only)
- `/admin/users` - List all users
- `/admin/users/create` - Create new user
- `/admin/users/{user}/edit` - Edit user
- `/admin/users/{user}` - View user details

### Product Management
- `/admin/products` - List all products
- `/admin/products/create` - Create new product
- `/admin/products/{product}/edit` - Edit product
- `/admin/products/{product}` - View product details

### Category Management
- `/admin/categories` - List all categories
- `/admin/categories/create` - Create new category
- `/admin/categories/{category}/edit` - Edit category

### Brand Management
- `/admin/brands` - List all brands
- `/admin/brands/create` - Create new brand
- `/admin/brands/{brand}/edit` - Edit brand

### Settings (Super Admin only)
- `/admin/settings` - Site settings

## Roles and Permissions

### Super Admin
- Full access to all features
- User management
- Settings management

### Admin
- Product management
- Category management
- Brand management
- Dashboard access

### Manager
- Product management
- Category management
- Dashboard access

### Editor
- Product management
- Dashboard access

### Viewer
- Dashboard access only

## Database Structure

### Users Table
- Basic user information
- Role assignments
- Media attachments for avatars

### Products Table
- Product details (name, description, price, stock)
- Brand relationship
- Category relationships (many-to-many)
- Media attachments for images
- SEO-friendly slugs

### Categories Table
- Category information
- Media attachments for images
- Product relationships

### Brands Table
- Brand information
- Media attachments for logos
- Product relationships

### Media Table (Spatie Media Library)
- File uploads
- Conversions (thumbnails, etc.)
- Organized collections

## Packages Used

- **Laravel Breeze** - Authentication scaffolding
- **Spatie Laravel Permission** - Role and permission management
- **Spatie Laravel Media Library** - File uploads and media management
- **Spatie Laravel Settings** - Application settings management
- **Bootstrap 5** - UI framework
- **Font Awesome** - Icons

## File Structure

```
app/
├── Http/Controllers/Admin/
│   ├── DashboardController.php
│   ├── UserController.php
│   ├── ProductController.php
│   ├── CategoryController.php
│   ├── BrandController.php
│   └── SettingController.php
├── Models/
│   ├── User.php
│   ├── Product.php
│   ├── Category.php
│   └── Brand.php
└── Settings/
    └── GeneralSettings.php

resources/views/admin/
├── layouts/
│   └── app.blade.php
├── dashboard/
│   └── index.blade.php
├── users/
│   └── index.blade.php
├── products/
│   ├── index.blade.php
│   └── create.blade.php
├── categories/
├── brands/
└── settings/

database/
├── migrations/
│   ├── create_categories_table.php
│   ├── create_brands_table.php
│   └── create_products_table.php
└── seeders/
    ├── RolePermissionSeeder.php
    └── SuperAdminSeeder.php
```

## Customization

### Adding New Roles
1. Add role in `RolePermissionSeeder.php`
2. Assign permissions to the role
3. Update navigation in `admin/layouts/app.blade.php`

### Adding New Features
1. Create controller in `app/Http/Controllers/Admin/`
2. Add routes in `routes/web.php`
3. Create views in `resources/views/admin/`
4. Update navigation if needed

### Styling
- Main styles in `resources/views/admin/layouts/app.blade.php`
- Bootstrap 5 classes used throughout
- Custom CSS in layout file

## Security Features

- **CSRF Protection** - All forms include CSRF tokens
- **Role-based Access** - Routes protected by middleware
- **Input Validation** - All inputs validated in controllers
- **File Upload Security** - Image validation and secure storage
- **SQL Injection Protection** - Eloquent ORM usage

## Performance

- **Eager Loading** - Relationships loaded efficiently
- **Pagination** - Large datasets paginated
- **Image Optimization** - Media library conversions
- **Caching** - Laravel's built-in caching

## Troubleshooting

### Common Issues

1. **Database Connection**
   - Check `.env` file configuration
   - Ensure database exists
   - Run `php artisan migrate:fresh --seed`

2. **Permission Issues**
   - Clear cache: `php artisan cache:clear`
   - Clear config: `php artisan config:clear`

3. **File Upload Issues**
   - Check storage permissions
   - Ensure storage link exists: `php artisan storage:link`

4. **Asset Issues**
   - Run `npm run build`
   - Check Vite configuration

## Contributing

1. Follow Laravel coding standards
2. Add proper validation
3. Include error handling
4. Test thoroughly
5. Update documentation

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). 