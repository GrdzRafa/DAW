import React, { useContext } from "react";
import { ProductContext } from "../Contexts/ProductContext";
import { VisibleContext } from "../Contexts/VisibleContext";

function CartProd({ producte }) {
  const { carreto, setCarreto } = useContext(ProductContext);
  const { setCartVisible } = useContext(VisibleContext);

  const handleUpdatePrices = (e) => {
    const novaQuantitat = parseInt(e.target.value, 10);
    //creo una nova propietat per afegir el preuTotal al producte nou
    //que es crea per canviar els preus
    const updateCart = carreto
      .map((p) =>
        p.pid === producte.pid
          ? {
              ...p,
              quantitat: novaQuantitat,
              preuTotal: (p.preu * novaQuantitat).toFixed(2),
            }
          : p
      )
      .filter((p) => p.quantitat > 0);
    setCarreto(updateCart);
    if (updateCart.length === 0) {
      setCartVisible(false);
    }
  };

  return (
    <tr>
      <td className="cart__producte-id">{producte.pid}</td>
      <td className="cart__producte-img">
        <img src={"src/media/pccomp/" + producte.imatge} alt={producte.marca} />
      </td>
      <td className="cart__producte-marca">
        {producte.marca +
          " " +
          producte.model +
          "/" +
          producte.processador +
          "/" +
          producte.ram +
          "/ HD" +
          producte.emmagatzematge +
          "/" +
          producte.polzades}
      </td>
      <td className="cart__producte-quantitat">
        <input
          type="number"
          min="0"
          value={producte.quantitat}
          onChange={handleUpdatePrices}
        />
      </td>
      <td className="cart__producte-preu">{producte.preu}€</td>
      <td className="cart__producte-preu-total">
        {producte.preuTotal}€
      </td>
    </tr>
  );
}

const MemoizedCartProd = React.memo(CartProd);
export default MemoizedCartProd;
