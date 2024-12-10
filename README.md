# BPO System Installation Guide

Our **Business Process Outsourcing (BPO) System** is an online database developed using Laravel. It serves as a centralized platform for listing all BPO companies in Uganda, providing easy access to their details for businesses and individuals. The system ensures a user-friendly experience with secure and scalable database management to support efficient data retrieval and reporting.

---

## Installation Steps

1. **Clone the Repository**
   - Open your terminal and run the following command:
     ```bash
     git https://github.com/impactdevs/bpo.git
     ```
   - Navigate into the project directory:
     ```bash
     cd <project-folder>
     ```

2. **Install Dependencies**
   - Install PHP dependencies using Composer:
     ```bash
     composer install
     ```
   - Install front-end dependencies with npm:
     ```bash
     npm install
     ```

3. **Set Up Environment**
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Open the `.env` file and update the database and other necessary configurations.

4. **Generate Application Key**
   - Generate the application key:
     ```bash
     php artisan key:generate
     ```

5. **Migrate the Database**
   - Run database migrations to set up the tables:
     ```bash
     php artisan migrate
     ```

6. **Serve the Application**
   - Start the development server:
     ```bash
     php artisan serve
     ```
   - Open your browser and visit:
     ```
     http://localhost:8000
     ```

Your online database for BPO companies in Uganda is now up and running!
```