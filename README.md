# AutoRent - Premium Car Rental Platform

AutoRent is a modern, comprehensive car rental platform built with Laravel. It features a robust administrative dashboard powered by Filament and a sleek, responsive frontend utilizing Tailwind CSS and Alpine.js.

## 🌟 Key Features

### 🚗 Fleet & Booking Management
- **Extensive Vehicle Catalog**: Detailed vehicle listings with specifications, categories, and dynamic availability.
- **Advanced Booking System**: Seamless reservation flow with support for add-ons (e.g., drivers, child seats).
- **Wishlist & Reviews**: Users can save their favorite cars and leave reviews post-rental.
- **Vehicle Maintenance & Inspection**: Digital tracking of maintenance logs and pre/post-rental vehicle inspections.

### 💳 Payment & Invoicing
- **Integrated Payment Gateway**: Secure and automated transactions powered by Midtrans.
- **Professional PDF Invoices**: Audit-ready PDF invoices featuring clear financial breakdowns (Down Payment, Security Deposit, Balance) and vehicle odometer readings.
- **Document Validation**: Public QR code document validation system to verify booking authenticity via a dedicated portal.

### 💎 Membership & Loyalty System
- **Tier-Based Loyalty**: Automatic membership tier upgrades (e.g., Regular to Platinum) based on booking activity.
- **Points & Rewards**: Users earn points on bookings which can be redeemed for transaction discounts.
- **Transparent Tracking**: Dedicated user dashboard to track point history, active promo codes, and past bookings.

### 🛠 Customer Support & Safety
- **Emergency & Complaint Handling**: Built-in mechanisms to report accidents, natural disasters, or service issues during an active rental.
- **Comprehensive FAQ & Blog**: Searchable FAQ system and integrated blog for updates and guides.
- **Dynamic Legal Pages**: Clear, structured representation of Privacy Policies and Terms of Service.

### 💻 Modern Frontend Experience
- **Premium UI/UX**: High-quality design featuring glassmorphism effects, modern typography, rounded corners, and smooth interactions powered by Alpine.js.
- **Social Authentication**: Easy and secure login using Laravel Socialite (e.g., Google login).
- **Responsive Navigation**: Mobile-friendly navigation optimized for all devices.

### ⚙️ Powerful Admin Panel (Filament)
- Full control over fleet (Cars, Units, Branches, Drivers).
- Comprehensive booking and document management.
- Promotion and user point management.
- Data-rich dashboards.

## 🚀 Tech Stack

- **Backend**: Laravel 12.x, PHP 8.2+
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js, Vite
- **Admin Panel**: Filament PHP
- **Database**: MySQL / SQLite
- **Integrations**: Midtrans (Payments), Laravel Socialite (OAuth), DomPDF (Invoicing), Simple QrCode

## 📦 Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/iqbalmusyaffa/websewamobil.git
   cd websewamobil
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Make sure to configure your database, Midtrans keys, and Socialite credentials in the `.env` file.*

4. **Run Migrations & Seeders**
   ```bash
   php artisan migrate --seed
   ```

5. **Storage Link**
   ```bash
   php artisan storage:link
   ```

6. **Start Development Servers**
   ```bash
   npm run dev
   # In a separate terminal:
   php artisan serve
   ```

## 🛡️ License

This project is proprietary and confidential.
