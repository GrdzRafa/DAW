// import { useEffect, useState } from "react";

// export default function Filtres() {
//   const [filtres, setFiltres] = useState([]);

//   useEffect(() => {
//     fetch("http://localhost:5173/src/media/p3filtres.php", {
//             method: "POST",
//             body: JSON.stringify(filtres)
//         })
//       .then((response) => {
//         if (!response.ok) {
//           throw new Error(`Error a l'API: ${response.statusText}`);
//         }
//         return response.json();
//       })
//       .then((data) => {
//         console.log(filtres);
//         setFiltres(data);
//       })
//       .catch((error) => {
//         console.error("Error:", error);
//       });
//   }, [filtres]);
// }

import React, { useEffect, useState } from "react";
function Filtres({ setFilters }) {
  const [filtres, setFiltres] = useState({}); // Opciones de filtro

  useEffect(() => {
    fetch("http://localhost:5173/src/media/p3filtres.json")
      .then((res) => res.json())
      .then((data) => {
        if (data.length > 0) {
          setFiltres(data[0]); // Nos aseguramos de que sea un objeto válido
        }
      })
      .catch((error) => console.log("Error al cargar filtros:", error));
  }, []);

  const handleCheckboxChange = (categoria, valor) => {
    setFilters((prevFilters) => {
      const nuevaCopia = { ...prevFilters };

      if (!nuevaCopia[categoria]) {
        nuevaCopia[categoria] = [];
      }

      if (nuevaCopia[categoria].includes(valor)) {
        nuevaCopia[categoria] = nuevaCopia[categoria].filter((item) => item !== valor);
      } else {
        nuevaCopia[categoria].push(valor);
      }

      // Si la categoría queda vacía, la eliminamos con `delete`
      if (nuevaCopia[categoria].length === 0) {
        delete nuevaCopia[categoria];
      }

      return nuevaCopia;
    });
  };

  return (
    <aside>
      {Object.keys(filtres).map((categoria) => (
        <div key={categoria}>
          <h3>{categoria}</h3>
          {filtres[categoria].map((item, index) => {
            // Asegurar que siempre haya un valor
            const valor = item.nom || item.descripcio || item.capacitat || item.model || item.polzades || "Desconocido";
            return (
              <label key={`${categoria}-${index}`}>
                <input type="checkbox" onChange={() => handleCheckboxChange(categoria, valor)} />
                {valor}
              </label>
            );
          })}
        </div>
      ))}
    </aside>
  );
}

const MemoizedFiltres = React.memo(Filtres);
export default MemoizedFiltres;
