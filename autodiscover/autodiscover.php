<?
//get raw POST data so we can extract the email address
$data = file_get_contents("php://input");

// optional debug log
# file_put_contents('request.log',$data,FILE_APPEND);

// retrieve email address from client request
preg_match("/\<EMailAddress\>(.*?)\<\/EMailAddress\>/", $data, $email);

// get domain from email address
$domain = substr(strrchr($data, "@"), 1);


// POP settings
$popServer = 'pop' . $domain; // pop.example.com
$popPort = '110';
$popSSL = 'off';

// IMAP settings
$imapServer = 'imap' . $domain; // imap.example.com
$imapPort = '993';
$imapSSL = 'on';

// SMTP settings
$smtpServer = 'smtp' . $domain; // smtp.example.com
$smtpPort = '25';
$smtpSSL = 'off';


//set Content-Type
header("Content-Type: application/xml");
?>
<?='<?xml version="1.0" encoding="utf-8" ?>'; ?>
<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" >
	<Response xmlns="http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a">
		<Account>
			<AccountType>email</AccountType>
			<Action>settings</Action>
			<Protocol>
				<Type>POP3</Type>
				<Server><?=$popServer?></Server>
				<Port><?=$popPort?></Port>
				<LoginName><?php echo $email[1]; ?></LoginName>
				<DomainRequired>off</DomainRequired>
				<SPA>off</SPA>
				<SSL><?=$popSSL?></SSL>
				<DomainRequired>off</DomainRequired>
			</Protocol>
			<Protocol>
				<Type>IMAP</Type>
				<Server><?=$imapServer?></Server>
				<Port><?=$imapPort?></Port>
				<DomainRequired>off</DomainRequired>
				<LoginName><?php echo $email[1]; ?></LoginName>
				<SPA>off</SPA>
				<SSL><?=$imapSSL?></SSL>
				<AuthRequired>on</AuthRequired>
			</Protocol>
			<Protocol>
				<Type>SMTP</Type>
				<Server><?=$smtpServer?></Server>
				<Port><?=$smtpPort?></Port>
				<DomainRequired>off</DomainRequired>
				<LoginName><?php echo $email[1]; ?></LoginName>
				<SPA>off</SPA>
				<SSL><?=$smtpSSL?></SSL>
				<AuthRequired>on</AuthRequired>
				<UsePOPAuth>on</UsePOPAuth>
				<SMTPLast>on</SMTPLast>
			</Protocol>
		</Account>
	</Response>
</Autodiscover>
