# CRUD Brand - Application

## Description

This application lets you manage a list of the best brands with a PHP backend and a mobile-friendly frontend.

### Backend
- API RESTful with PHP (Laravel).
- CRUD operations for brand management.
- Brand list configured by geolocation.

### Frontend
- Responsive interface with HTML and CSS.
- API integration for data display.

### Additional features
- Mark pagination (5 per page).
- Search by brand name.
- Filter by country (ISO-2 code).

## Start application

1. Clone the repository :
   ```bash
   git clone https://github.com/ntebemp/Test-PHP-APP.git

2. Build Docker images

   docker-compose up --build 

3. Useful links

   Backend : http://localhost:8000

   Frontend : http://localhost:8080 

## API Info

- GET /api/brands

- POST /api/brands

- PUT /api/brands/{id}

- DELETE /api/brands/{id}