# places-api

Search germany for places.

Search by  
- zipcode (Postleitzahl)  
- ags (amtliche Gemeindeschlüssel)plz
- osm_id (Openstreetmap ID)

example output:


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


You need to build this docker image:
https://github.com/vgarcia007/webapp-baseimage

Then run it with

```bash
docker-compose up -d
```

At last step run the setup  
http://localhost:5013