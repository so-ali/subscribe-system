
Endpoint to create a "post"
<br>
127.0.0.1:8000/api/post/create
<br>
method:post
<br>
params:
<br>
user:int
<br>
site:int
<br>
title:string
<br>
content:string
<br>
<br>

Endpoint to make a user subscribe
<br>
127.0.0.1:8000/api/subscribe
<br>
method:post
<br>
params:
<br>
user:int
<br>
site:int
<br>
<br>

Endpoint to send emails
<br>
127.0.0.1:8000/api/subscribe/notify
<br>
method:post
<br>
site:int
<br>
post:int
<br>
