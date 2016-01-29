## Overview ##

We just wouldn't be a true Web 2.0 company if we didn't have an API now would we? The main reason for creating the API was so that vendors could manage their shirts in our index after an approval process, but we thought it'd be fun to open up access to our entire index. You can search shirts by keyword and tag, look up tags, etc. from the API. What use is this to you? We have no idea, but we're looking forward to finding out!

All queries to the API are sent via an HTTP GET with the exception of all of the vendor endpoints, which required an HTTP POST along with a standard HTTP-Auth username and password. All queries to the API are sent over SSL.

## Install PEAR Package ##

```
$ pear install http://pleasedressme.googlecode.com/files/Services_PleaseDressMe-0.0.1.tgz
```

## Shirts ##

### Search ###

The search endpoint allows you to search the tshirt index and return a list of shirts that match the search criteria. The only argument is `q` and should be the query you wish to search for.

```
https://pleasedress.me/api/1.0/shirts/search.xml?q=jerry
```

### Tag ###

The tags endpoint allows you to find tshirts by tag. It also allows you to find shirts by color since colors are just tags on a shirt. The only argument is `tag` and should be the tag you wish to find shirts by.

```
http://pleasedress.me/api/1.0/shirts/search.xml?q=blue
```

## Tags ##

### Letter ###

The letter endpoint lets you find tags that begin with the letter specified. This endpoint returns the tag, number of shirts tagged with that tag and the URL to view all shirts tagged with that tag. The letter expected is `a` through `z` or `0` through `9`.

```
http://pleasedress.me/api/1.0/tags/h.xml
```

## Vendors ##

All requests to vendor endpoints **must** be sent via SSL and use HTTP-Auth to authenticate via a POST request. Use your login email and password to access the API. You may only add shirts, which are then put in a pending queue for review and tagging, remove shirts or flush their information/image from cache.