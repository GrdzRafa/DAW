import { useContext, useCallback } from "react";
import React from "react";
import { ProductContext } from "../Contexts/ProductContext";
import { VisibleContext } from "../Contexts/VisibleContext";
import MemoizedCart from "./Cart";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

function CartIcon() {
  const { carreto, setCarreto } = useContext(ProductContext);
  const { cartVisible, setCartVisible } = useContext(VisibleContext);

  const handleShowCartProds = () => {
    if (carreto.length > 0) {
      setCartVisible(!cartVisible);
    }
  };

  const handleHideCart = useCallback(() =>{
    setCartVisible(cartVisible => !cartVisible);
  }, [])
  
  const handleClearCart = useCallback(() => {
    setCarreto([]);
  }, [setCarreto])

  return (
    <div>
      <FontAwesomeIcon
        icon="fa-solid fa-cart-shopping"
        onClick={handleShowCartProds}
      />
      {carreto.length}

      {cartVisible && <MemoizedCart onHideCart={handleHideCart} onClearCart={handleClearCart} />}
    </div>
  );
}
const MemoizedCartIcon = React.memo(CartIcon);
export default MemoizedCartIcon;
