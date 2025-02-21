import { useContext } from "react";
import React from "react";
import { ProductContext } from "../Contexts/ProductContext";
import MemoizedButton from "../Buttons/Button";
import MemoizedCartProd from "./CartProd";

function Cart({ onHideCart, onClearCart }) {
  const { carreto } = useContext(ProductContext);

  var preuTotal = carreto.reduce((total, producte) => {
    return total + producte.preu * producte.quantitat;
  }, 0);

  preuTotal = preuTotal.toFixed(2);
  return (
    <div id="cart">
      <table>
        <thead>
          <tr>
            <th>Ref.</th>
            <th>Imatge</th>
            <th>Descripció</th>
            <th>Quantitat</th>
            <th>Preu</th>
            <th>Import</th>
          </tr>
        </thead>
        <tbody>
          {carreto.map((producte) => (
            <MemoizedCartProd producte={producte} key={producte.pid} />
          ))}
        </tbody>
      </table>
      <div id="cartFooter">
        <div className="cartBtns">
          <MemoizedButton className="green" onClick={onHideCart}>
            Seguir Comprant
          </MemoizedButton>
          <MemoizedButton
            className="red"
            onClick={() => {
              onHideCart();
              onClearCart();
            }}
          >
            Buidar Carretó
          </MemoizedButton>
        </div>
        <div id="preuTotal">Preu Total: {preuTotal} €</div>
      </div>
    </div>
  );
}
const MemoizedCart = React.memo(Cart);
export default MemoizedCart;
