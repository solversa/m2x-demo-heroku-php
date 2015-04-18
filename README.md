# M2X Heroku PHP Demo


## Introduction

This is an example of a Heroku application written in PHP that reports data to [AT&T M2X](https://m2x.att.com). The application reports the current system load every minute.

Please note that the Heroku machine and M2X are using times in UTC, not in your local time zone. M2X will, however, accept data in any time zone as long as the timestamp is formatted using ISO8601 (e.g. "2015-02-27T18:14:00.000-03:00").

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

## Pre-Requisites

You will need to have an account on [Heroku](https://www.heroku.com/). Because this example application uses only one Heroku dyno, it should be free for you to use, no matter how many other applications you have.

## Installation

### Deploying your application

Click the Heroku button to deploy your application to Heroku:

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

### Scaling Your Application

Because the application uses the "Clock" process type, your code isn't running yet. You need to scale the number of clock workers to 1.

Go to the Resources tab on your application's dashboard on Heroku and scale the `clock python master.py` process so that it uses one dyno.

Optionally, you can do this using the CLI:

```
heroku ps:scale clock=1
```

Notice that the [Heroku Toolbelt](https://toolbelt.heroku.com/) must be installed and configured with your Heroku login credentials for this to work.

## Testing

The application should now be reporting the system load to AT&T M2X every minute. Go to your app dashboard on Heroku and click on the AT&T M2X add-on to access AT&T M2X's Developer Portal and confirm the data is being reported.

## License

This library is released under the MIT license. See ``LICENSE`` for the terms.
