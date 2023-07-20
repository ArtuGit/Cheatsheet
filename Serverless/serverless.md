serverless OR sls

serverless --help    Discover more commands

Run these commands in the project directory:

Deploy changes
`sls deploy`
`sls deploy function -f function_name`

View deployed endpoints and resources
`sls info`

Invoke deployed functions
`sls invoke -f function_name`
`sls invoke local -f function_name`

Show function logs
`sls logs -f function_name`

Remove completely
`sls remove`