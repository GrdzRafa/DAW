let catalegDonuts = ``;

fetch('http://127.0.0.1:3000/pt1/media/rosquilla.json')
    .then(response => {
        // Es comprova si la resposta ha estat exitosa (estat 200-299).
        if (!response.ok) {
            // Si no, es llença un error.
            throw new Error('La resposta no ha estat correcta');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
        data.forEach(donut => {
            catalegDonuts += `<div>`;
            /* TITOL / TYPE */
            catalegDonuts += `<div class="title"><h3>${donut.name}</h3>`;
            catalegDonuts += `<h4>${donut.type}</h4></div>`;

            /* IMG / PRICE */
            catalegDonuts += `<div class="body"><img src="media/${donut.img}">`;
            catalegDonuts += `<h4>Price: ${donut.ppu}</h4>`;
            
             /* BATTERS TYPE */
            catalegDonuts += `<h5>Batters:</h5>`;
            catalegDonuts += `<select>`;
            donut.batters.batter.forEach(batter => {
                console.log(batter.type);
                catalegDonuts += `<option value="${batter.id}">${batter.type}</option>`;
            });
            catalegDonuts +=`</select>`;

            /*TOPPING TYPE */
            catalegDonuts += `<h5>Topping:</h5>`;
            catalegDonuts += `<select>`;
            
            donut.topping.forEach(topping => {
                catalegDonuts += `<option value="${topping.id}">${topping.type}</option>`;
            });
            catalegDonuts +=`</select>`;

            /* QUANTITY / BUY BUTTON */
            catalegDonuts += `<p>Quantity:</p>`
            catalegDonuts += `<input type="number" name="quantity" id="quantity"> <br>`;
            catalegDonuts += `<button>Buy</button>`;
            catalegDonuts += `</div></div>`;
            
        });
        document.body.innerHTML += catalegDonuts;
    })
    .catch(error => {
        // Si hi ha un error durant l'operació fetch,
        // es captura i es mostra a la consola.
        console.error('Error en la petició:', error);
    });

    // document.body.innerHTML = catalegDonuts;
