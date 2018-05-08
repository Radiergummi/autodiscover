# php-autodiscover
Generates a valid autodiscover.xml for mail clients.

## Usage
When mail clients are setup the first time, they'll try to connect to the subdomain `autodiscover.` of the respective mail domain to recieve their self-configuration information as an XML file. At a basic level, this includes things like mail server adresses for imap/pop and smtp servers, ports, SSL usage etc. Much more is possible though.  
This script generates a valid autodiscover.xml file upon request, but inserts server information based on the email address. For example, if you own several vhosts, say, `example.com`, `example.org`, `foo.com` and `bar.com`. They all have subdomains for imap and smtp, like `imap.example.com` and `smtp.example.com`.  
When setting up email accounts, it would be nice if the basic stuff would be automatically inserted - the mail servers, their ports, etc. That is exactly what this thing does.  
Of course you can hack this as much as you want, remove the interactive stuff and use it solely as a working autodiscover template. Either way I'd be happy if you forked the repository so I can merge new branches in.

## Setup
Put the *autodiscover*-folder into your webroot. Set up a new subdomain (via Hosting control panel or as a vhost using your own webserver) for `autodiscover.example.com`.  

## Configuration
The least information neeeded to autoconfigure email clients is the mail service domains and ports:
Inside of `autodiscover.php` you will find this code:

```php
    // pop settings
    $popServer = 'pop.' . $domain; // pop.example.com
    $popPort = 110;
    $smtpSSL = false;
    
    // imap settings
    $imapServer = 'imap.' . $domain; // imap.example.com
    $imapPort = 993;
    $imapSSL = true;
    
    // smtp settings
    $smtpServer = 'smtp.' . $domain; // smtp.example.com
    $smtpPort = 587;
    $smtpSSL = true;
  ```
The variable `$domain` is populated with the domain from the request.

## Debugging
If the client throws an error or is unable to retrieve the config, you can enable a debug log holding each individual http request by uncommenting [line 20 in `autodiscover.php`](./autodiscover/autodiscover.php#L20).  

## Known problems
 - Outlook takes pretty long for servers without a valid SSL certificate, so make sure to get one
 - Apple Mail doesn't implement the autodiscover protocol correctly, if you depend on this client, you might need to fiddle with the response
