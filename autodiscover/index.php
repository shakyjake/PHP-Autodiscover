<?php

	libxml_use_internal_errors(true);

	$entityBody = file_get_contents('php://input');

	if(strlen($entityBody) > 0){

		$xml = simplexml_load_string($entityBody);

		$Email = $xml->Request->EMailAddress;

		$Stamp = date('m/d/Y h:i:s a', time()) . ' ' . $Email;
	
		$sOut = '';
		
		$sOut .= '<?xml version="1.0" encoding="utf-8" ?>';
		$sOut .= '<Autodiscover xmlns="http://schemas.microsoft.com/exchange/autodiscover/responseschema/2006">';
		$sOut .= '		<Response xmlns="http://schemas.microsoft.com/exchange/autodiscover/outlook/responseschema/2006a">';
		$sOut .= '				<Account>';
		$sOut .= '						<AccountType>email</AccountType>';
		$sOut .= '						<Action>settings</Action>';
		$sOut .= '						<Protocol>';
		$sOut .= '								<Type>POP3</Type>';
		$sOut .= '								<Server>mail.eskdale.net</Server>';
		$sOut .= '								<Port>995</Port>';
		$sOut .= '								<LoginName>' . $Email . '</LoginName>';
		$sOut .= '								<DomainRequired>on</DomainRequired>';
		$sOut .= '								<SPA>off</SPA>';
		$sOut .= '								<SSL>on</SSL>';
		$sOut .= '								<AuthRequired>on</AuthRequired>';
		$sOut .= '						</Protocol>';
		$sOut .= '						<Protocol>';
		$sOut .= '								<Type>IMAP</Type>';
		$sOut .= '								<Server>mail.eskdale.net</Server>';
		$sOut .= '								<Port>993</Port>';
		$sOut .= '								<LoginName>' . $Email . '</LoginName>';
		$sOut .= '								<DomainRequired>on</DomainRequired>';
		$sOut .= '								<SPA>off</SPA>';
		$sOut .= '								<SSL>on</SSL>';
		$sOut .= '								<AuthRequired>on</AuthRequired>';
		$sOut .= '						</Protocol>';
		$sOut .= '						<Protocol>';
		$sOut .= '								<Type>SMTP</Type>';
		$sOut .= '								<Server>mail.eskdale.net</Server>';
		$sOut .= '								<Port>587</Port>';
		$sOut .= '								<LoginName>' . $Email . '</LoginName>';
		$sOut .= '								<DomainRequired>on</DomainRequired>';
		$sOut .= '								<SPA>off</SPA>';
		$sOut .= '								<SSL>on</SSL>';
		$sOut .= '								<AuthRequired>on</AuthRequired>';
		$sOut .= '								<UsePOPAuth>on</UsePOPAuth>';
		$sOut .= '						</Protocol>';
		$sOut .= '				</Account>';
		$sOut .= '		</Response>';
		$sOut .= '</Autodiscover>';
		
		header('Content-type: application/xml');

		echo $sOut;

	}
?>