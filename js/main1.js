const inputs = document.querySelectorAll(".input");


function addcl(){
	let parent = this.parentNode.parentNode;
	parent.classList.add("focus");
}

function remcl(){
	let parent = this.parentNode.parentNode;
	if(this.value == ""){
		parent.classList.remove("focus");
	}
}


inputs.forEach(input => {
	input.addEventListener("focus", addcl);
	input.addEventListener("blur", remcl);
});
document.querySelector("a[href='signup.html']").addEventListener("click", function(event) {
    event.preventDefault(); // Empêche le lien de suivre son URL par défaut
    window.location.href = "signup.html"; // Redirige vers la page d'inscription
  });
  document.addEventListener("DOMContentLoaded", function() {
    const emailInput = document.getElementById("emailInput");
    const telephoneInput = document.getElementById("telephoneInput");
    const submitButton = document.getElementById("submitButton");

    submitButton.addEventListener("click", function() {
        const email = emailInput.value;
        const telephone = telephoneInput.value;

        // Validation de l'e-mail
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(email)) {
            alert("Veuillez entrer une adresse e-mail valide.");
            return;
        }

        // Validation du numéro de téléphone (uniquement des chiffres)
        const phonePattern = /^\d+$/;
        if (!phonePattern.test(telephone)) {
            alert("Veuillez entrer un numéro de téléphone valide (chiffres uniquement).");
            return;
        }

        
    });
});