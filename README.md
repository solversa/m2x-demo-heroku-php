# M2X Heroku PHP Demo


## Introduction

This repo provides a framework for a Heroku application with PHP code that reports data to AT&T M2X. The application reports the current system load every minute.

Please note that the Heroku machine and M2X are using times in UTC, not in your local time zone. M2X will, however, accept data in any time zone as long as the timestamp is formatted using ISO8601 (e.g. "2015-02-27T18:14:00.000-03:00").


[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

## Pre-Requisites

You will need to have an account on [Heroku](https://www.heroku.com/). Because this example application uses only one Heroku dyno, it should be free for you to use, no matter how many other applications you have.

You will also need an [account on AT&T's M2X service](https://m2x.att.com/signup), which has a free Developer plan and usage based paid plans for higher volumes of data. Check out the [M2X Pricing](https://m2x.att.com/pricing) page for more details.

You will need the [Heroku Toolbelt](https://toolbelt.heroku.com/) installed and configured with your Heroku login credentials.

## Installation

### Creating Your Application

```
git clone https://github.com/attm2x/m2x-demo-heroku-php.git
cd m2x-demo-heroku-php
heroku apps:create APPNAME
```

### M2X API Key

Next you'll need to get your M2X API Master Key. Log into M2X, and click your name in the upper right-hand corner, then the "Account Settings" dropdown, then the "Master Keys" tab. [Here's a direct link](https://m2x.att.com/account#master-keys). Then you'll need to set the environment variable and push the codebase to Heroku.

```
heroku config:set M2X_API_KEY=<Your M2X API key>
git push heroku master
```

### Scaling Your Application
Now your code should be uploaded. However, because you're using the "Clock" process type, your code isn't running automatically. You'll need to scale the number of clock workers to 1:

```
heroku ps:scale clock=1
```

## Testing

Your loadreport.php should now be reporting the system load to AT&T M2X every minute.

If there are any errors from loadreport.php, they will be logged via Heroku's log system. Use ```heroku logs --tail``` to see the live output from your application.

## License

This library is released under the MIT license. See ``LICENSE`` for the terms.
