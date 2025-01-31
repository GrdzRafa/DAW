class ComponentPersonalitzat extends HTMLElement {

    #users = [
        { name: "Leanne Graham" },
        { name: "Ervin Howell" },
        { name: "Clementine Bauch" },
        { name: "Patricia Lebsack" },
        { name: "Chelsey Dietrich" }
    ];

    constructor() {
        super();

        // creacio shadowDOM
        const shadow = this.attachShadow({ mode: 'open' });

        // Adjuntar fitxer CSS
        const link = document.createElement('link');
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('href', 'styles.css');
        shadow.appendChild(link);

        const container = document.createElement('p');
        container.textContent = "hola, usuari";
        shadow.appendChild(container);

        this.fetchUsers(container);
    }

    fetchUsers(container) {
        fetch('https://jsonplaceholder.typicode.com/users')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error a l'API: ${response.statusText}`);
                }
                return response.json();
            })
            .then(users => {
                this.crearLlistaUsers(users, container);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    

    crearLlistaUsers(users, container) {
        let userListHTML = '<ul>';
        for (const user of users) {
            userListHTML += `<li>${user.name}</li>`;
        }
        userListHTML += '</ul>';

        container.innerHTML = userListHTML;
    }

}

// Registrar component personalitzat
customElements.define('component-personalitzat', ComponentPersonalitzat);
