document.body.onload = formulari;

function formulari(){
  const form = document.createElement('form');
  form.id = 'myForm';

  const h1 = document.createElement('h1');
  h1.textContent = 'Cookies i Web Storage';
  form.appendChild(h1);

  const divNom = document.createElement('div');
  const labelNom = document.createElement('label');
  labelNom.setAttribute('for', 'nom');
  labelNom.textContent = 'Nom*:';
  divNom.appendChild(labelNom);
  const inputNom = document.createElement('input');
  inputNom.type = 'text';
  inputNom.id = 'nom';
  inputNom.name = 'nom';
  inputNom.required = true;
  divNom.appendChild(inputNom);
  form.appendChild(divNom);

  const divCognom = document.createElement('div');
  const labelCognom = document.createElement('label');
  labelCognom.setAttribute('for', 'cognom');
  labelCognom.textContent = 'Cognom:';
  divCognom.appendChild(labelCognom);
  const inputCognom = document.createElement('input');
  inputCognom.type = 'text';
  inputCognom.id = 'cognom';
  inputCognom.name = 'cognom';
  divCognom.appendChild(inputCognom);
  form.appendChild(divCognom);

  const divEmail = document.createElement('div');
  const labelEmail = document.createElement('label');
  labelEmail.setAttribute('for', 'email');
  labelEmail.textContent = 'E-mail*:';
  divEmail.appendChild(labelEmail);
  const inputEmail = document.createElement('input');
  inputEmail.type = 'email';
  inputEmail.id = 'email';
  inputEmail.name = 'email';
  inputEmail.required = true;
  divEmail.appendChild(inputEmail);
  form.appendChild(divEmail);

  const divAdreca = document.createElement('div');
  const labelAdreca = document.createElement('label');
  labelAdreca.setAttribute('for', 'adreca');
  labelAdreca.textContent = 'Adreça:';
  divAdreca.appendChild(labelAdreca);
  const inputAdreca = document.createElement('input');
  inputAdreca.type = 'text';
  inputAdreca.id = 'adreca';
  inputAdreca.name = 'adreca';
  divAdreca.appendChild(inputAdreca);
  form.appendChild(divAdreca);

  const divButtons = document.createElement('div');
  const submitButton = document.createElement('button');
  submitButton.type = 'submit';
  submitButton.textContent = 'Envia';
  divButtons.appendChild(submitButton);

  const resetButton = document.createElement('button');
  resetButton.type = 'reset';
  resetButton.textContent = 'Reseteja';
  divButtons.appendChild(resetButton);

  form.appendChild(divButtons);

  document.body.appendChild(form);

  const styles = `
  form {
    width: 300px;
    margin: 50px auto;
    font-family: Arial, sans-serif;
  }
  h1 {
    font-size: 24px;
    margin-bottom: 20px;
  }
  label {
    display: block;
    margin-bottom: 5px;
  }
  input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  button {
    padding: 10px 15px;
    margin-right: 10px;
    background-color: #f0f0f0;
    border: 1px solid #ccc;
    cursor: pointer;
  }
  button:hover {
    background-color: #ddd;
  }
`;
  const styleSheet = document.createElement('style');
  styleSheet.type = 'text/css';
  styleSheet.innerText = styles;
  document.head.appendChild(styleSheet);

  const inputsIn = document.querySelectorAll('input');

  inputsIn.forEach(input => {
    input.addEventListener('change', (e) => {
      const {name, value} = e.target;
      localStorage.setItem(name, value);
    });
  });

  const inputsOut = document.querySelectorAll('input');

  inputsOut.forEach(input => {
    const valor = localStorage.getItem(input.name);
    if (valor) {
      input.value = valor;
    }
  });
}