document.querySelector("form#user-form").addEventListener("submit", function(e) {
    const age = parseInt(document.querySelector("input[name='age']").value);
    const basePlan = document.querySelector("select[name='base_plan']").value;
    const subscriptionDuration = parseInt(document.querySelector("input[name='subscription_duration']").value);
    const packages = Array.from(document.querySelectorAll("input[name='packages[]']:checked")).map(p => p.value);
    const alertContainer = document.getElementById("alert-container");

    alertContainer.style.display = "none";

    if (age < 18) {
        if (packages.length > 0 && (!packages.includes("Infantil") || packages.length > 1)) {
            alertContainer.textContent = "Los usuarios menores de 18 años solo pueden contratar el Pack Infantil.";
            alertContainer.style.display = "block";
            e.preventDefault();
        }
        if (basePlan !== "Básico") {
            alertContainer.textContent = "Los usuarios menores de 18 años solo pueden contratar el Plan Básico.";
            alertContainer.style.display = "block";
            e.preventDefault();
        }
    }

    if (basePlan === "Básico" && packages.length > 1) {
        alertContainer.textContent = "El Plan Básico solo permite un paquete adicional.";
        alertContainer.style.display = "block";
        e.preventDefault();
    }

    if (basePlan === "Estándar" && packages.length > 2) {
        alertContainer.textContent = "El Plan Estándar solo permite hasta dos paquetes adicionales.";
        alertContainer.style.display = "block";
        e.preventDefault();
    }

    if (subscriptionDuration < 12 && packages.includes("Deporte")) {
        alertContainer.textContent = "El Pack Deporte solo puede ser contratado si la duración de la suscripción es de 1 año.";
        alertContainer.style.display = "block";
        e.preventDefault();
    }

    if (age < 18 && basePlan === "Premium" && packages.length === 3) {
        alertContainer.textContent = "Los usuarios menores de 18 años no pueden contratar los tres paquetes con el plan Premium.";
        alertContainer.style.display = "block";
        e.preventDefault();
    }
});