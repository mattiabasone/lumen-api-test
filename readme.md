## Lumen API Test

[![Coverage Status](https://coveralls.io/repos/github/mattiabasone/lumen-api-test/badge.svg)](https://coveralls.io/github/mattiabasone/lumen-api-test)

### Build and start Docker environment

- `cd docker/`
- `docker-compose build`
- `docker-compose up`

*docker-compose.yml configuration binds ports 80 (HTTP) and 33060 (MySQL)*

### Application

The docker entrypoint script will automatically run migration and some DB seeders.
The data will be visible at [http://localhost](http://localhost)

#### Authentication

The user is authenticated with a Bearer token, before using REST endpoints you must issue a valid 
token with a POST request to /api/v1/oauth/token with the following parameters:

| Parameter | Description |
| --------- | ----------- |
| client_id | Client numeric identifier *(available at [http://localhost](http://localhost))* |
| client_secret | Client secret *(available at [http://localhost](http://localhost))* |
| grant_type | password |
| username | User email |
| password | User password (*default: password*)

#### Endpoints

| Endpoints | Method | Description |
| --------- | ------ | ----------- |
| /api/v1/product | GET | Get products list |
| /api/v1/product | POST | Store new product |
| /api/v1/product/{id} | PUT | Updates a product |
| /api/v1/product/{id} | DELETE | Delete a product |
| /api/v1/wishlist | GET | Lists logged in user wishlists |
| /api/v1/wishlist | POST | Store new wishlist for current user |
| /api/v1/products | GET | |
| /api/v1/products | GET | |
