function toggleInputValidation(checkbox) {
    var inputId = checkbox.value;
    var inputElement = document.getElementById('qte_' + inputId);
    var buttonElement = document.getElementById('button');
    
    if (checkbox.checked) {
        inputElement.disabled = false;
    } else {
      inputElement.disabled = true;
      inputElement.value = null;
    }

    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    if (checkboxes.length > 0) {
        buttonElement.disabled = false;
    } else {
        buttonElement.disabled = true;
    }
    calculateTotal();
}

function calculateTotal() {
    var rows = document.querySelectorAll("tbody tr"); // Sélectionnez toutes les lignes du corps du tableau
    var total = 0;

    rows.forEach(function(row) {
        var priceCell = row.querySelector("td:nth-child(4)");
        var quantityCell = row.querySelector("td:nth-child(7) input");

        var price = parseFloat(priceCell.textContent);
        var quantity = parseInt(quantityCell.value);

        if (!isNaN(price) && !isNaN(quantity)) {
            total += price * quantity;
        }
    });

    var montantTotalInput = document.getElementById("montantTotal");
    montantTotalInput.value = total.toFixed(2); // Mettez à jour la valeur du champ de saisie
    
}

// Récupérez les éléments input par leur ID
var typeVenteInput = document.getElementById('typeVenteInput');
var montantTotalInput = document.getElementById('montantTotal');
var button = document.getElementById('button');

// Ajoutez un écouteur d'événement au formulaire pour détecter la soumission
document.querySelector('form').addEventListener('submit', function (e) {
    var typeVente = typeVenteInput.value;
    var montantTotal = parseFloat(montantTotalInput.value);

    // Vérifiez si les conditions sont remplies
    if (typeVente == 'Credit' && montantTotal > 5000) {
        e.preventDefault(); // Empêchez la soumission du formulaire
        alert('Le montant total est supérieur à 5000 pour une vente à crédit. Veuillez réviser les détails.');
    }
    
});

// Sélection de l'élément input
const birthdateInput = document.getElementById('birthdate');

// Fonction de validation
function validateBirthdate() {
    const selectedDate = new Date(birthdateInput.value);
    const currentDate = new Date();
    const minDate = new Date(currentDate.getFullYear() - 18, currentDate.getMonth(), currentDate.getDate());

    if (selectedDate > minDate) {
        alert("Vous devez avoir au moins 18 ans.");
        birthdateInput.value = ''; // Réinitialiser la date
    }
}

// Ajouter un écouteur d'événement pour la validation
birthdateInput.addEventListener('change', validateBirthdate);

function validerNumero() {
    // Récupérer la valeur du champ de saisie
    var numero = document.getElementById("telephone").value.replace(/\s/g, '');
    
    // Définir le motif de validation
    var pattern = /^\+509\d{8}$/;

    // Vérifier si le numéro correspond au motif
    if (!pattern.test(numero)) {
        alert("Numero de telephone Invalide.");
        document.getElementById("telephone").value = '';
    } 
}

function validerEmail() {
    // Récupérer la valeur de l'adresse e-mail
    var email = document.getElementById("email").value;

    // Définir le motif de validation
    var pattern = /^[a-z].*@gmail\.com$/;

    // Vérifier si l'adresse e-mail correspond au motif
    if (!pattern.test(email)) {
        // Afficher un message d'alert
        alert("adresse mail Invalide.");
        document.getElementById("email").value = '';
    }
}

