# php-autodiscover
Generate a valid autodiscover.xml for outlook clients

### Usage
Put the *autodiscover*-folder into your webroot. Set up a new subdomain (via Hosting control panel or as a vhost using your own webserver) for `autodiscover.example.com`.  
Now, when mail clients are setup the first time, they'll try to connect to this domain to recieve their configuration information as an XML file. At a basic level, this includes things like mail server adresses for imap/pop and smtp servers and respective ports, SSL usage etc. You can do much more if you want to anyway.  

#### configuration
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
