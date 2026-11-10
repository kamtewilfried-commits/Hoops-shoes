# Simulateur de guichet automatique

Prototype d'un guichet automatique, développé en Java avec une approche orientée objet. Travail pratique du cours Applications natives 1 (Cégep Rosemont).

## Fonctionnalités client

- Authentification par code client et NIP, avec blocage du compte après trois essais échoués
- Consultation du solde de tous les comptes
- Dépôt, retrait, transfert entre comptes et paiement de facture (frais de 1,25 $)
- Quatre types de comptes : chèque, épargne, hypothécaire et marge de crédit
- Utilisation automatique de la marge de crédit lorsque le solde est insuffisant
- Historique de chaque transaction

## Règles de gestion

- Retrait en multiples de 10 $, maximum 1 000 $ par transaction
- Le guichet connaît son stock d'argent papier et refuse un retrait si le montant est insuffisant
- Maximum de 20 000 $ dans le guichet

## Fonctionnalités administrateur

- Créer un client et créer un compte de n'importe quel type
- Afficher les transactions par compte
- Bloquer ou débloquer l'accès d'un client
- Ajouter de l'argent papier dans le guichet
- Verser l'intérêt de 1 % aux comptes épargne
- Prélever un montant sur un compte hypothécaire
- Augmenter de 5 % le solde des marges de crédit
- Fermer le guichet

## Tests

Le projet contient une classe de test pour la classe `GestionnaireGuichet`.

## Technologies

Java, programmation orientée objet.
