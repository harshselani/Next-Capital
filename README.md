# Next Capital Bowling API

This is a PHP based implementation of Next Capital Bowling API challenge found.

##API Features

1. Sign up
2. Log in
3. View a league's current jackpot
4. Let a league's bowlers buy tickets for the current jackpot
5. Draw a winning ticket for a jackpot
6. Record the result of the jackpot roll and then see the next jackpot
7. View the history of a league's jackpots

##API Endpoints

Requests must be sent with the `Content-Type: application/json header`

#Authorization

All authenticated requests must be sent with the header `"Authorization: Basic <auth-token>"`, where auth-header is equal to `base64Encode(email + ":" + password).`

###Create a user

`POST /api/users`

Note that this is a toy API with no expectations of security, so don't use a password you care about.

###Sample Request
```
curl -X POST 'http://nextcapital.harshselani.com/api/users' -H 'Content-Type: application/json' -d '
{
  "email": "user1@example.org",
  "password": "password"
}'

```
###Sample Response
```
{
  "id": 1,
  "email": "hello@sample.com"
}
```
#Log in

`POST /api/login`

Note that this doesn't actually establish a session, it only verifies that your <auth-token> is valid.

###Sample Request

```
curl -X POST 'http://nextcapital.harshselani.com/api/login' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>' -d ''
```

###Sample Response
```
{
  "id": 1,
  "email": "hello@sample.com"
}
```

#Create a league

`POST /api/leagues`

###Sample Request

```
curl -X POST 'http://nextcapital.harshselani.com/api/leagues' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>' -d '
{
  "name": "The League"
}'
```

###Sample Response
```
{
  "id": 1,
  "user_id": 1,
  "name": "The League"
}
```

#List all leagues

`GET /api/leagues`

###Sample Request

`
curl 'http://nextcapital.harshselani.com/api/leagues' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`

###Sample Response
```
[
  {
    "id": 1,
    "user_id": 1,
    "name": "The League"
  }
]
```

#Get one league

`GET /api/leagues/{leagueId}
`

###Sample Request
`
curl 'http://nextcapital.harshselani.com/api/leagues/1' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
{
  "id": 1,
  "user_id": 1,
  "name": "The League"
}
```
#Create a bowler

`POST /api/bowlers`

###Sample Request

```
curl -X POST 'http://nextcapital.harshselani.com/api/bowlers' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>' -d '
{
  "name": "Billy Bowler"
}'
```
###Sample Response
```
{
  "id": 1,
  "user_id": 1,
  "name": "Billy Bowler"
}
```
#List all bowlers

`GET /api/bowlers`

###Sample Request
`
curl 'http://nextcapital.harshselani.com/api/bowlers' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
[
  {
    "id": 1,
    "user_id": 1,
    "name": "Bobby Bowler"
  }
]
```
#Get one bowler

`GET /api/bowlers/{bowlerId}`

###Sample Request
`
curl 'http://nextcapital.harshselani.com/api/bowlers/1' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
{
  "id": 1,
  "user_id": 1,
  "name": "Billy Bowler"
}
```
#Add a bowler to a league

`PUT /api/leagues/{leagueId}/bowlers
`
###Sample Request
```
curl -X PUT 'http://nextcapital.harshselani.com/api/leagues/1/bowlers' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>' -d '
{
  "bowler_id": 1
}'
```
###Sample Response
```
[
  {
    "id": 1,
    "user_id": 1,
    "name": "Billy Bowler"
  }
]
```

#List all bowlers in a league

`GET /api/leagues/{leagueId}/bowlers`

###Sample Request
`
curl 'http://nextcapital.harshselani.com/api/leagues/1/bowlers' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
[
  {
    "id": 1,
    "user_id": 1,
    "name": "Billy Bowler"
  }
]
```
#List all lotteries for a league

`GET /api/leagues/{leagueId}/lotteries`

###Sample Request
`
curl 'http://nextcapital.harshselani.com/api/leagues/1/lotteries' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
[
  {
    "id": 1,
    "league_id": 1,
    "balance": 0.0,
    "payout": null
  }
]
```
#Get one lottery for a league

`GET /api/leagues/{leagueId}/lotteries/{lotteryId}
`
###Sample Request
`
curl 'http://nextcapital.harshselani.com/api/leagues/1/lotteries/1' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
{
  "id": 1,
  "league_id": 1,
  "balance": 0.0,
  "payout": null
}
```

#Buy a ticket for a bowler
`
POST /api/leagues/{leagueId}/lotteries/{lotteryId}/tickets
`
###Sample Request

```
curl -X POST 'http://nextcapital.harshselani.com/api/leagues/1/lotteries/1/tickets' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>' -d '{
  "bowler_id": 1
}'
```

###Sample Response
```
{
  "id": 1,
  "lottery_id": 1,
  "bowler_id": 1,
  "price": 10.0,
  "is_winner": false
}
```
#List all tickets for a jackpot

`GET /api/leagues/{leagueId}/lotteries/{lotteryId}/tickets
`

###Sample Request

`curl 'http://nextcapital.harshselani.com/api/leagues/1/lotteries/1/tickets' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`

###Sample Response

```
[
  {
    "id": 1,
    "lottery_id": 1,
    "bowler_id": 1,
    "price": 10.0,
    "is_winner": null
  }
]
```

#Draw a winning ticket for a jackpot

`GET /api/leagues/{leagueId}/lotteries/{lotteryId}/roll
`

###Sample Request

`curl 'http://nextcapital.harshselani.com/api/leagues/1/lotteries/1/roll' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>'
`
###Sample Response
```
{
  "id": 1,
  "lottery_id": 1,
  "bowler_id": 1,
  "pin_count": null,
  "payout": null
}
```
#Record the result of roll
`
PUT /api/leagues/{leagueId}/lotteries/{lotteryId}/roll
`
###Sample Request
```
curl -X PUT 'http://nextcapital.harshselani.com/api/leagues/1/lotteries/1/roll' -H 'Content-Type: application/json' -H 'Authorization: Basic <auth-token>' -d '{
  "pin_count": 7
}'
```
###Sample Response
```
{
  "id": 1,
  "lottery_id": 1,
  "bowler_id": 1,
  "pin_count": 7,
  "payout": 1.0
}
```
