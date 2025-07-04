<img src="https://github.com/user-attachments/assets/9bb08b29-b35b-4094-b49d-6642bd7ce705" alt="Imagem" height="80">

## About the project

This is a simple API built with Laravel. It was created for portfolio purposes to practice Laravel fundamentals, focusing on RESTful API structure and CRUD operations.

#### Features

- User authentication (login, logout, get current user)
- Create, view, update, and delete events
- Create, view, and delete attendees

#### Technologies

- Laravel  
- PHP  
- SQLite  

## Main Files

#### Routes

- [routes/api.php](routes/api.php) - Application route definitions

#### Models

- [app/Http/Models/Attendee.php](app/Http/Models/Attendee.php) - Attendee model  
- [app/Http/Models/Event.php](app/Http/Models/Event.php) - Event model  
- [app/Http/Models/User.php](app/Http/Models/User.php) - User model  

#### Controllers

- [app/Http/Controllers/Api/AttendeeController.php](app/Http/Api/AttendeeController.php) - Attendee controller  
- [app/Http/Controllers/Api/EventController.php](app/Http/Api/EventController.php) - Event controller  
- [app/Http/Controllers/Api/AuthController.php](app/Http/Api/AuthController.php) - Auth controller  

#### Resources

- [app/Http/Controllers/Resources/AttendeeResource.php](app/Http/Resources/AttendeeResource.php) - Attendee resource  
- [app/Http/Controllers/Resources/EventResource.php](app/Http/Resources/EventResource.php) - Event resource  
- [app/Http/Controllers/Resources/UserResource.php](app/Http/Resources/UserResource.php) - User resource  

## Endpoints

### Auth

- `POST /login` — Login
- `GET /user` — Get authenticated user
- `POST /logout` — Logout

### Events

- `GET /events` — Get all events
- `GET /events/{id}` — Get single event
- `POST /events` — Create an event
- `PUT /events/{id}` — Update an event
- `DELETE /events/{id}` — Delete an event

### Attendees

- `GET /attendees` — Get all attendees
- `GET /attendees/{id}` — Get single attendee
- `POST /attendees` — Create an attendee
- `DELETE /attendees/{id}` — Delete an attendee
