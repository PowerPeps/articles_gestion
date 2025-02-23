function includeHTML() {
    const elements = document.querySelectorAll("[w3-include-html]");
    elements.forEach(elmnt => {
        const file = elmnt.getAttribute("w3-include-html");
        if (file) {
            fetch(file)
                .then(response => response.text())
                .then(content => {
                    elmnt.innerHTML = content;
                    elmnt.removeAttribute("w3-include-html");
                    includeHTML();
                })
                .catch(() => {
                    elmnt.innerHTML = "Page not found.";
                    elmnt.removeAttribute("w3-include-html");
                    includeHTML();
                });
        }
    });
}