# :scissors: :scissors:  Little Big URL Shortener  :scissors: :scissors:

*Little Big Url Shortener* is broken into a rest API and a html client (mobile)

## What this does? ##
###The rest API provides the following endpoints###
- [GET]  /0923sdf0s0 → redirects to the original URL
- [GET]  /view/0923sdf0s0 → provides stats info about the short URL
- [POST] /create/http://google.es → creates the shor url 

###The HTML interface ###
Provides a text input for providing the original URL and a button for creating the short URL.
After the short URL is created, a link to the stats of that link is shown.
You always can introduce the (same) desired url to see its short URL and its statistics.

You can access the HTML interface via the following URL: `http://your-domain.dev/html`


## @//TODO ##
Given i have not much free time, there are quite `//@TODOs`
I would like to add to the API the following points:
- `basic http authentication`
- `cache`
- more `stats` data
- more & better tests

## Instalation instructions [HERE](https://gist.github.com/novia713/5cb047b018465acdb132646ffcbcb29d)##
I did this during a morning, so i expect it works. But if you find a bug, please file it in the Issues section!!

## Tests ##
`vendor/bin/phpunit Tests/ControllerTest.php --verbose`
