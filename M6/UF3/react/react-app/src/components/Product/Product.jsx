import React from "react";
function Product(producte) {
  return (
    <div className="producte" id={producte.producte.id} key={producte.producte.pid}>
          <img
            key="producte-imatge"
            src={"src/media/pccomp/" + producte.producte.imatge}
            alt={producte.producte.marca}
            className="producte-imatge"
          />
          <div>
            <h2 className="producte-marca">{producte.producte.marca}</h2>
            <h3 className="producte-model">{producte.producte.model}</h3>
            <p className="producte-preu">Precio: {producte.producte.preu} €</p>
            <p className="producte-tipus">Tipo: {producte.producte.tipus}</p>
            <ul className="producte-especificacions">
              <li>Procesador: {producte.producte.processador}</li>
              <li>RAM: {producte.producte.ram}</li>
              <li>Gráfica: {producte.producte.gràfica}</li>
              <li>Pulgadas: {producte.producte.polzades}</li>
              <li>Almacenamiento: {producte.producte.emmagatzematge}</li>
            </ul>
            <p className="producte-valoracio">
              Valoración: {producte.producte.valoracio}
            </p>
            <p className="producte-stock">Stock: {producte.producte.stock}</p>
            <button data-id={producte.producte.pid} className="producte-enlace">
              Afegir al carretó
            </button>
          </div>
    </div>
  );
}

const MemoizedProduct = React.memo(Product);
export default MemoizedProduct
