# Takeaway
Code challenge for Takeaway

Steps to run:
1. Copy the `.env` file provided to the main directory
2. Run `docker-compose up` to start up the containers
3. Run `docker exec web php artisan migrate`
4. The service should be running at [http://localhost:5050/](http://localhost:5050)

### Sending message
Do a post request to `http://localhost:5050/send` with such body:
```json
{
  "to": "+359897981948",
  "body": "The order from Restaurant 1 is on its way! It should arrive at 18:35."
}
```
