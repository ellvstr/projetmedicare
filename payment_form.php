<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <style>
        body {
            background-color: #0C1A1A;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column; 
            align-items: center; 
        }

        h1 {
            color: #008080;
            margin-bottom: 30px; 
        }

        form {
            background-color: #003333;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #FFFFFF;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            background-color: #0C1A1A;
            color: #FFFFFF;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #008080;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005959;
        }
        .radio-group {
            display:flex
        }
    
        input[type="radio"].radio {
            display: none;
            }
            input[type="radio"].radio + label {
            margin:10px 10px 10px 0;
            padding: 0.3rem 0.5rem;
            cursor:pointer;
            border: 1px solid #003333;
            border-radius:4px;
            }
            input[type="radio"].radio:hover + label {
            
            border: 1px solid #ccc;
            }
            input[type="radio"].radio:checked + label {
            border: 1px solid #fff;
         
            }
    </style>
</head>
<body>
    <div class="container">
        <h1>Paiement</h1>
        <form class="payment-form"  method="post" action="payment.php">
        
        <!-- Type de carte de paiement -->
        <div class="form-group">
            <label>Type de carte de paiement</label>
            <div class="radio-group">
                
                    <input type="radio" id="type_visa" class="radio" name="Type_carte" value="Visa" checked>
                    <label for="type_visa">Visa</label>
               
                    <input type="radio"  id="type_m" class="radio" name="Type_carte" value="MasterCard">  
                    <label for="type_m">MasterCard</label>
             
                    <input type="radio"  id="type_ae" class="radio" name="Type_carte" value="American Express"> 
                    <label for="type_ae"> American Express </label>
                
                    <input type="radio"  id="type_paypal" class="radio" name="Type_carte" value="PayPal">
                    <label for="type_paypal">PayPal</label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="Nom_proprietaire">Nom sur la carte</label>
            <input type="text" id="Nom_proprietaire" name="Nom_proprietaire" required>
        </div>
        <div class="form-group">
            <label for="Numero_carte">Numéro de carte</label>
            <input type="text" id="Numero_carte" name="Numero_carte" required pattern="\d{16}" title="Veuillez entrer un numéro de carte valide à 16 chiffres">
        </div>
        <div class="form-group">
            <label for="Date_expiration">Date d'expiration (MM/AA)</label>
            <input type="text" id="expiryDate" name="Date_expiration" required pattern="\d{2}/\d{2}" title="Veuillez entrer une date d'expiration valide (MM/AA)">
        </div>
        <div class="form-group">
            <label for="Code_securite">CVV</label>
            <input type="text" id="cvv" name="Code_securite" required pattern="\d{3}" title="Veuillez entrer un CVV valide à 3 chiffres">
        </div>
        <div class="form-group">
        <button type="submit">Valider le paiement</button>
        </div>
    </form>
    </div>
</body>
</html>
