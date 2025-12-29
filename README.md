# random-thing-counter-app
This is a very small side project, because I needed a custom counter app. You can add, delete and rename counters in it. And of course you can press the + button to count up. There is no count down. Sorry.

# Warning
This was made for my personal use, on a home server to use at home without any outside world access. If you put this online please keep it in mind that this app has zero security built in. The most you can do is htaccess things as described below, but I do not recommend to use this online. I made it in 2 hours and I will not update it ever. It could be a good starting point for you to make it bigger, better, safer or submit it as a homework and get a D. This thing doesn't even handle any errors.

# Install
Just copy the whole thing on your web server. There is an empty "count.db" file included too. That is yor SQLite database for this. Your webserver should have PDO SQLite installed and turned on (most have it by default)

# Setup
The user name and password are admin and admin. You can generate a new one by using the following code anywhere in MainController.php's handle() method. Or in index.php or wherever you find it good to print this out.
```
  $pw = new Password(APPKEY); // you should change the AAPKEY value for even more safety in the require/head.php 🤡
  echo '<pre>';
  var_dum($pw ->createPasswordHash('YOUR PRECIOUS SECRET PASSWORD'));
  die();
```

Then you should edit the auth.yzhk file with the data you just printed to look like this:
```username:passwordhash:saltvalue```

That is all. 

# Secure it
You might want to ```.htaccess deny from all``` the auth file, also the count.db file too.
```
<Files "auth.yzhk">
   Order allow,deny
   Deny from all
</Files>

<Files "count.db">
    Order allow,deny
    Deny from all
</Files>
```

This is not at all secure. It is good enough for me to use it on my phone when I am on my home network, to count what I count.
