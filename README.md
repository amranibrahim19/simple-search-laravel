# Simple Search Laravel

A modern, responsive Laravel application featuring real-time user search functionality with a beautiful UI built with Tailwind CSS.

## 🚀 Features

- **Real-time Search**: Live search functionality with debounced input (500ms delay)
- **Multi-field Search**: Search users by name, email, or status
- **Modern UI**: Beautiful gradient design with smooth animations and transitions
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices
- **User Management**: View and search through user directory
- **Status Badges**: Visual status indicators with color coding
- **Loading States**: Visual feedback during search operations
- **Clear Functionality**: Easy reset to view all users
- **Pagination**: Built-in pagination for large user lists

## 🛠️ Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: 
  - Tailwind CSS (via CDN)
  - jQuery 3.7.0
  - Vite 7.x (for asset compilation)
- **Database**: SQLite (default, can be configured for MySQL/PostgreSQL)
- **PHP**: 8.2+

## 📋 Prerequisites

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite (or MySQL/PostgreSQL)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd simple-search-laravel
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Edit `.env` file and set your database configuration:
   ```env
   DB_CONNECTION=sqlite
   # Or use MySQL/PostgreSQL
   # DB_CONNECTION=mysql
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=your_database
   # DB_USERNAME=your_username
   # DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

## 🚀 Running the Application

### Development Mode

1. **Start Laravel development server**
   ```bash
   php artisan serve
   ```

2. **Start Vite dev server** (in a separate terminal)
   ```bash
   npm run dev
   ```

3. **Access the application**
   ```
   http://localhost:8000
   ```

### Production Mode

1. **Build assets for production**
   ```bash
   npm run build
   ```

2. **Optimize Laravel**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## 📖 Usage

1. **View All Users**: Navigate to the home page to see all users in a paginated table
2. **Search Users**: 
   - Type in the search box to search by name, email, or status
   - Results update automatically as you type (with 500ms debounce)
   - Or click the "Search" button to perform an immediate search
3. **Clear Search**: Click the "Clear" button to reset and view all users
4. **View Details**: Browse through the user table to see:
   - User ID
   - Name
   - Email
   - IC Number
   - Status (with color-coded badges)
   - Email verification status

## 🗂️ Project Structure

```
simple-search-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── SearchController.php    # Main search controller
│   └── User.php                        # User model
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php          # Main search page
│   │   └── layouts/
│   │       └── app.blade.php          # Main layout
│   ├── css/
│   │   └── main.css                   # Custom styles
│   └── js/
│       └── app.js                     # JavaScript entry point
├── routes/
│   └── web.php                        # Web routes
├── database/
│   └── migrations/                    # Database migrations
└── vite.config.js                     # Vite configuration
```

## 🔌 Routes

- `GET /` - Home page with user listing
- `POST /search` - AJAX search endpoint
- `GET /result` - Result page (legacy)
- `GET /home` - Authenticated home page
- Auth routes (login, register, etc.)

## 🎨 Features in Detail

### Search Functionality
- **Live Search**: Automatically searches as you type (debounced)
- **Multi-field**: Searches across name, email, and status fields
- **AJAX-based**: No page reloads, instant results
- **Error Handling**: Graceful error handling with user feedback

### UI/UX Features
- **Gradient Backgrounds**: Modern gradient design
- **Hover Effects**: Interactive table rows with hover states
- **Status Badges**: Color-coded status indicators
- **Loading Indicators**: Visual feedback during operations
- **Responsive Tables**: Mobile-friendly table design
- **Smooth Animations**: Fade-in animations for better UX

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📧 Support

For support, please open an issue in the repository.

---

Built with ❤️ using Laravel
