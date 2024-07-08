# Laravel Project Setup Instructions for Snappshop Interview

1. **Copy the `env.example` File**

   Begin by copying the `env.example` file to `.env`. This file contains environment configuration settings for the project.

2. **Start the Docker Containers**

   This project is Dockerized. To start the Docker containers, run the following command:

   ```bash
   sudo docker compose up -d
   ```

3. **Access the Docker Container**

   Once the containers are up, access the PHP container with the following command:

   ```bash
   sudo docker exec -it bank_system_php sh
   ```

4. **Run Database Migrations**

   Inside the container, run the database migrations:

   ```bash
   composer install
   php artisan migrate
   ```

5. **Execute Seeders**

   Next, execute the seeders with the following command:

   ```bash
   php artisan module:seed Users Payment Notifications
   ```

   Please ensure that the order of executing the module seeders is followed as specified.

6. **API Endpoint Documentation**

   ### POST `/api/payment/p2p`

   This endpoint allows you to process a peer-to-peer payment.

   **Request Parameters:**

   The request should be a JSON object with the following fields:

    - **`from`**: (string) The source card number.
    - **`to`**: (string) The destination card number.
    - **`amount`**: (string) The amount to be transferred.

   **Example Request Body:**

   ```json
   {
       "from": "6396074154947992",
       "to": "5054168947608849",
       "amount": "40000"
   }
   ```

   **Note:** Ensure that the `php artisan queue:work` command is running while executing this API endpoint. This is necessary for processing queued jobs related to the payment.

7. **GET `/api/payment/recentTransaction`**

   This endpoint retrieves information about the top 3 users who have made the most transactions in the last 10 minutes, along with a list of their 10 most recent transactions.

   **Response:**

    - A JSON object containing the top 3 users and their latest 10 transactions.

8. **Nginx Port Configuration**

   The Nginx server is configured to listen on port `8002`. Ensure that you use this port to access the application.

