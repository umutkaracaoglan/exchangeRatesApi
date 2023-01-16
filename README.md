<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Welcome to Exchange Rates API Service

Exchange Rates API is a web service built using Laravel 9. This API provides the latest exchange rates and conversion functionality.

By default, exchange rates are fetched from İşBankası (https://www.isbank.com.tr/_vti_bin/DV.Isbank/PriceAndRate/PriceAndRateService.svc) every 15 minutes. 

The exchange rate data source can easily be switched by implementing a new class and extending the **ExchangeRateServiceAbstract** class located in **/app/services/GetExchange**.

## Installation
To install Exchange Rates API, follow these steps:

- Clone the repository  ```git clone https://github.com/umutkaracaoglan/exchangeRatesApi.git.```
- Rename **.env.example** to .env and fill your database setup.
- Run ```composer install``` to install the necessary dependencies.
- Run ```php artisan migrate``` to create the necessary tables.
- Start the development server by running ```php artisan serve```.
  
You can now access the service by visiting http://localhost:8000 in your web browser.

## Usage
The API provides exchange rate data for various currencies. The routes are prefixed with /api/.
You can use the following endpoints to retrieve data:

### Endpoints:

- /user/register: Allows for new user registration.
- /user/login: Allows for existing users to log in to the system.
- /user/logout: Allows for logged in users to log out of the system.
- /user/activities: Returns a list of activities for a specific user.
- /exchange: Returns actual exchange rates.
- /exchange/convert: Allows for conversion of a specific amount from one currency to another.

### Postman
You can use Postman collection for testing the API. 
https://www.postman.com/planetary-desert-995627/workspace/exchange/documentation/2734345-ce626fe0-ef58-43e5-bdea-f7142c4fba39.

- Please select **ExchangeRateApi** environment from the top right corner.  Make sure to check that the baseURL and port are correct.
