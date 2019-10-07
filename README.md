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

### How and what
The microservice runs on 3 containers - Db, apache and tunnel. 

The tunnel is needed for convenient local testing and is required to update the message status since it's done via a remote callback.
The tunnel container tends to crash and restart at random periods of time, this is a known bug and the developer is unable to fix it.
I've noticed that it also crashes if your firewall is running, so bear that in mind. Might not be able to receive callbacks if firewall is running.

The parameters needed for the notification are minimal - restaurant name, hour of delivery (if applicable) and number of the recipient.

The templates are currently stored in the config file, but would be better off in a db table when the service grows so they can be managed by non-programmers as well.

Twilio provides their own php SDK which I used. Not sure if you wanted to see me making an http call.
