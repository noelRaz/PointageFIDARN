function mettreAJourHorloge() {
    const horloge = document.getElementById("horloge");
    const heureElement = document.getElementById("heure");
    const dateElement = document.getElementById("date");
    const jourElement = document.getElementById("jour");

    const maintenant = new Date();
    const heures = maintenant.getHours().toString().padStart(2, "0");
    const minutes = maintenant.getMinutes().toString().padStart(2, "0");
    const secondes = maintenant.getSeconds().toString().padStart(2, "0");
    const jour = maintenant.toLocaleDateString(undefined, { weekday: "long" });
    const date = maintenant.toLocaleDateString();

    heureElement.textContent = `${heures}:${minutes}:${secondes}`;
    jourElement.textContent = `${jour}`;
    dateElement.textContent = `le ${date}`;
}

setInterval(mettreAJourHorloge, 1000); // Mettre à jour l'horloge chaque seconde