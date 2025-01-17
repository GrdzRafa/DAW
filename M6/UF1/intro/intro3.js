
document.body.onload = addElement;

function addElement() {
  // 23. Mitjançant JavaScript crea un element HTML 
  //amb les mateixes característiques que el què es mostra. 
  //Al final elimina l'atribut id.
  const inputNou = document.createElement('input');

  inputNou.setAttribute('type', 'email');
  inputNou.setAttribute('name', 'email');
  inputNou.setAttribute('id', 'email');
  inputNou.setAttribute('class', 'form-element');
  inputNou.setAttribute('required', 'required');
  inputNou.setAttribute('placeholder', 'Please enter a valid email account');


  document.body.appendChild(inputNou);

  inputNou.removeAttribute('id');

  // 24. Crea un element <form> i afegeix 
  // l'<input> del punt anterior i un <button>
  const formNou = document.createElement('form');
  formNou.setAttribute('action', '#');
  formNou.setAttribute('method', 'post');
  formNou.setAttribute('id', 'user-data');
  formNou.setAttribute('name', 'user-data');
  formNou.setAttribute('novalidate', '');

  const botoNou = document.createElement('button');

  botoNou.setAttribute('type', 'submit');
  botoNou.setAttribute('id', 'send');

  botoNou.appendChild(document.createTextNode('Send'));
  formNou.appendChild(inputNou);
  formNou.appendChild(botoNou);
  document.body.appendChild(formNou);
  
  //25. Crea un menú a partir dels valors d'un array
  const menu = ['home','about','products','contact'];
  
  const navNou = document.createElement('nav');
  navNou.setAttribute('class', 'menu');

  const UlNou = document.createElement('ul');

  for (let i = 0; i < menu.length; i++) {
    const novaLI = document.createElement('li');
    const nouA = document.createElement('a');
    nouA.setAttribute('href', menu[i]+'.html');
    nouA.appendChild(document.createTextNode(menu[i] = menu[i].charAt(0).toUpperCase() + menu[i].slice(1)));
    novaLI.appendChild(nouA);
    UlNou.appendChild(novaLI);
  }

  navNou.appendChild(UlNou);
  document.body.appendChild(navNou);
}



