# Takeaway
Code challenge for Takeaway

Steps to run:
1. Copy the `.env` file provided to the main directory
2. Run `docker-compose up` to start up the containers
3. Run `docker exec web php artisan migrate`
4. The service should be running at [https://ivailotakeaway.localtunnel.me/](https://ivailotakeaway.localtunnel.me) 

### Sending message
Do a POST request to `https://ivailotakeaway.localtunnel.me/send/{type}` where {type} is either `shipped` or `review` with such body:
```json
{
  "to": "+359897981948",
  "restaurant": "Subway",
  "time": "21:35"
}
```
