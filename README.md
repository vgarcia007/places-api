# places-api

## What does it?

It's an API to serch for places in Germany.  
You can search by  
- zipcode (Postleitzahl)  
- ags (Amtlicher Gemeindeschlüssel)
- osm_id (Openstreetmap ID)

---
## Example output:

```json
[
    {
    "osm_id": "2186917",
    "ags": "09187124",
    "ort": "Edling",
    "plz": "83533",
    "landkreis": "Landkreis Rosenheim",
    "bundesland": "Bayern"
    }
]
```
---
## How do i run it?

You need to build this docker image before:  
https://github.com/vgarcia007/webapp-baseimage

Then run docker compose  in this repo.  
You might edit the compose file...

```bash
docker-compose up -d
```

At last step run the setup  
http://localhost:5013/setup

Thats it  
For available routes see index.php (Yes i am very lazy).


---
## Do you use work from others? 

Yes, the places data is from:  
https://www.suche-postleitzahl.org/  
https://www.openstreetmap.org/copyright

And AltoRouter is used for routing in the script: 
https://github.com/dannyvankooten/AltoRouter
