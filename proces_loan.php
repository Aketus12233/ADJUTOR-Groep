<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $loanAmount = $_POST['loanAmount'];
    $duration = $_POST['duration'];
    $interestRate = $_POST['interestRate'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $maritalStatus = $_POST['maritalStatus'];
    $nationalId = $_POST['nationalId'];
    $birthdate = $_POST['birthdate'];
    $profession = $_POST['profession'];
    $monthlySalary = $_POST['monthlySalary'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Calcul des mensualités
    $monthlyInterestRate = ($interestRate / 100) / 12;
    $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$duration));
    
    // Envoi des données par e-mail (assurez-vous que la fonction mail est configurée)
    $to = "contact@ajutorgroup.com"; // Changez ceci avec votre adresse email
    $subject = "Nieuwe lening aanvraag van $firstName $lastName";
    $message = "
    Lening Bedrag: $loanAmount
    Duur: $duration maanden
    Rente: $interestRate%
    Geschatte Maandlasten: " . number_format($monthlyPayment, 2) . "
    
    Persoonlijke Gegevens:
    Voornaam: $firstName
    Achternaam: $lastName
    Burgerlijke Staat: $maritalStatus
    Identiteitskaart Nummer: $nationalId
    Geboortedatum: $birthdate
    Beroep: $profession
    Maandelijks Salaris: $monthlySalary
    E-mailadres: $email
    Telefoonnummer: $phone
    ";

    // Envoi du mail
    if (mail($to, $subject, $message)) {
        echo "Uw lening aanvraag is succesvol verzonden!";
    } else {
        echo "Er is een fout opgetreden bij het verzenden van uw aanvraag.";
    }
} else {
    echo "Ongeldige aanvraag.";
}
?>