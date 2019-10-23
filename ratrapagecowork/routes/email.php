<?php
function sendEmail($expediteur,$recepteur,$objet,$message){
// Le message
	
// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
	//$message = wordwrap($message, 70, "\r\n");
	
	
	$expediteur = "cowork@betball.fr";
	$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
	$headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
	$headers .= 'From: " CoWork"<'.$expediteur.'>'."\n\n";


// Envoi du mail
	if(mail($recepteur, $objet, $message, $headers)){
		echo "ok : email envoyé ".$expediteur.$recepteur. $objet. $message.$headers;
	}else echo 'not ok';
}