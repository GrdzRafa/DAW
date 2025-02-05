import { useContext, useEffect, useState } from "react";
import Product from "../Product/Product";
import styles from "./content.module.scss";
import  {ProductContext} from "../ProductContext/context";
export default function Content() {
  const [productes, setProductes] = useState([]);
  // const [data, setData] = useState();
  const {carreto, setCarreto} = useContext(ProductContext);
  
  useEffect(() => {
    fetch("http://localhost:5173/src/media/cataleg.json")
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Error a l'API: ${response.statusText}`);
        }
        return response.json();
      })
      .then((data) => {
        setProductes(data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });      
  }, []);

  const handleAddToCart = (e) => {
    e.stopPropagation();
    e.preventDefault();
    if (e.target.tagName == "BUTTON") {
      const attr = e.target.getAttribute("data-id");
      
      const cartProd = carreto.find((producte) => producte.pid == attr);
      
      if (!cartProd) {
        const product = productes.filter((producte) => producte.pid == attr);
        product[0].quantitat = 1;
        setCarreto(() => [...carreto, product[0]]);
      }
    }
  };

  return (
    <div id={styles.content} onClick={handleAddToCart}>
      {productes.map((producte) => <Product producte={producte} key={producte.pid}/>)}
    </div>  
  );
}
