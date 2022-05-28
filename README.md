
Endpoint to create a "post"
127.0.0.1:8000/api/post/create
method:post
params:
user:int
site:int
title:string
content:string

Endpoint to make a user subscribe
127.0.0.1:8000/api/subscribe
method:post
params:
user:int
site:int

Endpoint to send emails
127.0.0.1:8000/api/subscribe/notify
method:post
site:int
post:int
