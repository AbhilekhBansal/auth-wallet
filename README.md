# Laravel JWT Auth & Wallet System

## Project Overview
This project implements a secure authentication system using JWT tokens and a wallet system using the Bavix Laravel Wallet package. It includes comprehensive API documentation using Swagger/OpenAPI.

## Features
- **JWT Authentication**: Secure user authentication using JWT.
- **Wallet System**: Deposit, withdraw, and force withdraw functionality.
- **API Documentation**: Complete documentation for all authentication and wallet-related APIs.

## Installation
### Prerequisites
- PHP 8.0+
- Composer
- Laravel 9+
- MySQL/PostgreSQL

### Setup
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd project-folder
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Create a `.env` file:
   ```bash
   cp .env.example .env
   ```
4. Configure database and other environment settings in `.env`.
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations and seed database:
   ```bash
   php artisan migrate --seed
   ```
7. Install JWT package and generate a secret key:
   ```bash
   php artisan jwt:secret
   ```
8. Start the application:
   ```bash
   php artisan serve
   ```

## Authentication System
The authentication system uses JWT for secure access.

### Endpoints
- `POST /api/register` - User registration
- `POST /api/login` - User login
- `POST /api/logout` - User logout
- `POST /api/token/refresh` - Refresh JWT token

## Wallet System
The project integrates the **Bavix Laravel Wallet** package to manage wallet transactions.

### Wallet Functionality
- **Deposit**: Users can add funds.
- **Withdraw**: Users can withdraw funds.
- **Force Withdraw**: Users can withdraw even if it results in a negative balance.
- **Balance Check**: Users can check their current balance.

### Endpoints
- `POST /api/wallet/deposit` - Deposit funds
- `POST /api/wallet/withdraw` - Withdraw funds
- `POST /api/wallet/forceWithdraw` - Force withdraw funds
- `GET /api/wallet/balance` - Get wallet balance

## API Documentation
The API documentation is available via Swagger at:
```
/api/documentation
```
It includes request/response examples and authentication details.

## Security
- API routes are protected using JWT middleware.
- Only authenticated users can perform wallet transactions.
- Forced withdrawals require a reason.

## Testing
Run tests using:
```bash
php artisan test
```

## Deployment
1. Set up a production server with PHP, MySQL, and necessary dependencies.
2. Configure `.env` file for production.
3. Run migrations:
   ```bash
   php artisan migrate --force
   ```
4. Set up a queue worker for background tasks if needed:
   ```bash
   php artisan queue:work --daemon
   ```

## License
This project is licensed under the MIT License.

## Contact
For any queries, reach out at [Your Contact Information].

