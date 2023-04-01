# OPTIX

This project work is a comprehensive solution for managing an eye clinic with the integration of WhatsApp and OpenAI. The system has been set up using Docker, which allows for easy installation and deployment. The web server is powered by Nginx, and the database uses Postgres. Adminer is used for database management. Redis is also used for caching.

## Features

-   Appointment scheduling: Patients can book appointments online and receive reminders via WhatsApp.

-   Patient management: Manage patient records, including medical history, prescriptions, and test results.
    -   Inventory management: Keep track of inventory levels and receive alerts when supplies are running low.
    -   Automated diagnosis: Use OpenAI to assist doctors in making diagnoses and recommending treatments.
-   Secure messaging: Communicate securely with patients via WhatsApp, with end-to-end encryption.
-   Reporting: Generate reports on patient visits, revenue, and inventory levels.

#### NB: The above features are still in the pipeline

## Installation

To install the OPTIX, follow these steps:

1. Install Docker and Docker Compose on your system.

2. Clone the repository to your local machine.

3. Navigate to the project directory

4. Create a .env file based off .env.example

5. Start docker engine

6. Build containers

    - docker-compose build

7. Bring up containers in detached mode

    - docker-compose up -d

8. SSH into the optix app container

    - docker exec -it -u ubuntu optix /bin/bash

9. Run the following commands

    - composer install
    - php artisan key:generate
    - npm install
    - npm run watch

10. Visit the following urls to ensure everything is correctly setup:

    - **[Optix](http://localhost:9007)**

## Database management

To manage the database, use Adminer, which can be accessed at **[DB Management Interface](http://localhost:8095)**. Login with the following credentials:

-   System: PostgreSQL
-   Server: db
-   Username: optix_user
-   Password: root
-   Database: optix_db

## Env File Configurations

There are some keys in the env that has to be provided with values.

### Twilio Keys

-   TWILIO_ACC_SID (Twilio account SID)
-   TWILIO_ACC_AUTH_TOKEN (Twilio account authentication token)
-   TWILIO_NUMBER (Twilio number eg: whatsapp+000000000000)

Obtain the above from twilio.

### Open AI key

-   OPEN_AI_KEY (Authentication key from open AI)

Obtain the above from Open AI.

-   Thank you for using the Optix!
