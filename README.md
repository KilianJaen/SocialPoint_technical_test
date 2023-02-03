# SocialPoint Technical Test

## How it works

First we need to install the dependencies with this command:
```
composer install
```

Next step is activate the php with this command:  
```
php -S 127.0.0.1:8080
```

Once activated we can make calls to the api.

There are 3 types of calls:
```
- [POST] user/{user_id}/score
   With this call we can send the following parameters.
      - {"score": "+XXX"} or {"score": "-XXX"}  -> This is for relative scores. Change X for score numbers.
      - {"total": "XXX"} -> This is for absolute scores. Change X for total numbers. Always bigger than 0.
- [GET] ranking?type=top100
   With this call we can send the following parameters.
      - type=top10
      - type=top50
      - type=top100
      - type=top200
      - type=top300
      - type=top500
      
- [GET] ranking?type=at100/3
   With this call we can send the following parameters.
      - type=at10/3
      - type=at10/5
      - type=at100/3
```

The answers will always be like this:
```
['status' => STATUS_CODE, 'result'=> RESPONSE]
```

##Memory

All user information is stored in an internal file called:

```
/src/saved_info.json
```
If you want to clean the data you just have to go inside and delete it.

##Api Calls examples

```
http://localhost:8080/ranking?type=ranking?type=top100
http://localhost:8080/ranking?type=at100/3
```

##Tests

To run the tests you have to use the following command: composer tests
```
composer tests
```


##Extra explanations project

Since the technical test lasts 48 hours, I have focused on making the program work and trying to control possible errors. 
Many improvements can be added, and I would be delighted to share them with you in person. 

If you have any problem with the project please let me know, and I'll try to fix it as soon as possible.