// Fonction pour intégrer du contenu externe dans les éléments contenant l'attribut data-src
async function includeHtmlContent() {
    // Sélectionne tous les éléments ayant l'attribut 'data-src'
    const elements = document.querySelectorAll('[data-src]');

    for (const element of elements) {
        // Récupérer la source à inclure
        const dataSrc = element.getAttribute('data-src');

        if (dataSrc) {
            try {
                // Effectuer une requête fetch vers l'URL spécifiée
                const response = await fetch(dataSrc);

                // Vérifier si le fetch a réussi
                if (!response.ok) {
                    console.error(`Erreur lors du chargement de ${dataSrc}: HTTP ${response.status}`);
                    element.innerHTML = `<div style="color: red;">Erreur lors du chargement de ${dataSrc}</div>`;
                    continue;
                }

                // Charger le contenu
                const content = await response.text();

                // Insérer le contenu dans l'élément
                element.innerHTML = content;

                // Exécuter les scripts contenus dans le HTML
                executeInlineScripts(element);

            } catch (error) {
                console.error(`Erreur lors du fetch pour ${dataSrc} :`, error);
                element.innerHTML = `<div style="color: red;">Erreur de chargement : ${error.message}</div>`;
            }
        }
    }
}

// Fonction pour exécuter les <script> intégrés dans le contenu chargé
function executeInlineScripts(container) {
    // Trouver et exécuter tous les scripts dans l'élément
    const scripts = container.querySelectorAll('script');

    scripts.forEach(script => {
        const newScript = document.createElement('script');

        // Copier les attributs du script (par exemple, src)
        Array.from(script.attributes).forEach(attr => {
            newScript.setAttribute(attr.name, attr.value);
        });

        // Copier le contenu JS, si présent
        if (script.textContent) {
            newScript.textContent = script.textContent;
        }

        // Remplacer l'ancien script par le nouveau pour exécuter le code
        script.replaceWith(newScript);
    });
}

// Appeler la fonction au chargement du DOM
document.addEventListener('DOMContentLoaded', () => {
    includeHtmlContent();
});