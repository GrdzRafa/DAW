import { useContext } from "react";
import { ProductContext } from "../ProductContext/context";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import CarretoProd from "./CarretoProd";

function Carreto() {
  const { carreto } = useContext(ProductContext);

  const handleShowCartProds = () => {
    const cartProds = document.querySelector("#cart");
    // carreto.forEach((producte) => {
    //   <CarretoProd producte={producte} key={producte.pid} />;
    // });
    // let tbodyString = '';
    // cartProds.forEach((element) => {
    //   tbodyString+='<tr>';
    //   tbodyString+=`<td class="${headItem[0]}">${element[0]}</td>`;
    //   tbodyString+=`<td class="${headItem[1]}"><img src="img/${element[1]}" alt="${element[1]}"></td>`;
    //   tbodyString+=`<td class="${headItem[2]}">${element[2]}</td>`;
    //   tbodyString+=`<td class="${headItem[3]}"><input type="number" min="0" max="10" value="1"></td>`;
    //   tbodyString+=`<td class="${headItem[4]}">${element[3].toFixed(2)}</td>`;
    //   tbodyString+=`<td class="${headItem[5]}">${element[3].toFixed(2)}</td>`;
    //   tbodyString+='<td class="eliminar"><button>X</button></td>';
    //   tbodyString+='</tr>';
    // });

    if (cartProds.classList.contains("d-none")) {
      cartProds.classList.remove("d-none");
    } else{
      cartProds.classList.add("d-none");
    }
  };

  return (
    <div>
      <FontAwesomeIcon
        icon="fa-solid fa-cart-shopping"
        onClick={handleShowCartProds}
      />
      {carreto.length}
      <table className="d-none" id="cart">
        {carreto.forEach((producte) => {
          <CarretoProd producte={producte} key={producte.pid} />;
        })}
      </table>
    </div>
  );
}

export default Carreto;
