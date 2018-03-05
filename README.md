# JSON.DB
Single file JSON database and manager

## JSON.DB.PHP
### Useage
1. Place JSON.DB.php on a server
2. Edit the file's $password to be desired password
2. Make sure it can write itself. Example: `chown apache:apache JSON.DB.php`
3. Go to /JSON.DB.php?edit in a browser to edit the JSON
### Query
Go to /JSON.DB.php?query=JSON.DB.PHP//version to return targeted JSON values. Note the // forms a dot-notation-like targeting
