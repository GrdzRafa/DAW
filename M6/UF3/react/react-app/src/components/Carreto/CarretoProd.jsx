function CarretoProd(producte) {
  return (
    <tr>
      <td className="cart__producte-id">{producte.id}</td>
      <td className="cart__producte-img">
        <img src={"src/media/pccomp/" + producte.imatge} alt={producte.marca} />
      </td>
      <td className="cart__producte-marca">{producte.marca}</td>
      <td className="cart__producte-model">{producte.model}</td>
      <td className="cart__producte-quantitat">
        <input type="number" min="0" max="10" value={producte.quantitat} />
      </td>
      <td className="cart__producte-preu">{producte.preu}</td>
      <td className="cart__producte-preu-total">
        {producte.preu * producte.quantitat}
      </td>
      <td className="eliminar">
        <button>X</button>
      </td>
    </tr>
  );
}

export default CarretoProd;
