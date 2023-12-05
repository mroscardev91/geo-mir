// Load our customized validationjs library
import Validator from '../validator'

// Submit form ONLY when validation is OK
const form = document.getElementById("create-posts")

if (form) {
    form.addEventListener("submit", function(event) {
        // Reset errors messages
        // [...]
        let errorDiv = document.getElementById("message-error")
        errorDiv.style.display = "none"; // Oculta el mensaje de error por defecto

        // Get form inputs values
        let data = {
            "message": document.getElementsByName("message")[0].value,
        }
        let rules = {
            "message": "required",
        }
        // Create validation
        let validation = new Validator(data, rules)
        // Validate fields
        if (validation.passes()) {
            // Allow submit form (do nothing)
            console.log("Validation OK")
        } else {
            // Get error messages
            let errors = validation.errors.all()
            console.log(errors)
            // Show error messages
            for (let inputName in errors) {
                let error = errors[inputName]
                console.log("[ERROR] " + error)
                // [...]
                errorDiv.innerText = "Xiquillo que te ha dejao un campo"; // Establece el mensaje de error
                errorDiv.style.display = "block"; // Muestra el mensaje de error
                
            }
            // Avoid submit
            event.preventDefault()
            return false
        }
    })
}
