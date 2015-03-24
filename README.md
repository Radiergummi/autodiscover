# php-autodiscover
Generates a valid autodiscover.xml for outlook clients

## Usage
When mail clients are setup the first time, they'll try to connect to the subdomain `autodiscover.` of the respective mail domain to recieve their self-configuration information as an XML file. At a basic level, this includes things like mail server adresses for imap/pop and smtp servers, ports, SSL usage etc. Much more is possible though.  
This script generates a valid autoconfiguration.xml file upon request, but inserts server information based on the email address. For example, if you own several vhosts, say, `example.com`, `example.org`, `foo.com` and `bar.com`. They all have subdomains for imap and smtp, like `imap.example.com` and `smtp.example.com`.  
When setting up email accounts, it would be nice if the basic stuff would be automatically inserted - the mail servers, their ports, etc. That is exactly what this thing does.  
Of course you can hack this as much as you want, remove the interactive stuff and use it solely as a working autodiscover template. Either way I'd be happy if you forked the repository so I can merge new branches in.

#### Setup
Put the *autodiscover*-folder into your webroot. Set up a new subdomain (via Hosting control panel or as a vhost using your own webserver) for `autodiscover.example.com`.  

#### Configuration
The least information neeeded to autoconfigure email clients is the mail service domains and ports:
  Inside of `autodiscover.php` you will find this code:
  ```php
    // pop settings
    $popServer = 'pop' . $domain; // pop.example.com
    $popPort = '110';
    $smtpSSL = 'off';
    
    // imap settings
    $imapServer = 'imap' . $domain; // imap.example.com
    $imapPort = '993';
    $imapSSL = 'on';
    
    // smtp settings
    $smtpServer = 'smtp' . $domain; // smtp.example.com
    $smtpPort = '25';
    $smtpSSL = 'off';

  ```

#### debugging
If the client throws an error or is unable to retrieve the config, you can enable a debug log holding each individual http request by uncommenting line 6 in `autodiscover.php`.  

#### problems
Outlook takes pretty long for servers without a valid SSL certificate.
