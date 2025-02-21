import { useContext, useEffect, useState } from "react";
import React from "react";
import MemoizedProduct from "../Product/Product";
import MemoizedFiltres from "../Filtres/Filtres";
import styles from "./content.module.scss";
import { ProductContext } from "../Contexts/ProductContext";

function Content() {
  const [productes, setProductes] = useState([]);
  const { carreto, setCarreto } = useContext(ProductContext);
  const [filters, setFilters] = useState({});

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
        product[0].preuTotal = product[0].preu;
        setCarreto(() => [...carreto, product[0]]);
      }
    }
  };

  const cleanedFilters = {};
  Object.keys(filters).forEach((key) => {
    if (filters[key].length > 0) {
      cleanedFilters[key] = filters[key];
    }
  });

  // Filtra los productos en base a los filtros activos
  const filteredProducts = productes.filter((product) => {
    return Object.keys(cleanedFilters).every((categoria) =>
      cleanedFilters[categoria].some((valor) => product[categoria] === valor)
    );
  });

  return (
    <div>
      <MemoizedFiltres setFilters={setFilters} />
      <main id={styles.content} onClick={handleAddToCart}>
        {filteredProducts.map((producte) => (
          <MemoizedProduct producte={producte} key={producte.pid} />
        ))}
        {/* {productes.map((producte) => <MemoizedProduct producte={producte} key={producte.pid}/>)} */}
      </main>
    </div>
  );
}

const MemoizedContent = React.memo(Content);
export default MemoizedContent;
